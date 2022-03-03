<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Setrop_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }
    public function getrop_id($branch , $item_id)
    {
    $this->db->select('*');
    $this->db->from('tbl_rop');
    $this->db->where('branch_id_fk',$branch)->where('item_id_fk',$item_id);
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
    public function checkitem($brid,$item)
    {
        $this->db->select('*');
        $this->db->from('tbl_rop');
        $this->db->where('branch_id_fk',$brid);
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
        $res = $this->db->insert('tbl_master_rop',$data);
        return $res;
    }

    public function add1($data1)
    {
        $this->db->insert('tbl_rop',$data1);
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

    public function getRopTable($param){
        $arOrder = array('','item_name');
        $searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('tbl_item.item_name', $searchValue); 
        }
        
        if ($param['start'] != 'false' and $param['length'] != 'false') {
            $this->db->limit($param['length'],$param['start']);
        }

        $this->db->select('*,tbl_item.item_id,tbl_item.item_name,tbl_branch.branch_id,tbl_branch.branch_name');
        $this->db->from('tbl_rop');
        $this->db->join('tbl_item','tbl_rop.item_id_fk=tbl_item.item_id');
        $this->db->join('tbl_branch','tbl_rop.branch_id_fk=tbl_branch.branch_id');
        $this->db->order_by('rop_id', 'DESC');
        $query = $this->db->get();
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getBRopTotalCount();
        $data['recordsFiltered'] = $this->getBRopTotalCount();
        return $data;
    }


    public function getBRopTotalCount(){

         $this->db->select('*,tbl_item.item_id,tbl_item.item_name,tbl_branch.branch_id,tbl_branch.branch_name');
        $this->db->from('tbl_rop');
        $this->db->join('tbl_item','tbl_rop.item_id_fk=tbl_item.item_id');
        $this->db->join('tbl_branch','tbl_rop.branch_id_fk=tbl_branch.branch_id');
        $this->db->order_by('rop_id', 'DESC');
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
}
?>