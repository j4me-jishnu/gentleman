<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Apurchase_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}
	public function getPurchaseTable($param){
		$arOrder = array('','item_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		$br = $this->userbranch();
		$branch = $br[0]->user_branch;
		if($searchValue){
			$this->db->like('item_name', $searchValue);
		}
		$this->db->where("pr_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
			$this->db->limit($param['length'],$param['start']);
		}
		$this->db->select('*,count(pr_id) as purchase_count,DATE_FORMAT(item_date,\'%d-%m-%Y\') as item_date');
		$this->db->from('tbl_apurchase');
		// $this->db->join('tbl_purchase_approval', 'tbl_apurchase.pr_id = tbl_purchase_approval.pr_id_fk');
		$this->db->join('tbl_item', 'tbl_item.item_id = tbl_apurchase.item_id_fk');
		$this->db->group_by('ref_number');
		$this->db->order_by('pr_id', 'DESC');
		$query = $this->db->get();
		$data['data'] = $query->result();
		$data['recordsTotal'] = $this->getPurchaseTotalCount($param,$branch);
		$data['recordsFiltered'] = $this->getPurchaseTotalCount($param,$branch);
		return $data;
	}

	public function getPurchaseTotalCount($param = NULL,$branch){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		if($searchValue){
			$this->db->like('item_name', $searchValue);
		}
		$this->db->select('*,count(pr_id) as purchase_count,DATE_FORMAT(item_date,\'%d-%m-%Y\') as item_date');
		$this->db->from('tbl_apurchase');
		$this->db->where("pr_status",1);
		$this->db->join('tbl_item', 'tbl_item.item_id = tbl_apurchase.item_id_fk');
		$this->db->group_by('ref_number');
		$this->db->order_by('pr_id', 'DESC');
		$this->db->where('branch_id_fk',$branch);
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function getPurchaseTable_head($param){
		$arOrder = array('','item_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		if($searchValue){
			$this->db->like('item_name', $searchValue);
		}
		$this->db->where("pr_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
			$this->db->limit($param['length'],$param['start']);
		}
		$this->db->select('*,count(pr_id) as purchase_count,DATE_FORMAT(item_date,\'%d-%m-%Y\') as item_date,tbl_vendor.vendorname,tbl_vendor.vendor_id');
		$this->db->from('tbl_apurchase');
		$this->db->join('tbl_item', 'tbl_item.item_id = tbl_apurchase.item_id_fk');
		$this->db->join('tbl_vendor', 'tbl_vendor.vendor_id = tbl_apurchase.vendor_id_fk');
		//$this->db->join('tbl_purchase_approval', 'tbl_purchase_approval.pr_id_fk = tbl_apurchase.pr_id');
		$this->db->group_by('ref_number');
		$this->db->order_by('pr_id', 'DESC');
		$query = $this->db->get();
		$data['data'] = $query->result();
		$data['recordsTotal'] = $this->getPurchase_headTotalCount($param);
		$data['recordsFiltered'] = $this->getPurchase_headTotalCount($param);
		return $data;

	}

	public function getPurchase_headTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		if($searchValue){
			$this->db->like('item_name', $searchValue);
		}
		$this->db->select('*,count(pr_id) as purchase_count,DATE_FORMAT(item_date,\'%d-%m-%Y\') as item_date');
		$this->db->from('tbl_apurchase');
		$this->db->where("pr_status",1);
		$this->db->join('tbl_item', 'tbl_item.item_id = tbl_apurchase.item_id_fk');
		$this->db->group_by('ref_number');
		$this->db->order_by('pr_id', 'DESC');
		$query = $this->db->get();
		return $query->num_rows();
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
	public function userbranch(){

		$u = $this->session->userdata('id');
		$this->db->select('*');
		$this->db->from('tbl_user');
		// $this->db->join('tbl_branch', 'tbl_branch.branch_id = tbl_user.user_branch');
		$this->db->where('login_id_fk',$u);
		$query = $this->db->get();
		return $query->result();
	}
	public function is_head($branch_id){

		$this->db->select('*');
		$this->db->from('tbl_branch');
		$this->db->where('branch_status',1);
		$this->db->where('is_active',1);
		$this->db->where('is_head',$branch_id);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_narration($refno)
	{
		$this->db->select('*');
		$this->db->from('tbl_narration-reject');
		$this->db->where('ref_no',$refno);
		$query = $this->db->get();
		return $query->row();
	}
	public function get_items($refno)
	{
		$this->db->select('*');
		$this->db->from('tbl_apurchase');
		$this->db->where('ref_number',$refno);
		$query = $this->db->get();
		return $query->result();
	}
	public function viewInvoice($ref_number)
	{
		$this->db->select('tbl_apurchase.pr_id,tbl_apurchase.invoice_no,tbl_apurchase.item_id_fk,tbl_apurchase.ref_number,tbl_apurchase.taxamount,tbl_apurchase.item_quantity,tbl_apurchase.vendor_id_fk,tbl_apurchase.item_name,tbl_apurchase.item_price,tbl_apurchase.item_date,tbl_apurchase.item_total,tbl_apurchase.grand_total,tbl_vendor.vendor_id,tbl_vendor.vendorname,tbl_vendor.vendorgst,tbl_item.item_id,tbl_category.category_name');
		$this->db->from('tbl_apurchase');
		//$this->db->join('tbl_branch', 'tbl_branch.branch_id = tbl_purchase.branch_id_fk');
		//$this->db->join('tbl_user', 'tbl_user.user_branch = tbl_branch.branch_id');
		$this->db->join('tbl_item', 'tbl_item.item_id = tbl_apurchase.item_id_fk');
		$this->db->join('tbl_vendor', 'tbl_vendor.vendor_id = tbl_apurchase.vendor_id_fk');
		$this->db->join('tbl_category', 'tbl_category.category_id = tbl_item.category_id_fk');
		$this->db->where('pr_status',1);
		$this->db->where('ref_number',$ref_number);
		$query = $this->db->get();
		return $query->result();
	}
	public function viewBranch($br)
	{
		$this->db->select('*');
		$this->db->from('tbl_branch');
		$this->db->join('tbl_user', 'tbl_user.user_branch = tbl_branch.branch_id');
		$this->db->where('branch_status',1);
		$this->db->where('branch_id',01);
		$this->db->where('tbl_user.user_designation',3);
		$query = $this->db->get();
		return $query->result();
	}
	public function getProducts($refno)
	{
		$this->db->select('*');
		$this->db->from('tbl_apurchase');
		$this->db->where('ref_number',$refno);
		$query = $this->db->get();
		return $query->result();
	}
	public function update($table,$data,$primaryfield,$id,$secondaryfield,$idd)
	{
		$this->db->where($primaryfield, $id);
		$this->db->where($secondaryfield,$idd);
		$q = $this->db->update($table, $data);
		return $q;
	}
	public function getItemid($edit_ref)
	{
		$this->db->select('item_id_fk,grand_total,');
		$this->db->from('tbl_apurchase');
		$this->db->where('ref_number',$edit_ref);
		$query = $this->db->get();
		return $query->result();
	}
	public function getPrid($itemid,$edit_ref)
	{
		$this->db->select('pr_id');
		$this->db->from('tbl_apurchase');
		$this->db->where('item_id_fk',$itemid);
		$this->db->where('ref_number',$edit_ref);
		$query = $this->db->get();
		return $query->result();
	}

	public function getAgmmail()
	{
		$this->db->select('user_email');
		$this->db->from('tbl_login');
		$this->db->where('designation',1);
		$query = $this->db->get();
		return $query->result();
	}

	public function getCommail()
	{
		$this->db->select('user_email');
		$this->db->from('tbl_login');
		$this->db->where('designation',2);
		$query = $this->db->get();
		return $query->result();
	}

	public function getFmmail()
	{
		$this->db->select('user_email');
		$this->db->from('tbl_login');
		$this->db->where('designation',4);
		$query = $this->db->get();
		return $query->result();
	}
	public function getItem($id,$edit_ref)
	{
		$this->db->select('*');
		$this->db->from('tbl_apurchase');
		$this->db->where('item_id_fk',$id);
		$this->db->where('ref_number',$edit_ref);
		$query = $this->db->get();
		return $query->result();
	}
	public function getItem_grand($edit_ref)
	{
		$this->db->select('*');
		$this->db->from('tbl_purchase');
		$this->db->where('item_id_fk',$id);
		$this->db->where('ref_number',$edit_ref);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_gst($vendor_id)
	{
		$this->db->select('vendorgst');
		$this->db->from('tbl_vendor');
		$this->db->where('vendor_id',$vendor_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function updateRequest($data,$ref)
	{
		$this->db->where('ref_number', $ref);
		$q = $this->db->update('tbl_apurchase', $data);
		return $q;
	}

	public function getNextAproval($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_purchase_approval');
		$this->db->where('su_id_fk',$id);
		$query = $this->db->get();
		return $query->result();
	}
	public function getStatus()
	{
		$this->db->select('pr_id_fk,min(is_approved) as approved,max(reject) as reject,tbl_designation.designation as des_name');
		$this->db->from('tbl_purchase_approval');
		$this->db->join('tbl_designation','tbl_designation.desig_id = tbl_purchase_approval.designation','left');
		$this->db->group_by('pr_id_fk');
		$query = $this->db->get();
		return $query->result();
	}

	public function updateApprovel($pr_id,$id)
	{
		$data = array('is_approved' =>1);
		$this->db->where('pr_id_fk', $pr_id);
		$this->db->where('su_id_fk', $id);
		$q = $this->db->update('tbl_purchase_approval', $data);
		return $q;

	}

	public function updateReject($prid,$id,$reason)
	{
		$data = array('reject' =>1,'reject_reason'=>$reason,'updated_date'=>date('Y-m-d'));
		$this->db->where('pr_id_fk', $prid);
		$this->db->where('su_id_fk', $id);
		$q = $this->db->update('tbl_purchase_approval', $data);
		return $q;

	}

	public function updateDelivery($prid)
	{
		$data = array('delivery' =>0,'finaldelivery' =>0);
		$this->db->where('pr_id', $prid);
		$q = $this->db->update('tbl_apurchase', $data);
		return $q;

	}

	function get_who($pr){

		$this->db->select('username');
		$this->db->from('tbl_purchase_approval');
		$this->db->join('tbl_user','tbl_purchase_approval.su_id_fk=tbl_user.user_id');
		$this->db->where('tbl_purchase_approval.pr_id_fk',$pr);
		$query = $this->db->get();

		return $query->result();


	}

	function get_operator($pr_id){


		/*$this->db->select('user_name');
		$this->db->from('tbl_login');
		$this->db->where('id',$pr_id);
		$query = $this->db->get();
		return $query->result();*/

		$this->db->select('user_name,reject_reason,updated_date');
		$this->db->from('tbl_login');
		$this->db->join('tbl_purchase_approval',' tbl_purchase_approval.su_id_fk=tbl_login.id');
		$this->db->where('tbl_purchase_approval.pr_id_fk',$pr_id);
		$query = $this->db->get();

		return $query->result();

	}

	function get_price($item_id,$quantity){
		$this->db->select('*');
		$this->db->from('tbl_itemprice');
		$this->db->where('quantity',$quantity);
		$this->db->where('item_id_fk',$item_id);
		$query = $this->db->get();
		$result=$query->result();
		if($result){
			return $result;
		}
		else{
			return false;
		}

	}

	function getgst($vendor_id){

		return $this->db->select('*')->from('tbl_vendor')->where('vendor_id',$vendor_id)->get()->result();


	}

	function get_purchase($pr_id){
		$this->db->select('*');
		$this->db->from('tbl_apurchase');
		$this->db->where('pr_id',$pr_id);
		$query = $this->db->get();
		return $query->result();
	}

	function get_purchasedetails($pr_id){

		return $this->db->select('*')->from('tbl_apurchase')->where('pr_id',$pr_id)->get()->result();

	}

	public function get_item_list(){
		$query=$this->db->select('*')
		->join('tbl_stock','tbl_item.item_id=tbl_stock.item_id_fk')
		->get('tbl_item');
		$result=$query->result();
		return $result;
	}

	public function getItemName($id){
		$query=$this->db->select('item_name')->where('item_id',$id)->get('tbl_item');
		$result=$query->result();
		return $result;
	}

	public function getItemNameNew($id){
		$query=$this->db->select('item_name')->where('item_id',$id)->get('tbl_item');
		$result=$query->result();
		return $result[0]->item_name;
	}

	public function get_vendor_list(){
		$query=$this->db->select('vendor_id,vendorname')->where('vendorstatus',1)->get('tbl_vendor');
		$result=$query->result();
		return $result;
	}

	public function get_all_item_list(){
		$query=$this->db->select('item_id,item_name')->where('item_status',1)->get('tbl_item');
		$result=$query->result();
		return $result;
	}

	public function add_purchase($insert_array){
		$query=$this->db->insert('tbl_apurchase',$insert_array);
    return $query ? true : false;
	}


}
?>
