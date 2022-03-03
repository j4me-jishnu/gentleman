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

public function getitemname($rop_id)
{
$this->db->select('item_name,item_id_fk');
$this->db->from('tbl_item');
$this->db->join('tbl_master_rop','tbl_master_rop.item_id_fk = tbl_item.item_id');
$this->db->where('tbl_master_rop.rop_id',$rop_id);
$query = $this->db->get();
return $query->result();
}

public function getitems($rop_id)
{
$this->db->select('item_name,item_id');
$this->db->from('tbl_item');
$this->db->join('tbl_rop','tbl_rop.item_id_fk = tbl_item.item_id');
$this->db->where('tbl_rop.rop_id',$rop_id);
$query = $this->db->get();
return $query->result();
}
public function get_items($id)
{
$this->db->select('item_name,item_id_fk');
$this->db->from('tbl_item');
$this->db->join('tbl_branch_to_branch','tbl_branch_to_branch.item_id_fk = tbl_item.item_id');
$this->db->where('tbl_branch_to_branch.id',$id);
$query = $this->db->get();
return $query->result();
}

public function get_branches($id)
{
$this->db->select('branch_name,branch_id');
$this->db->from('tbl_branch');
$this->db->join('tbl_branch_to_branch','tbl_branch_to_branch.from_branch_id_fk= tbl_branch.branch_id');
$this->db->where('tbl_branch_to_branch.id',$id);
$query = $this->db->get();
return $query->result();
}

public function get_branch($rop_id)
{
$this->db->select('branch_name,branch_id');
$this->db->from('tbl_branch');
$this->db->join('tbl_rop','tbl_rop.branch_id_fk= tbl_branch.branch_id');
$this->db->where('tbl_rop.rop_id',$rop_id);
$query = $this->db->get();

// print_r($this->db->last_query());
// exit();
return $query->result();
}




public function get_branchmaster($id)
{
$this->db->select('branch_name,branch_id');
$this->db->from('tbl_branch');
$this->db->join('master_benchmark','master_benchmark.branch_id_fk= tbl_branch.branch_id');
$this->db->where('master_benchmark.id',$id);
$query = $this->db->get();

// print_r($this->db->last_query());
// exit();
return $query->result();
}
public function get_branchissue($issue_id)
{
$this->db->select('branch_name,branch_id');
$this->db->from('tbl_branch');
$this->db->join('tbl_issueitem','tbl_issueitem.branch_id_fk= tbl_branch.branch_id');
$this->db->where('tbl_issueitem.issue_id',$issue_id);
$query = $this->db->get();

// print_r($this->db->last_query());
// exit();
return $query->result();
}





/*public function get_branchissue($issue_id)
{
$this->db->select('branch_name,branch_id');
$this->db->from('tbl_branch');
$this->db->join('tbl_issueitem','tbl_issueitem.branch_id_fk= tbl_branch.branch_id');
$this->db->where('tbl_issueitem.issue_id',$issue_id);
$query = $this->db->get();

// print_r($this->db->last_query());
// exit();
return $query->result();
}*/


public function getitemmaster($id)
{
$this->db->select('item_name,item_id_fk');
$this->db->from('tbl_item');
$this->db->join('master_benchmark','master_benchmark.item_id_fk = tbl_item.item_id');
//$this->db->join('master_benchmark_report','master_benchmark_report.item_id_fk = tbl_item.item_id');
$this->db->where('master_benchmark.id',$id);
$query = $this->db->get();
return $query->result();
}


public function get_item()
	{
		$this->db->select('*');
		$this->db->from('tbl_item');
		$this->db->where('item_status', 1);
        $query = $this->db->get();
		return $query->result();

	}

    public function get_br()
	{
		$this->db->select('*');
		$this->db->from('tbl_branch');
		$this->db->where('branch_status', 1);
        $query = $this->db->get();
		return $query->result();

    }

    /***************/public function getapprovedadmins()
    {
        $this->db->select('id,designation,tbl_user.login_id_fk,tbl_user.user_status');
        $this->db->from('tbl_login');
        $this->db->join('tbl_user','tbl_user.login_id_fk = tbl_login.id');
        $this->db->join('tbl_purchase_approval','tbl_purchase_approval.su_id_fk = tbl_login.id');
        $this->db->where('user_type','Su');
        $this->db->where('user_status','1');
        $query = $this->db->get();
        return $query->result();
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
return true;
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

    public function getMail()
    {
        $this->db->select('email');
        $this->db->from('tbl_email');
        $query = $this->db->get();
        return $query->result();
    }

    public function getSuMail($id)
    {
        $this->db->select('user_email');
        $this->db->from('tbl_login');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->result();
    }


    public function getI($id)
    {
        $this->db->select('item_name');
        $this->db->from('tbl_item');
        $this->db->where('item_id',$id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getB($id)
    {
        $this->db->select('branch_name');
        $this->db->from('tbl_branch');
        $this->db->where('branch_id',$id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getSuperUsers()
    {
        $this->db->select('id,designation,tbl_user.login_id_fk,tbl_user.user_status');
        $this->db->from('tbl_login');
        $this->db->join('tbl_user','tbl_user.login_id_fk = tbl_login.id');
        $this->db->where('user_type','Su');
        $this->db->where('user_status','1');
        $query = $this->db->get();
        return $query->result();
    }

    public function add_operation($operation){
        $des = $this->session->userdata('designation');
        $user = $this->session->userdata('user_name');

        $operation['designation'] = $des;
        $operation['user_name'] = $user;

        $this->db->insert('operation_status',$operation);


    }

    public function getIsactive($login_id_fk)
    {
        $this->db->select('is_active');
        $this->db->from('tbl_user');
        $this->db->where('login_id_fk',$login_id_fk);
        $query = $this->db->get();
        return $query->row();
    }

    public function getBenchPeriod()
    {

        $sql = "SELECT initial_date,final_date FROM benchmark_period";
        $query = $this->db->query($sql);
        $data= $query->result();
        return $data;
    }

    public function getBranchBenchmark($user_id,$item_id)
    {

        $sql = "SELECT IFNULL( (SELECT benchmark FROM issue_benchmark WHERE user_id_fk =$user_id  and item_id_fk = $item_id) ,0) as bench,IFNULL( (SELECT initial_date FROM issue_benchmark WHERE user_id_fk = $user_id and item_id_fk = $item_id) ,0) as idate,IFNULL( (SELECT final_date FROM issue_benchmark WHERE user_id_fk = $user_id and item_id_fk = $item_id) ,0) as fdate

";
        $query = $this->db->query($sql);
        $data= $query->result();
        return $data;
    }

    public function getMasterBenchmark($branch_id,$item_id)
    {

        $sql = "SELECT IFNULL( (SELECT benchmark FROM master_benchmark WHERE branch_id_fk =$branch_id  and item_id_fk = $item_id) ,0) as bench,IFNULL( (SELECT initial_date FROM master_benchmark WHERE branch_id_fk = $branch_id and item_id_fk = $item_id) ,0) as idate,IFNULL( (SELECT final_date FROM master_benchmark WHERE branch_id_fk = $branch_id and item_id_fk = $item_id) ,0) as fdate";
        $query = $this->db->query($sql);
        $data= $query->result();
        return $data;
    }


    public function getTotalMoveStock($branch_id,$item_id,$idate,$fdate)
    {
        $sql = "SELECT COALESCE(sum(item_quantity),0) as sum FROM `tbl_branch_stock` WHERE item_id_fk = $item_id and shop_id_fk = $branch_id and updated_date BETWEEN '$idate' and '$fdate' and reject!=1";
        $query = $this->db->query($sql);
        $data= $query->result();
        return $data;
    }

     public function getTotalIssue($user_id,$item_id,$idate,$fdate)
    {
        $sql = "SELECT COALESCE(sum(issue_quantity),0) as sum FROM `tbl_issueitem` WHERE item_id_fk = $item_id and user_id_fk = $user_id and issue_date BETWEEN '$idate' and '$fdate' ";
        $query = $this->db->query($sql);
        $data= $query->result();
        return $data;
    }


}
?>
