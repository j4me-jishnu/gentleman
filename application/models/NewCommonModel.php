<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class NewCommonModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function add_data($table,$data_array){
		$query=$this->db->insert($table,$data_array);
		return $query ? true : false;
	}

	public function insert_get_id($table,$data_array){
		$query=$this->db->insert($table,$data_array);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}

	public function add_data_where($table,$data_array,$condition){
		$query=$this->db->insert($table,$data_array)->where($condition);
		return $query ? true : false;
	}

	public function get_data($table){
		$query=$this->db->select('*')->get($table);
		$records=$query->result();
		return $records ? $records : false;
	}

	public function get_data_where($table,$condition){
		$query=$this->db->select('*')->where($condition)->get($table);
		$records=$query->result();
		return $records ? $records : false;
	}

	public function get_data_where_row($table,$condition){
		$query=$this->db->select('*')->where($condition)->get($table);
		$records=$query->row();
		return $records ? $records : false;
	}

	public function update_data($table,$data_array,$condition){
		$query=$this->db->where($condition)->update($table,$data_array);
		return $query ? true : false;
	}

	public function delete_data($table,$condition){
		$query=$this->db->where($condition)->delete($table);
		return $query ? true : false;
	}

	//Need to pass branch id
	public function getBranchEmployeesList($condition){
		$query=$this->db->select('*')->where($condition)->get('ntbl_branch_employees');
		$data['data']=$query->result();
		$data['recordsTotal']=$query->num_rows();
		$data['recordsFiltered']=$query->num_rows();
		return $data['data'] ? $data : false;
	}

	public function getAllItems(){
		$query=$this->db->select('*')->get('ntbl_items');
		$data['data']=$query->result();
		$data['recordsTotal']=$query->num_rows();
		$data['recordsFiltered']=$query->num_rows();
		return $data['data'] ? $data : false;
	}
	public function getAllBranches(){
		$query=$this->db->select('*')->get('ntbl_branches');
		$data['data']=$query->result();
		$data['recordsTotal']=$query->num_rows();
		$data['recordsFiltered']=$query->num_rows();
		return $data['data'] ? $data : false;
	}

	public function getBranchID($branch_name){
		//$query=$this->db->select('*')->where('branch_name','Cherthala')->get('ntbl_branches');
		$query=$this->db->select('*')->where('branch_name',$branch_name)->get('ntbl_branches');
		$data=$query->row()->branch_id;
		return $data ? $data : false;
	}

	public function insertValues(){
		$data = array(
			'branch_name' => 'dummy',
			'created_at' => date("Y-m-d H:i:s"),
		);
		$query=$this->db->insert('ntbl_branches', $data);
		if($query){ return true; } else{ return false; }
	}

	public function getEditAllBranches($btob_id){
		$this->db->select('*');
		$this->db->from('ntbl_bs_branchtobranch');
		$this->db->join('ntbl_items','ntbl_items.item_id=ntbl_bs_branchtobranch.btob_item_id_fk');
		$this->db->join('ntbl_branches','ntbl_branches.branch_id=ntbl_bs_branchtobranch.btob_to_branch_id_fk');
		$this->db->where('btob_id',$btob_id);
		$query = $this->db->get();
		return $data = $query->result();
	}

	public function getBrachStockSQL($branch_id){
		$this->db->select('item_id,item_name,COALESCE(os_branch_id_fk,'.$branch_id.') AS os_branch_id_fk,COALESCE(os_quantity,0) AS os_quantity,req_branch_id_fk,COALESCE(req_item_quantity,0) AS req_item_quantity,btob_to_branch_id_fk,COALESCE(b2b_rec_qty,0) AS b2b_rec_qty');
		$this->db->join('(SELECT os_item_id_fk,os_branch_id_fk,os_quantity FROM ntbl_bs_openingstock WHERE os_status = 1 ORDER BY os_item_id_fk) brnch_op_stck','brnch_op_stck.os_item_id_fk=ntbl_items.item_id','left');
		$this->db->join('(SELECT req_item_id_fk,req_branch_id_fk,SUM(req_item_quantity) AS req_item_quantity FROM ntbl_bs_stockrequests WHERE req_status = 1 ORDER BY req_item_id_fk) recieved_4rom_master','recieved_4rom_master.req_item_id_fk=ntbl_items.item_id','left');
		$this->db->join('(SELECT btob_item_id_fk,btob_to_branch_id_fk,SUM(btob_quantity) AS b2b_rec_qty FROM ntbl_bs_branchtobranch WHERE is_approved = 2 ORDER BY btob_item_id_fk) b2b_recieved','b2b_recieved.btob_item_id_fk=ntbl_items.item_id','left');
		$this->db->from('ntbl_items');
		$this->db->where('item_status',1);
		// $this->db->where('brnch_op_stck.os_branch_id_fk',$branch_id);
		$query = $this->db->get();
		return $data['data'] = $query->result();
	}

	// returns all items opening stock details based on branch_id and items_id
	public function get_opening_stock_details($branch_id){
		$query=$this->db->select('ntbl_items.*,COALESCE(ntbl_openingstock.os_stock_qty,0) as os_qty,ntbl_category.cate_name as cat_name')
		->join('ntbl_openingstock','ntbl_openingstock.os_item_id=ntbl_items.item_id and ntbl_openingstock.os_branch_id='.$branch_id.'','left')
		->join('ntbl_category','ntbl_category.cate_id=ntbl_items.item_cat_fk','left')
		->get('ntbl_items');
		return $query->result();
	}
	// function to check the item already have os count and is it greater than zero
	public function check_os_exists($branch_id,$item_id){
		$condition=[
			'os_branch_id'=>$branch_id,
			'os_item_id'=>$item_id,
		];
		$query=$this->db->select('*')->where($condition)->where('os_stock_qty >',0)->get('ntbl_openingstock');
		if($query->num_rows()>0){
			return true;
		} else{
			return false;
		}
	}
	// ******************************************************************************************************************************
	// ******************************************************************************************************************************
	// this is the main stock updation function and this modifies the current stock from all branch items
	public function stockUpdate($branch_id,$item_id,$quantity,$operation){
		$condition=[
			'branch_id'=>$branch_id,
			'item_id'=>$item_id,
		];
		$query=$this->db->select('*')->where($condition)->get('ntbl_stock_balances');
		if($query->num_rows()>0){
			$currentBalance=intval($query->row()->stock_balance);
			if($operation){
				$newBalance=$currentBalance+intval($quantity);
				$update_array=['stock_balance'=>$newBalance,'updated_at'=>date('Y-m-d H:i:s')];
				$update_query=$this->db->where($condition)->update('ntbl_stock_balances',$update_array);
			}
			else{
				$newBalance=$currentBalance-intval($quantity);
				$update_array=['stock_balance'=>$newBalance,'updated_at'=>date('Y-m-d H:i:s')];
				$update_query=$this->db->where($condition)->update('ntbl_stock_balances',$update_array);
			}
			if($update_query){return true;}	else{return false;}
		}
		else{
			$insert_array=[
				'branch_id'=>$branch_id,
				'item_id'=>$item_id,
				'stock_balance'=>$quantity,
				'created_at'=>date('Y-m-d H:i:s')
			];
			$query=$this->db->insert('ntbl_stock_balances',$insert_array);
			if($query){return true;}else{return false;}
		}
	}
	// to get current stock of an item in a branch
	public function get_single_item_current_stock($master_branch,$item_id){
		$condition=[
			'branch_id'=>$master_branch,
			'item_id'=>$item_id,
		];
		$query=$this->db->select('stock_balance')->where($condition)->get('ntbl_stock_balances');
		if($query->num_rows()>0){
			return intval($query->row()->stock_balance);
		}
		else{
			return 0;
		}
	}

	// ***************************************************************************************************************************
	// ***************************************************************************************************************************
	// supporting function to get master id for finding current balance
	public function get_master_id(){
		$condition=[
			'user_name'=>'Admin',
			'user_type'=>'A'
		];
		$query=$this->db->select('id')->where($condition)->get('tbl_login');
		return $query->row()->id;
	}
	// to change status in ntbl_bs_stockrequests table status
	public function update_stock_request_status($condition,$update_array){
		$query=$this->db->where($condition)->update('ntbl_bs_stockrequests',$update_array);
		return $query ? true : false;
	}

	public function get_master_stock_balances($branch_id){
		$master_branch=$this->get_master_id();
		if($master_branch == $branch_id){
			$purchase_stock = "COALESCE((SELECT SUM(COALESCE(purchase_qty,0)) FROM ntbl_purchase where ntbl_purchase.purchase_item_id_fk=ntbl_items.item_id ),0)";
			$purchase_return_stock = "COALESCE((SELECT SUM(COALESCE(pur_rtrn_qty,0)) FROM ntbl_purchase_return where ntbl_purchase_return.pur_rtrn_item_id=ntbl_items.item_id  ),0)";
		} else {
			$purchase_stock = "0";
			$purchase_return_stock = "0";
		}
		// $branch_id = $this->branch_id;
		$query=$this->db->select('item_name,
		COALESCE((SELECT SUM(COALESCE(os_stock_qty,0)) FROM ntbl_openingstock where ntbl_openingstock.os_item_id=ntbl_items.item_id and os_branch_id = "'.$branch_id.'"  ),0) as os_quantity,
		COALESCE((SELECT SUM(COALESCE(return_quantity,0)) FROM ntbl_bs_returntomaster where ntbl_bs_returntomaster.return_item_id_fk=ntbl_items.item_id and is_approved=1  ),0) as return_qty,
		'.$purchase_stock.' as purchase_qty,
		'.$purchase_return_stock.' as pur_rtrn_qty,
		COALESCE((SELECT SUM(COALESCE(req_item_quantity,0)) FROM ntbl_bs_stockrequests where ntbl_bs_stockrequests.req_item_id_fk=ntbl_items.item_id and req_status=1  ),0)  as req_item_quantity,
		COALESCE((SELECT SUM(COALESCE(stock_balance,0)) FROM ntbl_stock_balances where ntbl_stock_balances.item_id=ntbl_items.item_id and ntbl_stock_balances.branch_id = "'.$branch_id.'"),0) as Total_qty')
		->group_by('ntbl_items.item_id')
		->get('ntbl_items');
		return $query->result();
	}

	public function getCategoryList(){
		$query=$this->db->select('*')->get('ntbl_category');
		return $query->result();
	}
	public function get_item_list(){
		$query=$this->db->select('*')
		->join('ntbl_category','ntbl_category.cate_id=ntbl_items.item_cat_fk')
		->get('ntbl_items');
		return $query->result();
	}

	public function get_branch_stock_from_master($param,$branch_id){
		// $query=$this->db->select('*')
		// ->join('ntbl_items','ntbl_items.item_id=ntbl_stock_balances.item_id')
		// ->where('branch_id',$branch_id)
		// ->get('ntbl_stock_balances');
		// return $data['data'] = $query->result();

		$arOrder = array('','item_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		if($searchValue){
			$this->db->like('item_name', $searchValue);
		}
		$this->db->where("status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
			$this->db->limit($param['length'],$param['start']);
		}
		$query=$this->db->select('*')
		->join('ntbl_items','ntbl_items.item_id=ntbl_stock_balances.item_id')
		->where('branch_id',$branch_id)
		->get('ntbl_stock_balances');
		$data['data'] = $query->result();
		$data['recordsTotal'] = $query->num_rows();
		$data['recordsFiltered'] = $query->num_rows();
		return $data;
	}

	public function test(){
		$sql="SELECT * FROM ntbl_stock_balances where 1";
		$query = $this->db->query($sql);
		var_dump($query->result_array());
	}
}
