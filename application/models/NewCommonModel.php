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

	public function getEditAllBranches($btob_id)
	{
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

}
