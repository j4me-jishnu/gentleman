<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enquiry extends MY_Controller {
	public $enquiry_table = 'enquiry';
	public $customer_table = 'customer';
	public $page  = 'enquiry';
	public function __construct() {
		parent::__construct();
        // if(! $this->is_logged_in()){
        //     redirect('/login');
        // }
        
	$this->load->model('General_model');
	}
	public function index()
	{
		$template['body'] = 'Enquiry/list';
		$template['script'] = 'Enquiry/script';
		$this->load->view('template', $template);
	}
	public function add(){

		$this->form_validation->set_rules('customer_email', 'Email', 'valid_email');
        $this->form_validation->set_rules('customer_name', 'Name', 'required');
        
        if ($this->form_validation->run() == FALSE) {
        	$template['enquiry_type'] = $this->config->item('enquiry_type');
            $template['body'] = 'Enquiry/add';
			$template['script'] = 'Enquiry/script';
			$this->load->view('template', $template);
        } else {
        	$customer_data = array(
                        'customer_name' => $this->input->post('customer_name'),
                        'customer_address' => $this->input->post('customer_address'),
                        'customer_phone' => $this->input->post('customer_phone'),
                        'customer_sec_phone' => $this->input->post('customer_sec_phone'),
                        'customer_email' => $this->input->post('customer_email'),
                        'customer_status' => 1
                        );
        	$customer_type  = $this->input->post('customer_type');
        	if($customer_type === 'O'){
        		$customer_id = $this->input->post('customer_id');
        	}
        	else{
        		$customer_id = $this->General_model->add_returnID($this->customer_table,$customer_data);
        	}
	        
	        if($customer_id){
	        	$date = str_replace('/', '-', $this->input->post('date'));
                $date =  date("Y-m-d",strtotime($date));

	        	$enquiry_data = array(
	        					'customer_id_fk' => $customer_id,
	        					'date' => $date,
	        					// 'current_date' => date("Y-m-d h:i:sa"),
	        					'customer_type' => $customer_type,
	        					'type' => $this->input->post('type'),
	        					'details' => $this->input->post('details'),
	        					'status' => 1

	        					);

	            
	            $result = $this->General_model->add($this->enquiry_table,$enquiry_data);
	            $response_text = 'Enquiry details added successfully';
	          
	        }
	        if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
	        }
	        else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
	        }
	        redirect('/enquiry/', 'refresh');
	    }
	}

	public function get(){
		$this->load->model('Enquiry_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
    	$data = $this->Enquiry_model->getEnquiryTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
}
