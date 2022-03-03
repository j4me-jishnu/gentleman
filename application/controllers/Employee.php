<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Employee extends MY_Controller {
	public $table = ' tbl_employee';
	public $page  = 'Employee';
	public function __construct() {

		parent::__construct();
		if(! $this->is_logged_in()){
			redirect('/login');
		}
		$this->load->library('email');

		$this->load->model('General_model');
		$this->load->model('Employee_model');
	}
	public function index()
	{
		$template['body'] = 'Employee/list';
		$template['script'] = 'Employee/script';
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('emp_name', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['body'] = 'Employee/add';
			$template['script'] = 'Employee/script';
			$this->load->view('template', $template);
		}
		else
		{
			$is_ac = $this->input->post('is_active'); if($is_ac==''){$is_ac=0;}
			$is_head = $this->input->post('is_head'); if($is_head==''){$is_head=0;}
			$data = array(
				'emp_id' => $this->input->post('emp_id'),
				'emp_name' => $this->input->post('emp_name'),
				'emp_desig' => $this->input->post('emp_desig'),
				'emp_status' => 1
			);
			$emp_id = $this->input->post('emp_id');
			if($emp_id){

				$data['emp_id'] = $emp_id;
				$result = $this->General_model->update($this->table,$data,'emp_id',$emp_id);
				$operation = array(
					'user_id' => $this->session->userdata('id'),
					'operation' => 'Modified',
					'to_whom' => $emp_id,
					'date' => date('Y-m-d'),
					'operation_id' => 4
				);
				$this->General_model->add_operation($operation);
				$response_text = 'Employee  updated successfully';
			}
			else{
				$result = $this->General_model->add($this->table,$data);
				$id = $this->db->insert_id();
				$operation = array(
					'user_id' => $this->session->userdata('id'),
					'operation' => 'Added',
					'to_whom' => $id,
					'date' => date('Y-m-d'),
					'operation_id' => 4
				);
				$this->General_model->add_operation($operation);
				$response_text = 'Employee added  successfully';
			}
			if($result){
				$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			}
			else{
				$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
			redirect('/Employee/', 'refresh');
		}
	}
	public function get(){
		$this->load->model('Employee_model');
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
		$param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
		$param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
		$param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
		$param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';

		$data = $this->Employee_model->getBranchTable($param);
		$json_data = json_encode($data);
		echo $json_data;
	}
	public function delete(){
		$emp_id = $this->input->post('emp_id');
		$updateData = array('emp_status' => 0);
		$data = $this->General_model->update($this->table,$updateData,'emp_id',$emp_id);
		if($data) {
			$operation = array(
				'user_id' => $this->session->userdata('id'),
				'operation' => 'Deleted',
				'to_whom' => $emp_id,
				'date' => date('Y-m-d'),
				'operation_id' => 4
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
//redirect('/Employee/', 'refresh');
	}
	public function edit($emp_id){
		$template['body'] = 'Employee/add';
		$template['script'] = 'Employee/script';
		$template['records'] = $this->General_model->get_row($this->table,'emp_id',$emp_id);
		$this->load->view('template', $template);
	}

	////////////////Employee Designation///////////////////////


	public function showDesignation()
	{
		$template['body'] = '';
		$template['script'] = '';
	}

}
