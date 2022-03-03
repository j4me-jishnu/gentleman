<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Purchase_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
    public function getPurchaseTable($param){
		$arOrder = array('','item_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		$br = $this->userbranch();
		$branch = $br[0]->user_branch;
		if($searchValue){
            $this->db->like('item_name', $searchValue); 
        }
		$this->db->where("pr_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*,count(pr_id) as purchase_count,DATE_FORMAT(item_date,\'%d-%m-%Y\') as item_date');
		$this->db->from('tbl_purchase');
		$this->db->join('tbl_item', 'tbl_item.item_id = tbl_purchase.item_id_fk');
		$this->db->group_by('ref_number');
		$this->db->order_by('pr_id', 'DESC');
		$this->db->where('branch_id_fk',$branch);
		$query = $this->db->get();
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getPurchaseTotalCount($param,$branch);
        $data['recordsFiltered'] = $this->getPurchaseTotalCount($param,$branch);
        return $data;

	}

	public function getPurchaseTotalCount($param = NULL,$branch){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('item_name', $searchValue); 
        }
		$this->db->select('*,count(pr_id) as purchase_count,DATE_FORMAT(item_date,\'%d-%m-%Y\') as item_date');
		$this->db->from('tbl_purchase');
		$this->db->where("pr_status",1);
		$this->db->join('tbl_item', 'tbl_item.item_id = tbl_purchase.item_id_fk');
		$this->db->group_by('ref_number');
		$this->db->order_by('pr_id', 'DESC');
		$this->db->where('branch_id_fk',$branch);
		$query = $this->db->get();
    	return $query->num_rows();
    }
	public function getPurchaseTable_head($param){
		$arOrder = array('','item_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		if($searchValue){
            $this->db->like('item_name', $searchValue); 
        }
		$this->db->where("pr_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*,count(pr_id) as purchase_count,DATE_FORMAT(item_date,\'%d-%m-%Y\') as item_date');
		$this->db->from('tbl_purchase');
		$this->db->join('tbl_item', 'tbl_item.item_id = tbl_purchase.item_id_fk');
		$this->db->group_by('ref_number');
		$this->db->order_by('pr_id', 'DESC');
		$query = $this->db->get();
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getPurchase_headTotalCount($param);
        $data['recordsFiltered'] = $this->getPurchase_headTotalCount($param);
        return $data;

	}

	public function getPurchase_headTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('item_name', $searchValue); 
        }
		$this->db->select('*,count(pr_id) as purchase_count,DATE_FORMAT(item_date,\'%d-%m-%Y\') as item_date');
		$this->db->from('tbl_purchase');
		$this->db->where("pr_status",1);
		$this->db->join('tbl_item', 'tbl_item.item_id = tbl_purchase.item_id_fk');
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
	

	public function Refnumb(){
	$this->db->select('*');
	$this->db->from('tbl_user');
	$this->db->join('tbl_branch', 'tbl_branch.branch_id = tbl_user.user_branch');
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
	public function get_narration($refno)
	{
		$this->db->select('*');
        $this->db->from('tbl_narration-reject');
        $this->db->where('ref_no',$refno);
        $query = $this->db->get();
    	return $query->row();
	}
	public function get_items($refno)
	{
		$this->db->select('*');
        $this->db->from('tbl_purchase');
        $this->db->where('ref_number',$refno);
        $query = $this->db->get();
    	return $query->result();
	}
	public function viewInvoice($ref_number)
	{
		$this->db->select('*');
        $this->db->from('tbl_purchase');
		//$this->db->join('tbl_branch', 'tbl_branch.branch_id = tbl_purchase.branch_id_fk');
		//$this->db->join('tbl_user', 'tbl_user.user_branch = tbl_branch.branch_id');
		$this->db->join('tbl_item', 'tbl_item.item_id = tbl_purchase.item_id_fk');
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
		$this->db->where('branch_id',$br);
		$this->db->where('tbl_user.user_designation',3);
        $query = $this->db->get();
    	return $query->result();
	}
	public function getProducts($refno)
	{
		$this->db->select('*');
        $this->db->from('tbl_purchase');
		$this->db->where('ref_number',$refno);
		$query = $this->db->get();
    	return $query->result();
	}
	public function update($table,$data,$primaryfield,$id,$secondaryfield,$idd)
    {
        $this->db->where($primaryfield, $id);
		$this->db->where($secondaryfield,$idd);
        $q = $this->db->update($table, $data);
        return $q;
    }
	public function getItemid($edit_ref)
	{
		$this->db->select('item_id_fk,grand_total,');
        $this->db->from('tbl_purchase');
		$this->db->where('ref_number',$edit_ref);
		$query = $this->db->get();
    	return $query->result();
	}
	public function getPrid($itemid,$edit_ref)
	{
		$this->db->select('pr_id');
        $this->db->from('tbl_purchase');
		$this->db->where('item_id_fk',$itemid);
		$this->db->where('ref_number',$edit_ref);
		$query = $this->db->get();
    	return $query->result();
	}
	public function getItem($id,$edit_ref)
	{
		$this->db->select('*');
        $this->db->from('tbl_purchase');
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
	
}
?>