<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Issueitem_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
    public function getIssueTable($param){
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
             $this->db->like('username', $searchValue);
             $this->db->or_like('item_name', $searchValue);
        }
		$this->db->where("issue_status",1);
		$this->db->where("branch_id_fk",$br);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }


        $this->db->select('*,DATE_FORMAT(issue_date,\'%d/%m/%Y\') as issuedate');
        $this->db->from('tbl_issueitem');
        $this->db->join('tbl_item', 'tbl_item.item_id = tbl_issueitem.item_id_fk');
        $this->db->join('tbl_user', 'tbl_user.user_id = tbl_issueitem.user_id_fk');
        $this->db->where('tbl_issueitem.master_status',0);
        $this->db->order_by('issue_id', 'DESC');
        $query = $this->db->get();
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getIssueTotalCount($param,$br);
        $data['recordsFiltered'] = $this->getIssueTotalCount($param,$br);
        return $data;

	}
	public function getIssueTotalCount($param = NULL,$br){

        $searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->where('issue_id', $searchValue);
        }
        $this->db->select('*,DATE_FORMAT(issue_date,\'%d/%m/%Y\') as issuedate');
        $this->db->from('tbl_issueitem');
        $this->db->join('tbl_item', 'tbl_item.item_id = tbl_issueitem.item_id_fk');
        $this->db->join('tbl_user', 'tbl_user.user_id = tbl_issueitem.user_id_fk');
        $this->db->where('tbl_issueitem.master_status',0);
        $this->db->order_by('issue_id', 'DESC');
        $this->db->where("issue_status",1);
		$this->db->where("branch_id_fk",$br);
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
    public function checkstock($item,$branch)
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

   //  	$sql = "SELECT t5.item_rop,t4.branch_name,t3.item_name,(CASE WHEN t1.issue_date IS NULL THEN t2.updated_date ELSE t1.issue_date END) AS date,t2.item_id_fk,t2.total_qty-(COALESCE(t1.total_issue_qty,0) + COALESCE(t6.total_return_qty,0) + COALESCE(t7.branch_qty,0)) as total FROM (SELECT branch_id_fk,item_id_fk,issue_date,SUM(issue_quantity) as total_issue_qty FROM tbl_issueitem where branch_id_fk = $br and item_id_fk= $itemid GROUP BY item_id_fk,branch_id_fk) t1 RIGHT JOIN (SELECT item_id_fk,SUM(item_quantity) as total_qty,max(updated_date) as updated_date,shop_id_fk FROM tbl_shopstock where shop_id_fk = $br and item_id_fk= $itemid GROUP BY shop_id_fk,item_id_fk) t2 ON t2.item_id_fk=t1.item_id_fk AND t2.shop_id_fk=t1.branch_id_fk LEFT JOIN (SELECT branch_id_fk,item_id_fk,return_date,SUM(item_quantity) as total_return_qty FROM tbl_returnproduct where branch_id_fk = $br and item_id_fk= $itemid GROUP BY item_id_fk,branch_id_fk) t6 ON t6.item_id_fk=t2.item_id_fk AND t6.branch_id_fk=t2.shop_id_fk LEFT JOIN (SELECT from_branch_id_fk,SUM(item_quantity) branch_qty from tbl_branch_to_branch where status = 1 and from_branch_id_fk = $br and item_id_fk= $itemid GROUP BY from_branch_id_fk,item_id_fk) t7 ON t7.from_branch_id_fk=t2.shop_id_fk
			// Join tbl_item t3 on t3.item_id=t2.item_id_fk join tbl_branch t4 on t4.branch_id = t2.shop_id_fk join tbl_rop t5 on t2.item_id_fk=t5.item_id_fk and t2.shop_id_fk=t5.branch_id_fk";
    	$sql = "SELECT COALESCE(t5.item_rop, 0) AS item_rop,t4.branch_name,t3.item_name,(CASE WHEN t2.updated_date IS NULL THEN t1.issue_date ELSE t2.updated_date END) AS date,t2.shop_id_fk,t2.item_id_fk,t2.total_qty+ COALESCE(t8.request_quantity,0) -(COALESCE(t1.total_issue_qty,0) + COALESCE(t6.total_return_qty,0) + COALESCE(t7.branch_qty,0)) as total,COALESCE(t2.total_qty,0) as total_qty,COALESCE(t8.request_quantity,0) as request_quantity,COALESCE(t8.updated_date,0) as updated_date,COALESCE(t1.total_issue_qty,0) as tot_qty FROM (SELECT branch_id_fk,item_id_fk,issue_date,SUM(issue_quantity) as total_issue_qty FROM tbl_issueitem where master_status!=1 and item_id_fk like $item and branch_id_fk like $branch GROUP BY item_id_fk,branch_id_fk) t1 RIGHT JOIN (SELECT id,item_id_fk,SUM(item_quantity) as total_qty,max(updated_date) as updated_date,shop_id_fk FROM tbl_shopstock where item_id_fk like $item and shop_id_fk like $branch GROUP BY shop_id_fk,item_id_fk) t2 ON t2.item_id_fk=t1.item_id_fk AND t2.shop_id_fk=t1.branch_id_fk LEFT JOIN (SELECT branch_id_fk,item_id_fk,return_date,SUM(item_quantity) as total_return_qty FROM tbl_returnproduct where item_id_fk like $item and branch_id_fk like $branch GROUP BY item_id_fk,branch_id_fk) t6 ON t6.item_id_fk=t2.item_id_fk AND t6.branch_id_fk=t2.shop_id_fk LEFT JOIN (SELECT branch_id_fk,item_id_fk,request_date,updated_date,SUM(request_quantity) as request_quantity FROM tbl_request_item Where request_status= 0 GROUP BY item_id_fk,branch_id_fk) t8  ON t2.item_id_fk=t8.item_id_fk AND t2.shop_id_fk=t8.branch_id_fk LEFT JOIN (SELECT item_id_fk,from_branch_id_fk,SUM(item_quantity) branch_qty from tbl_branch_to_branch where status = 1 and item_id_fk like $item and from_branch_id_fk like $branch GROUP BY from_branch_id_fk,item_id_fk) t7 ON t7.from_branch_id_fk=t2.shop_id_fk AND t7.item_id_fk=t2.item_id_fk Join tbl_item t3 on t3.item_id=t2.item_id_fk join tbl_branch t4 on t4.branch_id = t2.shop_id_fk left join tbl_rop t5 on t2.item_id_fk=t5.item_id_fk and t2.shop_id_fk=t5.branch_id_fk ";
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

    public function getBS($bid,$iid)
    {
    	$sql = "SELECT t5.item_rop,t4.branch_name,t3.item_name,(CASE WHEN t1.issue_date IS NULL THEN t2.updated_date ELSE t1.issue_date END) AS date,t2.item_id_fk,t2.total_qty-(COALESCE(t1.total_issue_qty,0) + COALESCE(t6.total_return_qty,0) + COALESCE(t7.branch_qty,0)) as total FROM (SELECT max(issue_date) as issue_date, branch_id_fk,item_id_fk,SUM(issue_quantity) as total_issue_qty FROM tbl_issueitem where branch_id_fk = $bid and item_id_fk = $iid GROUP BY item_id_fk,branch_id_fk) t1 RIGHT JOIN (SELECT item_id_fk,SUM(item_quantity) as total_qty,max(updated_date) as updated_date,shop_id_fk FROM tbl_shopstock where shop_id_fk = $bid and item_id_fk =$iid GROUP BY shop_id_fk,item_id_fk) t2 ON t2.item_id_fk=t1.item_id_fk AND t2.shop_id_fk=t1.branch_id_fk LEFT JOIN (SELECT branch_id_fk,item_id_fk,return_date,SUM(item_quantity) as total_return_qty FROM tbl_returnproduct where branch_id_fk =$bid and item_id_fk = $iid GROUP BY item_id_fk,branch_id_fk) t6 ON t6.item_id_fk=t2.item_id_fk AND t6.branch_id_fk=t2.shop_id_fk LEFT JOIN (SELECT item_id_fk,from_branch_id_fk,SUM(item_quantity) branch_qty from tbl_branch_to_branch where status = 1 and from_branch_id_fk = $bid and item_id_fk = $iid GROUP BY from_branch_id_fk,item_id_fk) t7 ON t7.from_branch_id_fk=t2.shop_id_fk AND t7.item_id_fk=t2.item_id_fk Join tbl_item t3 on t3.item_id=t2.item_id_fk join tbl_branch t4 on t4.branch_id = t2.shop_id_fk join tbl_rop t5 on t2.item_id_fk=t5.item_id_fk and t2.shop_id_fk=t5.branch_id_fk";
    		$query = $this->db->query($sql);
			$data = $query->result();
			return $data;
    }

    public function get_users($branch_id)
    {
    	$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_status',1);
		$this->db->where('user_branch',$branch_id);

        $query = $this->db->get();
    	return $query->result();
	}
	public function get_branch()
    {
    	$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->join('tbl_branch', 'tbl_branch.branch_id = tbl_user.user_branch');
		 $query = $this->db->get();
    	return $query->result();
	}


	public function get_usersbenchmark($branch_id)
    {
    	$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->join('tbl_branch', 'tbl_branch.branch_id = tbl_user.user_branch');
		$this->db->join('issue_benchmark', 'issue_benchmark.branch_id_fk = tbl_user.user_branch');
		$this->db->where('user_branch',$branch_id);
	 $query = $this->db->get();
    	return $query->result();
	}

	public function get_branchuser()
	{
	$this->db->select('branch_name,branch_id');
	$this->db->from('tbl_branch');

	$query = $this->db->get();

	// print_r($this->db->last_query());
	// exit();
	return $query->result();
	}

	public function get_item_name($branch_id){
		$query=$this->db->select('branch_name')->where('branch_id',$branch_id)->get('tbl_branch');
		$result=$query->row();
		return $result->branch_name;
	}


}
?>
