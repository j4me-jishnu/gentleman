<?php
Class Dash_board_model extends CI_Model{

	public function getUsersTable($param){
		$template['refno'] = $this->Refno();
		$branch_id = $template['refno'][0]->branch_id;
		$this->db->where("user_status",1);
		$this->db->where("tbl_user.user_branch",$branch_id);

		if ($param['start'] != 'false' and $param['length'] != 'false') {
			$this->db->limit($param['length'],$param['start']);
		}
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->join('tbl_login', 'tbl_login.id = tbl_user.login_id_fk');
		$this->db->order_by('user_id', 'DESC');
		$query = $this->db->get();
		$data['data'] = $query->result();
		$data['recordsTotal'] = $this->getUsersTotalCount($param,$branch_id);
		$data['recordsFiltered'] = $this->getUsersTotalCount($param,$branch_id);
		return $data;

	}

	public function getUsersTotalCount($param = NULL,$branch_id){
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->join('tbl_login', 'tbl_login.id = tbl_user.login_id_fk');
		$this->db->order_by('user_id', 'DESC');
		$this->db->where("user_status",1)->where("tbl_user.user_branch",$branch_id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function Refno(){
		$login_id_fk = $this->session->userdata('id');
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->join('tbl_branch', 'tbl_branch.branch_id = tbl_user.user_branch');
		$this->db->where('user_status',1);
		$this->db->where('login_id_fk',$login_id_fk);
		$query = $this->db->get();
		return $query->result();
	}

	public function gettotal_users($branch_id){
		$this->db->select('count(user_id)as totalusers');
		$this->db->from('tbl_user');
		$this->db->where("user_branch",$branch_id);
		$this->db->where("user_status",1)->where("is_active",1);
		$query = $this->db->get();
		return $query->result();
	}

	public function getIssued($branch_id){
		$this->db->select('sum(issue_quantity)as issued');
		$this->db->from('tbl_issueitem');
		$this->db->where('branch_id_fk',$branch_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getPuchaseDelivery($branch_id){
		//$where = "cc='0' OR brm='0' OR cm='0' OR fm='0' OR agm='0' OR pm='0' OR delivery='0'";
		$this->db->select('count(pr_id)as delivery');
		$this->db->from('tbl_purchase');
		$this->db->where('branch_id_fk',$branch_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getStockitem($bid){
		$sql ="SELECT t5.item_rop,t4.branch_name,t3.item_name,(CASE WHEN t1.issue_date IS NULL THEN t2.updated_date ELSE t1.issue_date END) AS date,t2.item_id_fk,t2.total_qty-(COALESCE(t1.total_issue_qty,0) + COALESCE(t6.total_return_qty,0) + COALESCE(t7.branch_qty,0)) as total FROM (SELECT branch_id_fk,item_id_fk,issue_date,SUM(issue_quantity) as total_issue_qty FROM tbl_issueitem where branch_id_fk = $bid GROUP BY branch_id_fk) t1 RIGHT JOIN (SELECT item_id_fk,SUM(item_quantity) as total_qty,max(updated_date) as updated_date,shop_id_fk FROM tbl_shopstock where shop_id_fk = $bid GROUP BY shop_id_fk) t2 ON t2.shop_id_fk=t1.branch_id_fk LEFT JOIN (SELECT branch_id_fk,item_id_fk,return_date,SUM(item_quantity) as total_return_qty FROM tbl_returnproduct where branch_id_fk = $bid GROUP BY branch_id_fk) t6 ON t6.branch_id_fk=t2.shop_id_fk LEFT JOIN (SELECT from_branch_id_fk,SUM(item_quantity) branch_qty from tbl_branch_to_branch where status = 1 and from_branch_id_fk = $bid GROUP BY from_branch_id_fk) t7 ON t7.from_branch_id_fk=t2.shop_id_fk Join tbl_item t3 on t3.item_id=t2.item_id_fk join tbl_branch t4 on t4.branch_id = t2.shop_id_fk join tbl_rop t5 on t2.item_id_fk=t5.item_id_fk and t2.shop_id_fk=t5.branch_id_fk";
		$query = $this->db->query($sql);
		$result=$query->result();
		return $query->result();
	}

	public function getallBranch(){
		$this->db->select('*');
		$this->db->from('tbl_branch');
		$this->db->where('branch_status',1);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_branch_id($branch_name){
		$response=$this->db->select('branch_id')->where('branch_name',$branch_name)->get('tbl_branch');
		$result=$response->result();
		return (int)$result[0]->branch_id;
	}

	public function get_branch_id2($branch_name){
		$response=$this->db->select('branch_id')->where('branch_name',$branch_name)->get('ntbl_branches');
		$result=$response->result();
		return (int)$result[0]->branch_id;
	}

	public function getIssued2($branch_id){
		$this->db->select('COUNT(issued_id)as issued');
		$this->db->from('ntbl_bs_issuedstock');
		$this->db->where('issued_branch_id_fk',$branch_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function stockItemslist($branch_id)
	{
		$this->db->select('SUM(COALESCE(os_quantity,0) + COALESCE(branch_qty_sum,0) + COALESCE(brach_r_qty_sum,0) - COALESCE(brach_g_qty_sum,0) - COALESCE(brach_issue_qty_sum,0) - COALESCE(branch_ret_qty_sum,0)) AS br_total_stck');
		$this->db->from('ntbl_bs_openingstock');
		$this->db->join('ntbl_items','ntbl_items.item_id=ntbl_bs_openingstock.os_item_id_fk','left');
		$this->db->join('(SELECT req_item_id_fk,req_branch_id_fk,SUM(req_item_quantity) AS branch_qty_sum FROM ntbl_bs_stockrequests where req_status = 1 GROUP BY req_item_id_fk) branch_req','branch_req.req_item_id_fk=ntbl_bs_openingstock.os_item_id_fk','left');
		$this->db->join('(SELECT btob_item_id_fk,btob_to_branch_id_fk,SUM(CASE WHEN btob_to_branch_id_fk = '.$branch_id.' THEN btob_quantity ELSE 0 END) AS brach_r_qty_sum FROM ntbl_bs_branchtobranch where is_approved = 1 GROUP BY btob_to_branch_id_fk) branch_recieved','branch_recieved.btob_item_id_fk=ntbl_bs_openingstock.os_item_id_fk','left');
		$this->db->join('(SELECT btob_item_id_fk,btob_branch_id_fk,SUM(CASE WHEN btob_branch_id_fk = '.$branch_id.' THEN btob_quantity ELSE 0 END) AS brach_g_qty_sum FROM ntbl_bs_branchtobranch where is_approved = 1 GROUP BY btob_branch_id_fk) branch_given','branch_given.btob_item_id_fk=ntbl_bs_openingstock.os_item_id_fk','left');
		$this->db->join('(SELECT issued_branch_id_fk,issued_item_id_fk,SUM(issued_quantity) AS brach_issue_qty_sum FROM ntbl_bs_issuedstock where is_approved = 1 GROUP BY issued_item_id_fk) branch_issue','branch_issue.issued_item_id_fk=ntbl_bs_openingstock.os_item_id_fk','left');
		$this->db->join('(SELECT return_branch_id_fk,return_item_id_fk,SUM(return_quantity) AS branch_ret_qty_sum FROM ntbl_bs_returntomaster where is_approved = 1 GROUP BY return_item_id_fk) branch_return','branch_return.return_item_id_fk=ntbl_bs_openingstock.os_item_id_fk','left');
		$this->db->where('os_branch_id_fk',$branch_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getBranchRopCount($branch_id)
	{
		$this->db->select('COUNT(rop_branch_id) AS br_rop_count');
		$this->db->from('ntbl_rop_branch');
		$this->db->where('rop_branch_id_fk',$branch_id);
		$query = $this->db->get();
		return $query->result();
	}


	public function getBranchRopTable($branch_id)
	{
		$this->db->select('item_id,item_name,rop_branch_ROP,br_total_stck,CASE WHEN(rop_branch_ROP > br_total_stck) THEN 2 WHEN(rop_branch_ROP < br_total_stck) THEN 1 WHEN(br_total_stck = 0) THEN 0 END AS br_rop_stat');
		$this->db->from('ntbl_rop_branch');
		$this->db->join('(SELECT item_name,item_id,os_branch_id_fk,(COALESCE(os_quantity, 0) + COALESCE(branch_qty_sum, 0) + COALESCE(brach_r_qty_sum, 0) - COALESCE(brach_g_qty_sum, 0) - COALESCE(brach_issue_qty_sum, 0) - COALESCE(branch_ret_qty_sum, 0)) AS br_total_stck FROM `ntbl_bs_openingstock` LEFT JOIN `ntbl_items` ON `ntbl_items`.`item_id`=`ntbl_bs_openingstock`.`os_item_id_fk` LEFT JOIN (SELECT req_item_id_fk,req_branch_id_fk,SUM(req_item_quantity) AS branch_qty_sum FROM ntbl_bs_stockrequests where req_status = 1 GROUP BY req_item_id_fk) branch_req ON `branch_req`.`req_item_id_fk`=`ntbl_bs_openingstock`.`os_item_id_fk` LEFT JOIN (SELECT btob_item_id_fk,btob_to_branch_id_fk,SUM(CASE WHEN btob_to_branch_id_fk = '.$branch_id.' THEN btob_quantity ELSE 0 END) AS brach_r_qty_sum FROM ntbl_bs_branchtobranch where is_approved = 1 GROUP BY btob_to_branch_id_fk) branch_recieved ON `branch_recieved`.`btob_item_id_fk`=`ntbl_bs_openingstock`.`os_item_id_fk` LEFT JOIN (SELECT btob_item_id_fk,btob_branch_id_fk,SUM(CASE WHEN btob_branch_id_fk = '.$branch_id.' THEN btob_quantity ELSE 0 END) AS brach_g_qty_sum FROM ntbl_bs_branchtobranch where is_approved = 1 GROUP BY btob_branch_id_fk) branch_given ON `branch_given`.`btob_item_id_fk`=`ntbl_bs_openingstock`.`os_item_id_fk` LEFT JOIN (SELECT issued_branch_id_fk,issued_item_id_fk,SUM(issued_quantity) AS brach_issue_qty_sum FROM ntbl_bs_issuedstock where is_approved = 1 GROUP BY issued_item_id_fk) branch_issue ON `branch_issue`.`issued_item_id_fk`=`ntbl_bs_openingstock`.`os_item_id_fk` LEFT JOIN (SELECT return_branch_id_fk,return_item_id_fk,SUM(return_quantity) AS branch_ret_qty_sum FROM ntbl_bs_returntomaster where is_approved = 1 GROUP BY return_item_id_fk) branch_return ON `branch_return`.`return_item_id_fk`=`ntbl_bs_openingstock`.`os_item_id_fk` WHERE `os_branch_id_fk` = 2) AS br_stck_cnt','br_stck_cnt.os_branch_id_fk=ntbl_rop_branch.rop_branch_id_fk','left');
		$this->db->where('rop_branch_status',1);
		$this->db->where('rop_branch_id_fk',$branch_id);
		$this->db->order_by('rop_branch_id','DESC');
		$query = $this->db->get();
		return $data['data'] = $query->result_array();
	}

	public function getempCount($branch_name)
	{
		$this->db->select('COUNT(emp_id) AS emp_id');
		$this->db->from('ntbl_branch_employees');
		$this->db->where('branch_name',$branch_name);
		$query = $this->db->get();
		return $query->result();
	}

	public function getBtoblist($branch_id)
	{
		$this->db->select('COUNT(btob_id) AS btob_id');
		$this->db->from('ntbl_bs_branchtobranch');
		$this->db->where('btob_branch_id_fk',$branch_id);
		$this->db->where('is_approved',1);
		$query = $this->db->get();
		return $query->result();

	}

	public function get_branch_return_to_master_count($branch_id){
		$condition=[
			'return_branch_id_fk'=>$branch_id
		];
		$query=$this->db->select_sum('return_quantity')->where($condition)->get('ntbl_bs_returntomaster');
		$result=$query->row()->return_quantity;
		return $result;
	}
}


?>
