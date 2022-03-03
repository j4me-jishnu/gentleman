<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Branch_Benchmark_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }

    public function getrop_id($user , $item_id)
    {
    $this->db->select('*');
    $this->db->from('issue_benchmark');
    $this->db->where('user_id_fk',$user)->where('item_id_fk',$item_id);
    $query = $this->db->get();
    if($query->num_rows() > 0)
    {
        return $query->row();
    }
    return false;
    }
    public function update($table,$data,$primaryfield,$id,$secondaryfield,$idd)
    {
        $this->db->where($primaryfield, $id);
        $this->db->where($secondaryfield,$idd);
        $q = $this->db->update($table, $data);
        return $q;
    }
    public function checkitem($user,$item)
    {
        $this->db->select('*');
        $this->db->from('issue_benchmark');
        $this->db->where('user_id_fk',$user);
        $this->db->where('item_id_fk',$item);
        $query = $this->db->get();
    	return $query->row();
    }

    public function checkMasteritem($item)
    {
        $this->db->select('*');
        $this->db->from('tbl_master_rop');
        $this->db->where('item_id_fk',$item);
        $query = $this->db->get();
        return $query->row();
    }

    public function getMasterrop_id($item_id)
    {
    $this->db->select('*');
    $this->db->from('tbl_master_rop');
    $this->db->where('item_id_fk',$item_id);
    $query = $this->db->get();
    if($query->num_rows() > 0)
    {
        return $query->row();
    }
    return false;
    }

    public function add($data)
    {
        $this->db->insert('tbl_master_rop',$data);
    }

    public function add1($data)
    {
        $this->db->insert('issue_benchmark',$data);
    }
    public function getMasterRopTable($param){
        $arOrder = array('','item_name');
        $searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('tbl_item.item_name', $searchValue);
        }

        if ($param['start'] != 'false' and $param['length'] != 'false') {
            $this->db->limit($param['length'],$param['start']);
        }

        $this->db->select('*,tbl_item.item_id,tbl_item.item_name');
        $this->db->from('tbl_master_rop');
        $this->db->join('tbl_item','tbl_master_rop.item_id_fk=tbl_item.item_id');
        $this->db->order_by('rop_id', 'DESC');
        $query = $this->db->get();
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getRopTotalCount();
        $data['recordsFiltered'] = $this->getRopTotalCount();
        return $data;
    }

    public function getBenchTable($param,$branch_id){

        $arOrder = array('','item_name');
        $user_name =(isset($param['user_name']))?$param['user_name']:'';
        $searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('tbl_item.item_name', $searchValue);
        }

         if($user_name){
            $this->db->where('issue_benchmark.user_id_fk', $user_name);
        }

        if ($param['start'] != 'false' and $param['length'] != 'false') {
            $this->db->limit($param['length'],$param['start']);
        }

        $this->db->select('*,tbl_item.item_id,tbl_item.item_name,tbl_user.user_id,tbl_user.username');
        $this->db->from('issue_benchmark');
        $this->db->join('tbl_item','issue_benchmark.item_id_fk=tbl_item.item_id');
        $this->db->join('tbl_user','issue_benchmark.user_id_fk=tbl_user.user_id');
        $this->db->order_by('issue_benchmark.id', 'DESC');
        $this->db->where('branch_id_fk',$branch_id);
        $query = $this->db->get();
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getBRopTotalCount();
        $data['recordsFiltered'] = $this->getBRopTotalCount();
        return $data;
    }


    public function getBRopTotalCount(){

        $this->db->select('*,tbl_item.item_id,tbl_item.item_name,tbl_user.user_id,tbl_user.username');
        $this->db->from('issue_benchmark');
        $this->db->join('tbl_item','issue_benchmark.item_id_fk=tbl_item.item_id');
        $this->db->join('tbl_user','issue_benchmark.user_id_fk=tbl_user.user_id');
        $this->db->order_by('issue_benchmark.id', 'DESC');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getRopTotalCount(){

        $this->db->select('*,tbl_item.item_id,tbl_item.item_name');
        $this->db->from('tbl_master_rop');
        $this->db->join('tbl_item','tbl_master_rop.item_id_fk=tbl_item.item_id');
        $this->db->order_by('rop_id', 'DESC');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function updateToapprove($id){
        $data=array('status' => 1);
        $this->db->where('id', $id);
        $q = $this->db->update('issue_benchmark', $data);
        return $q;
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

public function updateToreject($id){
$data=array('status' => 2);
$this->db->where('id', $id);
$q = $this->db->update('issue_benchmark', $data);
return $q;
}
}
?>
