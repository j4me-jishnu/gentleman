<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PurchaseReport extends MY_Controller {
	public $table = 'purchase_details';
	public $page  = 'Purchase';
	public $stock_table = 'stock_details';
        public $tax_table ='tax_class';
        public $vendor_table = 'vendor';
	public function __construct() {
		parent::__construct();
        // if(! $this->is_logged_in()){
        //     redirect('/login');
        // }
        
        $this->load->model('General_model');
        $this->load->model('Product_model');
        $this->load->model('Purchase_model');
        $this->load->model('Size_model');
        $this->load->model('Color_model');
        $this->load->model('Sale_model');
		
	}
	public function index()
	{
		$template['body'] = 'Purchase/reports';
		$template['script'] = 'Purchase/scriptreports';
		$this->load->view('template', $template);
	}
	
	
	public function get(){
		$this->load->model('Purchase_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
	$param['purchase_invoice_no'] =(isset($_REQUEST['purchase_invoice_no']))?$_REQUEST['purchase_invoice_no']:'';
        $param['vendor_name'] =(isset($_REQUEST['vendor_name']))?$_REQUEST['vendor_name']:'';
        $start_date =(isset($_REQUEST['start_date']))?$_REQUEST['start_date']:'';
        $end_date =(isset($_REQUEST['end_date']))?$_REQUEST['end_date']:'';
		if($start_date){
            $start_date = str_replace('/', '-', $start_date);
            $param['start_date'] =  date("Y-m-d",strtotime($start_date));
        }
       
        if($end_date){
            $end_date = str_replace('/', '-', $end_date);
            $param['end_date'] =  date("Y-m-d",strtotime($end_date));
        }
		
    	$data = $this->Purchase_model->getPurchaseReport($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	
}