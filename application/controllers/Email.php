<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Email extends MY_Controller {
	public $table = ' tbl_branch';
	public $page  = 'email';
	public function __construct() {
		parent::__construct();
       if(! $this->is_logged_in()){
            redirect('/login');
        }
        
        $this->load->model('General_model');
		//$this->load->model('UserwiseCR_model');
    }
	public function sendemail(){
		
		$to_email = "user03.wahylab@gmail.com";
		$from_email = "no-repaly@easy2deals.com";
		$this->load->library('email'); //to load mail
		$this->email->from($from_email, 'Alain Printers'); 
        $this->email->to($to_email);
        $this->email->subject('Invoice');
		$this->email->message('hail');
		$this->email->send();
     
      // $sender_email= 'jobymon99@gmail.com'; $user_password = 'fedel12450100076093';
      // $config['protocol'] = 'smtp';
      // $config['smtp_host'] = 'ssl://smtp.gmail.com';
      // $config['smtp_port'] = 465;
      // $config['smtp_user'] = $sender_email;
      // $config['smtp_pass'] = $user_password;
     
      // $this->load->library('email', $config);
      // $this->email->set_newline("\r\n");
      // $this->email->from('jobymon99@gmail.com', 'Joby');
      // $this->email->to('user03.wahylab@gmail.com');
      // $this->email->subject('Hello');
      // $this->email->message('Test email');
      // if (!$this->email->send()) {
        // show_error($this->email->print_debugger()); }
      // else {
        // echo 'Your e-mail has been sent!';
      // }
    }
	
	
}