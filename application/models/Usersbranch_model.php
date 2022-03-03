<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usersbranch_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }

    public function get($branch){

        $query = $this->db->select('*')->from('tbl_user')->join('tbl_branch','tbl_user.user_branch=tbl_branch.branch_id')->where('user_branch',$branch)->get();
       
        return $query->result();
    }
    function get_branch($id){

       return $this->db->select('user_branch')->from('tbl_user')->where('tbl_user.login_id_fk',$id)->get()->result();
    
    }
    public function getuserData($id,$user)
    {
        $this->db->select('*')->where('user_id',$user);
        return $this->db->get('tbl_user')->result();
    }
	
}
?>