<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class NewMasterstock extends MY_Controller {

	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
			redirect('/login');
		}
		$this->load->model('General_model');
		$this->load->model('Masterstock_model');
		$this->load->model('NewMasterstock_model');
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
	}

	public function index(){
		$uid = $this->session->userdata('id');
		$template['newmasterstock'] = $this->NewMasterstock_model->getNewMasterStock();
		$template['body'] = 'newMasterstock/list';
		$template['script'] = 'newMasterstock/script';
		$this->load->view('template', $template);
	}

	public function __destruct(){
		if(isset($this->result)){
			echo json_encode($this->result);
		}
	}


}
?>
