<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
class NewBranch extends MY_Controller {
	private $params;
	private $result;
	private $branch_name;
	private $branch_id;
	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
			redirect('/login');
		}
		$this->load->model('General_model');
		$this->load->model('Masterstock_model');
		$this->load->model('NewMasterstock_model');
		$this->load->model('NewCommonModel');
		$this->load->model('NewBranchModel');
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
		date_default_timezone_set("Asia/Kolkata");
		if(!empty($this->session->userdata('user_branch'))){
			$this->branch_name=$this->session->userdata('user_branch');
			$this->branch_id=$this->NewCommonModel->getBranchID($this->branch_name);
		}
	}
	////////////Stock Details///////////////////////////////
	// Stock Details page
	public function showStockDetails(){
		$template['body'] = 'NewBranch/Stock_details/list';
		$template['script'] = 'NewBranch/Stock_details/script';
		$this->load->view('template', $template);
	}

	public function getBranchOpeningStocks()
	{
		$branch_id = $this->branch_id;
		$condition=[
			'os_branch_id_fk'=>$this->branch_id
		];
		$this->result = $this->NewBranchModel->getBranchOpeningStock($this->param,$condition,$branch_id);
	}

	public function addBranchOpeningStock()
	{
		$insert_array = [
			'os_branch_id_fk' => $this->branch_id,
			'os_item_id_fk' => $this->params['item_id'],
			'os_quantity' => $this->params['item_qty'],
			'os_status' => 1,
			'created_at' => date('Y-m-d H:i:sa'),
			'created_at' => date('Y-m-d H:i:sa'),
		];

		$response = $this->General_model->add('ntbl_bs_openingstock',$insert_array);
		if($response)
		{
			redirect('/NewBranch/showStockDetails');
		}
		else
		{
			redirect('/NewBranch/showStockDetails');
		}
	}

	public function deleteBranchOpeningStock()
	{
		$os_id = $this->params['os_id'];
		$response = $this->General_model->delete('ntbl_bs_openingstock','os_id',$os_id);
		echo json_encode($response);
	}

	//////////////////////////////////////////////////////

	///////////Issued Item Page////////////////////////////
	// Issued item page
	public function showIssuedItemsPage(){
		$template['body'] = 'NewBranch/Issued_items/list';
		$template['script'] = 'NewBranch/Issued_items/script';
		$this->load->view('template', $template);
	}

	public function getIssuedList()
	{
		$condition=[
			'issued_branch_id_fk'=>$this->branch_id
		];
		$this->result = $this->NewBranchModel->getIssuedStockList($this->param,$condition);
		//var_dump($condition);die;
	}

	public function addIssuedStock()
	{
		$insert_array = [
			'issued_branch_id_fk' => $this->branch_id,
			'issued_item_id_fk' => $this->params['item_id'],
			'issued_emp_id_fk' => $this->params['emp_id'],
			'issued_quantity' => $this->params['item_qty'],
			'issued_status' => 1,
			'is_approved' => 1,
			'created_at' => date('Y-m-d H:i:sa'),
			'updated_at' => date('Y-m-d H:i:sa'),
		];

		$response = $this->General_model->add('ntbl_bs_issuedstock',$insert_array);
		if($response)
		{
			redirect('/NewBranch/showIssuedItemsPage');
		}
		else
		{
			redirect('/NewBranch/showIssuedItemsPage');
		}
	}

	public function deleteIssuedStock()
	{
		$issued_id = $this->params['issued_id'];
		$response = $this->General_model->delete('ntbl_bs_issuedstock','issued_id',$issued_id);
		echo json_encode($response);
	}

	///////////////////////////////////////////////////////

	// Branch to branch page
	public function showBranchtoBranchPage(){
		$template['body'] = 'NewBranch/BranchtoBranch/list';
		$template['script'] = 'NewBranch/BranchtoBranch/script';
		$this->load->view('template', $template);
	}

	public function addBtoBRequest(){
		// get the current stock balance of the item in requesting branch
		$item_id=$this->params['item'];
		$master_branch=$this->NewCommonModel->get_master_id();
		$current_stock=intval($this->NewCommonModel->get_single_item_current_stock($this->branch_id,$item_id));
		if($current_stock>intval($this->params['item_quantity'])){
			$insert_data=[
				'btob_branch_id_fk'=>$this->branch_id,
				'btob_to_branch_id_fk'=>$this->params['transfer_branch_id'],
				'btob_item_id_fk'=>$item_id,
				'btob_quantity'=>$this->params['item_quantity'],
				'created_at'=>date('Y-m-d H:i:s'),
			];

			if(!empty($this->params['btob_ide'])){
				$response = $this->General_model->update('ntbl_bs_branchtobranch',$insert_data,'btob_id',$this->params['btob_ide']);
			}
			else
			{
				$response=$this->NewCommonModel->add_data('ntbl_bs_branchtobranch',$insert_data);
			}

			if($response){
				redirect('/NewBranch/showBranchtoBranchPage');
			}
		}
		else{
			$message="Only ".$current_stock." numbers of stock are available!";
			$this->session->set_flashdata('message',$message);
			$this->session->set_flashdata('type',"warning");
			redirect('NewBranch/showBranchtoBranchPage', 'refresh');
		}
	}

	public function deleteBtoBRequest()
	{
		$btob_id = $this->params['btob_id'];
		$response = $this->General_model->delete('ntbl_bs_branchtobranch','btob_id',$btob_id);
		echo json_encode($response);
	}

	public function getBranchtoBranchRequests(){
		$condition=[
			'btob_branch_id_fk'=>$this->branch_id
		];
		$this->result=$this->NewBranchModel->getBranchtoBranchStockRequests($this->param,$condition);
	}
	//////////////////////////////////////////////////////////////////////////////
	// Return to master page
	public function showReturntoMasterPage(){
		$template['body'] = 'NewBranch/ReturntoMaster/list';
		$template['script'] = 'NewBranch/ReturntoMaster/script';
		$this->load->view('template', $template);
	}

	public function addReturntomasterRequest(){
		$remarks = $this->params['remarks'];
		if($remarks)
		{
			$remarks = $this->params['remarks'];
		}
		else
		{
			$remarks = " ";
		}
		$item_id=$this->params['item'];
		$current_stock=intval($this->NewCommonModel->get_single_item_current_stock($this->branch_id,$item_id));
		if($current_stock>intval($this->params['item_quantity'])){
			$insert_data=[
				'return_branch_id_fk'=>$this->branch_id,
				'return_item_id_fk'=>$item_id,
				'return_quantity'=>$this->params['item_quantity'],
				'return_remarks'=>$remarks,
				'created_at'=>date('Y-m-d H:i:s'),
			];
			$insert_scrap=[];
			$response=$this->NewCommonModel->add_data('ntbl_bs_returntomaster',$insert_data);
			if($response){
				redirect('/NewBranch/showReturntoMasterPage');
			}
		}
		else{
			$message="Only ".$current_stock." numbers of stock are available!";
			$this->session->set_flashdata('message',$message);
			$this->session->set_flashdata('type',"warning");
			redirect('NewBranch/showReturntoMasterPage', 'refresh');
		}
	}

	public function getReturntomasterRequests(){
		$condition=[
			'return_branch_id_fk'=>$this->branch_id
		];
		$this->result=$this->NewBranchModel->getReturntomasterRequests($this->param,$condition);
	}

	// #######################################################################################################
	// Stock Request
	public function showStockRequestsPage(){
		$template['body'] = 'NewBranch/StockRequests/list';
		$template['script'] = 'NewBranch/StockRequests/script';
		$this->load->view('template', $template);
	}

	public function addToStockRequest(){
		if(!empty($this->params['req_id'])){
			$update_data=[
				'req_item_id_fk'=>$this->params['item'],
				'req_item_quantity'=>$this->params['item_quantity'],
			];
			$response = $this->General_model->update('ntbl_bs_stockrequests',$update_data,'req_id',$this->params['req_id']);
		}
		else{
			$insert_data=[
				'req_item_id_fk'=>$this->params['item'],
				'req_branch_id_fk'=>$this->branch_id,
				'req_item_quantity'=>$this->params['item_quantity'],
				'created_at'=>date('Y-m-d H:i:s'),
			];
			$response=$this->NewCommonModel->add_data('ntbl_bs_stockrequests',$insert_data);
		}
		if($response){
			redirect('/NewMaster/showBranchItemRequestsPage');
		}
	}

	public function editToStockRequest(){
		$req_id = $this->input->post('req_id');
		$data = $this->NewBranchModel->getEditStockRequest($req_id);
		//$data = $this->NewBranchModel->getToStockRquestListEdit();
		echo json_encode($data);
	}

	public function deleteToStockRequest()
	{
		$req_id = $this->input->post('req_id');
		$data = $this->General_model->delete('ntbl_bs_stockrequests','req_id',$req_id);
		echo json_encode($data);
	}

	public function getMasterStockRequests(){
		$this->result=$this->NewBranchModel->getMasterStockRequests($this->param);
	}



	#########################################################################################################

	// Employees listing page
	public function showEmployeesPage(){
		$template['body'] = 'NewBranch/Employees/list';
		$template['script'] = 'NewBranch/Employees/script';
		$this->load->view('template', $template);
	}
	// add employee
	public function addEmployee(){
		$insert_array=[
			'emp_name'=>$this->params['emp_name'],
			'branch_name'=>$this->session->userdata('user_branch'),
			'created_at'=>date('Y-m-d H:i:s'),
			'updated_at'=>date('Y-m-d H:i:s')
		];
		$response=$this->NewCommonModel->add_data('ntbl_branch_employees',$insert_array);
		$response_text="Employee added successfully";
		if($response){
			$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
		}
		else{
			$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
		}
		redirect('/NewBranch/showEmployeesPage', 'refresh');
	}

	public function editEmployee()
	{
		$emp_id = $this->params['emp_id'];
		// var_dump($emp_id);die;
		$update_array = [
			'emp_name' =>$this->params['emp_name'],
			'branch_name' =>$this->session->userdata('user_branch'),
			'created_at' =>date('Y-m-d H:i:sa'),
		];
		$condition = [
			'emp_id' =>$emp_id,
		];
		$response=$this->NewCommonModel->update_data('ntbl_branch_employees',$update_array,$condition);
		if($response){
			$this->session->set_flashdata('message', "Success");
		}
		else{
			$this->session->set_flashdata('response', 'Something Went Wrong!');
		}
		redirect('/NewBranch/showEmployeesPage', 'refresh');
	}

	public function deleteEmployee()
	{
		$emp_id = $this->params['emp_id'];
		$condition = [
			'emp_id' =>$emp_id,
		];
		$this->result = $this->NewCommonModel->delete_data('ntbl_branch_employees',$condition);

	}

	public function getEmployeeList(){
		$branch_name=$this->session->userdata('user_branch');
		$condition=[
			'branch_name'=>$branch_name
		];
		$this->result=$this->NewBranchModel->get_branch_employee_list($this->param,$condition);
	}

	public function getBranchesNativeList()
	{
		$this->result = $this->NewCommonModel->getBrachStockSQL($this->branch_id);
	}
// ##########################################
	public function getBranchStockRequests(){
		$branch_id=$this->branch_id;
		$this->result=$this->NewBranchModel->get_single_branch_stock_request($this->param,$branch_id);
	}

	public function __destruct(){
		if(isset($this->result)){
			echo json_encode($this->result);
		}
	}


}
?>
