<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tax extends MY_Controller {
	public $table = 'tax_class';
	//public $customer_table = 'customer';
	public $page  = 'Tax';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
            redirect('/login');
        }
        $this->currentuserid = $this->session->userdata('id');
        $this->currentusertype = $this->session->userdata('admin_type');
        $this->load->model('General_model');
        //$this->load->model('Employee_model');
	}
	public function index()
	{
		$user_id = $this->currentuserid;
                $template['currentusertype'] = $this->currentusertype;
                $template['admin_data'] = $this->General_model->admin_data($user_id);
                $template['body'] = 'Tax/list';
		$template['script'] = 'Tax/script';
		$this->load->view('template', $template);
	}
	public function add(){

		
        $this->form_validation->set_rules('tax_name', 'Name', 'required');
        
        if ($this->form_validation->run() == FALSE) {
                        $template['enquiry_type'] = $this->config->item('enquiry_type');
                        $user_id = $this->currentuserid;
                        $template['currentusertype'] = $this->currentusertype;
                        $template['admin_data'] = $this->General_model->admin_data($user_id);
                        $template['body'] = 'Tax/add';
			$template['script'] = 'Tax/script';
			$this->load->view('template', $template);
        } else {
        	$data = array(
                        'tax_name' => $this->input->post('tax_name'),
                        'tax_type' => $this->input->post('tax_type'),
                        'tax_amount' => $this->input->post('tax_amount'),
                        'tax_description' => $this->input->post('tax_description'),
                        'tax_status' => 1
                        );
                    $tax_id = $this->input->post('tax_id');
                    if($tax_id){
					 
                     $data['tax_id'] = $tax_id;
                     $result = $this->General_model->update($this->table,$data,'tax_id',$tax_id);
                     $response_text = 'Tax Details updated successfully';
                }
				else{
                     $result = $this->General_model->add($this->table,$data);
                     $response_text = 'Tax Details added  successfully';
                }
	        if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
	        }
	        else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
	        }
	        redirect('/Tax/', 'refresh');
	    }
	}
	public function get(){
        $param['user_id'] = $this->currentuserid;
        $this->load->model('Tax_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
    	$data = $this->Tax_model->getTax($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function edit($tax_id){
		$template['body'] = 'tax/add';
		$template['script'] = 'tax/script';
                $user_id = $this->currentuserid;
                $template['currentusertype'] = $this->currentusertype;
                $template['admin_data'] = $this->General_model->admin_data($user_id);
		$template['records'] = $this->General_model->get_row($this->table,'tax_id',$tax_id);
    	$this->load->view('template', $template);
		//print_r($template);
		//exit();
	}
	public function delete(){
        $tax_id = $this->input->post('tax_id');
        $updateData = array('tax_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'tax_id',$tax_id);
        if($data) {
            $response['text'] = 'Deleted successfully';
            $response['type'] = 'success';
        }
        else{
            $response['text'] = 'Something went wrong';
            $response['type'] = 'error';
        }
        $response['layout'] = 'topRight';
        $data_json = json_encode($response);
        echo $data_json;
		redirect('/Tax/', 'refresh');
    }
}
