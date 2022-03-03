<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Log_file extends MY_Controller {
	public $table = 'operation_status';
	public $tbl_login = 'tbl_login';
	public $page  = 'users';
	public function __construct() {
		parent::__construct();
       if(! $this->is_logged_in()){
            redirect('/login');
        }

        $this->load->model('General_model');
        $this->load->model('Users_model');
        $this->load->model('Log_model');
	}
	public function index()
	{

		$template['designation'] = $this->Users_model->get_designation();
		//$template['branch'] = $this->Users_model->get_branch();
		$template['body'] = 'Log_file/list';
		$template['script'] = 'Log_file/script';
		$this->load->view('template', $template);
	}

	public function get(){
		$this->load->model('Log_model');
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
		$param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
		$param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
		$param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
		$param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
		$param['user_name'] = (isset($_REQUEST['user_name']))?$_REQUEST['user_name']:'';
		$param['designation'] = (isset($_REQUEST['designation']))?$_REQUEST['designation']:'';
		$param['log'] = (isset($_REQUEST['log']))?$_REQUEST['log']:'';
		$param['action'] = (isset($_REQUEST['action']))?$_REQUEST['action']:'';
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
		$data1 = $this->Log_model->get_designation($param);
		$data2 = $this->Log_model->get_vendor($param);
		$data3 = $this->Log_model->get_user($param);
		$data4 = $this->Log_model->get_branch($param);
		$data5 = $this->Log_model->get_category($param);
		$data6 = $this->Log_model->get_item($param);
		$data7 = $this->Log_model->get_mail($param);
		$data8 = $this->Log_model->get_purchase($param);
		$data9 = $this->Log_model->get_stockmove($param);
		$data10 = $this->Log_model->get_mrop($param);
		$data11 = $this->Log_model->get_brop($param);
		$data12 = $this->Log_model->get_issue($param);
		$data13 = $this->Log_model->get_return($param);
		$data14 = $this->Log_model->get_request($param);
		$data15 = $this->Log_model->get_payment($param);
		$data16 = $this->Log_model->get_benchperiod($param);
		$data17 = $this->Log_model->get_masterbenchmark($param);
		$data18 = $this->Log_model->get_branchbenchmark($param);
		$data = array_merge_recursive($data1,$data2,$data3,$data4,$data5,$data6,$data7,$data8,$data9,$data10,$data11,$data12,$data13,$data14,$data15,$data16,$data17,$data18);
		$json_data = json_encode($data);
		echo $json_data;
	}

}
