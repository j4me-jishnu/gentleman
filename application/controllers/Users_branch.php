<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users_branch extends MY_Controller {
	public $table = 'tbl_user';
	public $tbl_login = 'tbl_login';
	public $page  = 'users';
	public function __construct() {
		parent::__construct();
       if(! $this->is_logged_in()){
            redirect('/login');
        }
        
        $this->load->model('General_model');
        $this->load->model('Usersbranch_model');
	}
	public function index()
	{   

        $id = $this->session->userdata('id');
  //       $template['branch'] = $this->Usersbranch_model->get_branch($id);
		// $template['records'] = $this->Usersbranch_model->get($template['branch'][0]->user_branch);
		
		$template['body'] = 'Users_branch/list';
		$template['script'] = 'Users_branch/script';
		$this->load->view('template', $template);
	}
	public function add(){

	 $template['body'] = 'Users_branch/add';
	 $template['script'] = 'Users_branch/script';
	 $this->load->view('template',$template);
	
 
	}

	public function add_action(){

		$id = $this->session->userdata('id');
       $branch = $this->Usersbranch_model->get_branch($id);
	   $data = array('username' => $this->input->post('name'),
					  'user_address' => $this->input->post('user_address'),
					  'user_phone' => $this->input->post('user_phone'),
					  'user_branch' => $branch[0]->user_branch,
					  'user_email' => $this->input->post('user_email'));
	 
		$this->General_model->add('tbl_user',$data);
		
		redirect('Users_branch');


	}
	public function edit()
	{
		$user=$this->uri->segment(3);
		$id = $this->session->userdata('id');
       $branch = $this->Usersbranch_model->get_branch($id);
       $template['records']=$this->Usersbranch_model->getuserData($id,$user);
       // print_r($template);
       $template['body'] = 'Users_branch/edit';
	 $template['script'] = 'Users_branch/script';
	 $this->load->view('template',$template);
	}
	public function update_action()
	{
		$id = $this->session->userdata('id');
       $branch = $this->Usersbranch_model->get_branch($id);
       $uid=$this->input->post('ur_id');
       $data = array('username' => $this->input->post('name'),
					  'user_address' => $this->input->post('user_address'),
					  'user_phone' => $this->input->post('user_phone'),
					  'user_branch' => $branch[0]->user_branch,
					  'user_email' => $this->input->post('user_email'));
	 
		$this->General_model->update('tbl_user',$data,'user_id',$uid);
		
		redirect('Users_branch');
	}
}