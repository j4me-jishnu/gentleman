<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Designation extends MY_Controller {
	public $table = 'tbl_designation';
	public $page  = 'designation';
	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
			redirect('/login');
		}

		$this->load->model('General_model');
		$this->load->model('Designation_model');
	}
	public function index()
	{
		$template['body'] = 'Designation/list';
		$template['script'] = 'Designation/script';
		$this->load->view('template', $template);
	}

	public function add(){
		// var_dump($this->input->post()); die;
		$this->form_validation->set_rules('designation', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['body'] = 'Designation/add';
			$template['script'] = 'Designation/script';
			$this->load->view('template', $template);
		}
		else {
			$data = array(
				'designation' => $this->input->post('designation'),
				'description' => $this->input->post('description'),
				'desig_status' => 1
			);
			$desig_id = $this->input->post('desig_id');
			if($desig_id){
				// $data['desig_id'] = $desig_id;
				$result = $this->General_model->update($this->table,$data,'desig_id',$desig_id);
				$operation = array(
					'user_id' => $this->session->userdata('id'),
					'operation' => 'Modified',
					'to_whom' => $desig_id,
					'date' => date('Y-m-d'),
					'operation_id' => 1
				);
				$this->General_model->add_operation($operation);
				$response_text = 'Designation  updated successfully';
			}
			else{
				$result = $this->General_model->add($this->table,$data);
				$id = $this->db->insert_id();
				$operation = array(
					'user_id' => $this->session->userdata('id'),
					'operation' => 'Added',
					'to_whom' => $id,
					'date' => date('Y-m-d'),
					'operation_id' => 1
				);
				$this->General_model->add_operation($operation);
				$response_text = 'Designation added  successfully';
			}
			if($result){
				$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			}
			else{
				$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
			redirect('/designation/', 'refresh');
		}
	}
	public function get(){
		$this->load->model('Designation_model');
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
		$param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
		$param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
		$param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
		$param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';

		$data = $this->Designation_model->getDesiTable($param);
		$json_data = json_encode($data);
		echo $json_data;
	}
	public function delete(){
		$desig_id = $this->input->post('desig_id');
		$updateData = array('desig_status' => 0);
		$data = $this->General_model->update($this->table,$updateData,'desig_id',$desig_id);
		if($data) {
			$operation = array(
				'user_id' => $this->session->userdata('id'),
				'operation' => 'Deleted',
				'to_whom' => $desig_id,
				'date' => date('Y-m-d'),
				'operation_id' => 1
			);
			$this->General_model->add_operation($operation);
			$response['text'] = 'Deleted successfully';
			$response['type'] = 'success';
		}
		else{
			$response['text'] = 'Something went wrong';
			$response['type'] = 'error';
		}
		$response['layout'] = 'topRight';
		$data_json = json_encode($response);
		echo $data_json;
		redirect('/designation/', 'refresh');
	}
	public function edit($desig_id){
		$template['body'] = 'Designation/add';
		$template['script'] = 'Designation/script';
		$template['records'] = $this->General_model->get_row($this->table,'desig_id',$desig_id);
		$this->load->view('template', $template);
	}

	public function checkUser($designation){
		// return $this->Designation_model->checkUser($designation);
		return $this->Designation_model->checkUser($designation);
	}

	/*	public function checkUser(){
	$designation=$this->input->post('designation');
	$result=$this->Designation_model->checkuser($designation);
	if($result)
	{
		echo  1;
	}
else{
	echo  0;
}

}*/

}
