<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
    public function getUsersTable($param){
		$arOrder = array('','user_name','user_name','designation');
		$user_name =(isset($param['user_name']))?$param['user_name']:'';
		$designation =(isset($param['designation']))?$param['designation']:'';
		$branch =(isset($param['branch_name']))?$param['branch_name']:'';
        if($user_name){
            $this->db->like('username', $user_name); 
        }
		if($designation){
            $this->db->where('user_designation', $designation); 
        }
		if($branch!=''){
            $this->db->where('tbl_user.user_branch', $branch); 
        }
		$this->db->where("user_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->join('tbl_login', 'tbl_login.id = tbl_user.login_id_fk');
		$this->db->join('tbl_branch', 'tbl_user.user_branch = tbl_branch.branch_id');
		$this->db->order_by('user_id', 'DESC');
        $query = $this->db->get();
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getUsersTotalCount($param);
        $data['recordsFiltered'] = $this->getUsersTotalCount($param);
        return $data;

	}

	public function getUsersTotalCount($param = NULL){
		
		$user_name =(isset($param['user_name']))?$param['user_name']:'';
        $designation =(isset($param['designation']))?$param['designation']:'';
		$branch_name =(isset($param['branch_name']))?$param['branch_name']:'';
        if($user_name){
            $this->db->like('username', $user_name); 
        }
		if($designation){
            $this->db->where('user_designation', $designation); 
        }
        if($branch_name!=''){
            $this->db->where('tbl_user.user_branch', $branch_name); 
        }
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->join('tbl_login', 'tbl_login.id = tbl_user.login_id_fk');
		$this->db->order_by('user_id', 'DESC');
        $this->db->where("user_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
	public function get_designation()
	{
		$this->db->select('*');
		$this->db->from('tbl_designation');
		$this->db->where('desig_status',1);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_branch()
	{
		$this->db->select('*');
		$this->db->from('tbl_branch');
		$this->db->where('branch_status',1);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_items()
	{
		$this->db->select('*');
		$this->db->from('tbl_item');
		$this->db->where('item_status',1);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_row($user_id)
	{
		$this->db->select('*,tbl_user.is_active AS active');
		$this->db->from('tbl_user');
		$this->db->join('tbl_login', 'tbl_login.id = tbl_user.login_id_fk');
		$this->db->join('tbl_branch','tbl_user.user_branch = tbl_branch.branch_id');
		$this->db->where('user_id',$user_id);
        $query = $this->db->get();
    	if($query->num_rows() > 0)
        {
		//    print_r($query->row());
		//    exit();
			return $query->row();
			
		}
		
        return false;
	}
	public function user_branch($br)
	{
		$this->db->select('*');
		$this->db->from('tbl_branch');
		$this->db->where('branch_id',$br);
        $query = $this->db->get();
    	if($query->num_rows() > 0)
        {
            return $query->row();
        }
        return false;
	}
	public function get_userid()
	{
		$this->db->select('ur_id');
		$this->db->from('tbl_user');
		$this->db->order_by('user_id','DESC');
		$this->db->limit(1);
        $query = $this->db->get();
    	return $query->row();
	}

	public function getLogid($id)
	{
		$this->db->select('login_id_fk');
		$this->db->from('tbl_user');
		$this->db->where('user_id',$id);
        $query = $this->db->get();
    	return $query->row();
	}
	public function setPrivilage($option,$uid)
	{
		$privilage = array('user_type' =>$option);
		$this->db->where('id', $uid);
        $q = $this->db->update('tbl_login', $privilage);
        return $q;

	}


	public function get_user_type($uid){

	   $this->db->select('user_type');
	   $this->db->from('tbl_login');
	   $this->db->where('id',$uid);

	   $query = $this->db->get();

	   return $query->result();

	}

	public function get_history($id){

	  $this->db->select('user_history.date,user_history.user_type,user_history.operation,user.user_name as user,operator.user_name AS operator');
	  $this->db->from('user_history');
	  $this->db->join('tbl_login AS user','user.id=user_history.user_id');
	  $this->db->join('tbl_login AS operator','operator.id=user_history.login_id');
	  $this->db->order_by('user_history.date');
	  $this->db->where('user_history.user_id',$id);

	  $query = $this->db->get();
	  return $query->result();

	}

	public function get_loginid($id){

	   $this->db->select('login_id_fk');
	   $this->db->from('tbl_user');
	   $this->db->where('user_id',$id);

	   $query = $this->db->get();

	   return $query->result();

	}

	public function get_u()
	{
	   $this->db->select('*');
	   $this->db->from('tbl_user');
	   $query = $this->db->get();
	   return $query->result();	
	}
	
}
?>