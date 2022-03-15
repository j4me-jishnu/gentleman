<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends MY_Controller {

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
		date_default_timezone_set("Asia/Kolkata");
	}

// to get opening stock of a particular branch, even master
	public function getOpeningStockDetails(){
	}


	public function showOpeningStock(){
		$template['body'] = 'Opening_stock/list';
		$template['script'] = 'Opening_stock/script';
		$this->load->view('template',$template);
	}

	public function addOpeningStock(){
		$branch_id=$this->branch_id;
		for($i=0;$i<count($_POST['item_names']);$i++){
				$item_result=$this->NewCommonModel->check_item_table_status($_POST['item_names'][$i]);
				if($item_result['status']){
					$stock_result=$this->NewCommonModel->check_stocktable_status($item_result['id'],$branch_id);
					if($stock_result['status']){
						$update_data=[
							'item_id'=>$item_result['id'],
							'branch_id'=>$branch_id,
							'stock_balance'=>$_POST['quantities'][$i]
						];
						$condition=['id'=>$stock_result['id']];
						$result=$this->NewCommonModel->update_data('ntbl_stock_balances',$update_data,$condition);
					}
					else{
						$insert_stock_balance_array=[
							'branch_id'=>$branch_id,
							'item_id'=>$item_result['id'],
							'stock_balance'=>$_POST['quantities'][$i],
							'created_at'=>date('Y-m-d H:i:s')
						];
						$result=$this->NewCommonModel->add_data('ntbl_stock_balances',$insert_stock_balance_array);
					}
				}
				else{
					$insert_array=[
							'item_name'=>$_POST['item_names'][$i],
							'created_at'=>date('Y-m-d H:i:s')
						];
						$insert_item_id=$this->NewCommonModel->insert_get_id('ntbl_items',$insert_array);
						$insert_stock_balance_array=[
							'branch_id'=>$branch_id,
							'item_id'=>$insert_item_id,
							'stock_balance'=>$_POST['quantities'][$i],
							'created_at'=>date('Y-m-d H:i:s')
						];
						$result=$this->NewCommonModel->add_data('ntbl_stock_balances',$insert_stock_balance_array);
				}
		}
		if($result){
			$message="Item and stock updated successfully!";
			$this->session->set_flashdata('message',$message);
			$this->session->set_flashdata('type',"success");
			redirect('Main/showOpeningStock','refresh');
		}
		else{
			$message="Failed to update the stock! Something went wrong!";
			$this->session->set_flashdata('message',$message);
			$this->session->set_flashdata('type',"error");
			redirect('Main/showOpeningStock','refresh');
		}
	}

	public function checkItemExistanceStatus(){
		$item_name="FEED BACK FORM";
		$branch_id=$this->branch_id;
		$existance=$this->NewCommonModel->check_existance_status($item_name,$branch_id);
		if($existance!=false){
			var_dump($existance); die;
		}
		else{
			//item not existing in items table or stock balances table!
			return false;
		}
	}
}
?>
