<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Request_Br_to_br_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }

    public function getRequest($param){

        $searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('', $searchValue);
        }

        if ($param['start'] != 'false' and $param['length'] != 'false') {
            $this->db->limit($param['length'],$param['start']);
        }
        // $this->db->select('*,tbl_branch_to_branch.id as newid,tbl_branch_to_branch.status as newstatus,tbl_item.item_id,tbl_item.item_name,tbl_branch.branch_id,tbl_branch.branch_name');
        // $this->db->from('tbl_branch_to_branch');
        // $this->db->join('tbl_item','tbl_item.item_id = tbl_branch_to_branch.item_id_fk');
        // $this->db->join('tbl_branch','tbl_branch.branch_id = tbl_branch_to_branch.from_branch_id_fk');
        // $this->db->order_by('tbl_branch_to_branch.id', 'DESC');
       $sql = "select *,b1.id as newid,b1.status as newstatus,b2.branch_name as from_branch,b2.branch_id ,b3.branch_name as to_branch,b3.branch_id from tbl_branch_to_branch b1 join tbl_branch b2 on b2.branch_id = b1.from_branch_id_fk join tbl_branch b3 on b3.branch_id = b1.to_branch_id_fk join tbl_item on tbl_item.item_id = b1.item_id_fk";
        $query = $this->db->query($sql);
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getCount($param);
        $data['recordsFiltered'] = $this->getCount($param);
        return $data;

    }


     public function updateToapprove($id){
        $data=array('status' => 1,'log_id' => $this->session->userdata('id'),'updated_date'=>date('Y-m-d'));
        $this->db->where('id', $id);
        $q = $this->db->update('tbl_branch_to_branch', $data);
        return $q;

    }
    public function getBrtobr_row($id){
        $this->db->select('to_branch_id_fk,item_id_fk,item_quantity,date');
        $this->db->from('tbl_branch_to_branch');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->result();
    }
    public function getFromBranch($id){
        $this->db->select('id,from_branch_id_fk,item_id_fk,item_quantity,item_name,branch_name');
        $this->db->from('tbl_branch_to_branch');
        $this->db->join('tbl_branch','tbl_branch.branch_id = tbl_branch_to_branch.from_branch_id_fk');
        $this->db->join('tbl_item','tbl_item.item_id = tbl_branch_to_branch.item_id_fk');
        $this->db->where('tbl_branch_to_branch.id',$id);
        $query = $this->db->get();
        return $query->result();
    }
    public function getToBranch($id){
        $this->db->select('id,to_branch_id_fk,item_id_fk,item_quantity,item_name,branch_name');
        $this->db->from('tbl_branch_to_branch');
        $this->db->join('tbl_branch','tbl_branch.branch_id = tbl_branch_to_branch.to_branch_id_fk');
        $this->db->join('tbl_item','tbl_item.item_id = tbl_branch_to_branch.item_id_fk');
        $this->db->where('tbl_branch_to_branch.id',$id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAgm()
    {
        $this->db->select('user_email');
        $this->db->from('tbl_login');
        $this->db->where('designation',1);
        $query = $this->db->get();
        return $query->result();
    }

    public function getBrm($branch)
    {
        $this->db->select('user_email');
        $this->db->from('tbl_login');
        $this->db->where('designation',3);
        $this->db->where('user_branch',$branch);
        $query = $this->db->get();
        return $query->result();
    }

    public function getCom()
    {
        $this->db->select('user_email');
        $this->db->from('tbl_login');
        $this->db->where('designation',2);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAdmin()
    {
        $this->db->select('user_email');
        $this->db->from('tbl_login');
        $this->db->where('user_type','A');
        $query = $this->db->get();
        return $query->result();
    }

    public function updateToreject($id,$reason){
        $data=array('status' => 2,'log_id' => $this->session->userdata('id'),'reject_reason'=>$reason,'updated_date'=>date('Y-m-d'));
        $this->db->where('id', $id);
        $q = $this->db->update('tbl_branch_to_branch', $data);
        return $q;

    }
    public function addtoShop($data)
    {
        $this->db->insert('tbl_shopstock', $data);
        return $this->db->insert_id();
    }

    public function getRtn($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_returnproduct');
        $this->db->where('return_id',$id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getCount($param = NULL){

      $searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('tbl_branch.branch_name', $searchValue);
        }

        if ($param['start'] != 'false' and $param['length'] != 'false') {
            $this->db->limit($param['length'],$param['start']);
        }

        $this->db->select('*,tbl_item.item_id,tbl_item.item_name,tbl_branch.branch_id,tbl_branch.branch_name');
        $this->db->from('tbl_branch_to_branch');
        $this->db->join('tbl_item','tbl_item.item_id = tbl_branch_to_branch.item_id_fk');
        $this->db->join('tbl_branch','tbl_branch.branch_id = tbl_branch_to_branch.to_branch_id_fk');
        $this->db->order_by('tbl_branch_to_branch.id', 'DESC');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function checkitem($item)
    {
        $this->db->select('*');
        $this->db->from('tbl_stock');
        $this->db->where('item_id_fk',$item);
        $this->db->where('stock_status',1);
        $query = $this->db->get();
        return $query->row();
    }


    public function getoperator($sid)
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('login_id_fk',$sid);
        $query = $this->db->get();
    	if($query->num_rows() > 0)
        {
            return $query->row();
        }
        return false;
	}

    function get_operator($rt){
     $this->db->select('user_name,updated_date,reject_reason');
	$this->db->from('tbl_login');
	$this->db->join('tbl_branch_to_branch',' tbl_branch_to_branch.log_id=tbl_login.id');
	$this->db->where('tbl_branch_to_branch.id',$rt);
	$query = $this->db->get();

		return $query->result();

	}
}
?>
