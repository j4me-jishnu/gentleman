<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('Loginmodel');
    }
    public function index(){
        $this->form_validation->set_rules('username', 'Username', 'required');
        if ($this->form_validation->run() == FALSE) {
              $this->load->view('Login/login');
        } else {
                $data = array('user_name' => $this->input->post('username'),
                              'admin_password' => $this->input->post('password')
                              );
                $result = $this->Loginmodel->checkUserLogin($data);
                if($result){
                    redirect('dashboard');
                }
                else{
                    $error['message'] = "The user name or password is invalid";
                    $this->load->view('Login/login',$error);
                }
        }
    }
    public function logout(){
        $this->session->sess_destroy();
        redirect('/login/');
    }
}
?>
