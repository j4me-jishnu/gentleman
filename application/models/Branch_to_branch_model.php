<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Branch_to_branch_model extends CI_Model{

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
		$this->db->select('*,tbl_branch_to_branch.status as sstatus');
		$this->db->from('tbl_branch_to_branch');
		$this->db->join('tbl_item','tbl_item.item_id=tbl_branch_to_branch.item_id_fk');
		$this->db->join('tbl_branch','tbl_branch.branch_id=tbl_branch_to_branch.to_branch_id_fk');
		$this->db->where('from_branch_id_fk', $br);
		$this->db->order_by('tbl_branch_to_branch.id','DESC');
		$query = $this->db->get();
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getReturnCount($param,$br);
        $data['recordsFiltered'] = $this->getReturnCount($param,$br);
        return $data;
	}

	public function getReturnCount($param = NULL,$br){

       	$this->db->select('*');
		$this->db->from('tbl_branch_to_branch');
		$this->db->join('tbl_item','tbl_item.item_id=tbl_branch_to_branch.item_id_fk');
		$this->db->join('tbl_branch','tbl_branch.branch_id=tbl_branch_to_branch.to_branch_id_fk');
		$this->db->where('from_branch_id_fk', $br);
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

    public function checkstock($itemid,$branch)
    {

    	// $sql = "SELECT t3.item_name,t2.item_id_fk,t2.total_qty-COALESCE(t1.total_issue_qty,0) as total FROM (SELECT item_id_fk,SUM(issue_quantity) as total_issue_qty FROM tbl_issueitem) t1 RIGHT JOIN (SELECT item_id_fk,SUM(item_quantity) as total_qty FROM tbl_shopstock WHERE shop_id_fk=$br and item_id_fk=$itemid GROUP BY shop_id_fk,item_id_fk) t2 ON t2.item_id_fk=t1.item_id_fk Join tbl_item t3 on t3.item_id=t2.item_id_fk";
    	$sql = "SELECT COALESCE(t5.item_rop, 0) AS item_rop,t4.branch_name,t3.item_name,(CASE WHEN t2.updated_date IS NULL THEN t1.issue_date ELSE t2.updated_date END) AS date,t2.shop_id_fk,t2.item_id_fk,t2.total_qty+ COALESCE(t8.request_quantity,0) -(COALESCE(t1.total_issue_qty,0) + COALESCE(t6.total_return_qty,0) + COALESCE(t7.branch_qty,0)) + t2.total_qty  as total,COALESCE(t2.total_qty,0) as total_qty,COALESCE(t8.request_quantity,0) as request_quantity,COALESCE(t8.updated_date,0) as updated_date FROM (SELECT branch_id_fk,item_id_fk,issue_date,SUM(issue_quantity) as total_issue_qty FROM tbl_issueitem where branch_id_fk like $branch and item_id_fk= $itemid GROUP BY item_id_fk,branch_id_fk) t1 RIGHT JOIN (SELECT id,item_id_fk,SUM(item_quantity) as total_qty,max(updated_date) as updated_date,shop_id_fk FROM tbl_shopstock where shop_id_fk like $branch and item_id_fk= $itemid GROUP BY shop_id_fk,item_id_fk) t2 ON t2.item_id_fk=t1.item_id_fk AND t2.shop_id_fk=t1.branch_id_fk LEFT JOIN (SELECT branch_id_fk,item_id_fk,return_date,SUM(item_quantity) as total_return_qty FROM tbl_returnproduct where branch_id_fk like $branch and item_id_fk= $itemid GROUP BY item_id_fk,branch_id_fk) t6 ON t6.branch_id_fk=t2.shop_id_fk LEFT JOIN (SELECT branch_id_fk,item_id_fk,request_date,updated_date,SUM(request_quantity) as request_quantity FROM tbl_request_item Where request_status= 0 GROUP BY item_id_fk,branch_id_fk) t8  ON t2.item_id_fk=t8.item_id_fk AND t2.shop_id_fk=t8.branch_id_fk LEFT JOIN (SELECT item_id_fk,from_branch_id_fk,SUM(item_quantity) branch_qty from tbl_branch_to_branch where status = 1 and from_branch_id_fk like $branch and item_id_fk= $itemid GROUP BY from_branch_id_fk,item_id_fk) t7 ON t7.from_branch_id_fk=t2.shop_id_fk AND t7.item_id_fk=t2.item_id_fk Join tbl_item t3 on t3.item_id=t2.item_id_fk join tbl_branch t4 on t4.branch_id = t2.shop_id_fk left join tbl_rop t5 on t2.item_id_fk=t5.item_id_fk and t2.shop_id_fk=t5.branch_id_fk ";
    	$query = $this->db->query($sql);
        return $query->row();

    }

    public function getBranch($branch_id)
    {
    	$this->db->select('branch_name');
        $this->db->from('tbl_branch');
        $this->db->where('branch_id',$branch_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getItemm($item_id)
    {
    	$this->db->select('item_name');
        $this->db->from('tbl_item');
        $this->db->where('item_id',$item_id);
        $query = $this->db->get();
        return $query->result();
    }
}
?>