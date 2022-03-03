<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_view_Request extends MY_Controller {
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
		$this->load->model('Returnmodel');
		$this->load->model('Stock_model');
		$this->load->model('Masterstock_model');
		$this->load->model('Admin_view_Request_model');
	}
	public function index()
	{

		$template['body'] = 'Admin_view_request/list';
		$template['script'] = 'Admin_view_request/script';
		$this->load->view('template', $template);
	}

	public function getRequest()
	{
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
		$param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
		$param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
		$param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
		$param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
		$param['branch'] = (isset($_REQUEST['branch']))?$_REQUEST['branch']:
		$data=$this->Admin_view_Request_model->getRequest($param);
		$json_data = json_encode($data);
		echo $json_data;

	}

	public function updateToapprove($id){

		$sid = $this->uri->segment(3); // user id
		$branch_name=$this->session->userdata['user_branch'];
		$branch=$this->Stock_model->get_branch_id($branch_name);
		$branch_id=intval($branch[0]->branch_id);
		$data= $this->Admin_view_Request_model->getoperator($sid);
		$itemid = $this->Admin_view_Request_model->getItemid($sid); // all the details about user requst stored.
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
		$param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
		$param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
		$param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
		$param['branch'] = (isset($_REQUEST['branch']))?$_REQUEST['branch']:'';
		$param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
		$data = $this->Masterstock_model->getStockTable($param);
		$bstock =$this->Masterstock_model->getBstock();
		for($i=0;$i<count($data['data']);$i++){
			$tot=0;
			for($j=0;$j<count($bstock['data']);$j++){
				if($data['data'][$i]->item_id_fk == $bstock['data'][$j]->item_id_fk){
					$tot = $bstock['data'][$j]->total;
					break;
				}
			}
			// $tot=500;
			$data['data'][$i]->btotal = $tot;
			$issued = $this->Masterstock_model->get_issued($data['data'][$i]->item_id_fk);
			// print_r($issued); die;
			$request = $this->Masterstock_model->get_request($data['data'][$i]->item_id_fk);
			$data['data'][$i]->requestquantity = $request[0]->request;
			$data['data'][$i]->issuedquantity = $issued[0]->issued;
			$data['data'][$i]->t_quantity = $data['data'][$i]->opening_stock + $data['data'][$i]->purchase_quantity  - $issued[0]->issued - $request[0]->request;
			$data['data'][$i]->tot_issued = $issued[0]->issued + $request[0]->request;
		}
		for ($i=0; $i < count($data['data']) ; $i++){
			if ($itemid[0]->item_id_fk == $data['data'][$i]->item_id_fk){
				$bal_stock = $data['data'][$i]->t_quantity;
			}
		}
		//Fetching the stock balance against the selected item

		$req_item_stock_balance=$this->GetItemwiseBranchStock(intval($sid));

		// var_dump($itemid[0]->request_quantity); die;
		// #######################################################################################
		//Temporary static code, it need to change
		$req_item_stock_balance=500;
		// #######################################################################################
		if (intval($req_item_stock_balance) < intval($itemid[0]->request_quantity)){
			$response_text='Available Quantity is Lesser than Requested Quantity';
			$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;error&quot;}");
		}
		else{
			$data=$this->Admin_view_Request_model->updateToapprove($id);
			$response_text='Request Approved';
			$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
		}
		redirect('/Admin_view_Request/', 'refresh');
	}

	public function GetItemwiseBranchStock($request_id){
		if(!empty($request_id)){
			$request_details=$this->Admin_view_Request_model->getRequestDetails($request_id);
			$req_item_id=$request_details[0]->item_id_fk;
			$req_branch_id=$request_details[0]->branch_id_fk;

			$openingstock=$this->Stock_model->get_item_openingstock($req_item_id);
			$result['openingstock']=array_sum(array_column($openingstock,'item_quantity'));

			$purchasestock=$this->Stock_model->get_item_purchasestock($req_item_id);
			$result['purchasestock']=array_sum(array_column($purchasestock,'item_quantity'));

			// To fetch Issued to master stock quantity
			$returnfrombranches=$this->Stock_model->get_stock_returns_from_branch($req_item_id);
			$result['returnfrombranches']=array_sum(array_column($purchasestock,'item_quantity'));

			$issuedcount=$this->Stock_model->get_total_issued($req_item_id);
			$result['totalissued']=array_sum(array_column($issuedcount,'issue_quantity'));

			$result['total_item_stock_balance']=$result['openingstock']+$result['purchasestock']-$result['returnfrombranches']-$result['totalissued'];

			return $result['total_item_stock_balance'];
		}

		// $openingStockArray=$this->Stock_model->getItemOpeningStockDetails($branch_id,$item_id);
		// $result['totalOpeningStockSum']=array_sum(array_column($openingStockArray,'item_quantity'));
		//
		// $receivedFromMasterArray=$this->Stock_model->getItemStockReceivedFromMaster($branch_id,$item_id);
		// $result['totalReceivedFromMasterSum']=array_sum(array_column($receivedFromMasterArray,'request_quantity'));
		//
		// $issuedQuantityArray=$this->Stock_model->getItemIssuedDetails($branch_id,$item_id);
		// $result['totalIssuedItemSum']=array_sum(array_column($issuedQuantityArray,'issue_quantity'));
		//
		// $returnedToMasterArray=$this->Stock_model->getItemStockReturnedToMaster($branch_id,$item_id);
		// $result['totalReturnedToMaterSum']=array_sum(array_column($returnedToMasterArray,'item_quantity'));
		//
		// $branchToBranchIssuedArray=$this->Stock_model->getItemStockIssuedToBranches($branch_id,$item_id);
		// $result['totalBranchToBranchIssuedSum']=array_sum(array_column($branchToBranchIssuedArray,'item_quantity'));
		//
		// $branchToBranchReceivedArray=$this->Stock_model->getItemStockReceivedFromBranches($branch_id,$item_id);
		// $result['totalBranchToBranchReceivedSum']=array_sum(array_column($branchToBranchReceivedArray,'item_quantity'));
		//
		// $result['total_item_balance_stock']= $result['totalOpeningStockSum']+$result['totalReceivedFromMasterSum']+$result['totalBranchToBranchReceivedSum']-$result['totalIssuedItemSum']-$result['totalReturnedToMaterSum']-$result['totalBranchToBranchIssuedSum'];
		//
		// return $result;
	}

	public function updateToreject()
	{
		$id = $this->input->post('req_id');
		$reason = $this->input->post('reason');
		$data=$this->Admin_view_Request_model->updateToreject($id,$reason);
		redirect('/Admin_view_Request/', 'refresh');
	}

	function get_operator(){

		$request_id = $this->input->post('request_id');

		// print_r($pr_id);
		// exit();
		$data = $this->Admin_view_Request_model->get_operator($request_id);

		//echo $data[0]->user_name;
		echo json_encode("Rejected by".$data[0]->user_name." reason: ".$data[0]->reject_reason." On ".$data[0]->updated_date);
	}

	function get_operator_aprove(){
		$request_id = $this->input->post('request_id');
		// print_r($pr_id);
		// exit();
		$data = $this->Admin_view_Request_model->get_operator($request_id);
		//echo $data[0]->user_name;
		echo json_encode("Aproved by ".$data[0]->user_name." On ".$data[0]->updated_date);
	}

	function edit(){
		$this->load->model('Users_model');
		$request_id = $this->uri->segment(3);
		$template['items'] = $this->Users_model->get_items();
		$template['record'] = $this->Admin_view_Request_model->get_request($request_id);
		$template['body'] = "Admin_view_request/add";
		$template['script'] = 'Admin_view_request/script';
		$this->load->view('template',$template);
	}

	function add(){

		$request_id = $this->input->post('request_id');
		$quantity = $this->input->post('quantity');
		$items=$this->input->post('itemid');
		$data = array(
			'request_quantity' => $quantity,
			'item_id_fk'=>$items
		);

		$this->General_model->update('tbl_request_item',$data,'request_id',$request_id);
		redirect('Admin_view_Request');

	}

	public function adminUpdateBranchRequestQuantity(){
		$insertArray=array(
			'request_quantity' => intval($_POST['new_quantity'])
		);
		$result=$this->Admin_view_Request_model->update_request_quantity($insertArray);
		$response_text=$result["message"];
		if($result['status']){
			$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
		}
		else{
			$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;error&quot;}");
		}
		redirect('/Admin_view_Request/', 'refresh');
	}
}

?>
