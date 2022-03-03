<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SetBenchmark extends MY_Controller {
	public $table = 'benchmark_period';
	public $page  = 'Vendor';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
		}
        $this->load->model('General_model');
        $this->load->model('Users_model');
		$this->load->model('Set_Benchmark_model');
        
	}
	public function index()
	{	
		$template['branch'] = $this->Users_model->get_branch();
		$template['items'] = $this->Users_model->get_items();
		$template['body'] = 'SetBenchmark/list';
		$template['script'] = 'SetBenchmark/script';
		$this->load->view('template', $template);
	}
	public function get(){
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        $param['item'] = (isset($_REQUEST['item']))?$_REQUEST['item']:'';
		$param['branch'] = (isset($_REQUEST['branch']))?$_REQUEST['branch']:'';
		$idate = (isset($_REQUEST['idate']))?$_REQUEST['idate']:'';
		$fdate = (isset($_REQUEST['fdate']))?$_REQUEST['fdate']:'';
    	if($idate){
			$idate = str_replace('/', '-', $idate);
			$param['idate'] =  date("Y-m-d",strtotime($idate));
		}
		if($fdate){
			$fdate = str_replace('/', '-', $fdate);
			$param['fdate'] =  date("Y-m-d",strtotime($fdate));
		}
    	$data = $this->Set_Benchmark_model->getTable($param);
    	$json_data = json_encode($data);
        echo $json_data;
    }

    public function getStockmove(){
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        $param['item'] = (isset($_REQUEST['item']))?$_REQUEST['item']:'';
		$param['branch'] = (isset($_REQUEST['branch']))?$_REQUEST['branch']:'';
		$idate = (isset($_REQUEST['idate']))?$_REQUEST['idate']:'';
		$fdate = (isset($_REQUEST['fdate']))?$_REQUEST['fdate']:'';
    	if($idate){
			$idate = str_replace('/', '-', $idate);
			$param['idate'] =  date("Y-m-d",strtotime($idate));
		}
		if($fdate){
			$fdate = str_replace('/', '-', $fdate);
			$param['fdate'] =  date("Y-m-d",strtotime($fdate));
		}
    	$data = $this->Set_Benchmark_model->getStockmoveTable($param);
    	$json_data = json_encode($data);
        echo $json_data;
    }

    public function getUserBenchmark(){
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        $param['item'] = (isset($_REQUEST['item']))?$_REQUEST['item']:'';
		$param['branch'] = (isset($_REQUEST['branch']))?$_REQUEST['branch']:'';
		$idate = (isset($_REQUEST['idate']))?$_REQUEST['idate']:'';
		$fdate = (isset($_REQUEST['fdate']))?$_REQUEST['fdate']:'';
    	if($idate){
			$idate = str_replace('/', '-', $idate);
			$param['idate'] =  date("Y-m-d",strtotime($idate));
		}
		if($fdate){
			$fdate = str_replace('/', '-', $fdate);
			$param['fdate'] =  date("Y-m-d",strtotime($fdate));
		}
    	$data = $this->Set_Benchmark_model->getUserBenchmark($param);
    	$json_data = json_encode($data);
        echo $json_data;
    }

     public function getUserissue(){
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        $param['item'] = (isset($_REQUEST['item']))?$_REQUEST['item']:'';
		$param['branch'] = (isset($_REQUEST['branch']))?$_REQUEST['branch']:'';
		$idate = (isset($_REQUEST['idate']))?$_REQUEST['idate']:'';
		$fdate = (isset($_REQUEST['fdate']))?$_REQUEST['fdate']:'';
    	if($idate){
			$idate = str_replace('/', '-', $idate);
			$param['idate'] =  date("Y-m-d",strtotime($idate));
		}
		if($fdate){
			$fdate = str_replace('/', '-', $fdate);
			$param['fdate'] =  date("Y-m-d",strtotime($fdate));
		}
    	$data = $this->Set_Benchmark_model->getUserissue($param);
    	$json_data = json_encode($data);
        echo $json_data;
    }



	public function edit($id){
		$template['body'] = 'SetBenchmark/add';
		$template['script'] = 'SetBenchmark/script';
		$template['records'] = $this->General_model->get_row($this->table,'id',$id);
    	$this->load->view('template', $template);
	}

	public function editAction()
	{
		$id = $this->input->post('id');
		$idate = $this->input->post('idate');
		$fdate = $this->input->post('fdate');
		$array1 = array('initial_date' => $idate,'final_date' =>$fdate);
		$result = $this->General_model->update($this->table,$array1,'id',$id);
		$operation = array(
			'user_id' => $this->session->userdata('id'),
			'operation' => 'Bench mark Period Updated',
			'to_whom' => $id,
			'date' => date('Y-m-d'),
			'operation_id' => 20
		);
		$this->General_model->add_operation($operation);
		redirect('/SetBenchmark/', 'refresh');
	}
   
}