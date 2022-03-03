<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Color extends MY_Controller {
	public $table = 'color_details';
	public $page  = 'color';
	public function __construct() {
		parent::__construct();
       if(! $this->is_logged_in()){
            redirect('/login');
        }
        
        $this->load->model('General_model');
        $this->load->model('Color_model');
	}
	public function index()
	{
		$template['body'] = 'Color/list';
		$template['script'] = 'Color/script';
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('color_name', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['enquiry_type'] = $this->config->item('enquiry_type');
            $template['body'] = 'Color/add';
			$template['script'] = 'Color/script';
			$this->load->view('template', $template);
		}
		else {
			$data = array(
						'color_name' => $this->input->post('color_name'),
						'color_remarks' => $this->input->post('color_remarks'),
						'color_status' => 1
						);
						$color_id = $this->input->post('color_id');
				if($color_id){
					 
                     $data['color_id'] = $color_id;
                     $result = $this->General_model->update($this->table,$data,'color_id',$color_id);
                     $response_text = 'Color  updated successfully';
                }
				else{
                     $result = $this->General_model->add($this->table,$data);
                     $response_text = 'Color added  successfully';
                }
				if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
	        redirect('/color/', 'refresh');
		}
	}
	public function newclour()
	{
            $newclourdata = array(
                    'color_name' => $this->input->post('color_name'),
                    'color_remarks' => $this->input->post('remarks'),
                    'color_status' => 1
                    );
            $data = $this->General_model->add($this->table,$newclourdata);
            $insert_id = $this->db->insert_id();
            $data = $this->Color_model->getlast($insert_id);
            echo json_encode($data);            
//		if($data) {
//            $response['text'] = 'Colour Added successfully';
//            $response['type'] = 'success';
//        }
//        else{
//            $response['text'] = 'Something went wrong';
//            $response['type'] = 'error';
//        }
	}
	public function get(){
		$this->load->model('Color_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
    	$data = $this->Color_model->getColorTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function delete(){
        $color_id = $this->input->post('color_id');
        $updateData = array('color_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'color_id',$color_id);
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
		redirect('/color/', 'refresh');
    }
	public function edit($color_id){
		$template['body'] = 'Color/add';
		$template['script'] = 'Color/script';
		$template['records'] = $this->General_model->get_row($this->table,'color_id',$color_id);
    	$this->load->view('template', $template);
		//print_r($template);
		//exit();
		
	}
}