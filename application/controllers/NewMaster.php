<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class NewMaster extends MY_Controller {
	private $branch_name;
	private $branch_id;
	private $params;
	private $result;

	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
			redirect('/login');
		}
		$this->load->model('General_model');
		$this->load->model('Masterstock_model');
		$this->load->model('NewMasterstock_model');
		$this->load->model('NewCommonModel');
		if(isset($_POST)){
			$this->params=$_POST;
		}
		if(isset($_REQUEST)){
			$this->param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
			$this->param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
			$this->param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
			$this->param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
			$this->param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
			$this->param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
		}

		if(!empty($this->session->userdata('user_branch'))){
			$this->branch_name=$this->session->userdata('user_branch');
			$this->branch_id=$this->NewCommonModel->getBranchID($this->branch_name);
		}
	}

	public function showBranchItemRequestsPage(){
		$template['body'] = 'NewMaster/BranchRequests/list';
		$template['script'] = 'NewMaster/BranchRequests/script';
		$this->load->view('template', $template);
	}

	public function approveStockRequestMaster(){
		$req_id = $this->params['req_id'];
		$data = [
			'req_status' => 1,
		];
		$response = $this->General_model->update('ntbl_bs_stockrequests',$data,'req_id',$req_id);

		if($response)
		{
			redirect('newMaster/showBranchItemRequestsPage');
		}
		else
		{
			echo '<script>alert("something Went Wrong")</script>';
			redirect('NewMaster/showBranchItemRequestsPage');
		}
	}

	public function ajaxTotalStocks(){
		$item_id = $this->params['item_id'];

		$this->result = $this->Masterstock_model->getAjaxTotalStocks($item_id);
	}

	public function rejectStockRequestMaster(){
		$req_id = $this->params['req_id'];
		if($req_id){
			$data = [
				'req_status' => 2,
				'req_remarks' => $this->params['reject_descp'],
			];

			$response = $this->General_model->update('ntbl_bs_stockrequests',$data,'req_id',$req_id);
			if($response)
			{
				redirect('NewMaster/showBranchItemRequestsPage');
			}
			else
			{
				echo '<script>alert("something Went Wrong")</script>';
				redirect('NewMaster/showBranchItemRequestsPage');
			}
		}
	}
	//////////////////Vendor///////////////////////////
	public function showVendor(){
		$template['body'] = 'NewMaster/Vendor/list';
		$template['script'] = 'NewMaster/Vendor/script';
		$this->load->view('template',$template);
	}

	public function getVendorList(){
		$this->result = $this->Masterstock_model->getVendorListsTable();
	}

	public function addVendorList(){
		$this->form_validation->set_rules('v_name', 'Name', 'required');
		$this->form_validation->set_rules('ve_gst', 'Gst', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['body'] = 'NewMaster/Vendor/add';
			$template['script'] = 'NewMaster/Vendor/script';
			$this->load->view('template', $template);
		}
		else
		{
			$vendor_id = $this->params['ven_id'];
			if($vendor_id){
				die($vendor_id);
			}
			$data = array(
				'vendor_name'=>$this->params['v_name'],
				'vendor_address'=>$this->params['v_address'],
				'vendor_phone'=>$this->params['v_phone'],
				'vendor_email'=>$this->params['v_email'],
				'vendor_gst'=>$this->params['ve_gst'],
				'vendor_pan'=>$this->params['v_pan'],
				'vendor_status'=>1,

			);
			$result=$this->General_model->add('ntbl_vendor',$data);
			if($result)
			{
				redirect('NewMaster/showVendor','refresh');
			}
			else
			{
				redirect('NewMaster/showVendor','refresh');
			}
		}
	}

	public function deleteVendorDetails(){
		$v_id = $this->params['vendor_id'];
		$condition = [
			'vendor_status' => 0,
		];
		$this->result = $this->General_model->update('ntbl_vendor',$condition,'vendor_id',$v_id);
	}

	public function showVendorPaymentList(){
		$template['body'] = 'NewMaster/Vendor/pay_list';
		$template['script'] = 'NewMaster/Vendor/script';
		$this->load->view('template', $template);
	}

	public function getVendorPayemntList(){
		$this->result = $this->Masterstock_model->getVendorPayList();
	}

	public function addVendorPayment($vendor_id){
		$template['records'] = $this->Masterstock_model->getvendorPaymentadddetails($vendor_id);
		//var_dump($template['records']);die;
		$template['body'] = 'NewMaster/Vendor/pay';
		$template['script'] = 'NewMaster/Vendor/script';
		$this->load->view('template', $template);
	}

	public function addpaymentVendor(){
		$data = array(
			'vendor_id_fk'=>$this->params['ven_id'],
			'vendor_payment'=>1,
			'vendor_payed_amt'=>$this->params['ve_pay_amt'],
		);
		$result=$this->General_model->add('ntbl_vendor_pay',$data);
		if($result){
			redirect('NewMaster/showVendorPaymentList','refresh');
		}
		else{
			redirect('NewMaster/showVendorPaymentList','refresh');
		}
	}
	///////////////////////////Purchase////////////////////////////
	public function showPurchase(){
		$template['body'] = 'NewMaster/Purchase/list';
		$template['script'] = 'NewMaster/Purchase/script';
		$this->load->view('template',$template);
	}

	public function getPurchaseList(){
		$this->result = $this->Masterstock_model->getPurchaseListsTable();
	}

	public function ajaxItemList(){
		$this->result = $this->Masterstock_model->getajaxItemTable();
	}

	public function addPurchaseList(){
		$this->form_validation->set_rules('bill_no', 'Bill Number', 'required');
		if ($this->form_validation->run() == FALSE) {
			$vendor_con = ['vendor_status'=>1];
			$item_con = ['item_status'=>1];
			$template['vendor'] = $this->General_model->getall('ntbl_vendor',$vendor_con);
			$template['item'] = $this->General_model->getall('ntbl_items',$item_con);
			$template['body'] = 'NewMaster/Purchase/add';
			$template['script'] = 'NewMaster/Purchase/script';
			$this->load->view('template', $template);
		}
		else{
			$purchae_id = $this->params['pur_id'];
			if(empty($purchae_id)){
				$purchase_vendor=$this->params['v_list_id'];
				$purchase_bill_number=$this->params['bill_no'];
				$purchase_gst_no=$this->params['gst_no'];
				$purchase_item_list_id=$this->params['item_list_id'];
				$purchase_qty=$this->params['pur_qty'];
				$purchase_price=$this->params['pur_price'];
				$purchase_tax=$this->params['pur_tax'];
				$purchase_total=$this->params['pur_total'];
				$purchase_date=date('Y-m-d h:i:sa',strtotime($this->params['pur_date']));

				for($i=0;$i<count($purchase_qty);$i++){
					$item = array(
						'purchase_vendor_id_fk'=>$purchase_vendor,
						'purchase_bill_no'=>$purchase_bill_number,
						'purchase_gst_no'=>$purchase_gst_no,
						'purchase_item_id_fk'=>$purchase_item_list_id[$i],
						'purchase_qty'=>$purchase_qty[$i],
						'purchase_price'=>$purchase_price[$i],
						'purchase_tax'=>$purchase_tax[$i],
						'purchase_amt'=>$purchase_total[$i],
						'purchase_date'=>$purchase_date,
						'purchase_status'=>1,
						'created_at'=>date('Y-m-d H:i:s'),
					);
					$master_branch=$this->NewCommonModel->get_master_id();
					$updateMasterStock=$this->NewCommonModel->stockUpdate($master_branch,$purchase_item_list_id[$i],$purchase_qty[$i],true);
					$result = $this->General_model->add('ntbl_purchase',$item);
				}
			}else{
				$purchase_vendor=$this->params['v_list_id'];
				$purchase_bill_number=$this->params['bill_no'];
				$purchase_gst_no=$this->params['gst_no'];
				$purchase_item_list_id=$this->params['item_list_id'];
				$purchase_qty=$this->params['pur_qty'];
				$purchase_price=$this->params['pur_price'];
				$purchase_tax=$this->params['pur_tax'];
				$purchase_total=$this->params['pur_total'];
				$purchase_date=date('Y-m-d h:i:sa',strtotime($this->params['pur_date']));
				$purchase__status=1;
				for($i=0;$i<count($purchase_qty);$i++){
					$item = array(
						'purchase_vendor_id_fk'=>$purchase_vendor,
						'purchase_bill_no'=>$this->$purchase_bill_number,
						'purchase_gst_no'=>$this->$purchase_gst_no,
						'purchase_item_id_fk'=>$this->$purchase_item_list_id[$i],
						'purchase_qty'=>$this->$purchase_qty[$i],
						'purchase_price'=>$this->$purchase_price[$i],
						'purchase_tax'=>$this->$purchase_tax[$i],
						'purchase_amt'=>$purchase_total[$i],
						'purchase_date'=>$purchase_date,
						'purchase_status'=>1,
						'created_at'=>date('Y-m-d H:i:s'),
					);
					$master_branch=$this->NewCommonModel->get_master_id();
					$updateMasterStock=$this->NewCommonModel->stockUpdate($master_branch,$purchase_item_list_id[$i],$purchase_qty[$i],true);
					$result = $this->General_model->update('ntbl_purchase',$item,'purchase_id',$purchae_id);
				}
			}
			if($result){
				$message="Purchase added to stock successfully!";
				$this->session->set_flashdata('message',$message);
				$this->session->set_flashdata('type',"success");
				redirect('NewMaster/showPurchase','refresh');
			}
			else{
				$message="Something went wrong!";
				$this->session->set_flashdata('message',$message);
				$this->session->set_flashdata('type',"error");
				redirect('NewMaster/showPurchase','refresh');
			}
		}
	}

	public function deletePurchaseDetails(){
		$purchase_id = $this->params['purchase_id'];
		$condition = [
			'purchase_status' => 0,
		];
		$this->result = $this->General_model->update('ntbl_purchase',$condition,'purchase_id',$purchase_id);
	}
	/////////////////////Reorder Point Master///////////////////
	public function showReoderMaster(){
		$template['body'] = 'NewMaster/ReorderPoint/Master/list';
		$template['script'] = 'NewMaster/ReorderPoint/Master/script';
		$this->load->view('template',$template);
	}

	public function getROPMaster(){
		$this->result = $this->Masterstock_model->getROPmasterTable();
	}

	public function addROPmasterList(){
		$this->form_validation->set_rules('item_list_id', 'Item List', 'required');
		$this->form_validation->set_rules('rop_no', 'ROP Number', 'required');
		if ($this->form_validation->run() == FALSE) {
			$item_con = ['item_status'=>1];
			$template['item'] = $this->General_model->getall('ntbl_items',$item_con);
			$template['body'] = 'NewMaster/ReorderPoint/Master/add';
			$template['script'] = 'NewMaster/ReorderPoint/Master/script';
			$this->load->view('template', $template);
		}
		else{
			$rop_master_id = $this->params['rop_master_id'];
			$data = array(
				'rop_master_item_id_fk'=>$this->params['item_list_id'],
				'rop_master_ROP'=>$this->params['rop_no'],
				'rop_master_date'=>date('Y-m-d',strtotime($this->params['rop_date'])),
				'rop_master_status'=>1,
				'updated_at'=>date('Y-m-d H:i:s'),
				'created_at'=>date('Y-m-d H:i:s'),

			);
			if(!empty($rop_master_id)){
				$result=$this->General_model->update('ntbl_rop_master',$data,'rop_master_id',$rop_master_id);
			}
			else{
				$result=$this->General_model->add('ntbl_rop_master',$data);
			}
			if($result){
				redirect('NewMaster/showReoderMaster','refresh');
			}
			else{
				redirect('NewMaster/showReoderMaster','refresh');
			}
		}
	}

	public function editROPmasterList($item_id){
		$item_con = ['item_status'=>1];
		$template['item'] = $this->General_model->getall('ntbl_items',$item_con);
		$template['records'] = $this->Masterstock_model->getEditRopMasterList($item_id);
		$template['body'] = 'NewMaster/ReorderPoint/Master/add';
		$template['script'] = 'NewMaster/ReorderPoint/Master/script';
		$this->load->view('template', $template);
	}

	public function deleteROPmasterDetails(){
		$rop_master_id = $this->params['rop_master_id'];
		$condition = [
			'rop_master_status' => 0,
		];
		$this->result = $this->General_model->update('ntbl_rop_master',$condition,'rop_master_id',$rop_master_id);
	}
	/////////////////Reorder Point Branch/////////////////////////
	public function showReoderBranch(){
		$template['body'] = 'NewMaster/ReorderPoint/Branch/list';
		$template['script'] = 'NewMaster/ReorderPoint/Branch/script';
		$this->load->view('template',$template);
	}

	public function getROPBranch(){
		$this->result = $this->Masterstock_model->getROPbranchTable();
	}

	public function addROPbranchList(){
		$this->form_validation->set_rules('item_list_id', 'Item List', 'required');
		$this->form_validation->set_rules('rop_no', 'ROP Number', 'required');
		if ($this->form_validation->run() == FALSE) {
			$branch_con = ['branch_status'=>1];
			$item_con = ['item_status'=>1];
			$template['branch'] = $this->General_model->getall('ntbl_branches',$branch_con);
			$template['item'] = $this->General_model->getall('ntbl_items',$item_con);
			$template['body'] = 'NewMaster/ReorderPoint/Branch/add';
			$template['script'] = 'NewMaster/ReorderPoint/Branch/script';
			$this->load->view('template', $template);
		}
		else{
			$ropBranch_id = $this->params['ropBranch_id'];

			$data = array(
				'rop_branch_id_fk'=>$this->params['branch_list_id'],
				'rop_branch_item_id_fk'=>$this->params['item_list_id'],
				'rop_branch_ROP'=>$this->params['rop_no'],
				'rop_branch_date'=>date('Y-m-d',strtotime($this->params['rop_date'])),
				'rop_branch_status'=>1,

			);
			$result=$this->General_model->add('ntbl_rop_branch',$data);
			if($result)
			{
				redirect('NewMaster/showReoderBranch','refresh');
			}
			else
			{
				redirect('NewMaster/showReoderBranch','refresh');
			}
		}
	}

	public function deleteROPbranchDetails(){
		$rop_branch_id = $this->params['rop_branch_id'];
		$condition = [
			'rop_branch_status' => 0,
		];
		$this->result = $this->General_model->update('ntbl_rop_branch',$condition,'rop_branch_id',$rop_branch_id);
	}
	/////////////Opening Stock Master//////////////////
	public function showMasterOpeningStock(){
		$cond = ['cate_status' => 1,];
		$condition=['branch_status'=>1];
		$condition1=['item_status'=>1];
		$template['category_list'] = $this->General_model->getall('ntbl_category',$cond);
		$template['branch_list'] = $this->General_model->getall('ntbl_branches',$condition);
		$template['item_list'] = $this->General_model->getall('ntbl_items',$condition1);
		$template['body'] = 'NewMaster/OpeningStock/Master/list';
		$template['script'] = 'NewMaster/OpeningStock/Master/script';
		$this->load->view('template',$template);
	}

	public function addNewItem(){
		$item_name = $this->params['item_name'];
		if(!empty($item_name)){
			$data = array(
				'item_name' =>$item_name,
				'cate_id_fk'=>$this->params['cate_id'],
				'item_status' =>1,
			);
			$result = $this->General_model->add('ntbl_items',$data);
			$new_item_id = $this->db->insert_id();
			$item_qty = $this->params['item_qty'];
			if(!empty($item_qty)){
				$items_qtys = [
					'os_item_id_fk' =>$new_item_id,
					'os_quantity' =>$this->params['item_qty'],
				];
				$result = $this->General_model->add('ntbl_master_os',$items_qtys);
			}
			if($result){
				redirect('NewMaster/showMasterOpeningStock');
			}
		}
	}

	public function getMasterStock(){
		$this->result = $this->NewCommonModel->get_opening_stock_details($this->branch_id);
	}

	public function updateMasterStockDetails($os_id){
		$template['records'] = $this->General_model->get_row('ntbl_items','item_id',$os_id,);
		$template['body'] = 'NewMaster/OpeningStock/Master/add';
		$template['script'] = 'NewMaster/OpeningStock/Master/script';
		$this->load->view('template',$template);
	}

	public function updatMasterStock(){
		$data = array(
			'os_item_id_fk'=>$this->params['ms_item_id'],
			'os_quantity'=>$this->params['stck_qty'],
			'os_status'=>1,
			'created_at'=>date('Y-m-d'),
			'updated_at'=>date('Y-m-d'),
		);
		$result=$this->General_model->add('ntbl_master_os',$data);

		if($result)
		{
			redirect('NewMaster/showMasterOpeningStock','refresh');
		}
		else
		{
			redirect('NewMaster/showMasterOpeningStock','refresh');
		}
	}

	public function deleteItems2(){
		$item_id = $this->params['item_id'];
		$this->result = $this->General_model->delete('ntbl_items','item_id',$item_id);
	}
	//////////////////////B2BRequest////////////////////////////////////////
	public function showB2bRequest(){
		$template['body'] = 'NewMaster/B2bRequest/list';
		$template['script'] = 'NewMaster/B2bRequest/script';
		$this->load->view('template',$template);
	}

	public function getB2bRequest(){
		$this->result = $this->Masterstock_model->getB2bRequestList();
	}

	public function approvajaxb2b(){
		$b2b_id = $this->params['b2b_id'];
		$cond = ['is_approved' => 1,];
		$condition=['btob_id'=>$b2b_id];
		$requestDetails=$this->NewCommonModel->get_data_where('ntbl_bs_branchtobranch',$condition);
		$request_id=$requestDetails[0]->btob_id;
		$from_branch=$requestDetails[0]->btob_branch_id_fk;
		$to_branch=$requestDetails[0]->btob_to_branch_id_fk;
		$item_id=$requestDetails[0]->btob_item_id_fk;
		$quantity=$requestDetails[0]->btob_quantity;
		// stock balance update
		$currentFromBranchStock=$this->NewCommonModel->get_single_item_current_stock($from_branch,$item_id);
		$newBalance=intval($currentFromBranchStock)-intval($quantity);
		if($newBalance<=0){
			$this->result['status']=false;
			$message="Stock balance will be below 0 if approved!";
			$this->session->set_flashdata('message',$message);
			$this->session->set_flashdata('type',"warning");
			redirect('newMaster/showBranchReturn', 'refresh');
		}
		else{
			$updateFromBranchStockBalance=$this->NewCommonModel->stockUpdate($from_branch,$item_id,$quantity,false);
			$updateToBranchStockBalance=$this->NewCommonModel->stockUpdate($to_branch,$item_id,$quantity,true);
		}
		if($updateFromBranchStockBalance && $updateToBranchStockBalance){
			$this->result = $this->General_model->update('ntbl_bs_branchtobranch',$cond,'btob_id',$b2b_id);
		}
		else{
			$message="Couldn't update the stock! Something went wrong!";
			$this->session->set_flashdata('message',$message);
			$this->session->set_flashdata('type',"error");
			redirect('newMaster/showBranchReturn', 'refresh');
		}
	}

	public function rejectajaxb2b(){
		$b2b_id = $this->params['b2b_id'];
		$remark = $this->params['remarks'];
		$cond = [
			'is_approved' => 2,
		];
		if(!empty($b2b_id)){
			$this->result = $this->General_model->update('ntbl_bs_branchtobranch',$cond,'btob_id',$b2b_id);
			redirect('NewMaster/showB2bRequest');
		}
	}
	//////////////////Branch Return//////////////////////
	public function showBranchReturn(){
		$template['body'] = 'NewMaster/BranchReturn/list';
		$template['script'] = 'NewMaster/BranchReturn/script';
		$this->load->view('template',$template);
	}

	public function getBranchReturnList(){
		$this->result = $this->Masterstock_model->getBranchReturnListTable();
	}

	public function ajaxapproveBReturn(){
		$return_id =$this->params['return_id'];
		$cond = [
			'is_approved' => 1,
		];
		$this->result = $this->General_model->update('ntbl_bs_returntomaster',$cond,'return_id',$return_id);
	}

	public function approveBReturns(){
		$new_return_qty = "";
		$return_id = $this->params['return_id'];
		$scrap_qty = $this->params['scrap_qty'];
		$condition=['return_id'=>$return_id];
		$return_details=$this->NewCommonModel->get_data_where_row('ntbl_bs_returntomaster',$condition);
		$item_id=$return_details->return_item_id_fk;
		$branch_id=$return_details->return_branch_id_fk;
		$quantity=$return_details->return_quantity;
		$master_branch=$this->NewCommonModel->get_master_id();
		if($scrap_qty == 0){
			$cond = [
				'is_approved' => 1,
			];
			$this->result = $this->General_model->update('ntbl_bs_returntomaster',$cond,'return_id',$return_id);
			$updateBranchStock=$this->NewCommonModel->stockUpdate($branch_id,$item_id,$quantity,false);
			$updateMasterStock=$this->NewCommonModel->stockUpdate($master_branch,$item_id,$quantity,true);

			if($this->result&&$updateBranchStock&&$updateMasterStock){
				$message="Updated successfully";
				$this->session->set_flashdata('message',$message);
				$this->session->set_flashdata('type',"success");
				redirect('NewMaster/showBranchReturn', 'refresh');
			}
		}
		else{
			$data = $this->General_model->get_row('ntbl_bs_returntomaster','return_id',$return_id);
			if(!empty($data)){
				if(intval($data->return_quantity)>=intval($scrap_qty)){
					$new_return_qty = (int)$data->return_quantity - (int)$scrap_qty;
					$add_scrap = [
						'scrap_qty' => $scrap_qty,
					];
					$this->result = $this->General_model->add('ntbl_scrap_items',$add_scrap);
					$cond = [
						'return_quantity' =>$new_return_qty,
						'is_approved' => 1,
					];
					$updateBranchStock=$this->NewCommonModel->stockUpdate($branch_id,$item_id,$new_return_qty,false);
					$updateMasterStock=$this->NewCommonModel->stockUpdate($master_branch,$item_id,$new_return_qty,true);
					$this->result = $this->General_model->update('ntbl_bs_returntomaster',$cond,'return_id',$return_id);
					if($this->result&&$updateBranchStock&&$updateMasterStock){
						$message="Stock and scrap updated successfully";
						$this->session->set_flashdata('message',$message);
						$this->session->set_flashdata('type',"success");
						redirect('NewMaster/showBranchReturn', 'refresh');
					}
					else{
						$message="Oops! Something went wrong. Failed to update stock!";
						$this->session->set_flashdata('message',$message);
						$this->session->set_flashdata('type',"error");
						redirect('NewMaster/showBranchReturn', 'refresh');
					}
				}
				else{
					$message="Scrap quantity is greater than the returned quantity!";
					$this->session->set_flashdata('message',$message);
					$this->session->set_flashdata('type',"warning");
					redirect('NewMaster/showBranchReturn', 'refresh');
				}
			}
			else{
				$message="No data found in database!";
				$this->session->set_flashdata('message',$message);
				$this->session->set_flashdata('type',"error");
				redirect('NewMaster/showBranchReturn', 'refresh');
			}
		}
	}

	public function rejectBReturn(){
		$return_id = $this->params['return_id'];

		$cond = [
			'is_approved' => 2,
			'return_remarks' => $this->params['reject_descp'],
		];
		$this->result = $this->General_model->update('ntbl_bs_returntomaster',$cond,'return_id',$return_id);
		if($this->result){
			redirect('NewMaster/showBranchReturn');
		}
	}
	///////////////////////Purchase Stock////////////////////////////
	public function showPurchaseStock(){
		$template['body'] = 'NewMaster/PurchaseStock/list';
		$template['script'] = 'NewMaster/PurchaseStock/script';
		$this->load->view('template',$template);
	}

	public function getPurchaseStockList(){
		$this->result = $this->Masterstock_model->getPurchaseStockListTable();
	}
	/////////////////////Master Stock///////////////////////////////
	public function showMasterStock(){
		$template['body'] = 'NewMaster/MasterStock/list';
		$template['script'] = 'NewMaster/MasterStock/script';
		$this->load->view('template',$template);
	}

	public function getMasterStockList(){
		$this->result = $this->Masterstock_model->getMasterStockListTable();
	}
	//////////////////Purchase Return///////////////////////////////
	public function showPurchaseReturn(){
		$template['body'] = 'NewMaster/PurchaseReturn/list';
		$template['script'] = 'NewMaster/PurchaseReturn/script';
		$this->load->view('template',$template);
	}

	public function getPurchaseReturn(){
		$this->result = $this->Masterstock_model->getPurchaseListsTables();
	}

	public function addPurchaseReturn($purchase_id){
		$template['records'] = $this->Masterstock_model->getPurchaseEditList($purchase_id);
		$template['body'] = 'NewMaster/PurchaseReturn/add';
		$template['script'] = 'NewMaster/PurchaseReturn/script';
		$this->load->view('template',$template);
	}

	public function updatePurchaseReturns(){
		$pur_return_qty = $this->params['pur_return_qty'];
		if(!empty($pur_return_qty)){
			$purchase_idse = $this->params['purchase_id'];
			$purchase_list = $this->General_model->get_row('ntbl_purchase','purchase_id',$purchase_idse);
			$item_id=$purchase_list->purchase_item_id_fk;
			$master_branch=$this->NewCommonModel->get_master_id();
			// calculate return amount//
			$purchase_final_amt = ($purchase_list->purchase_price/$purchase_list->purchase_qty) * $pur_return_qty;
			$check = $this->General_model->get_row('ntbl_purchase_return','pur_rtrn_fk_id',$purchase_idse);
			if(!empty($check)){
				$update_array = [
					'pur_rtrn_qty' => $pur_return_qty,
					'pur_rtrn_amt' => $purchase_final_amt,
					'updated_at' => date('Y-m-d H:i:s'),
				];
				$updateMasterStock=$this->NewCommonModel->stockUpdate($master_branch,$item_id,$pur_return_qty,false);
				if($updateMasterStock){
					$this->result = $this->General_model->update('ntbl_purchase_return',$update_array,'pur_rtrn_fk_id',$purchase_idse);
					if($this->result){
						$message="Successfully updated stock";
						$this->session->set_flashdata('message',$message);
						$this->session->set_flashdata('type',"success");
						redirect('NewMaster/showPurchaseReturn', 'refresh');
					}
					else{
						$message="Failed to update master stock balance!";
						$this->session->set_flashdata('message',$message);
						$this->session->set_flashdata('type',"error");
						redirect('NewMaster/showPurchaseReturn', 'refresh');
					}
				}
				else{
					$message="Something went wrong! Failed to update stock!";
					$this->session->set_flashdata('message',$message);
					$this->session->set_flashdata('type',"error");
					redirect('NewMaster/showPurchaseReturn', 'refresh');
				}
			}
			else
			{
				$insert_array = [
					'pur_rtrn_fk_id' => $purchase_idse,
					'pur_rtrn_item_id' => $this->params['item_id_fk'],
					'pur_rtrn_qty' => $pur_return_qty,
					'pur_rtrn_bill_no' => $this->params['bill_no_fk'],
					'pur_rtrn_amt' => $purchase_final_amt,
					'pur_rtrn_status' => 1,
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s'),
				];
				$updateMasterStock=$this->NewCommonModel->stockUpdate($master_branch,$item_id,$pur_return_qty,false);
				if($updateMasterStock){
					$this->result = $this->General_model->add('ntbl_purchase_return',$insert_array);
					$message="Successfully updated stock";
					$this->session->set_flashdata('message',$message);
					$this->session->set_flashdata('type',"success");
					redirect('NewMaster/showPurchaseReturn', 'refresh');
				}
				else{
					$message="Failed to update! Something went wrong";
					$this->session->set_flashdata('message',$message);
					$this->session->set_flashdata('type',"error");
					redirect('NewMaster/showPurchaseReturn', 'refresh');
				}
			}
		}
	}
	/////////////////Employee//////////////////////////
	public function ShowEmployeeList(){
		$template['body'] = 'NewMaster/Employee/list';
		$template['script'] = 'NewMaster/Employee/script';
		$this->load->view('template',$template);
	}

	public function getEmployeeList(){
		$this->result = $this->Masterstock_model->getEmployeeListTable();
	}

	public function addEmployee(){
		$this->form_validation->set_rules('branch_name','Select Branch','required');
		$this->form_validation->set_rules('emp_name','Employee Name','required');
		$this->form_validation->set_rules('desg_id','Select Designation','required');
		if ($this->form_validation->run() == FALSE){
			$desg_stat = [
				'desg_status' => 1,
			];
			$template['desg_list'] = $this->General_model->getall('ntbl_designation',$desg_stat);
			$template['branch_list'] = $this->General_model->get_all('ntbl_branches');
			$template['body'] = 'NewMaster/Employee/add';
			$template['script'] = 'NewMaster/Employee/script';
			$this->load->view('template',$template);
		}
		else{
			$emp_id = $this->params['emp_id'];
			$data = [
				'branch_name' => $this->params['branch_name'],
				'emp_name' => $this->params['emp_name'],
				'desg_id_fk' => $this->params['desg_id'],
				'emp_address' => $this->params['emp_address'],
				'emp_phone_no' => $this->params['emp_phone'],
				'emp_email' => $this->params['emp_mail'],
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
				'emp_status' => 1,
			];
			if(empty($emp_id)){
				$this->result = $this->General_model->add('ntbl_branch_employees',$data);
				redirect('NewMaster/ShowEmployeeList');
			}
			else{
				$this->result = $this->General_model->update('ntbl_branch_employees',$data,'emp_id',$emp_id);
				redirect('NewMaster/ShowEmployeeList');
			}
		}
	}

	public function editemployee($emp_id){
		$cond = [
			'emp_id' => $emp_id,
		];
		$desg_stat = [
			'desg_status' => 1,
		];
		$template['desg_list'] = $this->General_model->getall('ntbl_designation',$desg_stat);
		$template['branch_list'] = $this->General_model->get_all('ntbl_branches');
		$template['records'] = $this->General_model->getall('ntbl_branch_employees',$cond);
		$template['body'] = 'NewMaster/Employee/add';
		$template['script'] = 'NewMaster/Employee/script';
		$this->load->view('template',$template);
	}

	public function deleteEmployee(){
		$emp_id = $this->params['emp_id'];
		$cond = [
			'emp_status' => 0,
		];
		$this->result = $this->General_model->update('ntbl_branch_employees',$cond,'emp_id',$emp_id);
	}
	/////////////////Designation////////////////////
	public function showDesignation(){
		$template['body'] = 'NewMaster/Designation/list';
		$template['script'] = 'NewMaster/Designation/script';
		$this->load->view('template',$template);
	}

	public function getDesignationList(){
		$this->result = $this->Masterstock_model->getDesignationTable();
	}

	public function addDesignation(){
		$this->form_validation->set_rules('desg_name','Designation Name','required');
		if ($this->form_validation->run() == FALSE){
			$template['body'] = 'NewMaster/Designation/add';
			$template['script'] = 'NewMaster/Designation/script';
			$this->load->view('template',$template);
		}
		else{
			$desg_id = $this->params['desg_id'];
			$data = [
				'desg_name' => $this->params['desg_name'],
			];
			if(empty($desg_id)){
				$this->result = $this->General_model->add('ntbl_designation',$data);
				redirect('NewMaster/showDesignation');
			}
			else{
				$this->result = $this->General_model->update('ntbl_designation',$data,'desg_id',$desg_id);
				redirect('NewMaster/showDesignation');
			}
		}
	}

	public function editDesignation($desg_id){
		$template['records'] = $this->General_model->get_row('ntbl_designation','desg_id',$desg_id);
		$template['body'] = 'NewMaster/Designation/add';
		$template['script'] = 'NewMaster/Designation/script';
		$this->load->view('template',$template);
	}

	public function deleteDesignation(){
		$desg_id = $this->params['desg_id'];
		$cond = [
			'desg_status' => 0,
		];
		$this->result = $this->General_model->update('ntbl_designation',$cond,'desg_id',$desg_id);
	}
	//////////////////////Items Category////////////////////////////
	public function showCategory(){
		$template['body'] = 'NewMaster/Category/list';
		$template['script'] = 'NewMaster/Category/script';
		$this->load->view('template',$template);
	}

	public function showItem(){
		$template['categories']=$this->NewCommonModel->getCategoryList();
		$template['body'] = 'NewMaster/Item/list';
		$template['script'] = 'NewMaster/Item/script';
		$this->load->view('template',$template);
	}

	public function addItem(){
		if(!empty($_POST['opening_stock'])){
			$insert_array=[
				'item_name'=>$_POST['item_name'],
				'item_cat_fk'=>$_POST['category'],
				'created_at'=>date('Y-m-d H:i:s'),
			];
			$opening_stock=$_POST['opening_stock'];
			$branch_id=$this->branch_id;
			$item_id=$this->NewCommonModel->insert_get_id('ntbl_items',$insert_array);
			$insert_array=[
				'os_branch_id'=>$branch_id,
				'os_item_id'=>$item_id,
				'os_stock_qty'=>$opening_stock,
				'os_status'=>1,
				'created_at'=>date('Y-m-d H:i:s'),
			];
			if($item_id){
				$updateBranchStock=$this->NewCommonModel->stockUpdate($branch_id,$item_id,$opening_stock,true);
				$addToOpeningStock=$this->NewCommonModel->add_data('ntbl_openingstock',$insert_array);
				if($updateBranchStock && $addToOpeningStock){
					$message="Item added successfully! and Opening stock updated!";
					$this->session->set_flashdata('message',$message);
					$this->session->set_flashdata('type',"success");
					redirect('NewMaster/showItem', 'refresh');
				}
				else{
					$message="Something went wrong! Failed to update new item stock";
					$this->session->set_flashdata('message',$message);
					$this->session->set_flashdata('type',"error");
					redirect('NewMaster/showItem', 'refresh');
				}
			}
			else{
				$message="Something went wrong! Failed to add new item";
				$this->session->set_flashdata('message',$message);
				$this->session->set_flashdata('type',"error");
				redirect('NewMaster/showItem', 'refresh');
			}
		}
		else{
			$insert_array=[
				'item_name'=>$_POST['item_name'],
				'item_cat_fk'=>$_POST['category'],
				'created_at'=>date('Y-m-d H:i:s')
			];
			$query1=$this->NewCommonModel->add_data('ntbl_items',$insert_array);
			if($query1){
				$message="Item added successfully";
				$this->session->set_flashdata('message',$message);
				$this->session->set_flashdata('type',"success");
				redirect('NewMaster/showItem', 'refresh');
			}
			else{
				$message="Something went wrong! Failed to add new item";
				$this->session->set_flashdata('message',$message);
				$this->session->set_flashdata('type',"error");
				redirect('NewMaster/showItem', 'refresh');
			}
		}
	}

	public function getCategoryList(){
		$this->result = $this->Masterstock_model->getCategoryTable();
	}

	public function addCategory(){
		$this->form_validation->set_rules('cate_name','Category Name','required');
		if ($this->form_validation->run() == FALSE)
		{
			$template['body'] = 'NewMaster/Category/add';
			$template['script'] = 'NewMaster/Category/script';
			$this->load->view('template',$template);
		}
		else{
			$cate_id = $this->params['cate_id'];

			$data = [
				'cate_name' => $this->params['cate_name'],
			];

			if(empty($cate_id)){
				$this->result = $this->General_model->add('ntbl_category',$data);
				redirect('NewMaster/showCategory');
			}
			else{
				$this->result = $this->General_model->update('ntbl_category',$data,'cate_id',$cate_id);
				redirect('NewMaster/showCategory');
			}
		}

	}

	public function editCategory($cate_id){
		$template['records'] = $this->General_model->get_row('ntbl_category','cate_id',$cate_id);
		$template['body'] = 'NewMaster/Category/add';
		$template['script'] = 'NewMaster/Category/script';
		$this->load->view('template',$template);
	}

	public function deleteCategory(){
		$cate_id = $this->params['cate_id'];
		$cond = [
			'cate_status' => 0,
		];
		$this->result = $this->General_model->update('ntbl_category',$cond,'cate_id',$cate_id);
	}
	////////////////Master Reorder//////////////////
	public function showMasterReorder(){
		$template['body'] = 'NewMaster/MasterReorder/list';
		$template['script'] = 'NewMaster/MasterReorder/script';
		$this->load->view('template',$template);
	}

	public function getMasterROPList(){
		$this->result = $this->Masterstock_model->getMasterRopTable();

	}
	///////////////Login Users List/////////////////////
	public function showLoginUsersList(){
		$template['body'] = 'NewMaster/UsersLogin/list';
		$template['script'] = 'NewMaster/UsersLogin/script';
		$this->load->view('template',$template);
	}

	public function getLoginUserList(){
		$this->result = $this->Masterstock_model->getLoginUserTable();
	}

	public function addLoginUsersDetails(){
		$this->form_validation->set_rules('branch_name','Brnach Name','required');
		$this->form_validation->set_rules('user_name','User Name','required');
		$this->form_validation->set_rules('user_password','User Password','required');
		if ($this->form_validation->run() == FALSE){
			$cond = [
				'branch_status' => 1,
			];
			$template['branch'] = $this->General_model->getall('ntbl_branches',$cond);
			$template['body'] = 'NewMaster/UsersLogin/add';
			$template['script'] = 'NewMaster/UsersLogin/script';
			$this->load->view('template',$template);
		}
		else{
			$user_login_id = $this->params['user_login_id'];
			$data = [
				'user_name' => $this->params['user_name'],
				'user_email' => $this->params['user_email'],
				'user_password' => $this->params['user_password'],
				'user_branch' => $this->params['branch_name'],
				'user_type' => 'S'
			];
			if(empty($user_login_id)){
				$this->result = $this->General_model->add('tbl_login',$data);
				$this->session->set_flashdata('response','User Succesfully Added');
				redirect('NewMaster/showLoginUsersList');
			}
			else{
				$this->result = $this->General_model->update('tbl_login',$data,'id',$user_login_id);
				$this->session->set_flashdata('response','User Succesfully Updated');
				redirect('NewMaster/showLoginUsersList');
			}
		}
	}

	public function deleteLoginUserDetails(){
		$id = $this->params['id'];
		$this->result = $this->General_model->delete('tbl_login','id',$id);
	}

	public function editLoginUsersDetails($id){
		$cond = [
			'branch_status' => 1,
		];
		$template['branch'] = $this->General_model->getall('ntbl_branches',$cond);
		$template['records'] = $this->Masterstock_model->editLoginUsersTable($id);
		//var_dump($template['records']);die;
		$template['body'] = 'NewMaster/UsersLogin/add';
		$template['script'] = 'NewMaster/UsersLogin/script';
		$this->load->view('template',$template);
	}
	///////////////Branch Stock////////////////
	public function showBranchStock(){
		$template['branches']=$this->NewCommonModel->getAllBranches()['data'];
		$template['body'] = 'NewMaster/BranchStock/list';
		$template['script'] = 'NewMaster/BranchStock/script';
		$this->load->view('template',$template);
	}

	public function getBranchOpeningStocks(){
		$branch_id = 2;
		$condition=[
			'os_branch_id_fk'=>$this->branch_id
		];
		$this->result = $this->Masterstock_model->getBranchOpeningStock($this->param,$condition,$branch_id);
	}
	////////////////////Branch List & Add/////////////////////
	public function showBranchLists(){
		$template['body'] = 'NewMaster/BranchList/list';
		$template['script'] = 'NewMaster/BranchList/script';
		$this->load->view('template', $template);
	}

	public function getBranchList(){
		$param['draw'] = (isset($_REQUEST['draw'])) ? $_REQUEST['draw'] : '';
		$param['length'] = (isset($_REQUEST['length'])) ? $_REQUEST['length'] : '100';
		$param['start'] = (isset($_REQUEST['start'])) ? $_REQUEST['start'] : '0';
		$param['order'] = (isset($_REQUEST['order'][0]['column'])) ? $_REQUEST['order'][0]['column'] : '';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir'])) ? $_REQUEST['order'][0]['dir'] : '';
		$param['searchValue'] = (isset($_REQUEST['search']['value'])) ? $_REQUEST['search']['value'] : '';

		$data = $this->Masterstock_model->getBranchTable2($param);
		$json_data = json_encode($data);
		echo $json_data;
	}

	public function addBranch(){
		$this->form_validation->set_rules('branch_name', 'Branch Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['body'] = 'NewMaster/BranchList/add';
			$template['script'] = 'NewMaster/BranchList/script';
			$this->load->view('template', $template);
		} else {
			$data = array(
				'branch_name' => $this->input->post('branch_name'),
				'branch_address' => $this->input->post('branch_address'),
				'branch_phone' => $this->input->post('branch_phone'),
				'branch_email' => $this->input->post('branch_email'),
				'branch_status' => 1
			);
			$branch_id = $this->input->post('branch_id');
			if ($branch_id) {
				$result = $this->General_model->update('ntbl_branches',$data,'branch_id',$branch_id);
				$response_text = 'Branch  updated successfully';
			} else {
				$result = $this->General_model->add('ntbl_branches',$data);
				$response_text = 'Branch added  successfully';
			}
			if ($result) {
				$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			} else {
				$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
			redirect('NewMaster/showBranchLists', 'refresh');
		}
	}

	public function editBranchList($branch_id){
		$template['records'] = $this->Masterstock_model->getEditBranchList($branch_id);
		$template['body'] = 'NewMaster/BranchList/add';
		$template['script'] = 'NewMaster/BranchList/script';
		$this->load->view('template',$template);
	}

	public function deleteBranchList(){
		$branch_id = $this->params['branch_id'];
		$cond = [
			'branch_status' => 0
		];
		$this->result = $this->General_model->update('ntbl_branches',$cond,'branch_id',$branch_id);
	}
	#####################################################################################################################
	// adding a branch opening stock [both master and branch considered as a branch]
	public function addNewOpeningStock(){
		$branch_id=$_POST['branch_id'];
		$item_id=$_POST['item_id'];
		$os_quantity=$_POST['os_quantity'];
		$is_os=$this->NewCommonModel->check_os_exists($branch_id,$item_id);
		if($is_os){
			$message="Cannot add opening stock! Data existing already";
			$this->session->set_flashdata('message',$message);
			$this->session->set_flashdata('type',"warning");
			redirect('NewMaster/showMasterOpeningStock', 'refresh');
		}
		else{
			$insert_array=[
				'os_branch_id'=>$branch_id,
				'os_item_id'=>$item_id,
				'os_stock_qty'=>$os_quantity,
				'created_at'=>date('Y-m-d H:i:s')
			];
			$result=$this->General_model->add('ntbl_openingstock',$insert_array);
			if($result){
				$operation=true; // true means to add in stock balance and false means deduct from stock balance.
				$stockUpdateResult=$this->NewCommonModel->stockUpdate($branch_id,$item_id,$os_quantity,$operation);
				if($stockUpdateResult){
					$message="Stock changed successfully";
					$this->session->set_flashdata('message',$message);
					$this->session->set_flashdata('type',"success");
					redirect('NewMaster/showMasterOpeningStock', 'refresh');
				}
				else{
					$message="Failed to change stock!";
					$this->session->set_flashdata('message',$message);
					$this->session->set_flashdata('type',"error");
					redirect('NewMaster/showMasterOpeningStock', 'refresh');
				}
			}
			else{
				$message="Failed to add opening stock!";
				$this->session->set_flashdata('message',$message);
				$this->session->set_flashdata('type',"error");
				redirect('NewMaster/showMasterOpeningStock', 'refresh');
			}
		}
	}
	// function to test newcommonmodel stock updattion function
	public function stockchange(){
		$branch_id=1;
		$item_id=1;
		$quantity=5;
		$operation=false;
		// $this->NewCommonModel->stockUpdate($branch_id,$item_id,$quantity,$operation);
	}
	#####################################################################################################################
	public function getCurrentStock(){
		$item_id=$this->params['item_id'];
		$requested_branch_id=$this->params['branch_id'];
		$master_branch=$this->NewCommonModel->get_master_id();
		$this->result=$this->NewCommonModel->get_single_item_current_stock($master_branch,$item_id);
	}

	public function approveStockRequest(){
		$item_id=$_POST['request_item_id'];
		$current_master_stock=intval($_POST['current_stock']);
		$requested_stock=$_POST['requested_stock'];
		$requested_branch_id=$_POST['requested_branch'];
		if(intval($current_master_stock)>intval($requested_stock)){
			$condition=['req_id'=>$_POST['request_id']];
			$update_array=['req_status'=>1];
			$result=$this->NewCommonModel->update_stock_request_status($condition,$update_array);
			$new_stock=intval($current_master_stock)-intval($requested_stock);
			$master_branch=$this->NewCommonModel->get_master_id();
			$master_update_condition=[
				'branch_id'=>$master_branch,
				'item_id'=>$item_id,
			];
			$master_update_array=['stock_balance'=>$new_stock];
			$master_update_result=$this->NewCommonModel->update_data('ntbl_stock_balances',$master_update_array,$master_update_condition);
			$check_existance=$this->NewCommonModel->get_single_item_current_stock($requested_branch_id,$item_id);
			if($check_existance!=0){
				$branch_update_condition=[
					'branch_id'=>$requested_branch_id,
					'item_id'=>$item_id
				];
				$branch_current_stock=$this->NewCommonModel->get_single_item_current_stock($requested_branch_id,$item_id);
				$new_branch_stock=intval($branch_current_stock)+intval($requested_stock);
				$branch_update_array=['stock_balance'=>$new_branch_stock];
				$branch_update_result=$this->NewCommonModel->update_data('ntbl_stock_balances',$branch_update_array,$branch_update_condition);
			}
			else{
				$branch_insert_array=[
					'branch_id'=>$requested_branch_id,
					'item_id'=>$item_id,
					'stock_balance'=>$requested_stock
				];
				$branch_update_result=$this->NewCommonModel->add_data('ntbl_stock_balances',$branch_insert_array);
			}
			if($result&&$master_update_result&&$branch_update_result){
				$message="Stock updated successfully";
				$this->session->set_flashdata('message',$message);
				$this->session->set_flashdata('type',"success");
				redirect('newMaster/showBranchItemRequestsPage', 'refresh');
			}
			else{
				$message="Stock updation failed!";
				$this->session->set_flashdata('message',$message);
				$this->session->set_flashdata('type',"error");
				redirect('newMaster/showBranchItemRequestsPage', 'refresh');
			}
		}
		else{
			$message="Current balance is less than mentioned quantity";
			$this->session->set_flashdata('message',$message);
			$this->session->set_flashdata('type',"warning");
			redirect('newMaster/showBranchItemRequestsPage', 'refresh');
		}
	}

	public function getItemList(){
		$this->result=$this->NewCommonModel->get_item_list();
	}

	public function getBranchStockFromMaster(){
		$branch_id=$_POST['branch_id'];
		$param['draw'] = (isset($_REQUEST['draw'])) ? $_REQUEST['draw'] : '';
		$param['length'] = (isset($_REQUEST['length'])) ? $_REQUEST['length'] : '100';
		$param['start'] = (isset($_REQUEST['start'])) ? $_REQUEST['start'] : '0';
		$param['order'] = (isset($_REQUEST['order'][0]['column'])) ? $_REQUEST['order'][0]['column'] : '';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir'])) ? $_REQUEST['order'][0]['dir'] : '';
		$param['searchValue'] = (isset($_REQUEST['search']['value'])) ? $_REQUEST['search']['value'] : '';
		$this->result['data'] = $this->NewCommonModel->get_branch_stock_from_master($param,$branch_id);
	}

	public function __destruct(){
		if(isset($this->result)){
			echo json_encode($this->result);
		}
	}

}
?>
