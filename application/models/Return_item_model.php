<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Return_item_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
    public function getReturnTable($param){
        $arOrder = array('','issue_id');
        $searchValue =($param['searchValue'])?$param['searchValue']:'';
		$template['refno'] = $this->Refno();
		$branch_id = $template['refno'][0]->branch_id;
		$template['brmname'] = $this->brmname($branch_id);
		if(isset($template['brmname'][0]->user_branch))
		{
		$br = $template['brmname'][0]->user_branch;
		}
		else
		{
		$br = 0;
		}
		if($searchValue){
            $this->db->where("(return_reason LIKE '%".$searchValue."%')", NULL, FALSE);
        }
		$this->db->where("status",1);
		$this->db->where("branch_id_fk",$br);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		
		
        $this->db->select('*,tbl_item.item_name,tbl_item.item_id');
        $this->db->from('tbl_returnproduct');
        $this->db->join('tbl_item', 'tbl_item.item_id = tbl_returnproduct.item_id_fk');
        $this->db->where("status",1);
		$this->db->where("branch_id_fk",$br);
        $this->db->order_by('return_id', 'DESC');
        $query = $this->db->get();
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getIssueTotalCount($param,$br);
        $data['recordsFiltered'] = $this->getIssueTotalCount($param,$br);
        return $data;

	}
	public function getIssueTotalCount($param = NULL,$br){

        $searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->where('return_id', $searchValue); 
        }
        $this->db->select('*,tbl_item.item_name,tbl_item.item_id');
        $this->db->from('tbl_returnproduct');
        $this->db->join('tbl_item', 'tbl_item.item_id = tbl_returnproduct.item_id_fk');
        $this->db->where("status",1);
		$this->db->where("branch_id_fk",$br);
        $this->db->order_by('return_id', 'DESC');
        $query = $this->db->get();
    	return $query->num_rows();
    }
	public function get_id($br)
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_branch',$br);
		//$this->db->where('user_designation <>', 1);
		//$this->db->where('user_designation <>', 2);
		//$this->db->where('user_designation <>', 3);
		//$this->db->where('user_designation <>', 4);
		//$this->db->where('user_designation <>', 5);
		//$this->db->where('user_designation <>', 6);
		$this->db->where('user_status', 1);
        $query = $this->db->get();
		return $query->result();
		
	}
	public function get_item($br)
	{
		$this->db->select('*');
		$this->db->from('tbl_item');
		$this->db->join('tbl_stock', 'tbl_stock.item_id_fk = tbl_item.item_id');
		$this->db->where('tbl_item.item_status', 1);
		$this->db->where('branch_id_fk', $br);
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
    public function checkstock($itemid,$br)
    {
  //       $this->db->select('used_quantity,sum(item_quantity) as total,updated_date,tbl_branch.branch_name,tbl_item.item_name');
		// $this->db->from('tbl_shopstock');
		// $this->db->join('tbl_branch', 'tbl_shopstock.shop_id_fk = tbl_branch.branch_id');
		// $this->db->join('tbl_item', 'tbl_shopstock.item_id_fk = tbl_item.item_id');
		// $this->db->where('shop_id_fk', $br);
		// $this->db->where('item_id_fk', $itemid);
		// $this->db->group_by('tbl_shopstock.item_id_fk');
		// $this->db->group_by('tbl_shopstock.shop_id_fk');
		// $this->db->order_by('tbl_branch.branch_name', 'DESC');
  //       $query = $this->db->get();
  //       return $query->row();

    	$sql = "SELECT t3.item_name,t2.item_id_fk,t2.total_qty-COALESCE(t1.total_issue_qty,0) as total FROM (SELECT item_id_fk,SUM(issue_quantity) as total_issue_qty FROM tbl_issueitem) t1 RIGHT JOIN (SELECT item_id_fk,SUM(item_quantity) as total_qty FROM tbl_shopstock WHERE shop_id_fk=$br and item_id_fk=$itemid GROUP BY shop_id_fk,item_id_fk) t2 ON t2.item_id_fk=t1.item_id_fk Join tbl_item t3 on t3.item_id=t2.item_id_fk";
    	$query = $this->db->query($sql);
        return $query->row();

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

    public function delete($return_id){
    	$data = array('status' => 0);
		$this->db->where('return_id',$return_id);
		$this->db->update('tbl_returnproduct',$data);
        return $this->db->affected_rows();
     
    }

	/* Function return branch id from branch */
	public function get_branch_id($branch_name){
		$query=$this->db->select('branch_id')->where('branch_name',$branch_name)->get('tbl_branch');
		$result=$query->result();
		return $result[0]->branch_id;
	}

	public function check_available_stock($item_id,$branch_id){
		var_dump($item_id,$branch_id); die();
		return $result;
	}


}
