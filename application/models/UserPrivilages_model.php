<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class UserPrivilages_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
		public function getUserDetails($param){
			$arOrder = array('','user_name');
			$searchValue =($param['searchValue'])?$param['searchValue']:'';
			if($searchValue){
				$this->db->like('user_name', $searchValue);
			}
			// $this->db->where("emp_status",1);
			if ($param['start'] != 'false' and $param['length'] != 'false') {
				$this->db->limit($param['length'],$param['start']);
			}
			$this->db->select('*');
			$this->db->from('tbl_login');
			$this->db->where('user_name !=','Admin');
			$this->db->order_by('user_name', 'ASC');
			$query = $this->db->get();
			$data['data'] = $query->result();
			$data['recordsTotal'] = $this->getBranchTotalCount($param);
			$data['recordsFiltered'] = $this->getBranchTotalCount($param);
			return $data;

		}

	public function getBranchTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('user_name', $searchValue);
        }
				$this->db->select('*');
				$this->db->from('tbl_login');
				$this->db->order_by('id', 'DESC');
				$query = $this->db->get();
				return $query->num_rows();
  }

	public function updateUserPrivilage($user_id,$user_type){
		$data=array('user_type' => $user_type);
		$this->db->set($data);
		$this->db->where('id', $user_id);
		$result = $this->db->update('tbl_login');
		if($result){
			return true;
		}
		else{
			return false;
		}
	}

}
?>
