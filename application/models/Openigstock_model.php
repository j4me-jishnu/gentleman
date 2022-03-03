<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Openigstock_model extends CI_Model{
  public function __construct()
  {
    parent::__construct();
  }
  public function getOpeningStockTable($param){
    $arOrder = array('','item_name');
    $searchValue =($param['searchValue'])?$param['searchValue']:'';
    if($searchValue){
    $this->db->like('item_name', $searchValue);
    }

    $start_date =(isset($param['start_date']))?$param['start_date']:'';
    $end_date =(isset($param['end_date']))?$param['end_date']:'';

    if($start_date && $end_date){
      $sql = "SELECT t1.*,t1.item_quantity + tbl_opening_stock.item_quantity - COALESCE(t2.item_quantity, 0) AS remaining_qty FROM (select pr_id,item_id_fk,item_name,SUM(item_quantity) AS item_quantity FROM tbl_apurchase where finaldelivery = 0 and item_date BETWEEN '$start_date' and '$end_date' GROUP BY item_id_fk) t1 LEFT JOIN (SELECT item_id_fk, SUM(item_quantity) AS item_quantity FROM tbl_shopstock where status = 1 and updated_date BETWEEN '$start_date' and '$end_date' GROUP BY item_id_fk) t2 ON t1.item_id_fk=t2.item_id_fk LEFT JOIN tbl_opening_stock ON t1.item_id_fk=tbl_opening_stock.item_id_fk WHERE tbl_opening_stock.branch_id_fk=0";
    }
    else{
      $sql = "SELECT t1.*,t1.item_quantity - COALESCE(t2.item_quantity, 0) AS remaining_qty FROM (select pr_id,item_id_fk,item_name,SUM(item_quantity) AS item_quantity FROM tbl_apurchase where finaldelivery = 0  GROUP BY item_id_fk) t1 LEFT JOIN (SELECT item_id_fk, SUM(item_quantity) AS item_quantity FROM tbl_shopstock where status = 1 GROUP BY item_id_fk) t2 ON t1.item_id_fk=t2.item_id_fk";
    }
    if($searchValue){
      $query=$this->db->select('pr_id,item_quantity,item_id_fk,')
      ->where('status',1)
      ->join('tbl_item','tbl_item.item_id = tbl_apurchase.item_id_fk')
      ->get('tbl_apurchase');
    }
    // if ($param['start'] != 'false' and $param['length'] != 'false')  {
    // $length=$param['length'];
    //     $start= $param['start'];
    //     $sql.=" limit $start,$length";
    // }
    if ($param['start'] != 'false' and $param['length'] != 'false')
    {
      $this->db->limit($param['length'],$param['start']);
    }
    $query = $this->db->query($sql);
    // print_r($this->db->last_query());
    //      exit();
    $data['data'] = $query->result();

    // print_r($data['data']);
    // exit();







    foreach($data['data'] as $row){

      $results = $this->db->select('SUM(item_quantity) as item_quantity')->from('tbl_opening_stock')->where('item_id_fk',$row->item_id_fk)->get()->result();

      // print_r($this->db->last_query());
      // exit();
      if(isset($results) && $results!=NULL){

        $row->remaining_qty = $row->item_quantity+$results[0]->item_quantity;

      }




    }
    $this->db->select('opening_id as pr_id,item_quantity as remaining_qty,tbl_item.item_name');
    $this->db->from('tbl_opening_stock');
    $this->db->join('tbl_item', 'tbl_item.item_id = tbl_opening_stock.item_id_fk');
    $this->db->where('tbl_opening_stock.branch_id_fk',0);
    $query = $this->db->get();

    $data['data']=array_merge($data['data'],$query->result());


    // print_r($data['data']);
    // exit();
    return $data;

  }

  public function getClosingMaster($param){
    $arOrder = array('','item_name');
    $start_date =(isset($param['start_date']))?$param['start_date']:'';
    $end_date =(isset($param['end_date']))?$param['end_date']:'';
    $start1_date =(isset($param['start1_date']))?$param['start1_date']:'';
    $end1_date =(isset($param['end1_date']))?$param['end1_date']:'';
    if($start_date && $end_date){
      $sql = "SELECT t1.*,t1.item_quantity - COALESCE(t2.item_quantity, 0) AS remaining_qty FROM (select pr_id,item_id_fk,item_name,SUM(item_quantity) AS item_quantity FROM tbl_apurchase where finaldelivery = 0 and item_date BETWEEN '$start1_date' and '$end1_date' GROUP BY item_id_fk) t1 LEFT JOIN (SELECT item_id_fk, SUM(item_quantity) AS item_quantity FROM tbl_shopstock where status = 1 and updated_date BETWEEN '$start_date' and '$end_date' GROUP BY item_id_fk) t2 ON t1.item_id_fk=t2.item_id_fk ";
    }
    else{
      $sql = "SELECT t1.*,t1.item_quantity - COALESCE(t2.item_quantity, 0) AS remaining_qty FROM (select pr_id,item_id_fk,item_name,SUM(item_quantity) AS item_quantity FROM tbl_apurchase where finaldelivery = 0  GROUP BY item_id_fk) t1 LEFT JOIN (SELECT item_id_fk, SUM(item_quantity) AS item_quantity FROM tbl_shopstock where status = 1 GROUP BY item_id_fk) t2 ON t1.item_id_fk=t2.item_id_fk ";
    }
    if ($param['start'] != 'false' and $param['length'] != 'false')  {
      $length=$param['length'];
      $start= $param['start'];
      $sql.=" limit $start,$length";
    }

    $query = $this->db->query($sql);
    $data['data'] = $query->result();
    return $data;

  }

  public function getOpeningBranchTable($param){

    $arOrder = array('','branch_name');
    $searchValue =($param['searchValue'])?$param['searchValue']:'';
    if($searchValue){
      $this->db->like('branch_name', $searchValue);
    }

    $start_date =(isset($param['start_date']))?$param['start_date']:'';
    $end_date =(isset($param['end_date']))?$param['end_date']:'';

    if($start_date && $end_date){
      $sql = "SELECT COALESCE(t5.item_rop, 0) AS item_rop,t4.branch_name,t3.item_name,(CASE WHEN t2.updated_date IS NULL THEN t1.issue_date ELSE t2.updated_date END) AS date,t2.shop_id_fk,t2.item_id_fk,t2.total_qty-(COALESCE(t1.total_issue_qty,0) + COALESCE(t6.total_return_qty,0) + COALESCE(t7.branch_qty,0)) as total FROM (SELECT branch_id_fk,item_id_fk,issue_date,SUM(issue_quantity) as total_issue_qty FROM tbl_issueitem where issue_date BETWEEN '$start_date' and '$end_date' GROUP BY item_id_fk,branch_id_fk) t1 RIGHT JOIN (SELECT id,item_id_fk,SUM(item_quantity) as total_qty,max(updated_date) as updated_date,shop_id_fk FROM tbl_shopstock where updated_date BETWEEN '$start_date' and '$end_date' GROUP BY shop_id_fk,item_id_fk) t2 ON t2.item_id_fk=t1.item_id_fk AND t2.shop_id_fk=t1.branch_id_fk LEFT JOIN (SELECT branch_id_fk,item_id_fk,return_date,SUM(item_quantity) as total_return_qty FROM tbl_returnproduct where return_date BETWEEN '$start_date' and '$end_date' GROUP BY item_id_fk,branch_id_fk) t6 ON t6.item_id_fk=t2.item_id_fk AND t6.branch_id_fk=t2.shop_id_fk LEFT JOIN (SELECT item_id_fk,from_branch_id_fk,SUM(item_quantity) branch_qty from tbl_branch_to_branch where status = 1 and date BETWEEN '$start_date' AND '$end_date' GROUP BY from_branch_id_fk,item_id_fk) t7 ON t7.from_branch_id_fk=t2.shop_id_fk AND t7.item_id_fk=t2.item_id_fk Join tbl_item t3 on t3.item_id=t2.item_id_fk join tbl_branch t4 on t4.branch_id = t2.shop_id_fk join tbl_rop t5 on t2.item_id_fk=t5.item_id_fk and t2.shop_id_fk=t5.branch_id_fk order by id desc";
    }
    else{
      $sql = "SELECT COALESCE(t5.item_rop, 0) AS item_rop,t4.branch_name,t3.item_name,(CASE WHEN t2.updated_date IS NULL THEN t1.issue_date ELSE t2.updated_date END) AS date,t2.shop_id_fk,t2.item_id_fk,t2.total_qty-(COALESCE(t1.total_issue_qty,0) + COALESCE(t6.total_return_qty,0) + COALESCE(t7.branch_qty,0)) as total FROM (SELECT branch_id_fk,item_id_fk,issue_date,SUM(issue_quantity) as total_issue_qty FROM tbl_issueitem GROUP BY item_id_fk,branch_id_fk) t1 RIGHT JOIN (SELECT id,item_id_fk,SUM(item_quantity) as total_qty,max(updated_date) as updated_date,shop_id_fk FROM tbl_shopstock GROUP BY shop_id_fk,item_id_fk) t2 ON t2.item_id_fk=t1.item_id_fk AND t2.shop_id_fk=t1.branch_id_fk LEFT JOIN (SELECT branch_id_fk,item_id_fk,return_date,SUM(item_quantity) as total_return_qty FROM tbl_returnproduct GROUP BY item_id_fk,branch_id_fk) t6 ON t6.item_id_fk=t2.item_id_fk AND t6.branch_id_fk=t2.shop_id_fk LEFT JOIN (SELECT item_id_fk,from_branch_id_fk,SUM(item_quantity) branch_qty from tbl_branch_to_branch where status = 1 GROUP BY from_branch_id_fk,item_id_fk) t7 ON t7.from_branch_id_fk=t2.shop_id_fk AND t7.item_id_fk=t2.item_id_fk Join tbl_item t3 on t3.item_id=t2.item_id_fk join tbl_branch t4 on t4.branch_id = t2.shop_id_fk join tbl_rop t5 on t2.item_id_fk=t5.item_id_fk and t2.shop_id_fk=t5.branch_id_fk order by id desc";
    }
    if($searchValue){
      $sql.= " where branch_name LIKE %$searchValue%'";
    }
    // if($searchValue){
    //   $sql.=" AND branch_name LIKE '%$searchValue%'";
    // }
    if ($param['start'] != 'false' and $param['length'] != 'false')
    {
      $length=$param['length'];
      $start= $param['start'];
      $sql.=" limit $start,$length";
    }

    $query = $this->db->query($sql);
    // print_r($this->db->last_query());
    //exit();
    $data['data'] = $query->result();
    return $data;

  }

  public function getOpen($param)
  {
    $arOrder = array('','item_name');
    $start_date =(isset($param['start_date']))?$param['start_date']:'';
    $end_date =(isset($param['end_date']))?$param['end_date']:'';
    if($start_date && $end_date){
      $sql = "SELECT t1.item_id_fk,t1.branch_id_fk as shop_id_fk,t1.total,t1.date,t3.branch_name,t2.item_name FROM (SELECT item_id_fk,branch_id_fk,item_quantity,date,sum(item_quantity) as total FROM tbl_opening_stock WHERE date BETWEEN '$start_date' AND '$end_date' GROUP BY item_id_fk,branch_id_fk) t1 JOIN tbl_item t2 ON t1.item_id_fk=t2.item_id JOIN tbl_branch t3 on t1.branch_id_fk = t3.branch_id";

    }
    else
    {
      $sql = "SELECT t1.item_id_fk,t1.branch_id_fk as shop_id_fk,t1.total,t1.date,t3.branch_name,t2.item_name FROM (SELECT item_id_fk,branch_id_fk,item_quantity,date,sum(item_quantity) as total FROM tbl_opening_stock GROUP BY item_id_fk,branch_id_fk) t1 JOIN tbl_item t2 ON t1.item_id_fk=t2.item_id JOIN tbl_branch t3 on t1.branch_id_fk = t3.branch_id";
    }
    if ($param['start'] != 'false' and $param['length'] != 'false')
    {
      $length=$param['length'];
      $start= $param['start'];
      $sql.=" limit $start,$length";
    }
    $query = $this->db->query($sql);
    $data['data'] = $query->result();
    return $data;

  }
  public function getStockTotalCount($param = NULL){

    $searchValue =($param['searchValue'])?$param['searchValue']:'';
    if($searchValue){
      $this->db->like('tbl_opening_stock.item_name', $searchValue);
    }
    $this->db->select('*');
    $this->db->from('tbl_opening_stock');
    $this->db->join('tbl_item', 'tbl_item.item_id = tbl_opening_stock.item_id_fk');
    $this->db->join('tbl_branch', 'tbl_branch.branch_id = tbl_opening_stock.branch_id_fk');
    $this->db->order_by('opening_id', 'DESC');
    $query = $this->db->get();
    return $query->num_rows();
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
  public function getitemName($item_id)
  {
    $this->db->select('*');
    $this->db->from('tbl_item');
    $this->db->where('item_id',$item_id);
    $query = $this->db->get();
    if($query->num_rows() > 0)
    {
      return $query->row();
    }
    return false;
  }
  public function insertOP($data)
  {
    $res=$this->db->insert('tbl_opening_stock',$data);
    if($res)
    {
      return true;
    }
    else
    {
      return false;
    }
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
    $this->db->from('tbl_stock');
    $this->db->where('branch_id_fk',$brid);
    $this->db->where('item_id_fk',$item);
    $this->db->where('stock_status',1);
    $query = $this->db->get();
    return $query->row();
  }

  public function get_stock($item_id){

    return $this->db->select('*')->from('tbl_stock')->where('item_id_fk',$item_id)->get()->result();

  }

  public function get_up($stock_id){

    return $this->db->select('*')->from('tbl_stockup')->where('stock_id_fk',$stock_id)->get()->result();

  }
  //Fetch all the stock items
  public function fetch_all_stock_items(){
    $rows=$this->db->select('item_id, item_name')->get("tbl_item");
    $result=$rows->result_array();
    return $result;
  }

  //Fetch all the branches

  public function fetch_all_branches(){
    $rows=$this->db->select('branch_id, branch_name')->get("tbl_branch");
    $result=$rows->result_array();
    return $result;
  }

  /* Function to fetch opening stock for branch and master stock items */
  public function fetch_opening_stock($branch_id,$item_id){
    $rows=$this->db->select('item_quantity')
    ->where('item_id_fk',$item_id)
    ->where('branch_id_fk',$branch_id)
    ->get("tbl_opening_stock");
    $data['data']=$rows->result();
    $records=$rows->result_array();

    $sum_array=array();

    for($i=0;$i<count($records);$i++){
      array_push($sum_array,$records[$i]["item_quantity"]);
    }
    if(empty($records)){
      $result['sum_of_item_quantity']=0;
      $result['matching_count']=0;
    }
    $result['sum_of_item_quantity']=array_sum($sum_array);
    return $result;
  }

  /* Function to fetch history of opening stock added for branches*/

  public function get_openingstock_history($branch_id,$item_id,$param){
    $arOrder = array('','searchValue','start_date','end_date','cust_name');
    $searchValue =($param['searchValue'])?$param['searchValue']:'';
    $start_date =(isset($param['start_date']))?$param['start_date']:'';
    $end_date =(isset($param['end_date']))?$param['end_date']:'';
    $user_name =(isset($param['user_name']))?$param['user_name']:'';
    if($searchValue){
      $this->db->like('first_name', $searchValue);
    }
    if($user_name){
      $this->db->like('first_name', $user_name);
      $this->db->or_like('last_name', $user_name);
    }
    if($start_date){
      $this->db->where('created_date >=', $start_date);
    }
    if($end_date){
      $this->db->where('updated_date <=', $end_date);
    }
    $rows=$this->db->select('*')
    ->where('item_id_fk',$item_id)
    ->where('branch_id_fk',$branch_id)
    ->get("tbl_opening_stock");
    $data['data']=$rows->result();
    // var_dump($data['data']); die;
    return $data;
  }
  // public function get_openingstock_history($branch_id,$item_id,$param){
  //
  //     $rows=$this->db->select('*')
  //     ->where('item_id_fk',$item_id)
  //     ->where('branch_id_fk',$branch_id)
  //     ->get("tbl_opening_stock");
  //     $data['data']=$rows->result_array();
  //     return $data;
  // }

  /* Function to fetch history of opening stock for all items Master*/

  public function get_master_openingstock_history($item_id){
    $rows=$this->db->select('*')
    ->where('item_id_fk',$item_id)
    ->get("tbl_opening_stock");
    $records=$rows->result_array();
    $response=array();
    for($i=0;$i<count($records);$i++){
      array_push($response,$records[$i]["item_quantity"]);
    }
    if(empty($records)){
      $result['sum_of_item_quantity']=0;
      $result['matching_count']=0;
    }
    $result['matching_count']=count($response);
    $result['matching_items']=$response;
    $result['sum_of_item_quantity']=array_sum($response);
    return $result;
  }

  public function get_single_os($os_id){
    $rows=$this->db->select('*')
    ->where('opening_id',$os_id)
    ->get("tbl_opening_stock");
    $result=$rows->result();
    return $result[0];
  }

  public function updateOpeningStock($os_id,$data){
    $this->db->where('opening_id', $os_id);
    $q = $this->db->update('tbl_opening_stock', $data);
    return $q;
  }

}
?>
