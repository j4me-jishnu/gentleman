<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Change_password_model extends CI_Model{

public function __construct()
{
parent::__construct();
}
public function getChangepassReport($param){
$arOrder = array('','email');
$email =(isset($param['email']))?$param['email']:'';

if($emailv){
$this->db->like('email', $email); 
}
if ($param['start'] != 'false' and $param['length'] != 'false') {
$this->db->limit($param['length'],$param['start']);
}
$this->db->select('*');
$this->db->from('tbl_login');
//$this->db->join('tbl_category','category_id = category_id_fk');
$this->db->order_by('id', 'DESC');
$query = $this->db->get();
$data['data'] = $query->result();
$data['recordsTotal'] = $this->getChangepassReportTotalCount($param);
$data['recordsFiltered'] = $this->getChangepassReportTotalCount($param);
return $data;
}
public function getChangepassReportTotalCount($param){
$email =(isset($param['email']))?$param['email']:'';
if($email){
	$this->db->like('email', $email); 
}
		$this->db->where("status",1);
		$this->db->select('*');
		$this->db->from('tbl_login');
		//$this->db->join('tbl_category','category_id = category_id_fk');
		$this->db->order_by('id', 'DESC');
        $query = $this->db->get();
		return $query->num_rows();
	}
	function getId($uname,$password)
	{
		$this->db->select('*');
		$this->db->from('tbl_login');
		$this->db->where('user_name',$uname);
		$this->db->where('user_password',$password);
		$query = $this->db->get();
		return $query->result();
	}


	
	public function view_by()
	{
		$this->db->select('*');
		$this->db->from('tbl_login');
		$this->db->where('status', 1);
		$query = $this->db->get();
		
		$emails = array();
		if ($query -> result()) {
		foreach ($query->result() as $email) {
		$emails[$email-> id] = $email -> email;
			}
		return $emails;
		} else {
		return FALSE;
		}
	}

	public function getMail($id)
	{
		$this->db->select('user_email');
		$this->db->from('tbl_login');
		$this->db->where('id',$id);		
		$query = $this->db->get();
		return $query->result();
	}
}
?>