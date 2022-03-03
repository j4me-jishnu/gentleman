<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stock_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
    public function getStockTable($param){
		$arOrder = array('','branch');
		$branch =(isset($param['branch']))?$param['branch']:'';
		if($branch){
            $this->db->where('tbl_stock.branch_id_fk', $branch); 
        }
		$this->db->where('stock_status',1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$this->db->select('*');
		$this->db->from('tbl_stock');
		$this->db->join('tbl_stockup', 'tbl_stockup.stock_id_fk = tbl_stock.stock_id');
		$this->db->order_by('stock_id', 'DESC');
        $query = $this->db->get();
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getStockTotalCount($param);
        $data['recordsFiltered'] = $this->getStockTotalCount($param);
        return $data;

	}
	public function get_request($itemid)
	{
		return $this->db->select('COALESCE(SUM(request_quantity),0) AS request')->from('tbl_request_item
')->where('item_id_fk',$item_id)->where('request_status',0)->get()->result();
	}

	public function getBstock($param,$br_id){
		$arOrder = array('','item');
		$item = (isset($param['item']))?$param['item']:'';
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	//$this->db->limit($param['length'],$param['start']);
        }

        if($item){
          $sql="SELECT COALESCE(t5.item_rop, 0) AS item_rop,t4.branch_name,t3.item_name,(CASE WHEN t1.issue_date IS NULL THEN t2.updated_date ELSE t1.issue_date END) AS date,t2.item_id_fk,t2.total_qty + COALESCE(t8.request_quantity,0) - (COALESCE(t1.total_issue_qty,0) + COALESCE(t6.total_return_qty,0) + COALESCE(t7.branch_qty,0)) as total,COALESCE(t2.total_qty,0) as total_qty,COALESCE(t8.request_quantity,0) as request_quantity,COALESCE(t8.updated_date,0) as updated_date FROM (SELECT max(issue_date) as issue_date, branch_id_fk,item_id_fk,SUM(issue_quantity) as total_issue_qty FROM tbl_issueitem where branch_id_fk = $br_id and item_id_fk like $item GROUP BY item_id_fk,branch_id_fk) t1 RIGHT JOIN (SELECT item_id_fk,SUM(item_quantity) as total_qty,max(updated_date) as updated_date,shop_id_fk FROM tbl_shopstock where shop_id_fk = $br_id and item_id_fk like $item GROUP BY shop_id_fk,item_id_fk) t2 ON t2.item_id_fk=t1.item_id_fk AND t2.shop_id_fk=t1.branch_id_fk LEFT JOIN (SELECT branch_id_fk,item_id_fk,return_date,SUM(item_quantity) as total_return_qty FROM tbl_returnproduct where branch_id_fk = $br_id and item_id_fk like $item GROUP BY item_id_fk,branch_id_fk) t6 ON t6.item_id_fk=t2.item_id_fk AND t6.branch_id_fk=t2.shop_id_fk 
          LEFT JOIN (SELECT branch_id_fk,item_id_fk,request_date,updated_date,SUM(request_quantity) as request_quantity FROM tbl_request_item Where request_status= 0 and branch_id_fk = $br_id and item_id_fk like $item GROUP BY item_id_fk,branch_id_fk) t8  ON t2.item_id_fk=t8.item_id_fk AND t2.shop_id_fk=t8.branch_id_fk
           LEFT JOIN (SELECT item_id_fk,from_branch_id_fk,SUM(item_quantity) branch_qty from tbl_branch_to_branch where status = 1 and from_branch_id_fk = $br_id and item_id_fk like $item GROUP BY from_branch_id_fk,item_id_fk) t7 ON t7.from_branch_id_fk=t2.shop_id_fk AND t7.item_id_fk=t2.item_id_fk Join tbl_item t3 on t3.item_id=t2.item_id_fk join tbl_branch t4 on t4.branch_id = t2.shop_id_fk left join tbl_rop t5 on t2.item_id_fk=t5.item_id_fk and t2.shop_id_fk=t5.branch_id_fk";
        }
        else{
		$sql="SELECT COALESCE(t5.item_rop, 0) AS item_rop,t4.branch_name,t3.item_name,(CASE WHEN t1.issue_date IS NULL THEN t2.updated_date ELSE t1.issue_date END) AS date,t2.item_id_fk,t2.total_qty + COALESCE(t8.request_quantity,0) - (COALESCE(t1.total_issue_qty,0) + COALESCE(t6.total_return_qty,0) + COALESCE(t7.branch_qty,0)) as total,COALESCE(t2.total_qty,0) as total_qty,COALESCE(t8.request_quantity,0) as request_quantity,COALESCE(t8.updated_date,0) as updated_date FROM (SELECT max(issue_date) as issue_date, branch_id_fk,item_id_fk,SUM(issue_quantity) as total_issue_qty FROM tbl_issueitem where branch_id_fk = $br_id GROUP BY item_id_fk,branch_id_fk) t1 RIGHT JOIN (SELECT item_id_fk,SUM(item_quantity) as total_qty,max(updated_date) as updated_date,shop_id_fk FROM tbl_shopstock where shop_id_fk = $br_id GROUP BY shop_id_fk,item_id_fk) t2 ON t2.item_id_fk=t1.item_id_fk AND t2.shop_id_fk=t1.branch_id_fk LEFT JOIN (SELECT branch_id_fk,item_id_fk,return_date,SUM(item_quantity) as total_return_qty FROM tbl_returnproduct where branch_id_fk = $br_id GROUP BY item_id_fk,branch_id_fk) t6 ON t6.item_id_fk=t2.item_id_fk AND t6.branch_id_fk=t2.shop_id_fk 
		LEFT JOIN (SELECT branch_id_fk,item_id_fk,request_date,updated_date,SUM(request_quantity) as request_quantity FROM tbl_request_item Where request_status= 0 and branch_id_fk = $br_id  GROUP BY item_id_fk,branch_id_fk) t8  ON t2.item_id_fk=t8.item_id_fk AND t2.shop_id_fk=t8.branch_id_fk
		 LEFT JOIN (SELECT item_id_fk,from_branch_id_fk,SUM(item_quantity) branch_qty from tbl_branch_to_branch where status = 1 and from_branch_id_fk = $br_id GROUP BY from_branch_id_fk,item_id_fk) t7 ON t7.from_branch_id_fk=t2.shop_id_fk AND t7.item_id_fk=t2.item_id_fk Join tbl_item t3 on t3.item_id=t2.item_id_fk join tbl_branch t4 on t4.branch_id = t2.shop_id_fk left join tbl_rop t5 on t2.item_id_fk=t5.item_id_fk and t2.shop_id_fk=t5.branch_id_fk";
	}

        $query = $this->db->query($sql);
		$data['data'] = $query->result();
        $data['recordsTotal'] = $this->getStockTotalCount($param,$br_id);
        $data['recordsFiltered'] = $this->getStockTotalCount($param,$br_id);
        return $data;

	}

	public function getIssuedQuantity($br_id){
		
		$sql="SELECT (CASE WHEN t1.issue_quantity IS NULL THEN 0 ELSE t1.issue_quantity END) AS last_issued ,(CASE WHEN t1.item_id_fk IS NULL THEN 0 ELSE t1.item_id_fk END) as iid FROM (SELECT * FROM tbl_issueitem t WHERE issue_id=(SELECT MAX(issue_id) FROM tbl_issueitem WHERE t.item_id_fk=item_id_fk AND t.branch_id_fk=branch_id_fk)) t1 RIGHT JOIN (SELECT id,shop_id_fk,item_id_fk FROM tbl_shopstock WHERE shop_id_fk=$br_id GROUP BY shop_id_fk,item_id_fk) t2 ON t2.item_id_fk=t1.item_id_fk and t2.shop_id_fk=t1.branch_id_fk ";

        $query = $this->db->query($sql);
		$data['data'] = $query->result();
        return $data;

	}

	public function getStockTotalCount($param = NULL,$br_id){
		
		$sql="SELECT t3.item_name,(CASE WHEN t1.issue_date IS NULL THEN t2.updated_date ELSE t1.issue_date END) AS date,t2.item_id_fk,t2.total_qty-COALESCE(t1.total_issue_qty,0) as total FROM (SELECT item_id_fk,issue_date,SUM(issue_quantity) as total_issue_qty,issue_quantity FROM tbl_issueitem ORDER BY issue_id DESC) t1 RIGHT JOIN (SELECT item_id_fk,SUM(item_quantity) as total_qty,updated_date FROM tbl_shopstock WHERE shop_id_fk=$br_id GROUP BY shop_id_fk,item_id_fk) t2 ON t2.item_id_fk=t1.item_id_fk Join tbl_item t3 on t3.item_id=t2.item_id_fk";

        $query = $this->db->query($sql);
    	return $query->num_rows();
    }
	public function getbranch($uid)
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('login_id_fk',$uid);
        $query = $this->db->get();
    	if($query->num_rows() > 0)
        {
            return $query->row();
        }
        return false;
	}

	public function getBranchid($uid)
	{
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('login_id_fk',$uid);
        $query = $this->db->get();
    	return $query->result();
	}
	public function getitems($ref_number)
	{
		$this->db->select('*');
		$this->db->from('tbl_apurchase');
		$this->db->where('pr_status',1);
		$this->db->where('ref_number',$ref_number);
        $query = $this->db->get();
		return $query->result();
	}

	public function get_Branchitem($branch_id)
	{
		$this->db->select('item_id_fk,tbl_item.item_name');
		$this->db->from('tbl_shopstock');
		$this->db->join('tbl_item', 'tbl_shopstock.item_id_fk = tbl_item.item_id');
		
		$this->db->where('shop_id_fk',$branch_id);
		$this->db->group_by('item_id_fk');
		
        $query = $this->db->get();
		return $query->result();
	}
	public function getPurchase($prid)
	{
		$this->db->select('*');
		$this->db->from('tbl_apurchase');
		$this->db->where('pr_status',1);
		$this->db->where('pr_id',$prid);
        $query = $this->db->get();
		return $query->result();
	}
	public function checkitem($brid,$item)
	{
		$this->db->select('*');
        $this->db->from('tbl_stock');
        $this->db->where('branch_id_fk',$brid);
		$this->db->where('item_id_fk',$item);
		$this->db->where('stock_status',1);
        $query = $this->db->get();
    	return $query->row();
	}
	public function update($table,$data,$primaryfield,$id,$secondaryfield,$idd)
    {
        $this->db->where($primaryfield, $id);
		$this->db->where($secondaryfield,$idd);
        $q = $this->db->update($table, $data);
        return $q;
    }
	public function get_rop($brid,$item)
	{
		$this->db->select('item_rop');
        $this->db->from('tbl_rop');
        $this->db->where('branch_id_fk',$brid);
		$this->db->where('item_id_fk',$item);
        $query = $this->db->get();
    	return $query->row();
	}
	public function getCount($refno)
	{
		$this->db->select('count(pr_id) as cnt');
        $this->db->from('tbl_apurchase');
		$this->db->where('ref_number',$refno);
		$this->db->where('cc',1);
		$this->db->where('delivery',1);
		$query = $this->db->get();
    	return $query->row();
	}

	public function checkstock($itemid)
    {
      $sql= "SELECT COALESCE(t5.opening_stock,0) AS opening_stock,COALESCE(t4.item_rop, 0) AS master_rop,t3.*,t1.*,t1.item_quantity - COALESCE(t2.item_quantity, 0) AS remaining_qty FROM tbl_stock t1 LEFT JOIN (SELECT item_id_fk, SUM(item_quantity) AS item_quantity FROM tbl_shopstock where status = 1 GROUP BY item_id_fk) t2 ON t1.item_id_fk=t2.item_id_fk JOIN tbl_stockup t3 ON t3.stock_id_fk=t1.stock_id LEFT JOIN tbl_master_rop t4 ON t1.item_id_fk=t4.item_id_fk  LEFT JOIN ( SELECT item_quantity AS opening_stock,item_id_fk FROM tbl_opening_stock WHERE branch_id_fk=0) t5 ON t5.item_id_fk=t2.item_id_fk LEFT JOIN (SELECT SUM(item_quantity) AS purchase_quantity,item_id_fk FROM tbl_apurchase) t6 ON t6.item_id_fk=t2.item_id_fk LEFT JOIN (SELECT SUM(issue_quantity) AS issue_qty,item_id_fk FROM tbl_issueitem) t7 ON t7.item_id_fk=t2.item_id_fk where t1.stock_status=1 AND t1.item_id_fk=$itemid";
       $query = $this->db->query($sql);
        return $query->row();
    }

    public function get_item($br)
	{
		$this->db->select('*');
		$this->db->from('tbl_item');
		$this->db->join('tbl_stock', 'tbl_stock.item_id_fk = tbl_item.item_id');
		$this->db->where('tbl_item.item_status', 1);
		$this->db->where('branch_id_fk',$br);
        $query = $this->db->get();
		return $query->result();
		
	}


	public function get_items()
	{
		$this->db->select('*');
		$this->db->from('tbl_item');
		$this->db->where('item_status', 1);
        $query = $this->db->get();
		return $query->result();
		
	}

	public function get_branch()
	{
		$this->db->select('*');
		$this->db->from('tbl_branch');
		$this->db->where('branch_status', 1);
        $query = $this->db->get();
		return $query->result();
		
	}
}
?>