<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class UserwiseCR_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
    public function get_desig($user_id)
	{
		$this->db->select('*');
        $this->db->from('tbl_user');
		$this->db->join('tbl_designation', 'tbl_designation.desig_id = tbl_user.user_designation');
        $this->db->join('tbl_branch', 'tbl_branch.branch_id = tbl_user.user_branch');
		$this->db->where('tbl_user.user_id',$user_id);
        $query = $this->db->get();
    	return $query->row();
	}
	public function getuserCrTable($param){
		$arOrder = array('','user_id','start_date','end_date');
		$user_id =(isset($param['user_id']))?$param['user_id']:'';
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
		$end_date =(isset($param['end_date']))?$param['end_date']:'';
        if($user_id){
            $this->db->where('user_id_fk', $user_id); 
        }
		if($start_date){
            $this->db->where('issue_date >=', $start_date);
        }
        if($end_date){
            $this->db->where('issue_date <=', $end_date); 
        }
        $this->db->where("issue_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_issueitem');
		$this->db->join('tbl_item', 'tbl_item.item_id = tbl_issueitem.item_id_fk');
		$this->db->order_by('issue_id', 'DESC');
        $query = $this->db->get();
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getuserCrTotalCount($param);
        $data['recordsFiltered'] = $this->getuserCrTotalCount($param);
        return $data;

	}
	public function getuserCrTotalCount($param = NULL){
		
		$user_id =(isset($param['user_id']))?$param['user_id']:'';
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
		$end_date =(isset($param['end_date']))?$param['end_date']:'';
        if($user_id){
            $this->db->where('user_id_fk', $user_id); 
        }
		if($start_date){
            $this->db->where('issue_date >=', $start_date);
        }
        if($end_date){
            $this->db->where('issue_date <=', $end_date); 
        }
		$this->db->select('*');
		$this->db->from('tbl_issueitem');
		$this->db->join('tbl_item', 'tbl_item.item_id = tbl_issueitem.item_id_fk');
		$this->db->where("issue_status",1);
		$this->db->order_by('issue_id', 'DESC');
        $query = $this->db->get();
    	return $query->num_rows();
    }
	public function getuserCrusageTable($param){
		$arOrder = array('','user_id','start_date','end_date');
		$user_id =(isset($param['user_id']))?$param['user_id']:'';
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
		$end_date =(isset($param['end_date']))?$param['end_date']:'';
        if($user_id){
            $this->db->where('user_id_fk', $user_id); 
        }
		if($start_date){
            $this->db->where('usage_date >=', $start_date);
        }
        if($end_date){
            $this->db->where('usage_date <=', $end_date); 
        }
        $this->db->where("usage_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_usageitem');
		$this->db->join('tbl_item', 'tbl_item.item_id = tbl_usageitem.item_id_fk');
		$this->db->order_by('usage_id', 'DESC');
        $query = $this->db->get();
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getuserCrUTotalCount($param);
        $data['recordsFiltered'] = $this->getuserCrUTotalCount($param);
        return $data;

	}
	public function getuserCrUTotalCount($param = NULL){
		
		$user_id =(isset($param['user_id']))?$param['user_id']:'';
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
		$end_date =(isset($param['end_date']))?$param['end_date']:'';
        if($user_id){
            $this->db->where('user_id_fk', $user_id); 
        }
		if($start_date){
            $this->db->where('usage_date >=', $start_date);
        }
        if($end_date){
            $this->db->where('usage_date <=', $end_date); 
        }
		$this->db->select('*');
		$this->db->from('tbl_usageitem');
		$this->db->join('tbl_item', 'tbl_item.item_id = tbl_usageitem.item_id_fk');
		$this->db->where("usage_status",1);
		$this->db->order_by('usage_id', 'DESC');
        $query = $this->db->get();
    	return $query->num_rows();
    }
	public function getuserCrReturnTable($param){
		$arOrder = array('','user_id','start_date','end_date');
		$user_id =(isset($param['user_id']))?$param['user_id']:'';
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
		$end_date =(isset($param['end_date']))?$param['end_date']:'';
        if($user_id){
            $this->db->where('user_id_fk', $user_id); 
        }
		if($start_date){
            $this->db->where('return_date >=', $start_date);
        }
        if($end_date){
            $this->db->where('return_date <=', $end_date); 
        }
        $this->db->where("return_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_return');
		$this->db->join('tbl_item', 'tbl_item.item_id = tbl_return.item_id_fk');
		$this->db->order_by('return_id', 'DESC');
        $query = $this->db->get();
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getuserCrReturnTotalCount($param);
        $data['recordsFiltered'] = $this->getuserCrReturnTotalCount($param);
        return $data;

	}
	public function getuserCrReturnTotalCount($param = NULL){
		
		$user_id =(isset($param['user_id']))?$param['user_id']:'';
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
		$end_date =(isset($param['end_date']))?$param['end_date']:'';
        if($user_id){
            $this->db->where('user_id_fk', $user_id); 
        }
		if($start_date){
            $this->db->where('return_date >=', $start_date);
        }
        if($end_date){
            $this->db->where('return_date <=', $end_date); 
        }
		$this->db->select('*');
		$this->db->from('tbl_return');
		$this->db->join('tbl_item', 'tbl_item.item_id = tbl_return.item_id_fk');
		$this->db->where("return_status",1);
		$this->db->order_by('return_id', 'DESC');
        $query = $this->db->get();
    	return $query->num_rows();
    }
}
?>