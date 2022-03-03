<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller
{
function __construct()
{
parent::__construct();
$this->load->model('Loginmodel');
}
public function index(){
$this->form_validation->set_rules('username', 'Username', 'required');
if ($this->form_validation->run() == FALSE) {
$this->load->view('Login/login');
} 
else
{
$data = array('user_name' => $this->input->post('username'),
'user_password' => $this->input->post('password')
);
$result = $this->Loginmodel->checkUserLogin($data);
if($result){
$user = $this->session->userdata('user_type');
$des = $this->session->userdata('designation');
if($des == 3){redirect('Dash_board');}else if($user == 'A' || $user == 'Su'){redirect('Dashboard');}else if($user == 'S'){redirect('Dash_board');}
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

public function forgot_pass()
{
$data['message']="";
 if($this->input->post('forgot_pass'))
{
 $email=$this->input->post('email');
$que=$this->db->query("select user_password,user_email from tbl_login where user_email='$email'");
$row=$que->row();
if(isset($row)){
$user_email=$row->user_email;
 if((!strcmp($email, $user_email))){
 $pass=$row->user_password;
/*Mail Code*/
 $to = $user_email;
 $subject = "Password";
 $txt = "Your password is $pass .";
$headers = "From:" . "\r\n".
"CC: ";
 mail($to,$subject,$txt,$headers);
            $data['message']="Please check your email!";
        //	redirect('customers/login/');
            }
        else{
        $data['error']="Invalid Email ID !";
        }

}
else{
    $data['error']="Invalid Email ID !";
    }

}
          $this->load->view('Login/forgot_password',@$data);


}








}




?>
