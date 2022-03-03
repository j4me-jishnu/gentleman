<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Benchmark_Request_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
   
 

 public function getRequest($param){
 $user_name =(isset($param['user_name']))?$param['user_name']:'';
  $searchValue =($param['searchValue'])?$param['searchValue']:'';
 if($searchValue){
 $this->db->like('tbl_item.item_name', $searchValue); 
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


     public function updateToapprove($id){
        $data=array('status' => 1);   
        $this->db->where('id', $id);
        $q = $this->db->update('issue_benchmark', $data);
        return $q;
 }
   
    
    public function updateToreject($id){
        $data=array('status' => 2);   
        $this->db->where('id', $id);
        $q = $this->db->update('issue_benchmark', $data);
        return $q;
 }
    

    

   
   
}
?>