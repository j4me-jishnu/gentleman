<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Category extends MY_Controller {
	public $table = 'category';
	public $page  = 'Category';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->load->model('General_model');
        $this->load->model('Category_model');
	}
	public function index()
	{
		$template['body'] = 'Category/list';
		$template['script'] = 'Category/script';
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('category_name', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['enquiry_type'] = $this->config->item('enquiry_type');
            $template['body'] = 'Category/add';
			$template['script'] = 'Category/script';
			$this->load->view('template', $template);
		}
		else {
			$data = array(
						'category_name' => $this->input->post('category_name'),
						'category_description' => $this->input->post('category_description'),
						'category_status' => 1
						);
						$category_id = $this->input->post('category_id');
				if($category_id){
					 
                     $data['category_id'] = $category_id;
                     $result = $this->General_model->update($this->table,$data,'category_id',$category_id);
                     $response_text = 'Category  updated successfully';
                }
				else{
                     $result = $this->General_model->add($this->table,$data);
                     $response_text = 'Category added  successfully';
                }
				if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
	        redirect('/category/', 'refresh');
		}
	}
	public function newcategory()
	{
        $newcategorydata = array(
                        'category_name' => $this->input->post('Category_name'),
                        'category_description' => $this->input->post('Category_desc'),
                        'category_status' => 1
                        );
        $this->General_model->add($this->table,$newcategorydata);
        $insert_id = $this->db->insert_id();
        $data = $this->Category_model->getlast($insert_id);
        echo json_encode($data);
       
//	if($data) {
//            $response['text'] = 'Category Added successfully';
//            $response['type'] = 'success';
//        }
//        else{
//            $response['text'] = 'Something went wrong';
//            $response['type'] = 'error';
//        }
	}
	public function get(){
		$this->load->model('Category_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
    	$data = $this->Category_model->getCategoryTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function delete(){
        $category_id = $this->input->post('category_id');
        $updateData = array('category_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'category_id',$category_id);
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
	public function edit($category_id){
		$template['body'] = 'Category/add';
		$template['script'] = 'Category/script';
		$template['records'] = $this->General_model->get_row($this->table,'category_id',$category_id);
    	$this->load->view('template', $template);
		//print_r($template);
		//exit();
		
	}
}