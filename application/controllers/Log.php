<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Log extends MY_Controller {
	public $table = ' tbl_category';
	public $page  = 'category';
	public function __construct() {
		parent::__construct();
       if(! $this->is_logged_in()){
            redirect('/login');
        }

        $this->load->model('General_model');
		$this->load->model('Log_model');
    }
	public function designation()
	{
        $data['results'] = $this->Log_model->get_designation();
        $data['title'] = 'Designation';
        $this->load->view('template/header');
        $this->load->view('template/left_navigation');
        $this->load->view('log/list',$data);
        $this->load->view('template/footer');
    }

    public function user(){
        $data['results'] = $this->Log_model->get_user();
        $data['title'] = 'User';
        $this->load->view('template/header');
        $this->load->view('template/left_navigation');
        $this->load->view('log/list',$data);
        $this->load->view('template/footer');

    }

    public function vendor(){


        $data['results'] = $this->Log_model->get_vendor();
        $data['title'] = 'Vendor';
        $this->load->view('template/header');
        $this->load->view('template/left_navigation');
        $this->load->view('log/list',$data);
        $this->load->view('template/footer');


    }

    public function branch(){


        $data['results'] = $this->Log_model->get_branch();
        $data['title'] = 'Branch';
        $this->load->view('template/header');
        $this->load->view('template/left_navigation');
        $this->load->view('log/list',$data);
        $this->load->view('template/footer');


    }

    public function category(){


        $data['results'] = $this->Log_model->get_category();
        $data['title'] = 'Category';
        $this->load->view('template/header');
        $this->load->view('template/left_navigation');
        $this->load->view('log/list',$data);
        $this->load->view('template/footer');


    }

    public function mrop(){


        $data['results'] = $this->Log_model->get_mrop();
        $data['title'] = 'Rop';
        $this->load->view('template/header');
        $this->load->view('template/left_navigation');
        $this->load->view('log/list',$data);
        $this->load->view('template/footer');


    }

    public function mail(){


        $data['results'] = $this->Log_model->get_mail();
        $data['title'] = 'Mail';
        $this->load->view('template/header');
        $this->load->view('template/left_navigation');
        $this->load->view('log/list',$data);
        $this->load->view('template/footer');


    }

}
