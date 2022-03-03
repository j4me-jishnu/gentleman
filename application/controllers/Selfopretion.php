<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Selfopretion extends MY_Controller {
	public $table = ' tbl_branch';
	public $page  = 'selfopretion';
	public function __construct() {
		parent::__construct();
       if(! $this->is_logged_in()){
            redirect('/login');
        }
        
        $this->load->model('General_model');
       
	}
	public function index()
	{
		$template['body'] = 'SelfOR/list';
		$template['script'] = 'SelfOR/script';
		$this->load->view('template', $template);
	}
	
}