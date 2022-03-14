<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends MY_Controller {

	private $params;
	private $result;
	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
			redirect('/login');
		}
		$this->load->model('General_model');
		$this->load->model('Masterstock_model');
		$this->load->model('NewMasterstock_model');
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
		date_default_timezone_set("Asia/Kolkata");
	}

// to get opening stock of a particular branch, even master
	public function getOpeningStockDetails(){
	}


	public function addOpeningStock()
	{
		$template['body'] = 'Opening_stock/list';
		$template['script'] = 'Opening_stock/script';
		$this->load->view('template',$template);
	}

	public function addOS()
	{
		print_r($_POST);die;	
	}
}
?>
