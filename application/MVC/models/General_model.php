<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class General_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
	
    // Return all records in the table
    public function get_all($table)
    {
        $q = $this->db->get($table);
        if($q->num_rows() > 0)
        {
            return $q->result();
        }
        return array();
    }
	
	// Return all records from the table based on id
    public function getall($table,$id)
    {
		$this->db->where($id);
        $q = $this->db->get($table);
        if($q->num_rows() > 0)
        {
            return $q->result();
        }
        return array();
    }
 
    // Return only one row
    public function get_row($table,$primaryfield,$id)
    {
        $this->db->where($primaryfield,$id);
        $q = $this->db->get($table);
        if($q->num_rows() > 0)
        {
            return $q->row();
        }
        return false;
    }
	
 
    // Return one only field value
    public function get_data($table,$primaryfield,$fieldname,$id)
    {
        $this->db->select($fieldname);
        $this->db->where($primaryfield,$id);
        $q = $this->db->get($table);
        if($q->num_rows() > 0)
        {
            return $q->result();
        }
        return array();
    }
 
    // Insert into table
    public function add($table,$data)
    {
        return $this->db->insert($table, $data);
    }
    
    // Insert into table and return last insert id
    public function add_returnID($table,$data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
        
    }
    // Update data to table
    public function update($table,$data,$primaryfield,$id)
    {
        $this->db->where($primaryfield, $id);
        $q = $this->db->update($table, $data);
        return $q;
    }
 
    // Delete record from table
    public function delete($table,$primaryfield,$id)
    {
    	$this->db->where($primaryfield,$id);
    	$this->db->delete($table);
    }
 
    // Check whether a value has duplicates in the database
    public function has_duplicate($value, $tabletocheck, $fieldtocheck)
    {
        $this->db->select($fieldtocheck);
        $this->db->where($fieldtocheck,$value);
        $result = $this->db->get($tabletocheck);
 
        if($result->num_rows() > 0) {
            return true;
        }
        else {
            return false;
        }
    }
 
    // Check whether the field has any reference from other table
    // Normally to check before delete a value that is a foreign key in another table
    public function has_child($value, $tabletocheck, $fieldtocheck)
    {
        $this->db->select($fieldtocheck);
        $this->db->where($fieldtocheck,$value);
        $result = $this->db->get($tabletocheck);
 
        if($result->num_rows() > 0) {
            return true;
        }
        else {
            return false;
        }
    }
 
    // Return an array to use as reference or dropdown selection
    public function get_ref($table,$key,$value,$dropdown=false)
    {
        $this->db->from($table);
        $this->db->order_by($value);
        $result = $this->db->get();
 
        $array = array();
        if ($dropdown)
            $array = array("" => "Please Select");
 
        if($result->num_rows() > 0) {
            foreach($result->result_array() as $row) {
            $array[$row[$key]] = $row[$value];
            }
        }
        return $array;
    }
    public function admin_data($user_id){
        $this->db->select('*');
         $this->db->from('admin_login');
         $this->db->where('id',$user_id);
         $query = $this->db->get();
         return $query->row();
    }
    public function getAdminData($id){
        $this->db->select('*');
        $this->db->from('admin_login');
        $this->db->where("id",$id);
        $query = $this->db->get();
        return $query->row();
	
    }

}
?>