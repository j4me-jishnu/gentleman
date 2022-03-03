<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends MY_Controller {
	public $table = 'product_details';
	public $page  = 'Product';
	public $stock_table = 'stock_details';
	public function __construct() {
		parent::__construct();
         if(! $this->is_logged_in()){
            redirect('/login');
        }
        
        $this->load->model('General_model');
        $this->load->model('Category_model');
        $this->load->model('Size_model');
		$this->load->model('Product_model');
        $this->load->model('Color_model');
	}
	public function index()
	{
		$template['body'] = 'Product/list';
		$template['script'] = 'Product/script';
		$template['category_names'] = $this->Category_model->view_by();
		$this->load->view('template', $template);
	}
	public function add(){
		$template['category_names'] = $this->Category_model->view_by();
		$template['size'] = $this->Size_model->view_by();
		$template['color'] = $this->Color_model->view_by();
		// print_r($template);
		// exit();
		$this->form_validation->set_rules('product_name', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['enquiry_type'] = $this->config->item('enquiry_type');
            $template['body'] = 'Product/add';
			$template['script'] = 'Product/script';
			$this->load->view('template', $template);
		}
		else {
			$this->load->helper('date');
			$date = date('Y-m-d h:i:sa');
			$data = array(
						'category_id_fk' => $this->input->post('category_id'),
						'subcategory_id_fk' => $this->input->post('subcategory_id'),
						'color_id_fk' => $this->input->post('color_id_fk'),
						'size_id_fk' => $this->input->post('size_id_fk'),
						'product_name' => $this->input->post('product_name'),
						'product_reorderqty' => $this->input->post('product_reorderqty'),
						'product_brand' => $this->input->post('product_brand'),
						'product_description' => $this->input->post('product_description'),
						'product_created_date' => $date,
						'product_status' => 1
						);
						$product_id = $this->input->post('product_id');
				if($product_id){
					 
                     $data['product_id'] = $product_id;
                     $result = $this->General_model->update($this->table,$data,'product_id',$product_id);
                     $response_text = 'Product Details updated successfully';
                }
				else{
                     $product_id = $this->General_model->add_returnID($this->table,$data);
                     $result='';
                     if($product_id){
                        $stock_data = array(
                                            'product_id_fk' => $product_id,
                                            'purchase_quantity' => 0 ,
                                            'sale_quantity' => 0 ,
                                            'created_date' => date('Y-m-d h:i:s'),
                                            'updated_date' => date('Y-m-d h:i:s'),
                                            'stock_status' => 1
                                            );
                        $result = $this->General_model->add($this->stock_table,$stock_data);
                     }
                     $response_text = 'Product details added  successfully';
                 }
				if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
	        redirect('/product/', 'refresh');
		}
	}
	public function get(){
		$this->load->model('Product_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$param['product_name'] =(isset($_REQUEST['product_name']))?$_REQUEST['product_name']:'';
        $param['category_name'] =(isset($_REQUEST['category_name']))?$_REQUEST['category_name']:'';
        $param['subcategory_name'] =(isset($_REQUEST['subcategory_name']))?$_REQUEST['subcategory_name']:'';
        $param['size_name'] =(isset($_REQUEST['size_name']))?$_REQUEST['size_name']:'';
        $param['color_name'] =(isset($_REQUEST['color_name']))?$_REQUEST['color_name']:'';
		
    	$data = $this->Product_model->getProductReport($param);
		// print_r($data);
		// exit();
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function delete(){
        $product_id = $this->input->post('product_id');
        $updateData = array('product_status' => 0);
		$updatestock = array('stock_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'product_id',$product_id);
        $data = $this->General_model->update($this->stock_table,$updatestock,'product_id_fk',$product_id);
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
	public function edit($product_id){
		$template['body'] = 'Product/add';
		$template['category_names'] = $this->Category_model->view_by();
		$template['color'] = $this->Color_model->view_by();
		$template['script'] = 'Product/script';
		$template['size'] = $this->Size_model->view_by();
		//$template['category'] = $this->Category_model->view_by();
		$template['records'] = $this->Product_model->get_row($product_id);
    	$this->load->view('template', $template);
		//print_r($temp);
		//exit();
		
	}
	public function subcategory($category_name){
 
		header('Content-Type: application/x-json; charset=utf-8');
		
		$result = $this->Product_model->subcategory($category_name);
		//print_r($result);
		//exit();
		echo json_encode($result);
		
		
	}
}