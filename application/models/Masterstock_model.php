<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Masterstock_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}
	public function getStockTable($param)
	{
		$arOrder = array('', 'branch');
		$branch = (isset($param['branch'])) ? $param['branch'] : '';
		$searchValue = ($param['searchValue']) ? $param['searchValue'] : '';

		// if($branch){
		// $this->db->where('tbl_stock.branch_id_fk', $branch);
		// }
		// $this->db->where('stock_status',1);
		// if ($param['start'] != 'false' and $param['length'] != 'false') {
		// $this->db->limit($param['length'],$param['start']);
		// }
		//$sql ="SELECT COALESCE(t4.item_rop, 0) AS master_rop,t3.*,t1.*,t1.item_quantity - COALESCE(t2.item_quantity, 0) AS remaining_qty FROM tbl_stock t1 LEFT JOIN (SELECT item_id_fk, SUM(item_quantity) AS item_quantity FROM tbl_shopstock where status = 1 GROUP BY item_id_fk) t2 ON t1.item_id_fk=t2.item_id_fk JOIN tbl_stockup t3 ON t3.stock_id_fk=t1.stock_id LEFT JOIN tbl_master_rop t4 ON t1.item_id_fk=t4.item_id_fk where stock_status=1 order by master_rop<=remaining_qty , remaining_qty<=0 desc";
		$sql = "SELECT COALESCE(t5.opening_stock,0) AS opening_stock,t7.issue_qty,
				COALESCE(t6.purchase_quantity,0) AS purchase_quantity,
				COALESCE(t4.item_rop, 0) AS master_rop,t3.*,t1.*,t1.item_quantity + t5.opening_stock AS remaining_qty FROM tbl_stock t1
				LEFT JOIN (SELECT item_id_fk, SUM(item_quantity)
				AS item_quantity FROM tbl_shopstock where status = 1 GROUP BY item_id_fk) t2 ON
				t1.item_id_fk=t2.item_id_fk JOIN tbl_stockup t3 ON t3.stock_id_fk=t1.stock_id
				LEFT JOIN tbl_master_rop t4 ON t1.item_id_fk=t4.item_id_fk
				LEFT JOIN ( SELECT item_quantity AS opening_stock,item_id_fk
				FROM tbl_opening_stock WHERE branch_id_fk=0 ) t5 ON t5.item_id_fk=t1.item_id_fk
				LEFT JOIN (SELECT SUM(item_quantity) AS purchase_quantity,item_id_fk FROM tbl_apurchase) t6
				ON t6.item_id_fk=t2.item_id_fk LEFT JOIN (SELECT SUM(issue_quantity) AS issue_qty,item_id_fk FROM tbl_issueitem) t7
				ON t7.item_id_fk=t2.item_id_fk where t1.stock_status=1 ";

		if ($searchValue) {

			$sql .= "  AND item_name LIKE '%$searchValue%'";
		}
		$sql .= " order by master_rop<=remaining_qty , remaining_qty<=0 desc";

		if ($param['start'] != 'false' and $param['length'] != 'false') {
			$length = $param['length'];
			$start = $param['start'];
			$sql .= " limit $start,$length";
		}

		$query = $this->db->query($sql);
		// 	print_r($this->db->last_query());
		//  exit();

		$data['data'] = $query->result();
		//  print_r($data['data']);
		//  exit();
		$data['recordsTotal'] = $this->getStockTotalCount($param);
		$data['recordsFiltered'] = $this->getStockTotalCount($param);
		return $data;
	}

	public function getStockTotalCount($param = NULL)
	{
		$branch = (isset($param['branch'])) ? $param['branch'] : '';
		if ($branch) {
			$this->db->where('tbl_stock.branch_id_fk', $branch);
		}
		$this->db->select('*');
		$this->db->from('tbl_stock');
		$this->db->join('tbl_stockup', 'tbl_stockup.stock_id_fk = tbl_stock.stock_id');
		$this->db->where('stock_status', 1);
		$this->db->order_by('stock_id', 'DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function getbranch($uid)
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('login_id_fk', $uid);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		return false;
	}
	public function getitems($ref_number)
	{
		$this->db->select('*');
		$this->db->from('tbl_apurchase');
		$this->db->where('pr_status', 1);
		$this->db->where('ref_number', $ref_number);
		$query = $this->db->get();
		return $query->result();
	}
	public function getPurchase($prid)
	{
		$this->db->select('*');
		$this->db->from('tbl_apurchase');
		$this->db->where('pr_status', 1);
		$this->db->where('pr_id', $prid);
		$query = $this->db->get();
		return $query->result();
	}
	public function checkitem($brid, $item)
	{
		$this->db->select('*');
		$this->db->from('tbl_stock');
		$this->db->where('branch_id_fk', $brid);
		$this->db->where('item_id_fk', $item);
		$this->db->where('stock_status', 1);
		$query = $this->db->get();
		return $query->row();
	}
	public function update($table, $data, $primaryfield, $id, $secondaryfield, $idd)
	{
		$this->db->where($primaryfield, $id);
		$this->db->where($secondaryfield, $idd);
		$q = $this->db->update($table, $data);
		return $q;
	}
	public function get_rop($brid, $item)
	{
		$this->db->select('item_rop');
		$this->db->from('tbl_rop');
		$this->db->where('branch_id_fk', $brid);
		$this->db->where('item_id_fk', $item);
		$query = $this->db->get();
		return $query->row();
	}
	public function getCount($refno)
	{
		$this->db->select('count(pr_id) as cnt');
		$this->db->from('tbl_apurchase');
		$this->db->where('ref_number', $refno);
		$this->db->where('cc', 1);
		$this->db->where('delivery', 1);
		$query = $this->db->get();
		return $query->row();
	}

	public function getBstock(){
		$sql = "SELECT COALESCE(t5.item_rop, 0) AS item_rop,t4.branch_name,t3.item_name,
		(CASE WHEN t2.updated_date IS NULL THEN t1.issue_date ELSE t2.updated_date END) AS date,
		t2.shop_id_fk,t2.item_id_fk,t2.total_qty-(COALESCE(t1.total_issue_qty,0) + COALESCE(t6.total_return_qty,0) + COALESCE(t7.branch_qty,0)) as total
		FROM (SELECT branch_id_fk,item_id_fk,issue_date,SUM(issue_quantity) as total_issue_qty FROM tbl_issueitem GROUP BY item_id_fk) t1
		RIGHT JOIN (SELECT id,item_id_fk,SUM(item_quantity) as total_qty,
		max(updated_date) as updated_date,shop_id_fk FROM tbl_shopstock GROUP BY item_id_fk) t2 ON t2.item_id_fk=t1.item_id_fk
		LEFT JOIN (SELECT branch_id_fk,item_id_fk,return_date,SUM(item_quantity) as total_return_qty
		FROM tbl_returnproduct GROUP BY item_id_fk) t6 ON t6.item_id_fk=t2.item_id_fk
		LEFT JOIN (SELECT item_id_fk,from_branch_id_fk,SUM(item_quantity) branch_qty
		from tbl_branch_to_branch where status = 1 GROUP BY item_id_fk) t7 ON t7.item_id_fk=t2.item_id_fk
		Join tbl_item t3 on t3.item_id=t2.item_id_fk join tbl_branch t4 on t4.branch_id = t2.shop_id_fk
		join tbl_rop t5 on t2.item_id_fk=t5.item_id_fk and t2.shop_id_fk=t5.branch_id_fk order by id desc";
		$query = $this->db->query($sql);
		$data['data'] = $query->result();
		return $data;
	}

	public function get_issued($item_id)
	{
		return $this->db->select('COALESCE(SUM(issue_quantity),0) AS issued')->from('tbl_issueitem')->where('item_id_fk', $item_id)->where('master_status', 1)->get()->result();
	}
	public function get_request($item_id)
	{
		return $this->db->select('COALESCE(SUM(request_quantity),0) AS request')->from('tbl_request_item')->where('item_id_fk', $item_id)->where('request_status', 0)->get()->result();
	}
	public function get_branch_stock_return($item_id){
		$this->db->select('*');
        $this->db->from('tbl_returnproduct');
        $this->db->join('tbl_item','tbl_item.item_id = tbl_returnproduct.item_id_fk');
        $this->db->join('tbl_branch','tbl_branch.branch_id = tbl_returnproduct.branch_id_fk');
        $this->db->order_by('return_id', 'DESC');
        $query = $this->db->get();
        $data['data'] = $query->result_array();
        // return $data;



		//selecting data based on input item_id
		$allowed  = array('branch_id_fk', 'item_id_fk', 'item_quantity');
		$filtered_array=array();

		for($i=0;$i<count($data['data']);$i++){
			foreach($data['data'][$i] as $key=>$value){
				if(in_array($key,$allowed)){
					$filtered[$key]=$value;
					array_push($filtered_array,$filtered); // filtered array is set here
				}
			}

		}
		for($i=0;$i<count($filtered_array);$i++){
			if(!isset($filtered_array[$i]["item_id_fk"])){
				$filtered_array[$i]["item_id_fk"]="null";
			}
			if(!isset($filtered_array[$i]["item_quantity"])){
				$filtered_array[$i]["item_quantity"]="null";
			}
		}

		// if(in_array($key,$allowed)){
		// 	$filtered[$key]=$value;
		// 	array_push($filtered_array,$filtered);
		// }
		$total_quantity=array();
		foreach($filtered_array as $key=>$value){
			echo "asd".$item_id;
			if($value["item_id_fk"] == $item_id){
				echo"1-";
			}
		}
	}

	// Function to get itemwise count of stock returned by all the branches

	public function get_each_branch_return_stock(){
		$this->db->select('*');
        $this->db->from('tbl_returnproduct');
        $this->db->join('tbl_item','tbl_item.item_id = tbl_returnproduct.item_id_fk');
        $this->db->join('tbl_branch','tbl_branch.branch_id = tbl_returnproduct.branch_id_fk');
        $this->db->order_by('return_id', 'DESC');

        $query = $this->db->get();
        $data['data'] = $query->result_array();
        return $data;
	}

	// Function for fetch all stock returns for a single stock item | input = stock_item_id
	public function get_itemwise_stock_returns($id){
		$this->db->select('item_quantity');
		$this->db->where('item_id_fk',$id);
		$query=$this->db->get('tbl_returnproduct');
		$records=$query->result_array();

		$response=array();
		for($i=0;$i<count($records);$i++){
			array_push($response,$records[$i]["item_quantity"]);
		}
		if(empty($records)){
			$result['sum_of_item_quantity']=0;
			$result['matching_count']=0;
		}
		$result['matching_count']=count($response);
		$result['matching_items']=$response;
		$result['sum_of_item_quantity']=array_sum($response);
		return $result;
	}

	public function getNewMasterStock(){
		$query=$this->db->select('*')->get('tbl_stock');
		$result=$query->result();
		return $result;
	}


	public function getVendorListsTable()
	{
		$this->db->select('*');
		$this->db->from('ntbl_vendor');
		$this->db->where('vendor_status',1);
		$query = $this->db->get();
		return $data['data'] = $query->result();

	}

	public function getPurchaseListsTable()
	{
		$this->db->select('*');
		$this->db->join('ntbl_vendor','ntbl_vendor.vendor_id=ntbl_purchase.purchase_vendor_id_fk');
		$this->db->join('ntbl_items','ntbl_items.item_id=ntbl_purchase.purchase_item_id_fk');
		$this->db->from('ntbl_purchase');
		$this->db->where('purchase_status',1);
		$query = $this->db->get();
		return $data['data'] = $query->result();

	}

	public function getROPmasterTable()
	{
		$this->db->select('*,COALESCE(rop_master_ROP,0) AS rop_master_rops,ntbl_rop_master.updated_at as updated_date,ntbl_rop_master.*');
		// $this->db->join('ntbl_items','ntbl_items.item_id=ntbl_rop_master.rop_master_item_id_fk');
		// $this->db->from('ntbl_rop_master');
		$this->db->join('ntbl_rop_master','ntbl_rop_master.rop_master_item_id_fk=ntbl_items.item_id','left');
		$this->db->from('ntbl_items');
		// $this->db->where('rop_master_status',1);
		$this->db->where('item_status',1);
		$query = $this->db->get();
		return $data['data'] = $query->result();

	}

	public function getROPbranchTable()
	{
		$this->db->select('*');
		$this->db->join('ntbl_items','ntbl_items.item_id=ntbl_rop_branch.rop_branch_item_id_fk');
		$this->db->join('ntbl_branches','ntbl_branches.branch_id=ntbl_rop_branch.rop_branch_id_fk');
		$this->db->from('ntbl_rop_branch');
		$this->db->where('rop_branch_status',1);
		$query = $this->db->get();
		return $data['data'] = $query->result();

	}

	public function getEditRopMasterList($item_id)
	{
		$this->db->select('*');
		$this->db->join('ntbl_rop_master','ntbl_rop_master.rop_master_item_id_fk=ntbl_items.item_id','left');
		$this->db->from('ntbl_items');
		$this->db->where('item_id',$item_id);
		$this->db->where('item_status',1);
		$query = $this->db->get();
		return $data = $query->result();

	}

	public function getMasterStocklist(){
		$this->db->select('*,COALESCE(os_quantity,0) AS opening_stck_qty');
		$this->db->join('ntbl_master_os','ntbl_master_os.os_item_id_fk=ntbl_items.item_id','left');
		$this->db->join('ntbl_category','ntbl_category.cate_id=ntbl_items.cate_id_fk','left');
		$this->db->from('ntbl_items');
		$this->db->where('item_status',1);
		$this->db->order_by('item_name','ASC');
		$query = $this->db->get();
		return $data['data'] = $query->result();
	}

	public function getB2bRequestList()
	{
		$this->db->select('ntbl_bs_branchtobranch.btob_id as b2b_id,giver_br.branch_name AS given_br_name,recieve_br.branch_name AS recieved_br_name,ntbl_items.item_name as item_names,ntbl_bs_branchtobranch.btob_quantity as b2b_quantity,ntbl_bs_branchtobranch.is_approved as approval,ntbl_bs_branchtobranch.btob_status as b2b_status,COALESCE(ntbl_bs_branchtobranch.btob_remarks,"No Remark") as b2b_remark');
		$this->db->join('ntbl_branches AS giver_br','giver_br.branch_id=ntbl_bs_branchtobranch.btob_branch_id_fk','left');
		$this->db->join('ntbl_branches AS recieve_br','recieve_br.branch_id=ntbl_bs_branchtobranch.btob_to_branch_id_fk','left');
		$this->db->join('ntbl_items','ntbl_items.item_id=ntbl_bs_branchtobranch.btob_item_id_fk');
		$this->db->from('ntbl_bs_branchtobranch');
		$this->db->where('item_status',1);
		$query = $this->db->get();
		return $data['data'] = $query->result();
	}

	public function getBranchReturnListTable(){
		$this->db->select('*');
		$this->db->join('ntbl_branches','ntbl_branches.branch_id=ntbl_bs_returntomaster.return_branch_id_fk');
		$this->db->join('ntbl_items','ntbl_items.item_id=ntbl_bs_returntomaster.return_item_id_fk');
		$this->db->from('ntbl_bs_returntomaster');
		$this->db->where('return_status',1);
		$query = $this->db->get();
		return $data['data'] = $query->result();
	}


	public function getPurchaseStockListTable()
	{
		$this->db->select('*');
		$this->db->join('ntbl_items','ntbl_items.item_id=ntbl_purchase.purchase_item_id_fk');
		$this->db->from('ntbl_purchase');
		$this->db->where('purchase_status',1);
		$query = $this->db->get();
		return $data['data'] = $query->result();
	}


	public function getMasterStockListTable()
	{
		$this->db->select('item_name,COALESCE(os_quantity,0) AS os_quantity,COALESCE(return_qty,0) AS return_qty,COALESCE(purchase_qty,0) AS purchase_qty,COALESCE(pur_rtrn_qty,0) AS pur_rtrn_qty,COALESCE(req_item_quantity,0) AS req_item_quantity,(COALESCE(os_quantity,0) + COALESCE(return_qty,0) + COALESCE(purchase_qty,0) - COALESCE(req_item_quantity,0) - COALESCE(pur_rtrn_qty,0)) AS Total_qty');
		$this->db->join('(SELECT os_item_id_fk,os_quantity FROM ntbl_master_os where os_status = 1) mstr_os','mstr_os.os_item_id_fk=ntbl_items.item_id','left');
		$this->db->join('(SELECT return_item_id_fk,SUM(return_quantity) AS return_qty FROM ntbl_bs_returntomaster where is_approved = 1 GROUP BY return_item_id_fk) return_to_master','return_to_master.return_item_id_fk=ntbl_items.item_id','left');
		$this->db->join('(SELECT purchase_item_id_fk,SUM(purchase_qty) AS purchase_qty FROM ntbl_purchase where purchase_status = 1 GROUP BY purchase_item_id_fk) mstr_purchase','mstr_purchase.purchase_item_id_fk=ntbl_items.item_id','left');
		$this->db->join('(SELECT pur_rtrn_item_id,SUM(pur_rtrn_qty) AS pur_rtrn_qty FROM ntbl_purchase_return where pur_rtrn_status = 1 GROUP BY pur_rtrn_item_id) mstr_purchase_rtn','mstr_purchase_rtn.pur_rtrn_item_id=ntbl_items.item_id','left');
		//$this->db->join('(SELECT btob_item_id_fk,SUM(btob_quantity) AS btob_quantity FROM ntbl_bs_branchtobranch where is_approved = 1 GROUP BY btob_item_id_fk) mstr_given','mstr_given.btob_item_id_fk=ntbl_items.item_id','left');
		$this->db->join('(SELECT req_item_id_fk,SUM(req_item_quantity) AS req_item_quantity FROM ntbl_bs_stockrequests where req_status = 1 GROUP BY req_item_id_fk) mstr_given','mstr_given.req_item_id_fk=ntbl_items.item_id','left');
		$this->db->from('ntbl_items');
		$this->db->where('item_status',1);
		$this->db->order_by('item_name','ASC');
		$query = $this->db->get();
		return $data['data'] = $query->result();

	}

	public function getPurchaseReturnList()
	{
		$this->db->select('*');
		$this->db->join('ntbl_items','ntbl_items.item_id=ntbl_purchase_return.pur_rtrn_item_id');
		$this->db->from('ntbl_purchase_return');
		$this->db->where('pur_rtrn_status',1);
		$query = $this->db->get();
		return $data['data'] = $query->result();
	}

	public function getPurchaseEditList($purchase_id)
	{
		$this->db->select('*');
		$this->db->from('ntbl_purchase');
		$this->db->where('purchase_status',1);
		$this->db->where('purchase_id',$purchase_id);
		$query = $this->db->get();
		return $data = $query->result();
	}

	public function getPurchaseListsTables()
	{
		$this->db->select('*,COALESCE(ntbl_purchase_return.pur_rtrn_qty,0) AS rtrn_qtys,COALESCE(ntbl_purchase_return.pur_rtrn_amt,0) AS rtrn_amts,COALESCE(ntbl_purchase_return.updated_at,0) AS rtrn_dates');
		$this->db->join('ntbl_vendor','ntbl_vendor.vendor_id=ntbl_purchase.purchase_vendor_id_fk');
		$this->db->join('ntbl_items','ntbl_items.item_id=ntbl_purchase.purchase_item_id_fk');
		$this->db->join('ntbl_purchase_return','ntbl_purchase_return.pur_rtrn_fk_id=ntbl_purchase.purchase_id','left');
		$this->db->from('ntbl_purchase');
		$this->db->where('purchase_status',1);
		$query = $this->db->get();
		return $data['data'] = $query->result();

	}

	public function getEmployeeListTable()
	{
		$this->db->select('*');
		$this->db->from('ntbl_branch_employees');
		$this->db->join('ntbl_designation','ntbl_designation.desg_id=ntbl_branch_employees.desg_id_fk','left');
		$this->db->where('emp_status',1);
		$this->db->order_by('emp_id','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function getAjaxTotalStocks($item_id)
	{
		$this->db->select('item_name,COALESCE(os_quantity,0) AS os_quantity,COALESCE(return_qty,0) AS return_qty,COALESCE(purchase_qty,0) AS purchase_qty,COALESCE(pur_rtrn_qty,0) AS pur_rtrn_qty,COALESCE(req_item_quantity,0) AS req_item_quantity,(COALESCE(os_quantity,0) + COALESCE(return_qty,0) + COALESCE(purchase_qty,0) - COALESCE(req_item_quantity,0) - COALESCE(pur_rtrn_qty,0)) AS Total_qty');
		$this->db->join('(SELECT os_item_id_fk,os_quantity FROM ntbl_master_os where os_status = 1) mstr_os','mstr_os.os_item_id_fk=ntbl_items.item_id','left');
		$this->db->join('(SELECT return_item_id_fk,SUM(return_quantity) AS return_qty FROM ntbl_bs_returntomaster where is_approved = 1 GROUP BY return_item_id_fk) return_to_master','return_to_master.return_item_id_fk=ntbl_items.item_id','left');
		$this->db->join('(SELECT purchase_item_id_fk,SUM(purchase_qty) AS purchase_qty FROM ntbl_purchase where purchase_status = 1 GROUP BY purchase_item_id_fk) mstr_purchase','mstr_purchase.purchase_item_id_fk=ntbl_items.item_id','left');
		$this->db->join('(SELECT pur_rtrn_item_id,SUM(pur_rtrn_qty) AS pur_rtrn_qty FROM ntbl_purchase_return where pur_rtrn_status = 1 GROUP BY pur_rtrn_item_id) mstr_purchase_rtn','mstr_purchase_rtn.pur_rtrn_item_id=ntbl_items.item_id','left');
		//$this->db->join('(SELECT btob_item_id_fk,SUM(btob_quantity) AS btob_quantity FROM ntbl_bs_branchtobranch where is_approved = 1 GROUP BY btob_item_id_fk) mstr_given','mstr_given.btob_item_id_fk=ntbl_items.item_id','left');
		$this->db->join('(SELECT req_item_id_fk,SUM(req_item_quantity) AS req_item_quantity FROM ntbl_bs_stockrequests where req_status = 1 GROUP BY req_item_id_fk) mstr_given','mstr_given.req_item_id_fk=ntbl_items.item_id','left');
		$this->db->from('ntbl_items');
		$this->db->where('item_status',1);
		$this->db->where('item_id',$item_id);
		$query = $this->db->get();
		return $data['data'] = $query->result();
	}

	public function getDesignationTable()
	{
		$this->db->select('*');
		$this->db->from('ntbl_designation');
		$this->db->where('desg_status',1);
		$this->db->order_by('desg_id','DESC');
		$query = $this->db->get();
		return $data['data'] = $query->result();
	}

	public function getCategoryTable()
	{
		$this->db->select('*');
		$this->db->from('ntbl_category');
		$this->db->where('cate_status',1);
		$this->db->order_by('cate_id','DESC');
		$query = $this->db->get();
		return $data['data'] = $query->result();
	}

	public function getMasterRopTable()
	{
		$this->db->select('item_id,item_name,rop_master_ROP,Total_qty,CASE WHEN(rop_master_ROP > Total_qty) THEN 1 WHEN(rop_master_ROP < Total_qty) THEN 2 WHEN(Total_qty = 0) THEN 0 END AS m_rop_stat');
		$this->db->from('ntbl_rop_master');
		$this->db->join('(SELECT `item_name`,`item_id`, COALESCE(os_quantity, 0) AS os_quantity, COALESCE(return_qty, 0) AS return_qty, COALESCE(purchase_qty, 0) AS purchase_qty, COALESCE(pur_rtrn_qty, 0) AS pur_rtrn_qty, COALESCE(req_item_quantity, 0) AS req_item_quantity, (COALESCE(os_quantity, 0) + COALESCE(return_qty, 0) + COALESCE(purchase_qty, 0) - COALESCE(req_item_quantity, 0) - COALESCE(pur_rtrn_qty, 0)) AS Total_qty FROM `ntbl_items` LEFT JOIN (SELECT os_item_id_fk,os_quantity FROM ntbl_master_os where os_status = 1) mstr_os ON `mstr_os`.`os_item_id_fk`=`ntbl_items`.`item_id` LEFT JOIN (SELECT return_item_id_fk,SUM(return_quantity) AS return_qty FROM ntbl_bs_returntomaster where is_approved = 1 GROUP BY return_item_id_fk) return_to_master ON `return_to_master`.`return_item_id_fk`=`ntbl_items`.`item_id` LEFT JOIN (SELECT purchase_item_id_fk,SUM(purchase_qty) AS purchase_qty FROM ntbl_purchase where purchase_status = 1 GROUP BY purchase_item_id_fk) mstr_purchase ON `mstr_purchase`.`purchase_item_id_fk`=`ntbl_items`.`item_id` LEFT JOIN (SELECT pur_rtrn_item_id,SUM(pur_rtrn_qty) AS pur_rtrn_qty FROM ntbl_purchase_return where pur_rtrn_status = 1 GROUP BY pur_rtrn_item_id) mstr_purchase_rtn ON `mstr_purchase_rtn`.`pur_rtrn_item_id`=`ntbl_items`.`item_id` LEFT JOIN (SELECT req_item_id_fk,SUM(req_item_quantity) AS req_item_quantity FROM ntbl_bs_stockrequests where req_status = 1 GROUP BY req_item_id_fk) mstr_given ON `mstr_given`.`req_item_id_fk`=`ntbl_items`.`item_id` WHERE `item_status` = 1) AS m_stck_cnt','m_stck_cnt.item_id=ntbl_rop_master.rop_master_item_id_fk','left');
		$this->db->where('rop_master_status',1);
		$this->db->order_by('m_rop_stat','ASC');
		$query = $this->db->get();
		return $data['data'] = $query->result_array();
	}

	public function getLoginUserTable()
	{
		$this->db->select('*');
		$this->db->from('tbl_login');
		$this->db->where('user_type','S');
		$this->db->order_by('id','DESC');
		$query = $this->db->get();
		return $data['data'] = $query->result();
	}

	public function editLoginUsersTable($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_login');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $result = $query->result();
	}

	public function getajaxItemTable()
	{
		$this->db->select('item_id,item_name');
		$this->db->from('ntbl_items');
		$this->db->where('item_status',1);
		$query = $this->db->get();
		return $result = $query->result();
	}

	public function getVendorPayList()
	{
		$this->db->select('*,SUM(purchase_amt) AS purchase_amts');
		$this->db->from('ntbl_vendor');
		$this->db->join('(SELECT purchase_vendor_id_fk,purchase_id,COALESCE(purchase_amt,0) AS purchase_amt FROM ntbl_purchase) AS ntbl_purchases','ntbl_purchases.purchase_vendor_id_fk=ntbl_vendor.vendor_id','left');
		$this->db->join('ntbl_vendor_pay','ntbl_vendor_pay.vendor_id_fk=ntbl_vendor.vendor_id','left');
		$this->db->where('ntbl_vendor.vendor_status',1);
		$query = $this->db->get();
		return $data['data'] = $query->result();
	}

	public function getvendorPaymentadddetails($vendor_id)
	{
		$this->db->select('*,SUM(purchase_amt) AS purchase_amts');
		$this->db->from('ntbl_vendor');
		$this->db->join('(SELECT purchase_vendor_id_fk,purchase_id,COALESCE(purchase_amt,0) AS purchase_amt FROM ntbl_purchase) AS ntbl_purchases','ntbl_purchases.purchase_vendor_id_fk=ntbl_vendor.vendor_id','left');
		$this->db->join('ntbl_vendor_pay','ntbl_vendor_pay.vendor_id_fk=ntbl_vendor.vendor_id','left');
		$this->db->where('ntbl_vendor.vendor_status',1);
		$this->db->where('vendor_id',$vendor_id);
		$query = $this->db->get();
		return $result = $query->result();
	}

	public function getBranchOpeningStock($param,$condition,$branch_id)
	{
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		if($searchValue){
			$this->db->like('ntbl_branches.branch_name', $searchValue);
			//$this->db->or_like('ntbl_items.item_name', $searchValue);
		}
		if ($param['start'] != 'false' and $param['length'] != 'false') {
			$this->db->limit($param['length'],$param['start']);
		}
		$this->db->select('item_name,branch_name,COALESCE(os_quantity,0) AS os_quantity,COALESCE(branch_qty_sum,0) AS branch_qty_sum,COALESCE(brach_r_qty_sum,0) AS brach_r_qty_sum,COALESCE(brach_g_qty_sum,0) AS brach_g_qty_sum,COALESCE(brach_issue_qty_sum,0) AS brach_issue_qty_sum,COALESCE(branch_ret_qty_sum,0) AS branch_ret_qty_sum,(COALESCE(os_quantity,0) + COALESCE(branch_qty_sum,0) + COALESCE(brach_r_qty_sum,0) - COALESCE(brach_g_qty_sum,0) - COALESCE(brach_issue_qty_sum,0) - COALESCE(branch_ret_qty_sum,0)) AS br_total_stck');
		$this->db->from('ntbl_bs_openingstock');
		$this->db->join('ntbl_branches','ntbl_branches.branch_id=ntbl_bs_openingstock.os_branch_id_fk','left');
		$this->db->join('ntbl_items','ntbl_items.item_id=ntbl_bs_openingstock.os_item_id_fk','left');
		$this->db->join('(SELECT req_item_id_fk,req_branch_id_fk,SUM(req_item_quantity) AS branch_qty_sum FROM ntbl_bs_stockrequests where req_status = 1 GROUP BY req_item_id_fk) branch_req','branch_req.req_item_id_fk=ntbl_bs_openingstock.os_item_id_fk','left');
		$this->db->join('(SELECT btob_item_id_fk,btob_to_branch_id_fk,SUM(CASE WHEN btob_to_branch_id_fk = '.$branch_id.' THEN btob_quantity ELSE 0 END) AS brach_r_qty_sum FROM ntbl_bs_branchtobranch where is_approved = 1 GROUP BY btob_to_branch_id_fk) branch_recieved','branch_recieved.btob_item_id_fk=ntbl_bs_openingstock.os_item_id_fk','left');
		$this->db->join('(SELECT btob_item_id_fk,btob_branch_id_fk,SUM(CASE WHEN btob_branch_id_fk = '.$branch_id.' THEN btob_quantity ELSE 0 END) AS brach_g_qty_sum FROM ntbl_bs_branchtobranch where is_approved = 1 GROUP BY btob_branch_id_fk) branch_given','branch_given.btob_item_id_fk=ntbl_bs_openingstock.os_item_id_fk','left');
		$this->db->join('(SELECT issued_branch_id_fk,issued_item_id_fk,SUM(issued_quantity) AS brach_issue_qty_sum FROM ntbl_bs_issuedstock where is_approved = 1 GROUP BY issued_item_id_fk) branch_issue','branch_issue.issued_item_id_fk=ntbl_bs_openingstock.os_item_id_fk','left');
		$this->db->join('(SELECT return_branch_id_fk,return_item_id_fk,SUM(return_quantity) AS branch_ret_qty_sum FROM ntbl_bs_returntomaster where is_approved = 1 GROUP BY return_item_id_fk) branch_return','branch_return.return_item_id_fk=ntbl_bs_openingstock.os_item_id_fk','left');
		$this->db->where('os_branch_id_fk',$branch_id);
		$this->db->order_by('item_name','ASC');
		$query = $this->db->get();
		$data['data'] = $query->result();
		$data['recordsTotal']=$query->num_rows();
    	$data['recordsFiltered']=$query->num_rows();
    	return $data['data'] ? $data : false;
	}



	public function getBranchTable2($param){
		$arOrder = array('','branch_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('branch_name', $searchValue);
        }
        $this->db->where("branch_status",1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('ntbl_branches');
		$this->db->order_by('branch_id', 'DESC');
        $query = $this->db->get();
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getBranch2TotalCount($param);
        $data['recordsFiltered'] = $this->getBranch2TotalCount($param);
        return $data;

	}

	public function getBranch2TotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('branch_name', $searchValue);
        }
		$this->db->select('*');
		$this->db->from('ntbl_branches');
		$this->db->order_by('branch_id', 'DESC');
        $this->db->where("branch_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }

	public function getEditBranchList($branch_id)
	{
		$this->db->select('*');
		$this->db->from('ntbl_branches');
		$this->db->where('branch_id',$branch_id);
		$query = $this->db->get();
		return $query->result();
	}

}
