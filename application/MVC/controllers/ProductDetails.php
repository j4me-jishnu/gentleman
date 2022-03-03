 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductDetails extends MY_Controller {
	public $table = 'product_details';
	public $stock_table ="stock_details";
	//public $customer_table = 'customer';
	public $page  = 'ProductDetails';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
            redirect('/login');
        }
        $this->currentuserid = $this->session->userdata('id');
        $this->currentusertype = $this->session->userdata('admin_type');
        $this->load->model('General_model');
        $this->load->model('ProductCategory_model');
        $this->load->model('ProductDetails_model');
		$this->load->model('Size_model');
		$this->load->model('Color_model');
	}
	public function index()
	{
                $user_id = $this->currentuserid;
                $template['currentusertype'] = $this->currentusertype;
                $template['admin_data'] = $this->General_model->admin_data($user_id);
		$template['body'] = 'ProductDetails/list';
		$template['script'] = 'ProductDetails/script';
		$this->load->view('template', $template);
	}
	public function add(){

		//$template['category'] = $this->ProductCategory_model->getcategory();
		//
		//;
        $this->form_validation->set_rules('product_name', 'Name', 'required');
        
        if ($this->form_validation->run() == FALSE) {
                        $user_id = $this->currentuserid;
                        $template['currentusertype'] = $this->currentusertype;
                        $template['admin_data'] = $this->General_model->admin_data($user_id);
                        $template['enquiry_type'] = $this->config->item('enquiry_type');
			$template['category'] = $this->ProductDetails_model->view_by();
                        
			//$template['color'] = $this->Color_model->view_by();
			//$template['size'] = $this->Size_model->view_by();
                        $template['body'] = 'ProductDetails/add';
			$template['script'] = 'ProductDetails/script';
			$this->load->view('template', $template);
			//print_r($template);
			//exit;
        } else {
			$this->load->helper('date');
			$date = date('Y-m-d h:i:sa');
			//$reorder_quantity = $this->input->post('reorder_quantity');
			$category = $this->input->post('category_id');
                        $subcategory = $this->input->post('subcategory_id');
			//print_r($subcategory);
                        //exit();
			
                       
                        //$customer_id = $this->input->post('customer_id');
                        //if($customer_id==null)
                        //{
                            //$customer_id=0;
                       // }
                        //PRINT_R($customer_id);
                        
                        
                        //if($customer_id == null){
                           // $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Please Select Product Name from dropdown&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
                           // redirect('/ProductDetails/add', 'refresh');
                       // }
                        
			//print_r($reorder_quantity);
			//exit();
        	$data = array(
                        'product_name' => $this->input->post('product_name'),
                        'category_id_fk' => $category,
                        'subcategory_id_fk' => $this->input->post('subcategory_id'),
			//'color_id_fk' => $this->input->post('color_id_fk'),
                        //'size_id_fk' => $this->input->post('size_id_fk'),
                        'sale_amount' => $this->input->post('sale_amount'),
                        //'product_sku' => $this->input->post('product_sku'),
                        //'product_measurement' => $this->input->post('product_measurement'),
                        //'reorder_quantity' => $this->input->post('reorder_quantity'),
			//'product_brand' => $this->input->post('product_brand'),
                        //'customer_name' => $this->input->post('customer_name'),
                        'product_description' => $this->input->post('product_description'),
                        'product_created_date' => $date,
                        'product_status' => 1
                        );
						
			$product_id = $this->input->post('product_id');
			if($product_id){
			$data['product_id'] = $product_id;
                        $result = $this->General_model->update($this->table,$data,'product_id',$product_id);
                     $response_text = 'Service Details updated successfully';
                }
				else{
                     $result = $this->General_model->add($this->table,$data);
                     $response_text = 'Service Details added  successfully';
                }
	        if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
	        }
	        else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
	        }
	        redirect('/ProductDetails/', 'refresh');
	    }
	}
	public function get(){
        $param['user_id'] = $this->currentuserid;
	$this->load->model('ProductDetails_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        $param['product_name'] =(isset($_REQUEST['product_name']))?$_REQUEST['product_name']:'';
        $param['category_name'] =(isset($_REQUEST['category_name']))?$_REQUEST['category_name']:'';
    	$data = $this->ProductDetails_model->getProductTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function edit($product_id){
                $user_id = $this->currentuserid;
                $template['currentusertype'] = $this->currentusertype;
                $template['admin_data'] = $this->General_model->admin_data($user_id);
		$template['body'] = 'ProductDetails/add';
		$template['script'] = 'ProductDetails/script';
		$template['records'] = $this->General_model->get_row($this->table,'product_id',$product_id);
    	        $template['category'] = $this->ProductDetails_model->view_by();
                $category_id = $template['records']->category_id_fk;
                $template['subcategory'] = $this->ProductDetails_model->viewsub_by($category_id);
		$this->load->view('template', $template);
		//print_r($template);
		//exit();
	}
	public function delete(){
        $product_id = $this->input->post('product_id');
        $updateData = array('product_status' => 2);
        $data = $this->General_model->update($this->table,$updateData,'product_id',$product_id);
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
		redirect('/ProductDetails/', 'refresh');
    }
    public function getCustomerNameList(){
        $customer_name = ($this->input->get('searchTerm'))?$this->input->get('searchTerm'):'';
        $result = $this->ProductDetails_model->lookupcustomer($customer_name);
        $json = json_encode($result);
        echo $json;
    }
	public function subcategory($category_name){
 
		header('Content-Type: application/x-json; charset=utf-8');
		
		$result = $this->ProductDetails_model->subcategory($category_name);
		//print_r($result);
		//exit();
		echo json_encode($result);
		
		
	}
}
