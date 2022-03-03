<?php
class Commonmodel extends CI_Model{
    public function getVendorModel($vendorname){
        $this->db->where('vendor_status',1);
        if($vendorname){
            $this->db->like('vendor_name',$vendorname);
        }
        $query = $this->db->get('vendor');
        $result =  $query->result_array();
        
        $arData['rows']=$result;
        $arData['records']=$query->num_rows();
        $arData['total']=$query->num_rows();
        return $arData;
    }
    public function getItem($itemname){
        $this->db->where('item_status',1);
        if($itemname){
            $this->db->like('item_name',$itemname);
        }
		$this->db->select('*');
        $this->db->from('tbl_item');
        $query = $this->db->get();
        $result =  $query->result_array();
        
        $arData['rows']=$result;
        $arData['records']=$query->num_rows();
        $arData['total']=$query->num_rows();
        return $arData;
    }
	public function getbranchItem($itemname){
        $this->db->where('item_status',1);
        if($itemname){
            $this->db->like('item_name',$itemname);
        }
		$this->db->select('*');
        $this->db->from('tbl_item');
        $query = $this->db->get();
        $result =  $query->result_array();
        
        $arData['rows']=$result;
        $arData['records']=$query->num_rows();
        $arData['total']=$query->num_rows();
        return $arData;
    }
	public function getProductDetails($purchaseid){
        $this->db->where('product_status',1);
        $this->db->where('stock_status',1);
        if($purchaseid){
            $where = "(product_details.product_name like '%$purchaseid%')";
            $this->db->where($where);
        }
        $this->db->select('*');
        $this->db->from('stock_details');
		$this->db->join('product_details', 'stock_details.product_id_fk  = product_details.product_id');
        $this->db->join('size', 'size.size_id  = product_details.size_id_fk','left');
        $this->db->join('color_details', 'color_details.color_id  = product_details.color_id_fk','left');
        $this->db->join('category', 'category.category_id  = product_details.category_id_fk','left');
        $this->db->join('subcategory', 'subcategory.subcategory_id = product_details.subcategory_id_fk','left');
        $where_quantity = "(purchase_quantity - sale_quantity) > 0";
        $this->db->where($where_quantity);
		// $this->db->where('purchase_quantity!=',0);
		$query = $this->db->get();
        // echo $this->db->last_query();
        $result =  $query->result_array();
        
        $arData['rows']=$result;
        $arData['records']=$query->num_rows();
        $arData['total']=$query->num_rows();
        return $arData;
    }
   public function getCustomerModel($customername){
        $this->db->where('user_status',1);
        if($customername){
            $this->db->like('username',$customername);
        }
        $query = $this->db->get('tbl_user');
        $result =  $query->result_array();
        
        $arData['rows']=$result;
        $arData['records']=$query->num_rows();
        $arData['total']=$query->num_rows();
        return $arData;
    }
	public function getDealerModel($customername){
        $this->db->where('dealer_status',1);
        if($customername){
            $this->db->like('dealer_name',$customername);
        }
        $query = $this->db->get('dealer_details');
        $result =  $query->result_array();
        
        $arData['rows']=$result;
        $arData['records']=$query->num_rows();
        $arData['total']=$query->num_rows();
        return $arData;
    }
    public function getEmployeeModel($employeename,$br){
        $this->db->where('user_status',1);
		$this->db->where('is_active',1);
		$this->db->where('user_branch',$br);
		//$this->db->where('user_designation <>',1);
		//$this->db->where('user_designation <>',2);
		//$this->db->where('user_designation <>',3);
		//$this->db->where('user_designation <>',4);
		//$this->db->where('user_designation <>',5);
		//$this->db->where('user_designation <>',6);
        if($employeename){
            $this->db->like('username',$employeename);
        }
        $query = $this->db->get('tbl_user');
        $result =  $query->result_array();
        
        $arData['rows']=$result;
        $arData['records']=$query->num_rows();
        $arData['total']=$query->num_rows();
        return $arData;
    }
	public function getEmploye($empmname){
        $this->db->where('user_status',1);
		$this->db->where('is_active',1);
		if($empmname){
            $this->db->like('username',$empmname);
		}
        $query = $this->db->get('tbl_user');
        $result =  $query->result_array();
        
        $arData['rows']=$result;
        $arData['records']=$query->num_rows();
        $arData['total']=$query->num_rows();
        return $arData;
    }
    public function getInvoiceModel($invoiceNo){
        $this->db->where('purchase_status',1);
        if($invoiceNo){
            $this->db->like('purchase_invoice_no',$invoiceNo);
        }
        $this->db->select('*');
        $this->db->from('purchase_details');
        $this->db->join('product_details', 'purchase_details.product_id_fk  = product_details.product_id');
        $this->db->join('category', 'category.category_id  = product_details.category_id_fk','left');
        $this->db->join('subcategory', 'subcategory.subcategory_id = product_details.subcategory_id_fk','left');
        $this->db->join('size', 'size.size_id  = product_details.size_id_fk','left');
        $this->db->join('color_details', 'color_details.color_id  = product_details.color_id_fk','left');
        $where_quantity = "(product_purchase_quantity - purchase_return_qty) > 0";
        $this->db->where($where_quantity);
        $query = $this->db->get();
        $result =  $query->result_array();
        
        $arData['rows']=$result;
        $arData['records']=$query->num_rows();
        $arData['total']=$query->num_rows();
        return $arData;
    }
    
    public function getSaleInvoiceModel($invoiceNo){
        $this->db->where('sale_status',1);
        if($invoiceNo){
            $this->db->like('sale_invoice_number',$invoiceNo);
        }
        $this->db->select('*');
        $this->db->from('sale_details');
        $this->db->join('product_details', 'sale_details.product_id_fk  = product_details.product_id');
        $this->db->join('category', 'category.category_id  = product_details.category_id_fk','left');
        $this->db->join('subcategory', 'subcategory.subcategory_id = product_details.subcategory_id_fk','left');
        $query = $this->db->get();
        $result =  $query->result_array();
        
        $arData['rows']=$result;
        $arData['records']=$query->num_rows();
        $arData['total']=$query->num_rows();
        return $arData;
    }
	public function getBranchId(){
       
		$lg = $this->session->userdata('id');
        $this->db->select('*');
        $this->db->from('tbl_user');
		$this->db->where('login_id_fk',$lg);
        $query = $this->db->get();
        return $query->result();
    }
///////////////////Branch single item//////////////////////////////
    public function b2bcountlist($item_id,$branch_id)
	{
		$this->db->select('SUM(btob_quantity) as btb_sum_item');
		$this->db->from('ntbl_bs_branchtobranch');
		$this->db->where('btob_item_id_fk',$item_id);
		$this->db->where('btob_branch_id_fk',$branch_id);
		$query = $this->db->get();
		return $result = $query->result();
	}

	public function branchOpeningStock($item_id,$branch_id)
	{
		$this->db->select('SUM(os_quantity) as os_sum_item');
		$this->db->from('ntbl_bs_openingstock');
		$this->db->where('os_item_id_fk',$item_id);
		$this->db->where('os_branch_id_fk ',$branch_id);
		$query = $this->db->get();
		return $result = $query->result();
	}

	public function btomreqList($item_id,$branch_id)
	{
		$this->db->select('SUM(req_item_quantity) as req_sum_item');
		$this->db->from('ntbl_bs_stockrequests');
		$this->db->where('req_item_id_fk',$item_id);
		$this->db->where('req_branch_id_fk ',$branch_id);
		$this->db->where('req_status',0);
		$query = $this->db->get();
		return $result = $query->result();
	}

	public function issuedItemList($item_id,$branch_id)
	{
		$this->db->select('SUM(issued_quantity) as issue_sum_item');
		$this->db->from('ntbl_bs_issuedstock');
		$this->db->where('issued_item_id_fk',$item_id);
		$this->db->where('issued_branch_id_fk ',$branch_id);
		$this->db->where('is_approved',1);
		$query = $this->db->get();
		return $result = $query->result();
	}

    public function recievedFromBItemList($item_id,$branch_id)
	{
		$this->db->select('SUM(btob_quantity) as btb_sum_item');
		$this->db->from('ntbl_bs_branchtobranch');
		$this->db->where('btob_item_id_fk',$item_id);
		$this->db->where('btob_to_branch_id_fk',$branch_id);
		$query = $this->db->get();
		return $result = $query->result();
	}
    

	public function recievedItemList($item_id,$branch_id)
	{
		$this->db->select('SUM(req_item_quantity) as recive_sum_item');
		$this->db->from('ntbl_bs_stockrequests');
		$this->db->where('req_item_id_fk',$item_id);
		$this->db->where('req_branch_id_fk ',$branch_id);
		$this->db->where('req_status',1);
		$query = $this->db->get();
		return $result = $query->result();
	}

    public function returnToMasterList($item_id,$branch_id)
    {
        $this->db->select('SUM(return_quantity) as rtom_sum_item');
		$this->db->from('ntbl_bs_returntomaster');
		$this->db->where('return_item_id_fk',$item_id);
		$this->db->where('return_branch_id_fk',$branch_id);
        $this->db->where('is_approved',1);
		$query = $this->db->get();
		return $result = $query->result();
    }
 /////////////End Branch//////////////////////////////////////////   
 ////////////Branch Stock List///////////////////////////////////
public function getItemsListss()
{
    $this->db->select('item_id,item_name');
    $this->db->from('ntbl_items');
    $this->db->where('item_status',1);
    $query = $this->db->get();
    return $result = $query->result();
}

 public function b2bcountlist2($branch_id)
 {
     $this->db->select('btob_item_id_fk,SUM(btob_quantity) AS btb_item_count');
     $this->db->from('ntbl_bs_branchtobranch');
     $this->db->where('btob_branch_id_fk',$branch_id);
     $this->db->where('is_approved',1);
     $this->db->group_by('btob_item_id_fk');
     $query = $this->db->get();
     return $result = $query->result();
 }

 public function branchOpeningStock2($branch_id)
 {
     $this->db->select('os_item_id_fk,SUM(os_quantity) AS os_item_count');
    //  $this->db->join('ntbl_items','ntbl_items.item_id=ntbl_bs_openingstock.os_item_id_fk');
     $this->db->from('ntbl_bs_openingstock');
     $this->db->where('os_branch_id_fk ',$branch_id);
     $this->db->group_by('os_item_id_fk');
     $query = $this->db->get();
     return $result = $query->result();
 }

 public function btomreqList2($branch_id)
 {
     $this->db->select('req_item_id_fk,SUM(req_item_quantity) AS total_req2_qty');
     $this->db->from('ntbl_bs_stockrequests');
     $this->db->where('req_branch_id_fk ',$branch_id);
     $this->db->where('req_status',0);
     $this->db->group_by('req_item_id_fk');
     $query = $this->db->get();
     return $result = $query->result();
 }

 public function issuedItemList2($branch_id)
 {
     $this->db->select('issued_item_id_fk,SUM(issued_quantity) AS total_issued_qty');
     $this->db->from('ntbl_bs_issuedstock');
     $this->db->where('issued_branch_id_fk ',$branch_id);
     $this->db->where('is_approved',1);
     $this->db->group_by('issued_item_id_fk');
     $query = $this->db->get();
     return $result = $query->result();
 }

 public function recievedFromBItemList2($branch_id)
 {
     $this->db->select('btob_item_id_fk,SUM(btob_quantity) AS total_btb_qty');
     $this->db->from('ntbl_bs_branchtobranch');
     $this->db->where('btob_to_branch_id_fk',$branch_id);
     $this->db->where('is_approved',1);
     $this->db->group_by('btob_item_id_fk');
     $query = $this->db->get();
     return $result = $query->result();
 }
 

 public function recievedItemList2($branch_id)
 {
     $this->db->select('req_item_id_fk,SUM(req_item_quantity) AS total_req_qty');
     $this->db->from('ntbl_bs_stockrequests');
     $this->db->where('req_branch_id_fk ',$branch_id);
     $this->db->where('req_status',1);
     $this->db->group_by('req_item_id_fk');
     $query = $this->db->get();
     return $result = $query->result();
 }

 public function returnToMasterList2($branch_id)
 {
     $this->db->select('return_item_id_fk,SUM(return_quantity) AS total_return_qty');
     $this->db->from('ntbl_bs_returntomaster');
     $this->db->where('return_branch_id_fk',$branch_id);
     $this->db->where('is_approved',1);
     $this->db->group_by('return_item_id_fk');
     $query = $this->db->get();
     return $result = $query->result();
 }

//  public function getStockDEtailList($branch_id)
//  {
//     $this->db->select('*,SUM(btb_recieved.btob_quantity) AS total_of_btb_recieved,SUM(btb_given.btob_quantity) AS total_of_btb_given,SUM(os_quantity) AS opening_stock,SUM(),SUM()');
//     $this->db->join('ntbl_bs_branchtobranch AS btb_given','btb_given.btob_branch_id_fk=ntbl_bs_openingstock.os_branch_id_fk','left');
//     $this->db->join('ntbl_bs_branchtobranch AS btb_recieved','btb_recieved.btob_to_branch_id_fk=ntbl_bs_openingstock.os_branch_id_fk','left');
//     $this->db->join('ntbl_bs_issuedstock','ntbl_bs_issuedstock.issued_branch_id_fk=ntbl_bs_openingstock.os_branch_id_fk','left');
//     $this->db->join('ntbl_bs_returntomaster','ntbl_bs_returntomaster.return_branch_id_fk=ntbl_bs_openingstock.os_branch_id_fk','left');
//     $this->db->join('ntbl_bs_stockrequests','ntbl_bs_stockrequests.req_branch_id_fk=ntbl_bs_openingstock.os_branch_id_fk','left');
//     $this->db->from('ntbl_bs_openingstock');
//     $this->db->where('os_branch_id_fk',$branch_id);
//     $this->db->group_by();
//     $query = $this->db->get();
//     return $result = $query->result();
//  }

 public function stockLists3($branchid)
 {
    // $query = $this->db
    // ->select('*')
    // ->from()
    //  $query = $this->db
    //  ->select('*')
    //  ->join('ntbl_bs_openingstock','ntbl_bs_openingstock.os_item_id_fk=ntbl_items.item_id','left')
    //  ->join('ntbl_bs_branchtobranch','ntbl_bs_branchtobranch.btob_item_id_fk=ntbl_items.item_id','left')
    // //  ->join('ntbl_bs_stockrequests','ntbl_bs_stockrequests.req_item_id_fk=ntbl_items.item_id','left')
    // //  ->join('ntbl_bs_issuedstock','ntbl_bs_issuedstock.issued_item_id_fk=ntbl_items.item_id','left')
    // //  ->join('ntbl_bs_returntomaster','ntbl_bs_returntomaster.return_item_id_fk=ntbl_items.item_id','left')
    //  ->get('ntbl_items');
    //  ->where()
    // // echo $this->db->last_query();
    // echo"<pre>".print_r($query->result(),1),"</pre>";die;
    // return $result = $query->result();
 }

 public function stockLists4($item_id =2)
 {
     $query = $this->db
     ->select('*')
     ->join('ntbl_bs_openingstock','ntbl_bs_openingstock.os_item_id_fk=ntbl_items.item_id','left')
     ->join('ntbl_bs_branchtobranch','ntbl_bs_branchtobranch.btob_item_id_fk=ntbl_items.item_id','left')
     ->join('ntbl_bs_stockrequests','ntbl_bs_stockrequests.req_item_id_fk=ntbl_items.item_id','left')
     ->join('ntbl_bs_issuedstock','ntbl_bs_issuedstock.issued_item_id_fk=ntbl_items.item_id','left')
     ->join('ntbl_bs_returntomaster','ntbl_bs_returntomaster.return_item_id_fk=ntbl_items.item_id','left')
     ->get('ntbl_items');
    //  echo $this->db->last_query();
    echo"<pre>".print_r($query->result(),1),"</pre>";die;
 }
 ///////////End Branch Stock List///////////////////////////////


 ////////////Master Stock////////////////////////////////////////
 public function b2bCountListMaster($item_id)
	{
		$this->db->select('SUM(btob_quantity) as btb_qty_sum');
		$this->db->from('ntbl_bs_branchtobranch');
		$this->db->where('btob_item_id_fk',$item_id);
		$this->db->where('is_approved',1);
		$query = $this->db->get();
		return $result = $query->result();
	}

	public function masterOpeningStock($item_id)
	{
		$this->db->select('SUM(os_quantity) as os_qty_sum');
		$this->db->from('ntbl_master_os');
		$this->db->where('os_item_id_fk',$item_id);
		$query = $this->db->get();
		return $result = $query->result();
	}

	public function btomreqMasterList($item_id)
	{
		$this->db->select('SUM(req_item_quantity) as req_qty_sum');
		$this->db->from('ntbl_bs_stockrequests');
		$this->db->where('req_item_id_fk',$item_id);
		$this->db->where('req_status',0);
		$query = $this->db->get();
		return $result = $query->result();
	}

	public function issuedItemMasterList($item_id)
	{
		$this->db->select('SUM(issued_quantity) as issued_qty_sum');
		$this->db->from('ntbl_bs_issuedstock');
		$this->db->where('issued_item_id_fk',$item_id);
		$this->db->where('is_approved',1);
		$query = $this->db->get();
		return $result = $query->result();
	}

	public function recievedItemMasterList($item_id)
	{
		$this->db->select('SUM(req_item_quantity) as rec_qty_sum');
		$this->db->from('ntbl_bs_stockrequests');
		$this->db->where('req_item_id_fk',$item_id);
		$this->db->where('req_status',1);
		$query = $this->db->get();
		return $result = $query->result();
	}

//////////End Master Stock/////////////////////////////////////////////
}
?>
