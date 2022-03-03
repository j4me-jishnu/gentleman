<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Log_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
   
    public function get_designation($param){

    $arOrder = array('','user_name','action','log','designation');
    $user_name =(isset($param['user_name']))?$param['user_name']:'';
    $designation =(isset($param['designation']))?$param['designation']:'';
    $log =(isset($param['log']))?$param['log']:'';
    $action =(isset($param['action']))?$param['action']:'';
    $start_date =(isset($param['start_date']))?$param['start_date']:'';
    $end_date =(isset($param['end_date']))?$param['end_date']:'';
    if($user_name){
      $this->db->like('tbl_login.user_name', $user_name); 
    }
    if($designation){
      $this->db->where('operation_status.designation', $designation); 
        }
    if($action){
      $this->db->like('concat("Designation ",tbl_designation.designation)', $action); 
    }
    if($start_date){
      $this->db->where('operation_status.date >=', $start_date);
    }
    if($end_date){
      $this->db->where('operation_status.date <=', $end_date); 
    }
   
    if($log){
      $this->db->where('operation_status.operation_id',$log);
    }
    $this->db->select('operation_status.id,operation_status.operation,operation_status.date,tbl_login.user_name,concat("Designation ",tbl_designation.designation) AS name,tbl_login.user_type');
    $this->db->from('operation_status');
    $this->db->join('tbl_login','operation_status.user_id=tbl_login.id');
    $this->db->join('tbl_designation','operation_status.to_whom=tbl_designation.desig_id');
    $this->db->where('operation_status.operation_id',1);
    $query = $this->db->get();
    if ($param['start'] != 'false' and $param['length'] != 'false') {
      $this->db->limit($param['length'],$param['start']);
    }
    $data['data'] = $query->result();
    return $data;

    }

    public function get_vendor($param){
    $arOrder = array('','user_name','action','log','designation');
    $user_name =(isset($param['user_name']))?$param['user_name']:'';
    $designation =(isset($param['designation']))?$param['designation']:'';
    $log =(isset($param['log']))?$param['log']:'';
    $action =(isset($param['action']))?$param['action']:'';
    $start_date =(isset($param['start_date']))?$param['start_date']:'';
    $end_date =(isset($param['end_date']))?$param['end_date']:'';
    if($user_name){
      $this->db->like('tbl_login.user_name', $user_name); 
    }
    if($designation){
      $this->db->where('operation_status.designation', $designation); 
        }
    if($action){
      $this->db->like('concat("Vendor ",tbl_vendor.vendorname)', $action); 
    }
    if($start_date){
      $this->db->where('operation_status.date >=', $start_date);
    }
    if($end_date){
      $this->db->where('operation_status.date <=', $end_date); 
    }
    if ($param['start'] != 'false' and $param['length'] != 'false') {
      $this->db->limit($param['length'],$param['start']);
    }
    if($log){
      $this->db->where('operation_status.operation_id',$log);
    }

        $this->db->select('operation_status.id,operation_status.operation,operation_status.date,tbl_login.user_name,concat("Vendor ",tbl_vendor.vendorname) AS name,tbl_login.user_type');
        $this->db->from('operation_status');
        $this->db->join('tbl_login','operation_status.user_id=tbl_login.id');
        $this->db->join('tbl_vendor','operation_status.to_whom=tbl_vendor.vendor_id');
        $this->db->where('operation_status.operation_id',3);
        
  
        $query = $this->db->get();
        $data['data'] = $query->result();
        return $data;
  
      }
      

    public function get_user($param){

        $arOrder = array('','user_name','action','log','designation');
        $user_name =(isset($param['user_name']))?$param['user_name']:'';
        $designation =(isset($param['designation']))?$param['designation']:'';
        $log =(isset($param['log']))?$param['log']:'';
        $action =(isset($param['action']))?$param['action']:'';
        $start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
        if($user_name){
          $this->db->like('tbl_login.user_name', $user_name); 
        }
        if($designation){
          $this->db->where('operation_status.designation', $designation); 
            }
        if($action){
          $this->db->like('concat("user ",l.user_name)', $action); 
        }
        if($start_date){
          $this->db->where('operation_status.date >=', $start_date);
        }
        if($end_date){
          $this->db->where('operation_status.date <=', $end_date); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
          $this->db->limit($param['length'],$param['start']);
        }
        if($log){
          $this->db->where('operation_status.operation_id',$log);
        }
        $this->db->select('operation_status.id,operation_status.operation,operation_status.date,tbl_login.user_name,concat("user ",l.user_name) AS name,tbl_login.user_type');
        $this->db->from('operation_status');
        $this->db->join('tbl_login','operation_status.user_id=tbl_login.id');
        $this->db->join('tbl_login AS l','operation_status.to_whom=l.id');
        $this->db->where('operation_status.operation_id',2);
  
        $query = $this->db->get();
       $data['data'] = $query->result();
        return $data;
  
      }  


      public function get_branch($param){
        

        $arOrder = array('','user_name','action','log','designation');
        $user_name =(isset($param['user_name']))?$param['user_name']:'';
        $designation =(isset($param['designation']))?$param['designation']:'';
        $log =(isset($param['log']))?$param['log']:'';
        $action =(isset($param['action']))?$param['action']:'';
        $start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
        if($user_name){
          $this->db->like('tbl_login.user_name', $user_name); 
        }
        if($designation){
          $this->db->where('operation_status.designation', $designation); 
            }
        if($action){
          $this->db->like('concat("Branch ",tbl_branch.branch_name)', $action); 
        }
        if($start_date){
          $this->db->where('operation_status.date >=', $start_date);
        }
        if($end_date){
          $this->db->where('operation_status.date <=', $end_date); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
          $this->db->limit($param['length'],$param['start']);
        }
        if($log){
          $this->db->where('operation_status.operation_id',$log);
        }
        $this->db->select('operation_status.id,operation_status.operation,operation_status.date,tbl_login.user_name,concat("Branch ",tbl_branch.branch_name) AS name,tbl_login.user_type');
        $this->db->from('operation_status');
        $this->db->join('tbl_login','operation_status.user_id=tbl_login.id');
        $this->db->join('tbl_branch','operation_status.to_whom=tbl_branch.branch_id');
        $this->db->where('operation_status.operation_id',4);
       
        $query = $this->db->get();
       // print_r($this->db->last_query());
       // exit();
        $data['data'] = $query->result();
        return $data;
  
      }  

       public function get_stockmove($param){
        $arOrder = array('','user_name','action','log','designation');
        $user_name =(isset($param['user_name']))?$param['user_name']:'';
        $designation =(isset($param['designation']))?$param['designation']:'';
        $log =(isset($param['log']))?$param['log']:'';
        $action =(isset($param['action']))?$param['action']:'';
        $start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
        if($user_name){
          $this->db->like('tbl_login.user_name', $user_name); 
        }
        if($designation){
          $this->db->where('operation_status.designation', $designation); 
            }
        if($action){
          $this->db->like('concat("Branch ",tbl_branch.branch_name)', $action); 
        }
        if($start_date){
          $this->db->where('operation_status.date >=', $start_date);
        }
        if($end_date){
          $this->db->where('operation_status.date <=', $end_date); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
          $this->db->limit($param['length'],$param['start']);
        }
        if($log){
          $this->db->where('operation_status.operation_id',$log);
        }
        $this->db->select('tbl_item.item_name,operation_status.id,operation_status.operation,operation_status.date,tbl_login.user_name,concat("Branch:",tbl_branch.branch_name,",","Item:",item_name) AS name,tbl_login.user_type');
        $this->db->from('operation_status');
        $this->db->join('tbl_login','operation_status.user_id=tbl_login.id');
        $this->db->join('tbl_branch','operation_status.to_whom=tbl_branch.branch_id');
        $this->db->join('tbl_item','operation_status.value=tbl_item.item_id');
        $this->db->where('operation_status.operation_id',11);
        
        $query = $this->db->get();
        $data['data'] = $query->result();
        return $data;
  
      }  

      public function get_category($param){

        $arOrder = array('','user_name','action','log','designation');
        $user_name =(isset($param['user_name']))?$param['user_name']:'';
        $designation =(isset($param['designation']))?$param['designation']:'';
        $log =(isset($param['log']))?$param['log']:'';
        $action =(isset($param['action']))?$param['action']:'';
        $start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
        if($user_name){
          $this->db->like('tbl_login.user_name', $user_name); 
        }
        if($designation){
          $this->db->where('operation_status.designation', $designation); 
            }
        if($action){
          $this->db->like('concat("Category ",tbl_category.category_name)', $action); 
        }
        if($start_date){
          $this->db->where('operation_status.date >=', $start_date);
        }
        if($end_date){
          $this->db->where('operation_status.date <=', $end_date); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
          $this->db->limit($param['length'],$param['start']);
        }
        if($log){
          $this->db->where('operation_status.operation_id',$log);
        }
        $this->db->select('operation_status.id,operation_status.operation,operation_status.date,tbl_login.user_name,concat("Category ",tbl_category.category_name) AS name,tbl_login.user_type');
        $this->db->from('operation_status');
        $this->db->join('tbl_login','operation_status.user_id=tbl_login.id');
        $this->db->join('tbl_category','operation_status.to_whom=tbl_category.category_id');
        $this->db->where('operation_status.operation_id',5);
  
        $query = $this->db->get();
        $data['data'] = $query->result();
        return $data;
  
      }  

       public function get_item($param){

        $arOrder = array('','user_name','action','log','designation');
        $user_name =(isset($param['user_name']))?$param['user_name']:'';
        $designation =(isset($param['designation']))?$param['designation']:'';
        $log =(isset($param['log']))?$param['log']:'';
        $action =(isset($param['action']))?$param['action']:'';
        $start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
        if($user_name){
          $this->db->like('tbl_login.user_name', $user_name); 
        }
        if($designation){
          $this->db->where('operation_status.designation', $designation); 
            }
        if($action){
          $this->db->like('concat("Item ",tbl_item.item_name)', $action); 
        }
        if($start_date){
          $this->db->where('operation_status.date >=', $start_date);
        }
        if($end_date){
          $this->db->where('operation_status.date <=', $end_date); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
          $this->db->limit($param['length'],$param['start']);
        }
        if($log){
          $this->db->where('operation_status.operation_id',$log);
        }
        $this->db->select('operation_status.id,operation_status.operation,operation_status.date,tbl_login.user_name,concat("Item ",tbl_item.item_name) AS name,tbl_login.user_type');
        $this->db->from('operation_status');
        $this->db->join('tbl_login','operation_status.user_id=tbl_login.id');
        $this->db->join('tbl_item','operation_status.to_whom=tbl_item.item_id');
        $this->db->where('operation_status.operation_id',9);
        // $this->db->or_where('operation_status.operation_id',6);
        // $this->db->or_where('operation_status.operation_id',8);
        // $this->db->or_where('operation_status.operation_id',12);
        // $this->db->or_where('operation_status.operation_id',13);
        //  $this->db->or_where('operation_status.operation_id',15);
  
      $query = $this->db->get();
      $data['data'] = $query->result();
      return $data;
  
      }  

      public function get_mrop($param){

        $arOrder = array('','user_name','action','log','designation');
        $user_name =(isset($param['user_name']))?$param['user_name']:'';
        $designation =(isset($param['designation']))?$param['designation']:'';
        $log =(isset($param['log']))?$param['log']:'';
        $action =(isset($param['action']))?$param['action']:'';
        $start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
        if($user_name){
          $this->db->like('tbl_login.user_name', $user_name); 
        }
        if($designation){
          $this->db->where('operation_status.designation', $designation); 
            }
        if($action){
          $this->db->like('concat("Item ",tbl_item.item_name)', $action); 
        }
        if($start_date){
          $this->db->where('operation_status.date >=', $start_date);
        }
        if($end_date){
          $this->db->where('operation_status.date <=', $end_date); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
          $this->db->limit($param['length'],$param['start']);
        }
        if($log){
          $this->db->where('operation_status.operation_id',$log);
        }
        $this->db->select('operation_status.id,operation_status.operation,operation_status.date,tbl_login.user_name,concat("Item ",tbl_item.item_name,",","rop:",operation_status.value) AS name,tbl_login.user_type');
        $this->db->from('operation_status');
        $this->db->join('tbl_login','operation_status.user_id=tbl_login.id');
        $this->db->join('tbl_item','operation_status.to_whom=tbl_item.item_id');
        $this->db->where('operation_status.operation_id',6);
        $query = $this->db->get();
        $data['data'] = $query->result();
        return $data;
  
      }  

      public function get_brop($param){

        $arOrder = array('','user_name','action','log','designation');
        $user_name =(isset($param['user_name']))?$param['user_name']:'';
        $designation =(isset($param['designation']))?$param['designation']:'';
        $log =(isset($param['log']))?$param['log']:'';
        $action =(isset($param['action']))?$param['action']:'';
        $start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
        if($user_name){
          $this->db->like('tbl_login.user_name', $user_name); 
        }
        if($designation){
          $this->db->where('operation_status.designation', $designation); 
            }
        if($action){
          $this->db->like('concat("Item ",tbl_item.item_name)', $action); 
        }
        if($start_date){
          $this->db->where('operation_status.date >=', $start_date);
        }
        if($end_date){
          $this->db->where('operation_status.date <=', $end_date); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
          $this->db->limit($param['length'],$param['start']);
        }
        if($log){
          $this->db->where('operation_status.operation_id',$log);
        }
        $this->db->select('operation_status.id,operation_status.operation,operation_status.date,tbl_login.user_name,concat("Item ",tbl_item.item_name,",","rop:",operation_status.value) AS name,tbl_login.user_type');
        $this->db->from('operation_status');
        $this->db->join('tbl_login','operation_status.user_id=tbl_login.id');
        $this->db->join('tbl_item','operation_status.to_whom=tbl_item.item_id');
        $this->db->where('operation_status.operation_id',8);
        $query = $this->db->get();
        $data['data'] = $query->result();
        return $data;
  
      }  

      public function get_issue($param){

        $arOrder = array('','user_name','action','log','designation');
        $user_name =(isset($param['user_name']))?$param['user_name']:'';
        $designation =(isset($param['designation']))?$param['designation']:'';
        $log =(isset($param['log']))?$param['log']:'';
        $action =(isset($param['action']))?$param['action']:'';
        $start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
        if($user_name){
          $this->db->like('tbl_login.user_name', $user_name); 
        }
        if($designation){
          $this->db->where('operation_status.designation', $designation); 
            }
        if($action){
          $this->db->like('concat("Item ",tbl_item.item_name)', $action); 
        }
        if($start_date){
          $this->db->where('operation_status.date >=', $start_date);
        }
        if($end_date){
          $this->db->where('operation_status.date <=', $end_date); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
          $this->db->limit($param['length'],$param['start']);
        }
        if($log){
          $this->db->where('operation_status.operation_id',$log);
        }
        $this->db->select('operation_status.id,operation_status.operation,operation_status.date,tbl_login.user_name,concat("Item ",tbl_item.item_name,",","Quantity:",operation_status.value) AS name,tbl_login.user_type');
        $this->db->from('operation_status');
        $this->db->join('tbl_login','operation_status.user_id=tbl_login.id');
        $this->db->join('tbl_item','operation_status.to_whom=tbl_item.item_id');
        $this->db->where('operation_status.operation_id',12);
        $query = $this->db->get();
        $data['data'] = $query->result();
        return $data;
  
      }  

      public function get_return($param){

        $arOrder = array('','user_name','action','log','designation');
        $user_name =(isset($param['user_name']))?$param['user_name']:'';
        $designation =(isset($param['designation']))?$param['designation']:'';
        $log =(isset($param['log']))?$param['log']:'';
        $action =(isset($param['action']))?$param['action']:'';
        $start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
        if($user_name){
          $this->db->like('tbl_login.user_name', $user_name); 
        }
        if($designation){
          $this->db->where('operation_status.designation', $designation); 
            }
        if($action){
          $this->db->like('concat("Item ",tbl_item.item_name)', $action); 
        }
        if($start_date){
          $this->db->where('operation_status.date >=', $start_date);
        }
        if($end_date){
          $this->db->where('operation_status.date <=', $end_date); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
          $this->db->limit($param['length'],$param['start']);
        }
        if($log){
          $this->db->where('operation_status.operation_id',$log);
        }
        $this->db->select('operation_status.id,operation_status.operation,operation_status.date,tbl_login.user_name,concat("Item ",tbl_item.item_name,",","Quantity:",operation_status.value) AS name,tbl_login.user_type');
        $this->db->from('operation_status');
        $this->db->join('tbl_login','operation_status.user_id=tbl_login.id');
        $this->db->join('tbl_item','operation_status.to_whom=tbl_item.item_id');
        $this->db->where('operation_status.operation_id',13);
        $query = $this->db->get();
        $data['data'] = $query->result();
        return $data;
  
      } 

      public function get_request($param){

        $arOrder = array('','user_name','action','log','designation');
        $user_name =(isset($param['user_name']))?$param['user_name']:'';
        $designation =(isset($param['designation']))?$param['designation']:'';
        $log =(isset($param['log']))?$param['log']:'';
        $action =(isset($param['action']))?$param['action']:'';
        $start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
        if($user_name){
          $this->db->like('tbl_login.user_name', $user_name); 
        }
        if($designation){
          $this->db->where('operation_status.designation', $designation); 
            }
        if($action){
          $this->db->like('concat("Item ",tbl_item.item_name)', $action); 
        }
        if($start_date){
          $this->db->where('operation_status.date >=', $start_date);
        }
        if($end_date){
          $this->db->where('operation_status.date <=', $end_date); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
          $this->db->limit($param['length'],$param['start']);
        }
        if($log){
          $this->db->where('operation_status.operation_id',$log);
        }
        $this->db->select('operation_status.id,operation_status.operation,operation_status.date,tbl_login.user_name,concat("Item ",tbl_item.item_name,",","Quantity:",operation_status.value) AS name,tbl_login.user_type');
        $this->db->from('operation_status');
        $this->db->join('tbl_login','operation_status.user_id=tbl_login.id');
        $this->db->join('tbl_item','operation_status.to_whom=tbl_item.item_id');
        $this->db->where('operation_status.operation_id',15);
        $query = $this->db->get();
        $data['data'] = $query->result();
        return $data;
  
      }   
      
        
      public function get_mail($param){

        $arOrder = array('','user_name','action','log','designation');
        $user_name =(isset($param['user_name']))?$param['user_name']:'';
        $designation =(isset($param['designation']))?$param['designation']:'';
        $log =(isset($param['log']))?$param['log']:'';
        $action =(isset($param['action']))?$param['action']:'';
        $start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
        if($user_name){
          $this->db->like('tbl_login.user_name', $user_name); 
        }
        if($designation){
          $this->db->where('operation_status.designation', $designation); 
            }
        if($action){
          $this->db->like('concat("Mail ",tbl_email.email)', $action); 
        }
        if($start_date){
          $this->db->where('operation_status.date >=', $start_date);
        }
        if($end_date){
          $this->db->where('operation_status.date <=', $end_date); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
          $this->db->limit($param['length'],$param['start']);
        }
        if($log){
          $this->db->where('operation_status.operation_id',$log);
        }
        $this->db->select('operation_status.id,operation_status.operation,operation_status.date,tbl_login.user_name,concat("Mail ",tbl_email.email) AS name,tbl_login.user_type');
        $this->db->from('operation_status');
        $this->db->join('tbl_login','operation_status.user_id=tbl_login.id');
        $this->db->join('tbl_email','operation_status.to_whom=tbl_email.id');
        $this->db->where('operation_status.operation_id',7);
  
        $query = $this->db->get();
       $data['data'] = $query->result();
        return $data;
  
      }  

       public function get_purchase($param){

        $arOrder = array('','user_name','action','log','designation');
        $user_name =(isset($param['user_name']))?$param['user_name']:'';
        $designation =(isset($param['designation']))?$param['designation']:'';
        $log =(isset($param['log']))?$param['log']:'';
        $action =(isset($param['action']))?$param['action']:'';
        $start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
        if($user_name){
          $this->db->like('tbl_login.user_name', $user_name); 
        }
        if($designation){
          $this->db->where('operation_status.designation', $designation); 
            }
        if($action){
          $this->db->like('concat("Bill no ",operation_status.to_whom)', $action); 
        }
        if($start_date){
          $this->db->where('operation_status.date >=', $start_date);
        }
        if($end_date){
          $this->db->where('operation_status.date <=', $end_date); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
          $this->db->limit($param['length'],$param['start']);
        }
        if($log){
          $this->db->where('operation_status.operation_id',$log);
        }
        $this->db->select('operation_status.id,operation_status.operation,operation_status.date,tbl_login.user_name,concat("Bill no ",operation_status.to_whom) AS name,tbl_login.user_type');
        $this->db->from('operation_status');
        $this->db->join('tbl_login','operation_status.user_id=tbl_login.id');
        $this->db->where('operation_status.operation_id',10);
  
        $query = $this->db->get();
        $data['data'] = $query->result();
        return $data;
  
      }  

      public function get_payment($param){
        $arOrder = array('','user_name','action','log','designation');
        $user_name =(isset($param['user_name']))?$param['user_name']:'';
        $designation =(isset($param['designation']))?$param['designation']:'';
        $log =(isset($param['log']))?$param['log']:'';
        $action =(isset($param['action']))?$param['action']:'';
        $start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
        if($user_name){
          $this->db->like('tbl_login.user_name', $user_name); 
        }
        if($designation){
          $this->db->where('operation_status.designation', $designation); 
            }
        if($action){
          $this->db->like('concat("Vendor ",tbl_vendor.vendorname)', $action); 
        }
        if($start_date){
          $this->db->where('operation_status.date >=', $start_date);
        }
        if($end_date){
          $this->db->where('operation_status.date <=', $end_date); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
          $this->db->limit($param['length'],$param['start']);
        }
        if($log){
          $this->db->where('operation_status.operation_id',$log);
        }

        $this->db->select('operation_status.id,operation_status.operation,operation_status.date,tbl_login.user_name,concat("Vendor: ",tbl_vendor.vendorname,",","Amount:",operation_status.value) AS name,tbl_login.user_type');
        $this->db->from('operation_status');
        $this->db->join('tbl_login','operation_status.user_id=tbl_login.id');
        $this->db->join('tbl_vendor','operation_status.to_whom=tbl_vendor.vendor_id');
        $this->db->where('operation_status.operation_id',16);
        $query = $this->db->get();
        $data['data'] = $query->result();
        return $data;
  
      }

       public function get_benchperiod($param){
        $arOrder = array('','user_name','action','log','designation');
        $user_name =(isset($param['user_name']))?$param['user_name']:'';
        $designation =(isset($param['designation']))?$param['designation']:'';
        $log =(isset($param['log']))?$param['log']:'';
        $action =(isset($param['action']))?$param['action']:'';
        $start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
        if($user_name){
          $this->db->like('tbl_login.user_name', $user_name); 
        }
        if($designation){
          $this->db->where('operation_status.designation', $designation); 
            }
        if($action){
          $this->db->like('concat("Bench Mark Period","")', $action); 
        }
        if($start_date){
          $this->db->where('operation_status.date >=', $start_date);
        }
        if($end_date){
          $this->db->where('operation_status.date <=', $end_date); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
          $this->db->limit($param['length'],$param['start']);
        }
        if($log){
          $this->db->where('operation_status.operation_id',$log);
        }

        $this->db->select('operation_status.id,operation_status.operation,operation_status.date,tbl_login.user_name,concat("Bench Mark Period","") AS name,tbl_login.user_type');
        $this->db->from('operation_status');
        $this->db->join('tbl_login','operation_status.user_id=tbl_login.id');
       
        $this->db->where('operation_status.operation_id',20);
        $query = $this->db->get();
        $data['data'] = $query->result();
        return $data;
  
      }

      public function get_masterbenchmark($param){

        $arOrder = array('','user_name','action','log','designation');
        $user_name =(isset($param['user_name']))?$param['user_name']:'';
        $designation =(isset($param['designation']))?$param['designation']:'';
        $log =(isset($param['log']))?$param['log']:'';
        $action =(isset($param['action']))?$param['action']:'';
        $start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
        if($user_name){
          $this->db->like('tbl_login.user_name', $user_name); 
        }
        if($designation){
          $this->db->where('operation_status.designation', $designation); 
            }
        if($action){
          $this->db->like('concat("Item ",tbl_item.item_name)', $action); 
        }
        if($start_date){
          $this->db->where('operation_status.date >=', $start_date);
        }
        if($end_date){
          $this->db->where('operation_status.date <=', $end_date); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
          $this->db->limit($param['length'],$param['start']);
        }
        if($log){
          $this->db->where('operation_status.operation_id',$log);
        }
        $this->db->select('operation_status.id,operation_status.operation,operation_status.date,tbl_login.user_name,concat("Item ",tbl_item.item_name,",","branch:",tbl_branch.branch_name) AS name,tbl_login.user_type');
        $this->db->from('operation_status');
        $this->db->join('tbl_login','operation_status.user_id=tbl_login.id');
        $this->db->join('tbl_item','operation_status.to_whom=tbl_item.item_id');
         $this->db->join('tbl_branch','operation_status.value=tbl_branch.branch_id');
        $this->db->where('operation_status.operation_id',21);
        $query = $this->db->get();
        $data['data'] = $query->result();
        return $data;
  
      }  


      public function get_branchbenchmark($param){

        $arOrder = array('','user_name','action','log','designation');
        $user_name =(isset($param['user_name']))?$param['user_name']:'';
        $designation =(isset($param['designation']))?$param['designation']:'';
        $log =(isset($param['log']))?$param['log']:'';
        $action =(isset($param['action']))?$param['action']:'';
        $start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
        if($user_name){
          $this->db->like('tbl_login.user_name', $user_name); 
        }
        if($designation){
          $this->db->where('operation_status.designation', $designation); 
            }
        if($action){
          $this->db->like('concat("Item ",tbl_item.item_name,",","User:",tbl_user.username)', $action); 
        }
        if($start_date){
          $this->db->where('operation_status.date >=', $start_date);
        }
        if($end_date){
          $this->db->where('operation_status.date <=', $end_date); 
        }
        if ($param['start'] != 'false' and $param['length'] != 'false') {
          $this->db->limit($param['length'],$param['start']);
        }
        if($log){
          $this->db->where('operation_status.operation_id',$log);
        }
        $this->db->select('operation_status.id,operation_status.operation,operation_status.date,tbl_login.user_name,concat("Item ",tbl_item.item_name,",","User:",tbl_user.username) AS name,tbl_login.user_type');
        $this->db->from('operation_status');
        $this->db->join('tbl_login','operation_status.user_id=tbl_login.id');
        $this->db->join('tbl_item','operation_status.to_whom=tbl_item.item_id');
         $this->db->join('tbl_user','operation_status.value=tbl_user.user_id');
        $this->db->where('operation_status.operation_id',22);
        $query = $this->db->get();
        $data['data'] = $query->result();
        return $data;
  
      }  
      
      
      

      // public function getLogTable($param)
      // {
      //   $arOrder = array('','user_name','action','designation');
      //   $user_name =(isset($param['user_name']))?$param['user_name']:'';
      //   $designation =(isset($param['designation']))?$param['designation']:'';
      //   $log =(isset($param['log']))?$param['log']:'';
      //   // if($user_name){
      //   //   $this->db->like('username', $user_name); 
      //   // }
      //   // if($designation){
      //   //     $this->db->where('user_designation', $designation); 
      //   // }
      //   // if($branch!=''){
      //   //     $this->db->where('tbl_user.user_branch', $branch); 
      //   // }
        
      //   // if ($param['start'] != 'false' and $param['length'] != 'false') {
      //   //       $this->db->limit($param['length'],$param['start']);
      //   // }
      //   $this->db->select('operation_status.operation,operation_status.date,tbl_login.user_name,tbl_login.user_type,operation_status.operation_id');
      //   $this->db->from('operation_status');
      //   $this->db->join('tbl_login','operation_status.user_id=tbl_login.id');
      //   $this->db->order_by('user_id', 'DESC');
      //   $query = $this->db->get();
      //   $data['data'] = $query->result();
      //   // $data['recordsTotal'] = $this->getUsersTotalCount($param);
      //   // $data['recordsFiltered'] = $this->getUsersTotalCount($param);
      //   return $data;
      // }
	
}
?>