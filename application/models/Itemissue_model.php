<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Itemissue_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }
    public function getStockTable($param){
		$arOrder = array('','item_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		if($searchValue){
            $this->db->like('tbl_stock.item_name', $searchValue); 
        }
		$this->db->where("stock_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_stock');
		$this->db->join('tbl_item', 'tbl_item.item_id = tbl_stock.item_id_fk');
		$this->db->join('tbl_branch', 'tbl_branch.branch_id = tbl_stock.branch_id_fk');
		$this->db->order_by('stock_id', 'DESC');
		$query = $this->db->get();
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getStockTotalCount($param);
        $data['recordsFiltered'] = $this->getStockTotalCount($param);
        return $data;

	}
	public function getStockTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('tbl_stock.item_name', $searchValue); 
        }
		$this->db->select('*');
		$this->db->from('tbl_stock');
		$this->db->join('tbl_item', 'tbl_item.item_id = tbl_stock.item_id_fk');
		$this->db->join('tbl_branch', 'tbl_branch.branch_id = tbl_stock.branch_id_fk');
		$this->db->order_by('stock_id', 'DESC');
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
}
?>