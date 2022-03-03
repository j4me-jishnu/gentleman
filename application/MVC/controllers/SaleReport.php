
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SaleReport extends MY_Controller {
	public $table = 'sale_details';
	public $table1 = 'product_details';
	public $page  = 'Sale';
	public $stock_table  = 'stock_details';
        public $tax_table ='tax_class';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
            redirect('/login');
        }
        
        $this->load->model('General_model');
        $this->load->model('ProductDetails_model');
        $this->load->model('Sale_model');
		$this->currentuserid = $this->session->userdata('id');
        $this->currentusertype = $this->session->userdata('admin_type');
	}
	public function index()
	{
		$template['body'] = 'Sale/Report';
		$template['script'] = 'Sale/scriptreport';
		
		$this->load->view('template', $template);
	}
	
	
	public function get(){
		$this->load->model('Sale_model');
		//$param['user_id'] = $this->currentuserid;	
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
		
		$param['sale_invoice_number'] =(isset($_REQUEST['sale_invoice_number']))?$_REQUEST['sale_invoice_number']:'';
                $param['sale_totalPrice'] =(isset($_REQUEST['sale_totalPrice']))?$_REQUEST['sale_totalPrice']:'';
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
    	$data = $this->Sale_model->getSaleReport($param);
		
    	$json_data = json_encode($data);
    	echo $json_data;
    }	
}
