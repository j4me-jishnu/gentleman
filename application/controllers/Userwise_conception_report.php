<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Userwise_conception_report extends MY_Controller {
	public $table = ' tbl_branch';
	public $page  = 'userwise_conception_report';
	public function __construct() {
		parent::__construct();
       if(! $this->is_logged_in()){
            redirect('/login');
        }
        
        $this->load->model('General_model');
		$this->load->model('UserwiseCR_model');
    }
	public function index()
	{
		$template['body'] = 'UserwiseCR/list';
		$template['script'] = 'UserwiseCR/script';
		$this->load->view('template', $template);
	}
	public function get_designation()
	{
		$user_id = $this->input->post('user_id');
		$data=$this->UserwiseCR_model->get_desig($user_id);
		echo json_encode($data);
	}
	public function get_issue()
	{
		$user_id = $this->input->post('user_id');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$data=$this->UserwiseCR_model->get_issue($user_id,$start_date,$end_date);
		echo json_encode($data);
	}
	public function get(){
		
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$param['user_id'] = (isset($_REQUEST['user_id']))?$_REQUEST['user_id']:'';
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
		$data = $this->UserwiseCR_model->getuserCrTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function getu(){
		
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$param['user_id'] = (isset($_REQUEST['user_id']))?$_REQUEST['user_id']:'';
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
		$data = $this->UserwiseCR_model->getuserCrusageTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function getur(){
		
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$param['user_id'] = (isset($_REQUEST['user_id']))?$_REQUEST['user_id']:'';
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
		$data = $this->UserwiseCR_model->getuserCrReturnTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	
}