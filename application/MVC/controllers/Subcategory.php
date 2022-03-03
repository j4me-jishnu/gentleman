<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Subcategory extends MY_Controller {
	public $table = 'subcategory';
	public $page  = 'Subcategory';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
            redirect('/login');
        }
        
        $this->load->model('General_model');
        $this->load->model('Category_model');
        $this->load->model('Subcategory_model');
	}
	public function index()
	{
		$template['body'] = 'Subcategory/list';
		$template['script'] = 'Subcategory/script';
		$this->load->view('template', $template);
	}
	public function add(){
		$template['category'] = $this->Category_model->view_byname();
		// print_r($template);
		// exit();
		$this->form_validation->set_rules('subcategory_name', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['enquiry_type'] = $this->config->item('enquiry_type');
                        $template['body'] = 'Subcategory/add';
			$template['script'] = 'Subcategory/script';
			$this->load->view('template', $template);
		}
		else {
                        $category_id = $this->input->post('category_id_fk');
                        //print_r($category_id);
                        //exit();
			$data = array(
						'category_id_fk' => $this->input->post('category_id_fk'),
						'subcategory_name' => $this->input->post('subcategory_name'),
						'subcategory_remarks' => $this->input->post('subcategory_remarks'),
						'subcategory_status' => 1
						);
						$subcategory_id = $this->input->post('subcategory_id');
				if($subcategory_id){
					 
                     $data['subcategory_id'] = $subcategory_id;
                     $result = $this->General_model->update($this->table,$data,'subcategory_id',$subcategory_id);
                     $response_text = 'Subcategory  updated successfully';
                }
				else{
                     $result = $this->General_model->add($this->table,$data);
                     $response_text = 'Subcategory added  successfully';
                }
				if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
	        redirect('/subcategory/', 'refresh');
		}
	}
	public function newsubcategory()
	{
        $newsubcategorydata = array(
                        'category_id_fk' => $this->input->post('categoryidfk'),
                        'subcategory_name' => $this->input->post('subCategory_name'),
                        'subcategory_remarks' => $this->input->post('subCategory_desc'),
                        'subcategory_status' => 1
                        );
        $this->General_model->add($this->table,$newsubcategorydata);
        $insert_id = $this->db->insert_id();
        $data = $this->Subcategory_model->getlast($insert_id);
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
		$this->load->model('Subcategory_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
    	$data = $this->Subcategory_model->getSubCategoryTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function delete(){
        $subcategory_id = $this->input->post('subcategory_id');
        $updateData = array('subcategory_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'subcategory_id',$subcategory_id);
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
	public function edit($subcategory_id){
		$template['body'] = 'Subcategory/add';
		$template['script'] = 'Subcategory/script';
		$template['category'] = $this->Category_model->view_byname();
		$template['records'] = $this->General_model->get_row($this->table,'subcategory_id',$subcategory_id);
    	$this->load->view('template', $template);
		//print_r($template);
		//exit();
		
	}
	
	
}