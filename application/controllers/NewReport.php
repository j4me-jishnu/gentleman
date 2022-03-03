<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class NewReport extends MY_Controller {
	private $branch_name;
	private $branch_id;
	private $params;
	private $result;

	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
			redirect('/login');
		}
		$this->load->model('General_model');
		$this->load->model('NewReport_model');
		$this->load->model('NewCommonModel');
		if(isset($_POST)){
			$this->params=$_POST;
		}
		if(isset($_REQUEST)){
		  $this->param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
		  $this->param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
		  $this->param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
		  $this->param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
		  $this->param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
		  $this->param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
		}

		if(!empty($this->session->userdata('user_branch'))){
			$this->branch_name=$this->session->userdata('user_branch');
			$this->branch_id=$this->NewCommonModel->getBranchID($this->branch_name);
		}
	}


	///////////////Stock Report//////////////////////

    public function showPurcahseReport()
    {
        $template['body']='NewReport/PurchaseReport/list';
        $template['script']='NewReport/PurchaseReport/script';
        $this->load->view('template',$template);
    }

	public function getPurchaseReport()
	{
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

		$this->result = $this->NewReport_model->getPurchaseReportList($param);
	}

	public function __destruct(){
		if(isset($this->result)){
			echo json_encode($this->result);
		}
	}
}
?>
