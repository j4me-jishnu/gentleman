<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Branch_report extends MY_Controller {
	public $table = ' tbl_branch';
	public $page  = 'branch_conception_report';
	public function __construct() {
		parent::__construct();
       if(! $this->is_logged_in()){
            redirect('/login');
        }
        
        $this->load->model('General_model');
		$this->load->model('Branch_report_model');
		$this->load->model('Purchase_model');
		$this->load->model('Users_model');
    }
	public function index()
	{
		$template['branch'] = $this->Users_model->get_branch();
		$template['body'] = 'Branch_report/list';
		$template['script'] = 'Branch_report/script';
		$this->load->view('template', $template);
	}
	public function get(){
		$template['refno'] = $this->Purchase_model->Refno();
		$branch_id = $template['refno'][0]->branch_id;
		
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$param['user_branch'] = (isset($_REQUEST['user_branch']))?$_REQUEST['user_branch']:'';
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
		$data = $this->Branch_report_model->getbranchCrTable($param,$branch_id);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
}