<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Benchmark_Request extends MY_Controller {
	public $table = 'issue_benchmark';
    public $tabler = 'issue_benchmark_report';
	public $tbl_stock = 'tbl_stock';
	public $page  = 'setrop';
	public function __construct() {
        parent::__construct();
        if(! $this->is_logged_in()){
            redirect('/login');
        }
          $this->load->model('General_model');
        $this->load->model('Purchase_model');
        $this->load->model('Issueitem_model');
         $this->load->model('Users_model');
        $this->load->model('Branch_Benchmark_model');
        $this->load->model('Benchmark_Request_model');
    }
    public function index()
    {
        
        $template['body'] = 'Benchmark_request/list';
        $template['script'] = 'Benchmark_request/script';
        $this->load->view('template', $template);
    }
//public function get()
//{   
//$template['refno'] = $this->Purchase_model->Refno();
//$branch_id = $template['refno'][0]->branch_id;
//$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
//$param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
//$param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
//$param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
//$param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
//$param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
//$param['user_name'] = (isset($_REQUEST['user_name']))?$_REQUEST['user_name']:'';

//$data = $this->Branch_Benchmark_model->getBenchTable($param,$branch_id);
//$json_data = json_encode($data);
//echo $json_data;
//}
//}
 public function getRequest()
{
    $param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
    $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
    $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
    $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
    $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
    $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
    $param['user_name'] = (isset($_REQUEST['user_name']))?$_REQUEST['user_name']:'';
 $data=$this->Benchmark_Request_model->getRequest($param);
    $json_data = json_encode($data);
    echo $json_data;

} public function updateToapprove($id)
{
  $data=$this->Benchmark_Request_model->updateToapprove($id);
 redirect('/Benchmark_Request/', 'refresh');

}

public function updateToreject($id)
{
   $data=$this->Benchmark_Request_model->updateToreject($id);
   redirect('/Benchmark_Request/', 'refresh');

}




}
?>