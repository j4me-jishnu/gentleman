<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SetMail extends MY_Controller {
	public $table = 'tbl_email';
	public $page  = 'Vendor';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
		}
        $this->load->model('General_model');
		$this->load->model('SetMail_model');
        
	}
	public function index()
	{   
		
		$template['body'] = 'SetMail/list';
		$template['script'] = 'SetMail/script';
		$this->load->view('template', $template);
	}
	public function get(){
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
    	$data = $this->SetMail_model->getTable($param);
    	$json_data = json_encode($data);
        echo $json_data;
    }
	public function edit($id){
		$template['body'] = 'SetMail/add';
		$template['script'] = 'SetMail/script';
		$template['records'] = $this->General_model->get_row($this->table,'id',$id);
    	$this->load->view('template', $template);
	}

	public function editAction()
	{
		$id = $this->input->post('id');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$array1 = array('email' => $email,'password' =>$password);
		if(isset($id) && $id!=''){
		
		$result = $this->General_model->update($this->table,$array1,'id',$id);
		$operation = array(
			'user_id' => $this->session->userdata('id'),
			'operation' => 'Mail Updated',
			'to_whom' => $id,
			'date' => date('Y-m-d'),
			'operation_id' => 7
		);
		
	}
	else{

		$result = $this->General_model->add($this->table,$array1);

		$id = $this->db->insert_id();
		
		$operation = array(
			'user_id' => $this->session->userdata('id'),
			'operation' => 'Mail Added',
			'to_whom' => $id,
			'date' => date('Y-m-d'),
			'operation_id' => 7
		);
	}
		$this->General_model->add_operation($operation);
		redirect('/SetMail/', 'refresh');
	}


	public function add(){

		$template['body'] = 'SetMail/add';
		$template['script'] = 'SetMail/script';
		
		$this->load->view('template',$template);
  
	  }
   
}