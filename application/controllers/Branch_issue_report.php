<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Branch_issue_report extends MY_Controller {
	public $table = ' tbl_branch';
	public $tablei = ' tbl_issueitem';
	public $page  = 'branch_conception_report';
	public function __construct() {
		parent::__construct();
       if(! $this->is_logged_in()){
            redirect('/login');
        }
        
        $this->load->model('General_model');
		$this->load->model('Branch_issue_model');
		$this->load->model('Users_model');
    }
	public function index()
	{
		$template['branch'] = $this->Users_model->get_branch();
		$template['body'] = 'Branch_issue_report/list';
		$template['script'] = 'Branch_issue_report/script';
		$this->load->view('template', $template);
	}
	public function get(){
		
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$param['user_branch'] = (isset($_REQUEST['user_branch']))?$_REQUEST['user_branch']:'';
		$param['user_branch2'] = (isset($_REQUEST['user_branch2']))?$_REQUEST['user_branch2']:'';
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
		$data = $this->Branch_issue_model->getbranchCrTable($param);
		$all_total =0;
        for($i=0;$i<count($data['data']);$i++)
        {  
          
           $all_total = $data['data'][$i]->issue_quantity +$all_total;  
        }

        for($i=0;$i<count($data['data']);$i++)
        {  
          
           $data['data'][$i]->all_total = $all_total;  
        }
    	$json_data = json_encode($data);
    	echo $json_data;
	}
	
	/*public function edit($issue_id)
	{
	$template['body'] = 'Branch_issue_report/edit';
	$template['script'] = 'Branch_issue_report/script';
	$template['branch'] = $this->General_model->get_branchissues($issue_id);
	$template['item'] = $this->General_model->getitemmasterissues($issue_id);
	$template['records'] = $this->General_model->get_rows($this->tablei,'issue_id',$issue_id);
	$this->load->view('template', $template);
	}*/







}