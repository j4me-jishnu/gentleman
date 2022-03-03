<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class OldStock extends MY_Controller {
	//public $table = 'sale_details';
	//public $table1 = 'product_details';
	public $page  = 'OldStock';
	//public $stock_table  = 'stock_details';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        //$this->load->model('General_model');
        //$this->load->model('Product_model');
       // $this->load->model('Sale_model');
        //$this->load->model('Purchase_model');
        //$this->load->model('Stock_model');
        $this->load->model('OldStock_model');
	}
	public function index()
	{
		//$template['total_sale'] = $this->Sale_model->gettotal_sale();
		//$template['total_purchase'] = $this->Purchase_model->gettotal_purchase();
		//$template['product_count'] = $this->Product_model->getcount_product();
		//$template['purchase_details'] = $this->Purchase_model->getpurchase_details();
		//$template['sale_details'] = $this->Sale_model->getsale_details();
		//$template['old_stock'] = $this->Stock_model->getold_stock();
		$template['body'] = 'OldStock/list';
		$template['script'] = 'OldStock/script';
		
		$this->load->view('template', $template);
	}
	public function get(){
		$this->load->model('OldStock_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$param['product_name'] =(isset($_REQUEST['product_name']))?$_REQUEST['product_name']:'';
        
		
    	$data = $this->OldStock_model->getoldstock($param);
    	$json_data = json_encode($data);
    	echo $json_data;
			// print_r($data);
			// exit();
    }
}