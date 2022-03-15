<?php
Class Dashboard_model extends CI_Model{

	public function gettotal_users(){
		$this->db->select('count(user_id)as totalusers');
		$this->db->from('tbl_user');
		$this->db->where("user_status",1)->where("is_active",1);
        $query = $this->db->get();
    	return $query->result();
	}

	public function gettotal_users2(){
		$this->db->select('count(user_id)as totalusers');
		$this->db->from('tbl_user');
		$this->db->where("user_status",1)->where("is_active",1);
        $query = $this->db->get();
    	return $query->result();
	}


	public function gettotal_stock(){
		$sql ="SELECT t3.*,t1.*,sum(t1.item_quantity - COALESCE(t2.item_quantity, 0))AS sum FROM tbl_stock t1 left join (SELECT item_id_fk, SUM(item_quantity) AS item_quantity FROM tbl_shopstock where status = 1 GROUP BY item_id_fk) t2 ON t1.item_id_fk=t2.item_id_fk JOIN tbl_stockup t3 ON t3.stock_id_fk=t1.stock_id";

		$query = $this->db->query($sql);
    	return $query->result();
	}

	public function gettotal_stock2($branch_id){
		$query=$this->db->select_sum('stock_balance')->where('branch_id',$branch_id)->get('ntbl_stock_balances');
		return $query->row()->stock_balance;
	}

	public function getPuchaseOder(){
		$this->db->select('count(distinct ref_number)as orders');
		$this->db->from('tbl_apurchase');
		$this->db->where("delivery",1)->where("cc",1);

        $query = $this->db->get();
    	return $query->result();
	}

	public function gettotal_return(){
		$this->db->select('count(return_id)');
		$this->db->from('tbl_returnproduct');
		$this->db->where("return_to_master",0)->where("return_to_vendor",0);

        $query = $this->db->get();
    	return $query->result();
	}

	public function gettotal_brtobr(){
		$this->db->select('count(id) as total');
		$this->db->from('tbl_branch_to_branch');
		$this->db->where("status",0);

        $query = $this->db->get();
    	return $query->result();
	}

	public function gettotal_brtobr2(){
		$this->db->select('count(btob_id) as total');
		$this->db->from('ntbl_bs_branchtobranch');
		$this->db->where("is_approved",0);

        $query = $this->db->get();
    	return $query->result();
	}

	public function gettotal_requests(){
		$this->db->select('count(request_id)as product_request');
		$this->db->from('tbl_request_item');
		$this->db->where("request_status",1);

        $query = $this->db->get();
    	return $query->result();
	}


	public function getBranchstock(){
		$sql="SELECT t5.item_rop,t4.branch_name,t3.item_name,(CASE WHEN t1.issue_date IS NULL THEN t2.updated_date ELSE t1.issue_date END) AS date,t2.item_id_fk,t2.total_qty-(COALESCE(t1.total_issue_qty,0) + COALESCE(t6.total_return_qty,0) + COALESCE(t7.branch_qty,0)) as total FROM (SELECT branch_id_fk,item_id_fk,issue_date,SUM(issue_quantity) as total_issue_qty FROM tbl_issueitem GROUP BY item_id_fk,branch_id_fk) t1 RIGHT JOIN (SELECT item_id_fk,SUM(item_quantity) as total_qty,max(updated_date) as updated_date,shop_id_fk FROM tbl_shopstock GROUP BY shop_id_fk,item_id_fk) t2 ON t2.item_id_fk=t1.item_id_fk AND t2.shop_id_fk=t1.branch_id_fk LEFT JOIN (SELECT branch_id_fk,item_id_fk,return_date,SUM(item_quantity) as total_return_qty FROM tbl_returnproduct GROUP BY item_id_fk,branch_id_fk) t6 ON t6.item_id_fk=t2.item_id_fk AND t6.branch_id_fk=t2.shop_id_fk LEFT JOIN (SELECT from_branch_id_fk,SUM(item_quantity) branch_qty from tbl_branch_to_branch where status = 1 GROUP BY from_branch_id_fk,item_id_fk) t7 ON t7.from_branch_id_fk=t2.shop_id_fk Join tbl_item t3 on t3.item_id=t2.item_id_fk join tbl_branch t4 on t4.branch_id = t2.shop_id_fk join tbl_rop t5 on t2.item_id_fk=t5.item_id_fk and t2.shop_id_fk=t5.branch_id_fk";

        $query = $this->db->query($sql);
		return $query->result();
	}

	public function gettotal_requests2(){
		$this->db->select('count(req_id)as product_request');
		$this->db->from('ntbl_bs_stockrequests');
		$this->db->where("req_status",0);

        $query = $this->db->get();
    	return $query->result();
	}

	public function reOrderdetails2(){
		$this->db->select('count(rop_master_id)as mrop_count');
		$this->db->from('ntbl_rop_master');
		$this->db->where("rop_master_status",1);

        $query = $this->db->get();
    	return $query->result();
	}

	public function breordercount2(){
		$this->db->select('count(rop_branch_id)as brop_count');
		$this->db->from('ntbl_rop_branch');
		$this->db->where("rop_branch_status",1);

        $query = $this->db->get();
    	return $query->result();
	}

	public function empcounts2(){
		$this->db->select('count(emp_id)as emp_counts');
		$this->db->from('ntbl_branch_employees');
		$this->db->where("emp_status",1);

        $query = $this->db->get();
    	return $query->result();
	}

	public function branch_return_pending_count(){
		$query=$this->db->select('return_quantity')->get('ntbl_bs_returntomaster');
		return $query->num_rows();
	}

	public function getPuchaseRequest(){
		$where = "finaldelivery !='0' && reject !='1'";
		$this->db->select('count(distinct ref_number)as request');
		$this->db->from('tbl_apurchase');
		$this->db->where($where);

        $query = $this->db->get();
    	return $query->result();
	}

	public function getPuchaseDelivery(){
		$where = "finaldelivery='0'";
		$this->db->select('count(distinct ref_number)as delivery');
		$this->db->from('tbl_apurchase');
		$this->db->where($where);
        $query = $this->db->get();
    	return $query->result();
	}

	public function getDesignation(){
		$this->db->select('count(desig_id)as designation');
		$this->db->from('tbl_designation');
		$this->db->where('desig_status',1);
        $query = $this->db->get();
    	return $query->result();
	}

	public function getDesignation2(){
		$this->db->select('count(desg_id)as designation');
		$this->db->from('ntbl_designation');
		$this->db->where('desg_status',1);
        $query = $this->db->get();
    	return $query->result();
	}

	public function getPoducts(){
		$this->db->select('count(item_id)as item');
		$this->db->from('tbl_item');
		$this->db->where('item_status',1);
        $query = $this->db->get();
    	return $query->result();
	}

	public function getPoducts2(){
		$this->db->select('count(item_id)as item');
		$this->db->from('ntbl_items');
		$this->db->where('item_status',1);
        $query = $this->db->get();
    	return $query->result();
	}
	public function getVendors(){
		$this->db->select('count(vendor_id)as vendor');
		$this->db->from('tbl_vendor');
		$this->db->where('vendorstatus',1);
        $query = $this->db->get();
    	return $query->result();
	}

	public function getVendors2(){
		$this->db->select('count(vendor_id)as vendor');
		$this->db->from('ntbl_vendor');
		$this->db->where('vendor_status',1);
        $query = $this->db->get();
    	return $query->result();
	}

	public function getBranch(){
		$this->db->select('count(branch_id)as branch');
		$this->db->from('tbl_branch');
		$this->db->where('branch_status',1);
		// currently the is active status is 0
		// $this->db->where('is_active',0);
        $query = $this->db->get();
    	return $query->result();
	}

	public function getBranch2(){
		$this->db->select('count(branch_id)as branch');
		$this->db->from('ntbl_branches');
		$this->db->where('branch_status',1);
		// currently the is active status is 0
		// $this->db->where('is_active',0);
        $query = $this->db->get();
    	return $query->result();
	}

	public function getCategorys(){
		$this->db->select('count(category_id)as category');
		$this->db->from('tbl_category');
		$this->db->where('category_status',1);
        $query = $this->db->get();
    	return $query->result();
	}

	public function getCategorys2(){
		$this->db->select('count(cate_id)as category');
		$this->db->from('ntbl_category');
		$this->db->where('cate_status',1);
        $query = $this->db->get();
    	return $query->result();
	}

	public function getallBranch(){
		$this->db->select('*');
		$this->db->from('tbl_branch');
		$this->db->where('branch_status',1);
		$this->db->order_by('branch_id','ASC');
		$this->db->limit('5');
        $query = $this->db->get();
    	return $query->result();
	}

	function get_purchasepending(){

		$this->db->select('*');
		$this->db->from('tbl_apurchase');
		$this->db->join('tbl_vendor','vendor_id=tbl_apurchase.vendor_id_fk');
		$this->db->join('tbl_purchase_approval','tbl_apurchase.pr_id=tbl_purchase_approval.pr_id_fk');
		$this->db->join('tbl_login','tbl_purchase_approval.su_id_fk=tbl_login.id');
		$this->db->where('tbl_purchase_approval.reject',0);
		$this->db->where('tbl_purchase_approval.is_approved',0);
		$query = $this->db->get();

		return $query->result();
	}

	function get_stock_benchmark(){
		$this->db->select('*');
		$this->db->from('tbl_stock');
		$this->db->join('tbl_purchase_approval','tbl_apurchase.pr_id=tbl_purchase_approval.pr_id_fk');
		$this->db->where('tbl_purchase_approval.reject',0);
		$this->db->where('tbl_purchase_approval.is_approved',0);
		$query = $this->db->get();
		return $query->result();
	}

	function get_purchasepending_dashboard(){
		$this->db->select('count(pr_id)as purchase');
		$this->db->from('tbl_apurchase');
		$this->db->join('tbl_vendor','vendor_id=tbl_apurchase.vendor_id_fk');
		$this->db->join('tbl_purchase_approval','tbl_apurchase.pr_id=tbl_purchase_approval.pr_id_fk');
		$this->db->where('tbl_purchase_approval.reject',0);
		$this->db->where('tbl_purchase_approval.is_approved',0);
		$query = $this->db->get();
		return $query->result();
	  }

	  function get_rop(){
		$sql= "SELECT COALESCE(t5.item_rop, 0) AS item_rop,t4.branch_name,t3.item_name,(CASE WHEN t2.updated_date IS NULL THEN t1.issue_date ELSE t2.updated_date END) AS date,t2.shop_id_fk,t2.item_id_fk,t2.total_qty-(COALESCE(t1.total_issue_qty,0) + COALESCE(t6.total_return_qty,0) + COALESCE(t7.branch_qty,0)) as total FROM (SELECT branch_id_fk,item_id_fk,issue_date,SUM(issue_quantity) as total_issue_qty FROM tbl_issueitem GROUP BY item_id_fk,branch_id_fk) t1 RIGHT JOIN (SELECT id,item_id_fk,SUM(item_quantity) as total_qty,max(updated_date) as updated_date,shop_id_fk FROM tbl_shopstock GROUP BY shop_id_fk,item_id_fk) t2 ON t2.item_id_fk=t1.item_id_fk AND t2.shop_id_fk=t1.branch_id_fk LEFT JOIN (SELECT branch_id_fk,item_id_fk,return_date,SUM(item_quantity) as total_return_qty FROM tbl_returnproduct GROUP BY item_id_fk,branch_id_fk) t6 ON t6.item_id_fk=t2.item_id_fk AND t6.branch_id_fk=t2.shop_id_fk LEFT JOIN (SELECT item_id_fk,from_branch_id_fk,SUM(item_quantity) branch_qty from tbl_branch_to_branch where status = 1 GROUP BY from_branch_id_fk,item_id_fk) t7 ON t7.from_branch_id_fk=t2.shop_id_fk AND t7.item_id_fk=t2.item_id_fk Join tbl_item t3 on t3.item_id=t2.item_id_fk join tbl_branch t4 on t4.branch_id = t2.shop_id_fk join tbl_rop t5 on t2.item_id_fk=t5.item_id_fk and t2.shop_id_fk=t5.branch_id_fk order by id desc";
		return $this->db->query($sql)->result();
	//  $this->db->select('tbl_item.item_name')->from('tbl_item')->join('tbl_master_rop','tbl_item_id_fk=tbl_item.item_id')->join('')
	}

}

?>
