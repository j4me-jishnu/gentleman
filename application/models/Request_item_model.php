<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Request_item_model extends CI_Model{

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
	public function get_item()
	{
		$this->db->select('*');
		$this->db->from('tbl_item');

		$this->db->where('tbl_item.item_status', 1);

        $query = $this->db->get();
		return $query->result();

	}

	public function getData($param,$br)
	{
		$this->db->select('*,tbl_item.item_name,tbl_item.item_id');
		$this->db->from('tbl_request_item');
		$this->db->join('tbl_item','tbl_item.item_id=tbl_request_item.item_id_fk');
		$this->db->where('branch_id_fk', $br);
		$query = $this->db->get();
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getReturnCount($param,$br);
        $data['recordsFiltered'] = $this->getReturnCount($param,$br);
        return $data;
	}

	public function getReturnCount($param = NULL,$br){

       	$this->db->select('*,tbl_item.item_name,tbl_item.item_id');
		$this->db->from('tbl_request_item');
		$this->db->join('tbl_item','tbl_item.item_id=tbl_request_item.item_id_fk');
		$this->db->where('branch_id_fk', $br);
        $query = $this->db->get();
    	return $query->num_rows();
    }
	public function get_issue($itemid,$userid,$branch_id)
	{
		$this->db->select('sum(issue_quantity)as issued');
		$this->db->from('tbl_issueitem');
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

	 public function delete($return_id){

		$this->db->where('request_id',$return_id);
		$this->db->delete('tbl_request_item');
        return $this->db->affected_rows();

	}


	function get_operator($request_id){


		/*$this->db->select('user_name');
		$this->db->from('tbl_login');
		$this->db->where('id',$pr_id);
		$query = $this->db->get();
		return $query->result();*/

		$this->db->select('user_name');
		$this->db->from('tbl_login');
		$this->db->join('tbl_request_item',' tbl_request_item.log_id=tbl_login.id');
		$this->db->where('tbl_request_item.request_id',$request_id);
		$query = $this->db->get();

		return $query->result();

	}


}
?>
