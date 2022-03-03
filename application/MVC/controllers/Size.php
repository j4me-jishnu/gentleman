<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Size extends MY_Controller {
	public $table = 'size';
	public $page  = 'Size';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
           redirect('/login');
        }
        
        $this->load->model('General_model');
        $this->load->model('Size_model');
	}
	public function index()
	{
		$template['body'] = 'Size/list';
		$template['script'] = 'Size/script';
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('size_name', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['enquiry_type'] = $this->config->item('enquiry_type');
            $template['body'] = 'Size/add';
			$template['script'] = 'Size/script';
			$this->load->view('template', $template);
		}
		else {
			$data = array(
						'size_name' => $this->input->post('size_name'),
						'size_description' => $this->input->post('size_description'),
						'size_status' => 1
						);
						$size_id = $this->input->post('size_id');
				if($size_id){
					 
                     $data['size_id'] = $size_id;
                     $result = $this->General_model->update($this->table,$data,'size_id',$size_id);
                     $response_text = 'Size  updated successfully';
                }
				else{
                     $result = $this->General_model->add($this->table,$data);
                     $response_text = 'Size added  successfully';
                }
				if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
	        redirect('/size/', 'refresh');
		}
	}
	public function newSize()
	{
		$newsizedata = array(
				'size_name' => $this->input->post('size'),
				'size_description' => $this->input->post('size_remarks'),
				'size_status' => 1
				);
	$data = $this->General_model->add($this->table,$newsizedata);
        $insert_id = $this->db->insert_id();
        $data = $this->Size_model->getlast($insert_id);
        echo json_encode($data);
//		if($data) {
//            $response['text'] = 'Size Added successfully';
//            $response['type'] = 'success';
//        }
//        else{
//            $response['text'] = 'Something went wrong';
//            $response['type'] = 'error';
//        }
	}
	public function get(){
		$this->load->model('Size_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
    	$data = $this->Size_model->getSizeTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function delete(){
        $size_id = $this->input->post('size_id');
        $updateData = array('size_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'size_id',$size_id);
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
		redirect('/category/', 'refresh');
    }
	public function edit($size_id){
		$template['body'] = 'Size/add';
		$template['script'] = 'Size/script';
		$template['records'] = $this->General_model->get_row($this->table,'size_id',$size_id);
    	$this->load->view('template', $template);
		//print_r($template);
		//exit();
		
	}
}