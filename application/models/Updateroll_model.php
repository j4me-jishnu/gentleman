<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Updateroll_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
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
	public function get_id($br)
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_branch',$br);
		$this->db->where('user_designation <>', 1);
		$this->db->where('user_designation <>', 2);
		$this->db->where('user_designation <>', 3);
		$this->db->where('user_designation <>', 4);
		$this->db->where('user_designation <>', 5);
		$this->db->where('user_designation <>', 6);
		$this->db->where('user_status', 1);
        $query = $this->db->get();
		return $query->result();
		
	}
	public function get_item($br)
	{
		$it = 'PAPER ROLL- DC MACHINE';
		$this->db->select('*');
		$this->db->from('tbl_item');
		$this->db->join('tbl_stock', 'tbl_stock.item_id_fk = tbl_item.item_id');
		$this->db->where('tbl_item.item_status', 1);
		$this->db->where('branch_id_fk', $br);
		$this->db->like('tbl_stock.item_name', $it);
        $query = $this->db->get();
		return $query->result();
		
	}
	public function get_issue($itemid,$userid,$branch_id)
	{
		$this->db->select('sum(roll_quantity)as issued');
		$this->db->from('tbl_issueroll');
		$this->db->where('user_id_fk', $userid);
		$this->db->where('item_id_fk', $itemid);
		$this->db->where('branch_id_fk',$branch_id);
        $query = $this->db->get();
		return $query->result();
		
	}
	public function get_usage($itemid,$userid,$branch_id)
	{
		$this->db->select('sum(usage_quantity)as used');
		$this->db->from('tbl_usageitem');
		$this->db->where('user_id_fk', $userid);
		$this->db->where('item_id_fk', $itemid);
		$this->db->where('branch_id_fk',$branch_id);
        $query = $this->db->get();
		return $query->result();
		
	}
	public function get_returned($itemid,$userid,$branch_id)
	{
		$this->db->select('sum(item_quantity)as returned');
		$this->db->from('tbl_return');
		$this->db->where('user_id_fk', $userid);
		$this->db->where('item_id_fk', $itemid);
		$this->db->where('branch_id_fk',$branch_id);
        $query = $this->db->get();
		return $query->result();
		
	}
	public function get_stock($itemid,$branch_id)
	{
		$this->db->select('*');
		$this->db->from('tbl_stock');
		$this->db->where('item_id_fk', $itemid);
		$this->db->where('branch_id_fk', $branch_id);
        $query = $this->db->get();
		return $query->result();
	}
	public function get_rolldetails($itemid,$userid,$branch_id)
	{
		$this->db->select('sum(roll_quantity) as rollcount,sum(ticket_count) as tkcount,sum(cutoff_ticket) as ctcount,sum(expect_ticket) as excount');
		$this->db->from('tbl_issueroll');
		$this->db->where('item_id_fk', $itemid);
		$this->db->where('branch_id_fk', $branch_id);
		$this->db->where('user_id_fk', $userid);
        $query = $this->db->get();
		return $query->result();
	}
}
?>