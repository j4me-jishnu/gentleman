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


    }


}
