<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class NewBranchModel extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function get_branch_employee_list($param,$condition){
		$arOrder = array('','emp_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		if($searchValue){
			$this->db->like('emp_name', $searchValue);
		}
		$this->db->where("emp_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
			$this->db->limit($param['length'],$param['start']);
		}
		$this->db->select('*');
		$this->db->from('ntbl_branch_employees');
		$this->db->join('ntbl_designation','ntbl_designation.desg_id=ntbl_branch_employees.desg_id_fk','left');
		$this->db->where($condition);
		$this->db->order_by('emp_id', 'DESC');
		$query = $this->db->get();
		$data['data'] = $query->result();
		$data['recordsTotal']=$query->num_rows();
    	$data['recordsFiltered']=$query->num_rows();
    	return $data['data'] ? $data : false;
	}
	// get stock requests
	public function getBranchStockRequests($param,$condition){
		$arOrder = array('','req_id');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		if($searchValue){
			$this->db->like('req_id', $searchValue);
		}
		// $this->db->where("emp_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
			$this->db->limit($param['length'],$param['start']);
		}
		$this->db->select('ntbl_bs_stockrequests.*,ntbl_items.item_name');
		$this->db->join('ntbl_items','ntbl_items.item_id=ntbl_bs_stockrequests.req_item_id_fk');
		$this->db->where($condition);
		$this->db->order_by('req_id', 'DESC');
		$query = $this->db->get('ntbl_bs_stockrequests');
		$data['data'] = $query->result();
		$data['recordsTotal']=$query->num_rows();
    	$data['recordsFiltered']=$query->num_rows();
    	return $data['data'] ? $data : false;
	}
	public function getMasterStockRequests($param){
		$arOrder = array('','req_id');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		if($searchValue){
			$this->db->like('req_id', $searchValue);
		}
		// $this->db->where("emp_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
			$this->db->limit($param['length'],$param['start']);
		}
		$this->db->select('ntbl_bs_stockrequests.*,ntbl_items.item_name,ntbl_branches.branch_name');
		$this->db->join('ntbl_items','ntbl_items.item_id=ntbl_bs_stockrequests.req_item_id_fk');
		$this->db->join('ntbl_branches','ntbl_branches.branch_id=ntbl_bs_stockrequests.req_branch_id_fk');
		// $this->db->where($condition);
		$this->db->order_by('req_id', 'DESC');
		$query = $this->db->get('ntbl_bs_stockrequests');
		$data['data'] = $query->result();
		$data['recordsTotal']=$query->num_rows();
    	$data['recordsFiltered']=$query->num_rows();
    	return $data['data'] ? $data : false;
	}
	public function getBranchtoBranchStockRequests($param,$condition){
		$arOrder = array('','btob_id');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		if($searchValue){
			$this->db->like('btob_id', $searchValue);
		}
		// $this->db->where("emp_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
			$this->db->limit($param['length'],$param['start']);
		}
		$this->db->select('ntbl_bs_branchtobranch.*,ntbl_items.item_name,ntbl_branches.branch_name');
		$this->db->join('ntbl_items','ntbl_items.item_id=ntbl_bs_branchtobranch.btob_item_id_fk');
		$this->db->join('ntbl_branches','ntbl_branches.branch_id=ntbl_bs_branchtobranch.btob_to_branch_id_fk');
		$this->db->where($condition);
		$this->db->order_by('btob_id', 'DESC');
		$query = $this->db->get('ntbl_bs_branchtobranch');
		$data['data'] = $query->result();
		$data['recordsTotal']=$query->num_rows();
    	$data['recordsFiltered']=$query->num_rows();
    	return $data['data'] ? $data : false;
	}
	public function getReturntomasterRequests($param,$condition){
		$arOrder = array('','return_id');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		if($searchValue){
			$this->db->like('return_id', $searchValue);
		}
		// $this->db->where("emp_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
			$this->db->limit($param['length'],$param['start']);
		}
		$this->db->select('ntbl_bs_returntomaster.*,ntbl_items.item_name');
		$this->db->join('ntbl_items','ntbl_items.item_id=ntbl_bs_returntomaster.return_item_id_fk');
		$this->db->where($condition);
		$this->db->order_by('return_id', 'DESC');
		$query = $this->db->get('ntbl_bs_returntomaster');
		$data['data'] = $query->result();
		$data['recordsTotal']=$query->num_rows();
    	$data['recordsFiltered']=$query->num_rows();
    	return $data['data'] ? $data : false;
	}

	public function getEditStockRequest($req_id)
	{
		$this->db->select('*');
		$this->db->from('ntbl_bs_stockrequests');
		$this->db->join('ntbl_items','ntbl_items.item_id=ntbl_bs_stockrequests.req_item_id_fk');
		$this->db->where('req_id',$req_id);
		$query = $this->db->get();
		return $data = $query->result();

	}

	public function getToStockRquestListEdit()
	{
		$this->db->select('*');
		$this->db->from('ntbl_bs_stockrequests');
		$this->db->join('ntbl_items','ntbl_items.item_id=ntbl_bs_stockrequests.req_item_id_fk');
		$query = $this->db->get();
		return $data = $query->result();
	}

	public function getIssuedStockList($param,$condition)
	{
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		if($searchValue){
			$this->db->like('ntbl_branches.branch_name', $searchValue);
			//$this->db->or_like('ntbl_items.item_name', $searchValue);
		}
		$this->db->where("issued_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
			$this->db->limit($param['length'],$param['start']);
		}
		$this->db->select('*');
		$this->db->from('ntbl_bs_issuedstock');
		$this->db->join('ntbl_items','ntbl_items.item_id=ntbl_bs_issuedstock.issued_item_id_fk','left');
		$this->db->join('ntbl_branch_employees','ntbl_branch_employees.emp_id=ntbl_bs_issuedstock.issued_emp_id_fk','left');
		$this->db->where($condition);
		$this->db->order_by('issued_id', 'DESC');
		$query = $this->db->get();
		$data['data'] = $query->result();
		$data['recordsTotal']=$query->num_rows();
    	$data['recordsFiltered']=$query->num_rows();
    	return $data['data'] ? $data : false;
	}

	public function getBranchOpeningStock($param,$condition,$branch_id)
	{
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		if($searchValue){
			$this->db->like('ntbl_branches.branch_name', $searchValue);
			//$this->db->or_like('ntbl_items.item_name', $searchValue);
		}
		if ($param['start'] != 'false' and $param['length'] != 'false') {
			$this->db->limit($param['length'],$param['start']);
		}
		$this->db->select('item_name,COALESCE(os_quantity,0) AS os_quantity,COALESCE(branch_qty_sum,0) AS branch_qty_sum,COALESCE(brach_r_qty_sum,0) AS brach_r_qty_sum,COALESCE(brach_g_qty_sum,0) AS brach_g_qty_sum,COALESCE(brach_issue_qty_sum,0) AS brach_issue_qty_sum,COALESCE(branch_ret_qty_sum,0) AS branch_ret_qty_sum,(COALESCE(os_quantity,0) + COALESCE(branch_qty_sum,0) + COALESCE(brach_r_qty_sum,0) - COALESCE(brach_g_qty_sum,0) - COALESCE(brach_issue_qty_sum,0) - COALESCE(branch_ret_qty_sum,0)) AS br_total_stck');
		$this->db->from('ntbl_bs_openingstock');
		$this->db->join('ntbl_items','ntbl_items.item_id=ntbl_bs_openingstock.os_item_id_fk','left');
		$this->db->join('(SELECT req_item_id_fk,req_branch_id_fk,SUM(req_item_quantity) AS branch_qty_sum FROM ntbl_bs_stockrequests where req_status = 1 GROUP BY req_item_id_fk) branch_req','branch_req.req_item_id_fk=ntbl_bs_openingstock.os_item_id_fk','left');
		$this->db->join('(SELECT btob_item_id_fk,btob_to_branch_id_fk,SUM(CASE WHEN btob_to_branch_id_fk = '.$branch_id.' THEN btob_quantity ELSE 0 END) AS brach_r_qty_sum FROM ntbl_bs_branchtobranch where is_approved = 1 GROUP BY btob_to_branch_id_fk) branch_recieved','branch_recieved.btob_item_id_fk=ntbl_bs_openingstock.os_item_id_fk','left');
		$this->db->join('(SELECT btob_item_id_fk,btob_branch_id_fk,SUM(CASE WHEN btob_branch_id_fk = '.$branch_id.' THEN btob_quantity ELSE 0 END) AS brach_g_qty_sum FROM ntbl_bs_branchtobranch where is_approved = 1 GROUP BY btob_branch_id_fk) branch_given','branch_given.btob_item_id_fk=ntbl_bs_openingstock.os_item_id_fk','left');
		$this->db->join('(SELECT issued_branch_id_fk,issued_item_id_fk,SUM(issued_quantity) AS brach_issue_qty_sum FROM ntbl_bs_issuedstock where is_approved = 1 GROUP BY issued_item_id_fk) branch_issue','branch_issue.issued_item_id_fk=ntbl_bs_openingstock.os_item_id_fk','left');
		$this->db->join('(SELECT return_branch_id_fk,return_item_id_fk,SUM(return_quantity) AS branch_ret_qty_sum FROM ntbl_bs_returntomaster where is_approved = 1 GROUP BY return_item_id_fk) branch_return','branch_return.return_item_id_fk=ntbl_bs_openingstock.os_item_id_fk','left');
		$this->db->where('os_branch_id_fk',$branch_id);
		$this->db->order_by('item_name','ASC');
		$query = $this->db->get();
		$data['data'] = $query->result();
		$data['recordsTotal']=$query->num_rows();
    	$data['recordsFiltered']=$query->num_rows();
    	return $data['data'] ? $data : false;
	}

	public function get_single_branch_stock_request($param,$branch_id){
		// $searchValue =($param['searchValue'])?$param['searchValue']:'';
		// if($searchValue){
		// 	$this->db->like('ntbl_branches.branch_name', $searchValue);
		// 	//$this->db->or_like('ntbl_items.item_name', $searchValue);
		// }
		// if ($param['start'] != 'false' and $param['length'] != 'false') {
		// 	$this->db->limit($param['length'],$param['start']);
		// }
		// $this->db->select('*');
		// $this->db->join('ntbl_branches','ntbl_branches.branch_id=ntbl_bs_returntomaster.return_branch_id_fk');
		// $this->db->join('ntbl_items','ntbl_items.item_id=ntbl_bs_returntomaster.return_item_id_fk');
		// $this->db->from('ntbl_bs_returntomaster');
		// $this->db->where('return_status',1);
		// $query = $this->db->get();

		$query=$this->db->select('*')
		->join('ntbl_branches','ntbl_branches.branch_id=ntbl_bs_stockrequests.req_branch_id_fk','left')
		->join('ntbl_items','ntbl_items.item_id=ntbl_bs_stockrequests.req_item_id_fk','left')
		->where('req_branch_id_fk',$branch_id)
		->get('ntbl_bs_stockrequests');
		return $data['data'] = $query->result();
	}
}
