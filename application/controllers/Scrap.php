<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Scrap extends MY_Controller {
	public $table = 'tbl_user';
	public $tbl_login = 'tbl_login';
	public $page  = 'users';
	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
			redirect('/login');
		}
		$this->load->model('Scrap_model');
	}
	public function index(){
		$template['body'] = 'Scrap/list';
		$template['script'] = 'Scrap/script';
		$this->load->view('template', $template);
	}
	public function getScrap(){
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
		$param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
		$param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
		$param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
		$param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
		$param['item_name'] = (isset($_REQUEST['item_name']))?$_REQUEST['item_name']:'';
		$param['idate'] = (isset($_REQUEST['idate']))?$_REQUEST['idate']:'';
		$param['fdate'] = (isset($_REQUEST['fdate']))?$_REQUEST['fdate']:'';
		$data = $this->Scrap_model->getScrapTable($param);
		$json_data = json_encode($data);
		echo $json_data;
	}

	public function test(){
		phpinfo();
	}
}

	?>
