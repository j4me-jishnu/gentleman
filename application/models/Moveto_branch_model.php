<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Moveto_branch_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
    public function getPurchaseTable($param){
		$arOrder = array('','item_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		$br = $this->userbranch();		
		if($searchValue){
            $this->db->like('item_name', $searchValue); 
        }
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_shop_stock');
		$this->db->join('tbl_item', 'tbl_item.item_id = tbl_shop_stock.item_id_fk');
		$this->db->join('tbl_branch', 'tbl_branch.branch_id = tbl_shop_stock.shop_id_fk');
		$this->db->order_by('id', 'DESC');
		
		$query = $this->db->get();
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getPurchaseTotalCount($param);
        $data['recordsFiltered'] = $this->getPurchaseTotalCount($param);
        return $data;

	}

	public function getPurchaseTotalCount($param = NULL){

		$arOrder = array('','item_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		$br = $this->userbranch();		
		if($searchValue){
            $this->db->like('item_name', $searchValue); 
        }
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_branch_stock');
		$this->db->join('tbl_item', 'tbl_item.item_id = tbl_branch_stock.item_id_fk');
		$this->db->join('tbl_branch', 'tbl_branch.branch_id = tbl_branch_stock.shop_id_fk');
		$this->db->order_by('issue_id', 'DESC');
		$query = $this->db->get();
    	return $query->num_rows();
    }
	public function getPurchaseTable_head($param){
		$arOrder = array('','item_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		$br = $this->userbranch();		
		if($searchValue){
            $this->db->like('item_name', $searchValue); 
        }
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_branch_stock');
		$this->db->join('tbl_item', 'tbl_item.item_id = tbl_branch_stock.item_id_fk');
		$this->db->join('tbl_branch', 'tbl_branch.branch_id = tbl_branch_stock.shop_id_fk');
		$this->db->order_by('issue_id', 'DESC');
		
		$query = $this->db->get();
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getPurchaseTotalCount($param);
        $data['recordsFiltered'] = $this->getPurchaseTotalCount($param);
        return $data;

	}

	public function getPurchase_headTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('item_name', $searchValue); 
        }
		$this->db->select('*,count(pr_id) as purchase_count,DATE_FORMAT(item_date,\'%d-%m-%Y\') as item_date');
		$this->db->from('tbl_apurchase');
		$this->db->where("pr_status",1);
		$this->db->join('tbl_item', 'tbl_item.item_id = tbl_apurchase.item_id_fk');
		$this->db->group_by('ref_number');
		$this->db->order_by('pr_id', 'DESC');
		$query = $this->db->get();
    	return $query->num_rows();
    }
	public function Refno(){
		
		$login_id_fk = $this->session->userdata('id');
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->join('tbl_branch', 'tbl_branch.branch_id = tbl_user.user_branch');
		$this->db->where('user_status',1);
		$this->db->where('login_id_fk',$login_id_fk);
        $query = $this->db->get();
    	return $query->result();
    }
	public function brmname($branch_id){
		
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_status',1);
		$this->db->where('user_branch',$branch_id);
		//$this->db->where('user_designation',3);
        $query = $this->db->get();
    	return $query->result();
    }
	public function userbranch(){
		
		$u = $this->session->userdata('id');
		$this->db->select('*');
		$this->db->from('tbl_user');
		// $this->db->join('tbl_branch', 'tbl_branch.branch_id = tbl_user.user_branch');
		$this->db->where('login_id_fk',$u);
        $query = $this->db->get();
    	return $query->result();
    }
	public function is_head($branch_id){
		
		$this->db->select('*');
		$this->db->from('tbl_branch');
		$this->db->where('branch_status',1);
		$this->db->where('is_active',1);
		$this->db->where('is_head',$branch_id);
        $query = $this->db->get();
    	return $query->result();
    }
	public function get_narration($id)
	{
		$this->db->select('*');
        $this->db->from('tbl_narration-branchreject');
        $this->db->where('issue_id',$id);
        $query = $this->db->get();
    	return $query->row();
	}
	public function get_items($id)
	{
		$this->db->select('*');
        $this->db->from('tbl_branch_stock');
        $this->db->where('issued_id',$id);
        $query = $this->db->get();
    	return $query->result();
	}
	public function viewInvoice($ref_number)
	{
		$this->db->select('tbl_apurchase.invoice_no,tbl_apurchase.item_id_fk,tbl_apurchase.ref_number,tbl_apurchase.taxamount,tbl_apurchase.item_quantity,tbl_apurchase.vendor_id_fk,tbl_apurchase.item_name,tbl_apurchase.item_price,tbl_apurchase.item_date,tbl_apurchase.item_total,tbl_apurchase.grand_total,tbl_vendor.vendor_id,tbl_vendor.vendorname,tbl_vendor.vendorgst,tbl_item.item_id,tbl_category.category_name');
        $this->db->from('tbl_apurchase');
		//$this->db->join('tbl_branch', 'tbl_branch.branch_id = tbl_purchase.branch_id_fk');
		//$this->db->join('tbl_user', 'tbl_user.user_branch = tbl_branch.branch_id');
		$this->db->join('tbl_item', 'tbl_item.item_id = tbl_apurchase.item_id_fk');
		$this->db->join('tbl_vendor', 'tbl_vendor.vendor_id = tbl_apurchase.vendor_id_fk');
		$this->db->join('tbl_category', 'tbl_category.category_id = tbl_item.category_id_fk');
        $this->db->where('pr_status',1);
		$this->db->where('ref_number',$ref_number);
        $query = $this->db->get();
    	return $query->result();
	}
	public function viewBranch($br)
	{
		$this->db->select('*');
        $this->db->from('tbl_branch');
		$this->db->join('tbl_user', 'tbl_user.user_branch = tbl_branch.branch_id');
		$this->db->where('branch_status',1);
		$this->db->where('branch_id',01);
		$this->db->where('tbl_user.user_designation',3);
        $query = $this->db->get();
    	return $query->result();
	}
	public function getProducts($refno)
	{
		$this->db->select('*');
        $this->db->from('tbl_apurchase');
		$this->db->where('ref_number',$refno);
		$query = $this->db->get();
    	return $query->result();
	}
	public function update($table,$data,$primaryfield,$id)
    {
        $this->db->where($primaryfield, $id);
        $q = $this->db->update($table, $data);
        return $q;
    }
	public function getItemid($edit_ref)
	{
		$this->db->select('item_id_fk,grand_total,');
        $this->db->from('tbl_apurchase');
		$this->db->where('ref_number',$edit_ref);
		$query = $this->db->get();
    	return $query->result();
	}
	public function getPrid($itemid,$edit_ref)
	{
		$this->db->select('pr_id');
        $this->db->from('tbl_apurchase');
		$this->db->where('item_id_fk',$itemid);
		$this->db->where('ref_number',$edit_ref);
		$query = $this->db->get();
    	return $query->result();
	}
	public function getItem($id,$edit_ref)
	{
		$this->db->select('*');
        $this->db->from('tbl_apurchase');
		$this->db->where('item_id_fk',$id);
		$this->db->where('ref_number',$edit_ref);
		$query = $this->db->get();
    	return $query->result();
	}
	public function getItem_grand($edit_ref)
	{
		$this->db->select('*');
        $this->db->from('tbl_purchase');
		$this->db->where('item_id_fk',$id);
		$this->db->where('ref_number',$edit_ref);
		$query = $this->db->get();
    	return $query->result();
	}

	public function get_gst($vendor_id)
	{
		$this->db->select('vendorgst');
		$this->db->from('tbl_vendor');
		$this->db->where('vendor_id',$vendor_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function updateRequest($data,$ref)
	{
		$this->db->where('ref_number', $ref);
        $q = $this->db->update('tbl_apurchase', $data);
        return $q;
	}

	public function getRow($id)
	{
		$this->db->select('*');
        $this->db->from('tbl_branch_stock');
		$this->db->where('issue_id',$id);
		$query = $this->db->get();
    	return $query->result();
	}

	public function updateStatus($table,$data,$primaryfield,$id)
	{
		$this->db->where($primaryfield, $id);
        $q = $this->db->update($table, $data);
        return $q;
	}

	public function getMasterStock($item_id)
	{
		$sql = "SELECT COALESCE(t4.item_rop, 0) AS master_rop,t3.*,t1.*,t1.item_quantity - COALESCE(t2.item_quantity, 0) AS remaining_qty FROM tbl_stock t1 LEFT JOIN (SELECT item_id_fk, SUM(item_quantity) AS item_quantity FROM tbl_shopstock where status = 1 and item_id_fk = $item_id ) t2 ON t1.item_id_fk=t2.item_id_fk JOIN tbl_stockup t3 ON t3.stock_id_fk=t1.stock_id LEFT JOIN tbl_master_rop t4 ON t1.item_id_fk=t4.item_id_fk WHERE t1.item_id_fk =$item_id";
		$query = $this->db->query($sql);
		$data= $query->result();
		return $data;
	}


	public function getNextAproval($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_branchrequest_approval');
		$this->db->where('su_id_fk',$id);
		$query = $this->db->get();
		return $query->result();
	}
	public function getStatus()
	{
		$this->db->select('issue_id_fk,min(is_approved) as approved,max(reject) as reject,tbl_designation.designation as des_name');
		$this->db->from('tbl_branchrequest_approval');
		$this->db->join('tbl_designation','tbl_designation.desig_id = tbl_branchrequest_approval.designation');
		$this->db->group_by('issue_id_fk');
		$query = $this->db->get();
		return $query->result();
	}

	public function updateApprovel($issue_id,$id)
	{
		$data = array('is_approved' =>1);
		$this->db->where('issue_id_fk',$issue_id);
		$this->db->where('su_id_fk', $id);
        $q = $this->db->update(' tbl_branchrequest_approval', $data);
        return $q;

	}

	public function updateReject($issue_id,$id)
	{
		$data = array('reject' =>1);
		$this->db->where('issue_id_fk',$issue_id);
		$this->db->where('su_id_fk', $id);
        $q = $this->db->update('tbl_branchrequest_approval',$data);
        return $q;

	}

	public function updateDelivery($issue)
	{
		$data = array('delivery' =>1,);
		$this->db->where('issue_id', $issue);
        $q = $this->db->update('tbl_branch_stock', $data);
        return $q;

	}


	function get_operator($issue_id){
      
		
		/*$this->db->select('user_name');
		$this->db->from('tbl_login');
		$this->db->where('id',$pr_id);
		$query = $this->db->get();
		return $query->result();*/
		
		$this->db->select('user_name');
		$this->db->from('tbl_login');
		$this->db->join('tbl_branchrequest_approval',' tbl_branchrequest_approval.su_id_fk=tbl_login.id');
		$this->db->where('tbl_branchrequest_approval.issue_id_fk',$issue_id);
		$query = $this->db->get();
		
		return $query->result();

	}
	
}
?>