<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends MY_Controller {
	public $table = 'admin_login';
	public $page  = 'User';
	public function __construct() {
		parent::__construct();
        // if(! $this->is_logged_in()){
        //     redirect('/login');
        // }
        $this->currentuserid = $this->session->userdata('id');
        $this->currentusertype = $this->session->userdata('admin_type');
        $this->load->model('General_model');
        $this->load->model('Product_model');
        $this->load->model('Purchase_model');
        $this->load->model('Size_model');
        $this->load->model('Color_model');
        $this->load->model('Sale_model');
		
	}
	public function index()
	{       
                $user_id = $this->currentuserid;
                $template['currentusertype'] = $this->currentusertype;
                $template['admin_data'] = $this->General_model->admin_data($user_id);
                $created_date = str_replace('-', '/', $template['admin_data']->created_date);
                $template['admin_data']->created_date =  date("d/m/Y h:m:s",strtotime($created_date));
                
                $updated_date = str_replace('-', '/', $template['admin_data']->updated_date);
                $template['admin_data']->updated_date =  date("d/m/Y h:m:s",strtotime($updated_date));
                //print_r($template);
                //exit();
		$template['body'] = 'User/view';
		$template['script'] = 'User/script';
		$this->load->view('template', $template);
	}
        public function get_data(){
        $id = $this->input->post('id');
        $data = $this->General_model->getAdminData($id);
        echo json_encode($data);
        }
    public function editUpdate(){
        $id= $this->input->post('id');
        $shop_name= $this->input->post('shop_name');
        $address= $this->input->post('address');
        $tin_no= $this->input->post('tin_no');
        $phone_number= $this->input->post('phone_number');
        $admin_email= $this->input->post('admin_email');
        $user_name= $this->input->post('user_name');
        $password= $this->input->post('password');
        $this->load->helper('date');
        $date = date('Y-m-d h:i:sa');
        $update_data = array(
                'shop_name'=>$shop_name,
                'shop_address'=>$address,
                'tin_no'=>$tin_no,
                'phone_no'=>$phone_number,
                'admin_email'=>$admin_email,
                'user_name'=>$user_name,
                'admin_password'=>$password,
                'updated_date'=>$date
        );
        $data = $this->General_model->update($this->table,$update_data,'id',$id);
        if($data) {
            $response['text'] = 'Admin Details Updated successfully';
            $response['type'] = 'success';
        }
        else{
            $response['text'] = 'Something went wrong';
            $response['type'] = 'error';
        }
        $response['layout'] = 'topRight';
        $data_json = json_encode($response);
        echo $data_json;
        redirect('/Purchase/', 'refresh');
    }
}