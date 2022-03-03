<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Returnmodel extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
    public function getBranchTable($param){
		$arOrder = array('','branch_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('branch_name', $searchValue);
        }
        $this->db->where("branch_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_branch');
		$this->db->order_by('branch_id', 'DESC');
        $query = $this->db->get();
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getBranchTotalCount($param);
        $data['recordsFiltered'] = $this->getBranchTotalCount($param);
        return $data;

	}

	public function getBranchTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('branch_name', $searchValue);
        }
		$this->db->select('*');
		$this->db->from('tbl_branch');
		$this->db->order_by('branch_id', 'DESC');
        $this->db->where("branch_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }


    public function getreturn($param){
        $arOrder = array('','return_reason');
        $searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('item_name', $searchValue);
        }
        $this->db->select('*');
        $this->db->from('tbl_returnproduct');
        $this->db->join('tbl_item','tbl_item.item_id = tbl_returnproduct.item_id_fk');
        $this->db->join('tbl_branch','tbl_branch.branch_id = tbl_returnproduct.branch_id_fk');
        $this->db->order_by('return_id', 'DESC');

        $query = $this->db->get();
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getCount($param);
        $data['recordsFiltered'] = $this->getCount($param);
        return $data;
    }


     public function updatereturn($id){
        $data=array('status' => 0,'log_id' => $this->session->userdata('id'));
        $this->db->where('return_id', $id);
        $q = $this->db->update('tbl_returnproduct', $data);
        return $q;

    }

    public function updateToReturn($id){
        $data=array('return_to_vendor' =>1,'log_id' => $this->session->userdata('id'));
        $this->db->where('return_id', $id);
        $q = $this->db->update('tbl_returnproduct', $data);
        return $q;

    }

     public function updateToMaster($id){
        $data=array('return_to_master' => 1,'log_id' => $this->session->userdata('id'));
        $this->db->where('return_id', $id);
        $q =$this->db->update('tbl_returnproduct', $data);
        return $q;

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

       $arOrder = array('','return_reason');
        $searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('return_reason', $searchValue);
        }

        if ($param['start'] != 'false' and $param['length'] != 'false') {
            $this->db->limit($param['length'],$param['start']);
        }

        $this->db->select('*,tbl_item.item_id,tbl_item.item_name,tbl_branch.branch_id,tbl_branch.branch_name');
        $this->db->from('tbl_returnproduct');
        $this->db->join('tbl_item','tbl_item.item_id = tbl_returnproduct.item_id_fk');
         $this->db->join('tbl_branch','tbl_branch.branch_id = tbl_returnproduct.branch_id_fk');
        $this->db->order_by('return_id', 'DESC');

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

    public function getDate($id)
    {
        $this->db->select('return_date');
        $this->db->from('tbl_returnproduct');
        $this->db->where('return_id',$id);
        $query = $this->db->get();
        return $query->result();
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
     $this->db->select('user_name');
	$this->db->from('tbl_login');
	$this->db->join('tbl_returnproduct',' tbl_returnproduct.log_id=tbl_login.id');
	$this->db->where('tbl_returnproduct.return_id',$rt);
	$query = $this->db->get();

		return $query->result();

	}




}
?>
