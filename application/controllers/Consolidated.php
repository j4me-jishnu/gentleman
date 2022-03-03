<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Consolidated extends MY_Controller {
	public $table = 'tbl_stock';
	public $tbl_stockup = 'tbl_stockup';
	public $tbl_purchase = 'tbl_apurchase';
	public $page  = 'stock';
	public function __construct() {
		parent::__construct();
       if(! $this->is_logged_in()){
            redirect('/login');
        }
 $this->load->model('General_model');
$this->load->model('Branchstock_model');
$this->load->model('Users_model');
	}
	public function index()
	{
		$template['branch'] = $this->Users_model->get_branch();
        $template['items'] = $this->Users_model->get_items();
		$template['body'] = 'Consolidated/list';
		$template['script'] = 'Consolidated/script';
		$this->load->view('template', $template);
	}
}