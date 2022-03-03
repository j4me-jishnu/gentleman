<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Issueroll_model extends CI_Model{

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
            $this->db->where('issue_id', $searchValue); 
        }
		$this->db->where("issue_status",1);
		$this->db->where("branch_id_fk",$br);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		
		
        $this->db->select('*,DATE_FORMAT(issue_date,\'%d/%m/%Y\') as issuedate');
        $this->db->from('tbl_issueroll');
        $this->db->join('tbl_item', 'tbl_item.item_id = tbl_issueroll.item_id_fk');
        $this->db->join('tbl_user', 'tbl_user.user_id = tbl_issueroll.user_id_fk');
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
        $this->db->from('tbl_issueroll');
        $this->db->join('tbl_item', 'tbl_item.item_id = tbl_issueroll.item_id_fk');
        $this->db->join('tbl_user', 'tbl_user.user_id = tbl_issueroll.user_id_fk');
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
        $this->db->select('*');
        $this->db->from('tbl_stock');
        $this->db->where('item_id_fk',$itemid);
        $this->db->where('branch_id_fk',$br);
        $query = $this->db->get();
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
	public function getPrevious($itemid,$userid){
		
		$this->db->select('*,DATE_FORMAT(issue_date,\'%d/%m/%Y\') as issdate');
		$this->db->from('tbl_issueroll');
		$this->db->where('issue_status',1);
		$this->db->where('user_id_fk',$userid);
		$this->db->where('item_id_fk',$itemid);
        $query = $this->db->get();
    	return $query->result();
    }
}
?>