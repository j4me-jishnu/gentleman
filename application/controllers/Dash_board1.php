<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dash_board extends MY_Controller {
	public $page  = 'Dash_board';
	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
			redirect('/login');

			$this->load->helper('url');
			$this->load->helper('file');
			$this->load->helper('download');
			$this->load->library('zip');
		}
		$this->load->model('Dash_board_model');
		$this->load->model('Stock_model');
	}
	public function index(){
		$branch_name = $this->session->userdata('user_branch');
		$branch_id = $this->Dash_board_model->get_branch_id($branch_name);
		$template['refno'] = $this->Dash_board_model->Refno();
		$branch_id = $template['refno'][0]->branch_id;
		$template['total_users'] = $this->Dash_board_model->gettotal_users($branch_id);
		$template['items_Issued'] = $this->Dash_board_model->getIssued($branch_id);
		//print_r($template['Puchase_Request']); exit();
		$template['breorder']=$this->breordercount();
		$template['Puchase_delivery'] = $this->Dash_board_model->getPuchaseDelivery($branch_id);
		// $template['stock_items'] = $this->Dash_board_model->getStockitem($branch_id);
		$template['stock_items'] = 2540;
		$template['brns'] = $this->Dash_board_model->getallBranch();
		$template['body'] = 'Dashboard1/list';
		$template['script'] = 'Dashboard1/script';
		$this->load->view('template', $template);
	}
	public function get(){

		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
		$param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
		$param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
		$param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
		$param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';

		$data = $this->Dash_board_model->getUsersTable($param);
		$json_data = json_encode($data);
		echo $json_data;
	}
	public function breordercount()
	{

		$this->load->model('Stock_model');
		$uid = $this->session->userdata('id');
		$data = $this->Stock_model->getBranchid($uid);
		$br_id = $data[0] ->user_branch;
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
		$param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
		$param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
		$param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
		$param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
		$param['branch'] = (isset($_REQUEST['branch']))?$_REQUEST['branch']:'';
		$param['item'] = (isset($_REQUEST['item']))?$_REQUEST['item']:'';
		$data = $this->Stock_model->getBstock($param,$br_id);
		$bstock =$this->Stock_model->getIssuedQuantity($br_id);
		// var_dump(count($data['data']));
		for($i=0;$i<count($data['data']);$i++)
		{

			$last = 0;
			for($j=0;$j<count($bstock['data']);$j++)
			{
				if($data['data'][$i]->item_id_fk == $bstock['data'][$j]->iid){

					//$data['data'][$i]->last_issued_qty=$bstock['data'][$j]->last_issued;
					$last = $bstock['data'][$j]->last_issued;
					break;
				}

			}

			$data['data'][$i]->last_issued_qty = $last;

		}

		$all_total =0;
		for($i=0;$i<count($data['data']);$i++)
		{

			$all_total = $data['data'][$i]->total +$all_total;
		}

		for($i=0;$i<count($data['data']);$i++)
		{

			$data['data'][$i]->all_total = $all_total;
		}
		$j=0;
		for ($i=0; $i < count($data['data']) ; $i++)
		{
			if ($data['data'][$i]->total <= $data['data'][$i]->item_rop)
			{
				$j=$j+1;
			}
		}
		return $j;
	}

/* Function for getting all stock details against a branch */
	public function getBranchStockDetails(){
		$branch_name=$this->session->userdata('user_branch');
		$get_branch=$this->Stock_model->get_branch_id($branch_name);
		$branch_id=$get_branch[0]->branch_id;

		$openingStockArray=$this->Stock_model->getAllOpeningStockDetails($branch_id);
		$result['totalOpeningStockSum']=array_sum(array_column($openingStockArray,'item_quantity'));

		$receivedFromMasterArray=$this->Stock_model->getAllStockReceivedFromMaster($branch_id);
		$result['totalReceivedFromMasterSum']=array_sum(array_column($receivedFromMasterArray,'request_quantity'));

		$issuedQuantityArray=$this->Stock_model->getAllIssuedDetails($branch_id);
		$result['totalIssuedItemSum']=array_sum(array_column($issuedQuantityArray,'issue_quantity'));

		$returnedToMasterArray=$this->Stock_model->getAllStockReturnedToMaster($branch_id);
		$result['totalReturnedToMaterSum']=array_sum(array_column($returnedToMasterArray,'item_quantity'));

		$branchToBranchIssuedArray=$this->Stock_model->getAllStockIssuedToBranches($branch_id);
		$result['totalBranchToBranchIssuedSum']=array_sum(array_column($branchToBranchIssuedArray,'item_quantity'));

		$branchToBranchReceivedArray=$this->Stock_model->getAllStockReceivedFromBranches($branch_id);
		$result['totalBranchToBranchReceivedSum']=array_sum(array_column($branchToBranchReceivedArray,'item_quantity'));

		$result['total_balance_stock']= $result['totalOpeningStockSum']+$result['totalReceivedFromMasterSum']+$result['totalBranchToBranchReceivedSum']-$result['totalIssuedItemSum']-$result['totalReturnedToMaterSum']-$result['totalBranchToBranchIssuedSum'];

		$json_data = json_encode($result);
		echo $json_data;
	}

}
