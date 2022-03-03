<?php
class Loginmodel extends CI_Model{
    public function checkUserLogin($data){
        $this->db->where($data);
        $query = $this->db->get('admin_login');
        if($query->num_rows() == 1){
            $this->session->set_userdata($query->row_array());
            return true;
        }
        else{
            return false;
        }
    }
}
?>
