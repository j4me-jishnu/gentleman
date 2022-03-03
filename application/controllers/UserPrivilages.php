<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class UserPrivilages extends MY_Controller {
	public $table = ' tbl_login';
	public $page  = 'UserPrivilages';
	public function __construct() {

		parent::__construct();
		if(! $this->is_logged_in()){
			redirect('/login');
		}
		$this->load->library('email');

		$this->load->model('General_model');
		$this->load->model('UserPrivilages_model');
	}
	public function index()
	{
		$template['body'] = 'UserPrivilages/list';
		$template['script'] = 'UserPrivilages/script';
		$this->load->view('template', $template);
	}

	public function add(){
		$user_id = $this->input->post('id');
		$user_type = $this->input->post('user_type');
		$result = $this->UserPrivilages_model->updateUserPrivilage($user_id, $user_type);
		$response_text = 'User privilages modified successfully';
		if($result){
			$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
		}
		else{
			$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
		}
		redirect('/UserPrivilages/', 'refresh');
	}


	public function get(){
		$this->load->model('UserPrivilages_model');
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
		$param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
		$param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
		$param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
		$param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';

		$data = $this->UserPrivilages_model->getUserDetails($param);
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
	public function edit($user_id){
		$template['body'] = 'UserPrivilages/add';
		$template['script'] = 'UserPrivilages/script';
		$template['records'] = $this->General_model->get_row($this->table,'id',$user_id);
		$this->load->view('template', $template);
	}


}
