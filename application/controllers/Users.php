<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends MY_Controller {
	public $table = 'tbl_user';
	public $tbl_login = 'tbl_login';
	public $page  = 'users';
	public function __construct() {
		parent::__construct();
       if(! $this->is_logged_in()){
            redirect('/login');
        }
        
        $this->load->model('General_model');
        $this->load->model('Users_model');
	}
	public function index()
	{
		
		$template['designation'] = $this->Users_model->get_designation();
		$template['branch'] = $this->Users_model->get_branch();
		$template['body'] = 'Users/list';
		$template['script'] = 'Users/script';
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('user_email', 'Email', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['designation'] = $this->Users_model->get_designation();
			$template['branch'] = $this->Users_model->get_branch();
			$template['userid'] = $this->Users_model->get_userid();
			//print_r($template['userid']->ur_id); exit();
			$template['body'] = 'Users/add';
			$template['script'] = 'Users/script';
			$this->load->view('template', $template);
		}
		else{
			$is_ac = $this->input->post('is_active'); 
			if($is_ac=='')
				{
					$is_ac=0;
					$pwd='';
				}
				else{
					$pwd= $this->input->post('user_password');
				}
			
			$br = $this->input->post('user_branch');
			$user_type = $this->input->post('privilage');
			$branch = $this->Users_model->user_branch($br);
			$userbr = $branch->branch_name;
			$user_desi = $this->input->post('user_designation');
			$login_data = array(
						'user_name' => $this->input->post('user_name'),
						'user_email' => $this->input->post('user_email'),
						'user_password' => $pwd,
						'user_branch'=>$userbr,
						'designation'=>$user_desi,
						'user_type' =>$user_type,
						'purchase' =>$this->input->post('purchase'),
						'stockmove' =>$this->input->post('stockmovement'),
						'masterstock' =>$this->input->post('masterstock'),
						'branchstock' =>$this->input->post('branchstock'),
						'returnstock' =>$this->input->post('returnstock'),
						'branchrequest' =>$this->input->post('branchrequest'),
						'branch' =>$this->input->post('branch'),
						'scrap' =>$this->input->post('scrap'),
						'designationaccess' =>$this->input->post('designation'),
						'users' =>$this->input->post('users'),
						'vendor' =>$this->input->post('vendor'),
						'product' =>$this->input->post('product'),
						'inventory' =>$this->input->post('inventory'),
						'rop' =>$this->input->post('rop'),
						'report' =>$this->input->post('report'),
						'log' =>$this->input->post('log'),
						
						);
				$log_id = $this->input->post('log_id');
				if($log_id){
					$login_id_fk = $log_id;
					$this->General_model->update($this->tbl_login,$login_data,'id',$log_id);
					if($is_ac=='')
					{
						$operation = array(
							'user_id' => $this->session->userdata('id'),
							'operation' => 'Inactivated',
							'to_whom' => $login_id_fk,
							'date' => date('Y-m-d'),
							'operation_id' => 2
						);
					}
					else
					{
					
							$operation = array(
							'user_id' => $this->session->userdata('id'),
							'operation' => 'Modified',
							'to_whom' => $login_id_fk,
							'date' => date('Y-m-d'),
							'operation_id' => 2
						);
					}
					$this->General_model->add_operation($operation);
				
				}
				else{
					$this->General_model->add($this->tbl_login,$login_data);
					$login_id_fk = $this->db->insert_id();
					$operation = array(
						'user_id' => $this->session->userdata('id'),
						'operation' => 'Added',
						'to_whom' => $login_id_fk,
						'date' => date('Y-m-d'),
						'operation_id' => 2
					);
					$this->General_model->add_operation($operation);
                }
				$user_data = array(
						'login_id_fk'=>$login_id_fk,
						'ur_id' => $this->input->post('ur_id'),
						'username' => $this->input->post('name'),
						'user_address' => $this->input->post('user_address'),
						'user_phone' => $this->input->post('user_phone'),
						'user_email' => $this->input->post('user_email'),
						'user_designation' => $user_desi,
						'user_branch' => $this->input->post('user_branch'),
						'is_active' => $is_ac,
						'user_status' => 1
						);
				$user_id = $this->input->post('user_id');
				
				if($user_id){
				$status = $this->General_model->getIsactive($login_id_fk);
				$_status =$status->is_active;
					if($is_ac=='')
					{
						$history = array(
							"user_id" => $login_id_fk,
							"operation" => "Inactivated",
							"login_id" => $this->session->userdata('id'),
							"user_type" => $user_type,
							"date" => date('y-m-d')
						);
					}
					else if($is_ac !='' && $_status ==0)
					{
						$history = array(
							"user_id" => $login_id_fk,
							"operation" => "Activated",
							"login_id" => $this->session->userdata('id'),
							"user_type" => $user_type,
							"date" => date('y-m-d')
						);
					}
					else{
						$history = array(
							"user_id" => $login_id_fk,
							"operation" => "Modified",
							"login_id" => $this->session->userdata('id'),
							"user_type" => $user_type,
							"date" => date('y-m-d')
						);
					}
					$this->General_model->add('user_history',$history);
					
					$result = $this->General_model->update($this->table,$user_data,'user_id',$user_id);
                    $response_text = 'User  updated successfully';
                }
				else{
					$history = array(
						"user_id" => $login_id_fk,
						"operation" => "Created",
						"login_id" => $this->session->userdata('id'),
						"user_type" => $user_type,
						"date" => date('y-m-d')
					);

					$this->General_model->add('user_history',$history);
					 $result = $this->General_model->add($this->table,$user_data);
                     $response_text = 'User added  successfully';
                }
				
				if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
	        redirect('/Users/', 'refresh');
		}
	}
	public function get(){
		$this->load->model('Users_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        $param['user_name'] = (isset($_REQUEST['user_name']))?$_REQUEST['user_name']:'';
		$param['designation'] = (isset($_REQUEST['designation']))?$_REQUEST['designation']:'';
		$param['branch_name'] = (isset($_REQUEST['branch_name']))?$_REQUEST['branch_name']:'';
		
    	$data = $this->Users_model->getUsersTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function delete(){
        $user_id = $this->input->post('user_id');
        $updateData = array('user_status' => 0);
        $updata = array('user_password' => '');
        $data3 = $this->Users_model->getLogid($user_id);
        $login_id_fkk = $data3->login_id_fk;
        $data = $this->General_model->update($this->table,$updateData,'user_id',$user_id);
        $data1 = $this->General_model->update($this->tbl_login,$updata,'id',$login_id_fkk);
        if($data) {
			$operation = array(
				'user_id' => $this->session->userdata('id'),
				'operation' => 'Deleted',
				'to_whom' => $login_id_fkk,
				'date' => date('Y-m-d'),
				'operation_id' => 3
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
		//redirect('/users/', 'refresh');
    }
	public function edit($user_id){
		$template['designation'] = $this->Users_model->get_designation();
		$template['branch'] = $this->Users_model->get_branch();
		$template['body'] = 'Users/add';
		$template['script'] = 'Users/script';
		$template['records'] = $this->Users_model->get_row($user_id);
    	$this->load->view('template', $template);
	}

	public function setPrivilage()
	{
		$option = $this->input->post('option');
		$uid = $this->input->post('uid');
		
		$history = array(
			"user_id" => $uid,
			"operation" => "Changed User Type",
			"login_id" => $this->session->userdata('id'),
			"user_type" => $option,
			"date" => date('y-m-d')
		);

		$this->General_model->add('user_history',$history);

		
		
		$data = $this->Users_model->setPrivilage($option,$uid);

		$operation = array(
			'user_id' => $this->session->userdata('id'),
			'operation' => 'Usertype Changed',
			'to_whom' => $uid,
			'date' => date('Y-m-d'),
			'operation_id' => 2
		);
		$this->General_model->add_operation($operation);
		$json_data = json_encode($data);
    	echo $json_data;
	}

	public function history($id){

		// $id = $this->uri->segment(3);

		// //$l_id = $this->Users_model->get_loginid($id);

  //        // print_r($l_id); 
        $data['results'] = $this->Users_model->get_history($id);
		$this->load->view('template/header');
		$this->load->view('template/left_navigation');
		$this->load->view('Users/history',$data);
		$this->load->view('template/footer');
        
	  }
}