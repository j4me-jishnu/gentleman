<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Change_password extends MY_Controller {
	public $table = 'tbl_login';
	public $tbl_user = 'tbl_user';
	public $page  = 'Changepass';
	public function __construct() {
		parent::__construct();
       if(! $this->is_logged_in()){
            redirect('/login');
        }
        $this->load->model('General_model');
		$this->load->model('Change_password_model');
        
	}
	public function index()
	{	
		$id = $this->session->userdata('id');
		$template['email'] = $this->Change_password_model->getMail($id);

		$template['body'] = 'Change_password/add';
		$template['script'] = 'Change_password/script';
		$this->load->view('template', $template);
	}
	public function get(){
		
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
    	$data = $this->Change_password_model->getChangepassTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function add()
	{
		$k=1;

		$id = $this->session->userdata('id');
		$email = $this->input->post('email');
		// $password = $this->input->post('password');
		$data = array(
				// 'user_name' => $this->input->post('uname'),
				'user_password'=> $this->input->post('new_password'),
				'user_email'=> $this->input->post('email'));
		// $a = $this->Change_password_model->getId($uname,$password);
		// $a = $this->Change_password_model->getId($uname,$password);			 
		// if($a)
		// {
		// 	$id = $a[0]->id;
		// 	$result = $this->General_model->update($this->table,$data,'id',$id);
		// 	$response_text = 'password changed successfully';
		// 	if($result)
		// 	{
		// 		$k=1;
		// 	}
		// }
		$result = $this->General_model->update($this->table,$data,'id',$id);	
		if($result)
		{
			$response_text = 'password changed successfully';
			$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;".$response_text."&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			redirect('/Change_password/','refresh');
		}
		else
		{
			// $response_text = 'Sorry invalid details...';
			$response_text = 'Something went wrong...';
			$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;'.$response_text.'&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			redirect('/Change_password/','refresh');
		}
		
	}
}