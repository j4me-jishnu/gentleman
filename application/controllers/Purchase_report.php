<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Purchase_report extends MY_Controller {
	public $table = ' tbl_apurchase';
	public $page  = 'branch_conception_report';
	public function __construct() {
		parent::__construct();
       if(! $this->is_logged_in()){
            redirect('/login');
        }
        
        $this->load->model('General_model');
		$this->load->model('Purchase_report_model');
		$this->load->model('Users_model');
    }
	public function index()
	{
		
		$template['body'] = 'Purchase_report/list';
		$template['script'] = 'Purchase_report/script';
		$this->load->view('template', $template);
	}
	public function get(){
		
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
		$param['user_branch'] = (isset($_REQUEST['user_branch']))?$_REQUEST['user_branch']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
       
		$start_date = (isset($_REQUEST['start_date']))?$_REQUEST['start_date']:'';
		$end_date = (isset($_REQUEST['end_date']))?$_REQUEST['end_date']:'';
    	if($start_date){
			$start_date = str_replace('/', '-', $start_date);
			$param['start_date'] =  date("Y-m-d",strtotime($start_date));
		}
		if($end_date){
			$end_date = str_replace('/', '-', $end_date);
			$param['end_date'] =  date("Y-m-d",strtotime($end_date));
		}
		$data = $this->Purchase_report_model->getTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    	
    }
}