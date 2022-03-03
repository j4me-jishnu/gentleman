<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_view_Request_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
  }

  public function getRequest($param){

    $arOrder = array('','return_reason');
    $searchValue =($param['searchValue'])?$param['searchValue']:'';
    if($searchValue){
      $this->db->like('tbl_branch.branch_name', $searchValue);
    }
    if ($param['start'] != 'false' and $param['length'] != 'false') {
      $this->db->limit($param['length'],$param['start']);
    }
    $this->db->select('*,tbl_item.item_id,tbl_item.item_name,tbl_branch.branch_id,tbl_branch.branch_name');
    $this->db->from('tbl_request_item');
    $this->db->join('tbl_item','tbl_item.item_id = tbl_request_item.item_id_fk');
    $this->db->join('tbl_branch','tbl_branch.branch_id = tbl_request_item.branch_id_fk');
    $this->db->order_by('request_id', 'DESC');
    $query = $this->db->get();
    $data['data'] = $query->result();
    $data['recordsTotal'] = $this->getCount($param);
    $data['recordsFiltered'] = $this->getCount($param);
    return $data;
  }

  public function getItemid($sid)
  {
    $this->db->select('*');
    $this->db->where('request_id', $sid); // Error comes here
    $data=$this->db->get('tbl_request_item')->result();
    return $data;
  }
  public function updateToapprove($id){
    $data=array('request_status' => 0,'log_id' => $this->session->userdata('id'),'updated_date' => date('Y-m-d'));
    $this->db->where('request_id', $id);
    $q = $this->db->update('tbl_request_item', $data);
    $this->db->select('*');
    $this->db->where('request_id', $id);
    $data=$this->db->get('tbl_request_item')->result();
    $dataArray=array(
      'shop_id_fk'=>$data[0]->branch_id_fk,
      'item_id_fk'=>$data[0]->item_id_fk,
      'item_quantity'=>0,
      'updated_date'=>date('Y-m-d'),
      'status'=>1
    );
    $this->db->insert('tbl_shopstock',$dataArray);
    return $q;

  }

  public function updateToreject($id,$reason){
    $data=array('request_status' => 2,'log_id' => $this->session->userdata('id'),'reject_reason' => $reason,'updated_date' =>date('Y-m-d'));
    $this->db->where('request_id', $id);
    $q = $this->db->update('tbl_request_item', $data);
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
      $this->db->like('tbl_branch.branch_name', $searchValue);
    }

    if ($param['start'] != 'false' and $param['length'] != 'false') {
      $this->db->limit($param['length'],$param['start']);
    }
    $this->db->select('*,tbl_item.item_id,tbl_item.item_name,tbl_branch.branch_id,tbl_branch.branch_name');
    $this->db->from('tbl_request_item');
    $this->db->join('tbl_item','tbl_item.item_id = tbl_request_item.item_id_fk');
    $this->db->join('tbl_branch','tbl_branch.branch_id = tbl_request_item.branch_id_fk');
    $this->db->order_by('request_id', 'DESC');

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

  function get_operator($request_id){
    $this->db->select('user_name,reject_reason,updated_date');
    $this->db->from('tbl_login');
    $this->db->join('tbl_request_item',' tbl_request_item.log_id=tbl_login.id');
    $this->db->where('tbl_request_item.request_id',$request_id);
    $query = $this->db->get();

    return $query->result();

  }

  function get_request($request_id){

    $this->db->select('*,tbl_item.item_id,tbl_item.item_name,tbl_branch.branch_id,tbl_branch.branch_name');
    $this->db->from('tbl_request_item');
    $this->db->join('tbl_item','tbl_item.item_id = tbl_request_item.item_id_fk');
    $this->db->join('tbl_branch','tbl_branch.branch_id = tbl_request_item.branch_id_fk');
    $this->db->where('request_id',$request_id);

    $query = $this->db->get();

    return $query->result();

  }

  public function getRequestDetails($request_id){
    $query=$this->db->select('*')->where('request_id',$request_id)->get('tbl_request_item');
    $result=$query->result();
    return $result;
  }
  
  
  public function update_request_quantity($insertArray){
    $query=$this->db->set($insertArray)->where('request_id', $_POST["request_id"])->update('tbl_request_item');
    if($query){
      $result['status']=true;
      $result['message']="Updated successfully";
    }
    else{
      $result['status']=false;
      $result['message']="Couldnot update the new quantity";
    }
    return $result;
  }


}
?>
