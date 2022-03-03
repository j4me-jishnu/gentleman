<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Masterstock extends MY_Controller {
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
		$this->load->model('Masterstock_model');
	}
	public function index()
	{
		$uid = $this->session->userdata('id');
		$template['branch'] = $this->Masterstock_model->getbranch($uid);
		$template['body'] = 'Masterstock/list';
		$template['script'] = 'Masterstock/script';
		$this->load->view('template', $template);
	}

	public function get(){
		//$this->load->model('Stock_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['branch'] = (isset($_REQUEST['branch']))?$_REQUEST['branch']:'';
		$param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
    	$data = $this->Masterstock_model->getStockTable($param);
    	$bstock =$this->Masterstock_model->getBstock();
			// echo"<pre>",print_r($bstock['data']->item_name,1),"</pre>";
		// Variable for store data of brach stock return count for each branch
		//$bstock =$this->Masterstock_model->getopstock();

    	for($i=0;$i<count($data['data']);$i++)
        {
            $tot=0;
            for($j=0;$j<count($bstock['data']);$j++)
            {
                if($data['data'][$i]->item_id_fk == $bstock['data'][$j]->item_id_fk)
                {
                    $tot = $bstock['data'][$j]->total;
                    break;
                }
            }
			$data['data'][$i]->btotal = $tot;
			// echo $data['data'][$i]['item_id_fk'];
			// exit();
			$issued = $this->Masterstock_model->get_issued($data['data'][$i]->item_id_fk);
			$request = $this->Masterstock_model->get_request($data['data'][$i]->item_id_fk);
			$stock_returns = $this->Masterstock_model->get_itemwise_stock_returns($data['data'][$i]->item_id_fk);
			$data['data'][$i]->requestquantity = $request[0]->request;
			$data['data'][$i]->issuedquantity = $issued[0]->issued;
			// variable to store total stock {opening stock + purchase stock}
			$data['data'][$i]->simple_total_stock=$data['data'][$i]->opening_stock + $data['data'][$i]->purchase_quantity;
			$data['data'][$i]->t_quantity = $data['data'][$i]->opening_stock + $data['data'][$i]->purchase_quantity  - $issued[0]->issued - $request[0]->request;
			$data['data'][$i]->tot_issued = $issued[0]->issued + $request[0]->request;
			// variable stores the branch's returning count
			$data['data'][$i]->branch_return_count=$stock_returns['sum_of_item_quantity'];
			// $data['data'][$i]->branch_return_count=$issued[0]->issued + $request[0]->request;
        }

	   	$json_data = json_encode($data);
    	echo $json_data;
    }

	public function get_all_stock_return(){
		$result = $this->Masterstock_model->get_itemwise_stock_returns(18);
	}

	public function getNewMasterStock(){
		$uid = $this->session->userdata('id');
		$template['newmasterstock'] = $this->Masterstock_model->getNewMasterStock();
		// echo json_encode($template['newmasterstock']);
		$template['body'] = 'newMasterstock/list';
		$template['script'] = 'newMasterstock/script';
		$this->load->view('template', $template);
	}
}
?>
