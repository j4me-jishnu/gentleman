<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Branchstock_model extends CI_Model{

	public function __construct()
    {
        parent::__construct();
    }
    public function getStockTable($param){
		$arOrder = array('','branch_name');
		$branch =(isset($param['user_branch']))?$param['user_branch']:'';
		$item =(isset($param['item']))?$param['item']:'';
        if($branch && !$item){
            $sql = "SELECT COALESCE(t5.item_rop, 0) AS item_rop,t4.branch_name,t3.item_name,(CASE WHEN t2.updated_date IS NULL THEN t1.issue_date ELSE t2.updated_date END) AS date,t2.shop_id_fk,t2.item_id_fk,t2.total_qty+ COALESCE(t8.request_quantity,0) -(COALESCE(t1.total_issue_qty,0) + COALESCE(t6.total_return_qty,0) + COALESCE(t7.branch_qty,0)) as total,COALESCE(t2.total_qty,0) as total_qty,COALESCE(t8.request_quantity,0) as request_quantity,COALESCE(t8.updated_date,0) as updated_date FROM (SELECT branch_id_fk,item_id_fk,issue_date,SUM(issue_quantity) as total_issue_qty FROM tbl_issueitem where branch_id_fk like $branch GROUP BY item_id_fk,branch_id_fk) t1 RIGHT JOIN (SELECT id,item_id_fk,SUM(item_quantity) as total_qty,max(updated_date) as updated_date,shop_id_fk FROM tbl_shopstock where shop_id_fk like $branch GROUP BY shop_id_fk,item_id_fk) t2 ON t2.item_id_fk=t1.item_id_fk AND t2.shop_id_fk=t1.branch_id_fk LEFT JOIN (SELECT branch_id_fk,item_id_fk,return_date,SUM(item_quantity) as total_return_qty FROM tbl_returnproduct where branch_id_fk like $branch GROUP BY item_id_fk,branch_id_fk) t6 ON t6.branch_id_fk=t2.shop_id_fk LEFT JOIN (SELECT branch_id_fk,item_id_fk,request_date,updated_date,SUM(request_quantity) as request_quantity FROM tbl_request_item Where request_status= 0 GROUP BY item_id_fk,branch_id_fk) t8  ON t2.item_id_fk=t8.item_id_fk AND t2.shop_id_fk=t8.branch_id_fk LEFT JOIN (SELECT item_id_fk,from_branch_id_fk,SUM(item_quantity) branch_qty from tbl_branch_to_branch where status = 1 and from_branch_id_fk like $branch GROUP BY from_branch_id_fk,item_id_fk) t7 ON t7.from_branch_id_fk=t2.shop_id_fk AND t7.item_id_fk=t2.item_id_fk Join tbl_item t3 on t3.item_id=t2.item_id_fk join tbl_branch t4 on t4.branch_id = t2.shop_id_fk left join tbl_rop t5 on t2.item_id_fk=t5.item_id_fk and t2.shop_id_fk=t5.branch_id_fk ";

        }
       else if($item && !$branch){
            $sql = "SELECT COALESCE(t5.item_rop, 0) AS item_rop,t4.branch_name,t3.item_name,(CASE WHEN t2.updated_date IS NULL THEN t1.issue_date ELSE t2.updated_date END) AS date,t2.shop_id_fk,t2.item_id_fk,t2.total_qty+ COALESCE(t8.request_quantity,0) -(COALESCE(t1.total_issue_qty,0) + COALESCE(t6.total_return_qty,0) + COALESCE(t7.branch_qty,0)) as total,COALESCE(t2.total_qty,0) as total_qty,COALESCE(t8.request_quantity,0) as request_quantity,COALESCE(t8.updated_date,0) as updated_date FROM (SELECT branch_id_fk,item_id_fk,issue_date,SUM(issue_quantity) as total_issue_qty FROM tbl_issueitem where item_id_fk like $item GROUP BY item_id_fk,branch_id_fk) t1 RIGHT JOIN (SELECT id,item_id_fk,SUM(item_quantity) as total_qty,max(updated_date) as updated_date,shop_id_fk FROM tbl_shopstock where item_id_fk like $item GROUP BY shop_id_fk,item_id_fk) t2 ON t2.item_id_fk=t1.item_id_fk AND t2.shop_id_fk=t1.branch_id_fk LEFT JOIN (SELECT branch_id_fk,item_id_fk,return_date,SUM(item_quantity) as total_return_qty FROM tbl_returnproduct where item_id_fk like $item GROUP BY item_id_fk,branch_id_fk) t6 ON t6.item_id_fk=t2.item_id_fk AND t6.branch_id_fk=t2.shop_id_fk LEFT JOIN (SELECT branch_id_fk,item_id_fk,updated_date,request_date,SUM(request_quantity) as request_quantity FROM tbl_request_item Where request_status= 0 GROUP BY item_id_fk,branch_id_fk) t8  ON t2.item_id_fk=t8.item_id_fk AND t2.shop_id_fk=t8.branch_id_fk LEFT JOIN (SELECT item_id_fk,from_branch_id_fk,SUM(item_quantity) branch_qty from tbl_branch_to_branch where status = 1 and item_id_fk like $item GROUP BY from_branch_id_fk,item_id_fk) t7 ON t7.from_branch_id_fk=t2.shop_id_fk AND t7.item_id_fk=t2.item_id_fk Join tbl_item t3 on t3.item_id=t2.item_id_fk join tbl_branch t4 on t4.branch_id = t2.shop_id_fk left join tbl_rop t5 on t2.item_id_fk=t5.item_id_fk and t2.shop_id_fk=t5.branch_id_fk ";

        }
        else if ($item && $branch) {
            $sql = "SELECT COALESCE(t5.item_rop, 0) AS item_rop,t4.branch_name,t3.item_name,(CASE WHEN t2.updated_date IS NULL THEN t1.issue_date ELSE t2.updated_date END) AS date,t2.shop_id_fk,t2.item_id_fk,t2.total_qty+ COALESCE(t8.request_quantity,0) -(COALESCE(t1.total_issue_qty,0) + COALESCE(t6.total_return_qty,0) + COALESCE(t7.branch_qty,0)) as total,COALESCE(t2.total_qty,0) as total_qty,COALESCE(t8.request_quantity,0) as request_quantity,COALESCE(t8.updated_date,0) as updated_date FROM (SELECT branch_id_fk,item_id_fk,issue_date,SUM(issue_quantity) as total_issue_qty FROM tbl_issueitem where item_id_fk like $item and branch_id_fk like $branch GROUP BY item_id_fk,branch_id_fk) t1 RIGHT JOIN (SELECT id,item_id_fk,SUM(item_quantity) as total_qty,max(updated_date) as updated_date,shop_id_fk FROM tbl_shopstock where item_id_fk like $item and shop_id_fk like $branch GROUP BY shop_id_fk,item_id_fk) t2 ON t2.item_id_fk=t1.item_id_fk AND t2.shop_id_fk=t1.branch_id_fk LEFT JOIN (SELECT branch_id_fk,item_id_fk,return_date,SUM(item_quantity) as total_return_qty FROM tbl_returnproduct where item_id_fk like $item and branch_id_fk like $branch GROUP BY item_id_fk,branch_id_fk) t6 ON t6.item_id_fk=t2.item_id_fk AND t6.branch_id_fk=t2.shop_id_fk LEFT JOIN (SELECT branch_id_fk,item_id_fk,request_date,updated_date,SUM(request_quantity) as request_quantity FROM tbl_request_item Where request_status= 0 GROUP BY item_id_fk,branch_id_fk) t8  ON t2.item_id_fk=t8.item_id_fk AND t2.shop_id_fk=t8.branch_id_fk LEFT JOIN (SELECT item_id_fk,from_branch_id_fk,SUM(item_quantity) branch_qty from tbl_branch_to_branch where status = 1 and item_id_fk like $item and from_branch_id_fk like $branch GROUP BY from_branch_id_fk,item_id_fk) t7 ON t7.from_branch_id_fk=t2.shop_id_fk AND t7.item_id_fk=t2.item_id_fk Join tbl_item t3 on t3.item_id=t2.item_id_fk join tbl_branch t4 on t4.branch_id = t2.shop_id_fk left join tbl_rop t5 on t2.item_id_fk=t5.item_id_fk and t2.shop_id_fk=t5.branch_id_fk ";
        }
		
		else{
			$sql="SELECT COALESCE(t5.item_rop, 0) AS item_rop,t4.branch_name,t3.item_name,(CASE WHEN t2.updated_date IS NULL THEN t1.issue_date ELSE t2.updated_date END) AS date,t2.shop_id_fk,t2.item_id_fk,

			t2.total_qty + COALESCE(t8.request_quantity,0)-(COALESCE(t1.total_issue_qty,0) + COALESCE(t6.total_return_qty,0) + COALESCE(t7.branch_qty,0)) as total,COALESCE(t2.total_qty,0) as total_qty,COALESCE(t8.request_quantity,0) as request_quantity,COALESCE(t8.updated_date,0) as updated_date 
			-- -(COALESCE(t8.request_quantity,0)

			FROM (SELECT branch_id_fk,item_id_fk,issue_date,SUM(issue_quantity) as total_issue_qty FROM tbl_issueitem GROUP BY item_id_fk,branch_id_fk) t1 
			

			RIGHT JOIN (SELECT id,item_id_fk,SUM(item_quantity) as total_qty,max(updated_date) as updated_date,shop_id_fk FROM tbl_shopstock GROUP BY shop_id_fk,item_id_fk) t2 ON t2.item_id_fk=t1.item_id_fk AND t2.shop_id_fk=t1.branch_id_fk 


			LEFT JOIN (SELECT branch_id_fk,item_id_fk,return_date,SUM(item_quantity) as total_return_qty FROM tbl_returnproduct GROUP BY item_id_fk,branch_id_fk) t6 ON t6.item_id_fk=t2.item_id_fk AND t6.branch_id_fk=t2.shop_id_fk 

			LEFT JOIN (SELECT branch_id_fk,item_id_fk,request_date,updated_date,SUM(request_quantity) as request_quantity FROM tbl_request_item Where request_status= 0 GROUP BY item_id_fk,branch_id_fk) t8  ON t2.item_id_fk=t8.item_id_fk AND t2.shop_id_fk=t8.branch_id_fk

			LEFT JOIN (SELECT item_id_fk,from_branch_id_fk,SUM(item_quantity) branch_qty from tbl_branch_to_branch where status = 1 GROUP BY from_branch_id_fk,item_id_fk) t7 ON t7.from_branch_id_fk=t2.shop_id_fk AND t7.item_id_fk=t2.item_id_fk Join tbl_item t3 on t3.item_id=t2.item_id_fk join tbl_branch t4 on t4.branch_id = t2.shop_id_fk left join tbl_rop t5 on t2.item_id_fk=t5.item_id_fk and t2.shop_id_fk=t5.branch_id_fk";
	}
	 $sql.=" order by total<=item_rop OR total<=0 desc";
		
        if ($param['start'] != 'false' and $param['length'] != 'false')  {
			$length=$param['length'];
			$start= $param['start'];
            $sql.=" limit $start,$length";
        }
        $query = $this->db->query($sql);
        // print_r($this->db->last_query());
        // exit();
		$data['data'] = $query->result();

		// $this->db->select('*,tbl_branch_stock.used_quantity AS used_qty,SUM(tbl_branch_stock.item_quantity) AS total')->from('tbl_branch_stock')->join('tbl_branch','tbl_branch_stock.shop_id_fk=tbl_branch.branch_id')->join('tbl_item','tbl_branch_stock.item_id_fk=tbl_item.item_id')->join('tbl_rop','tbl_rop.item_id_fk=tbl_item.item_id')->where('tbl_branch_stock.delivery',1);
		// $query = $this->db->get();
		// $data['data'] = array_merge($data['data'],$query->result());

        $data['recordsTotal'] = $this->getStockTotalCount($param);
        $data['recordsFiltered'] = $this->getStockTotalCount($param);
        return $data;

	}

	public function getStockrequest($param){

	$branch =(isset($param['user_branch']))?$param['user_branch']:'';
	$item =(isset($param['item']))?$param['item']:'';
	if($branch && $item){
	
	$sql="SELECT COALESCE(SUM(request_quantity),0) AS request FROM tbl_request_item where item_id_fk = $item and branch_id_fk = $branch";
	$query = $this->db->query($sql);
    // print_r($this->db->last_query());    
	$data['data'] = $query->result();
    return $data;
	}

    

	}
	public function getUsedQuantity(){
		
		$sql="SELECT COALESCE(t1.issue_quantity,0) AS used_quantity,COALESCE(t1.branch_id_fk,0) AS br_id,COALESCE(t1.item_id_fk,0) AS iid FROM (SELECT item_id_fk,branch_id_fk,SUM(issue_quantity) AS issue_quantity FROM tbl_issueitem GROUP BY branch_id_fk,item_id_fk) t1 RIGHT JOIN (SELECT id,shop_id_fk,item_id_fk FROM tbl_shopstock GROUP BY shop_id_fk,item_id_fk) t2 ON t2.item_id_fk=t1.item_id_fk and t2.shop_id_fk=t1.branch_id_fk";

        $query = $this->db->query($sql);
		$data['data'] = $query->result();
        return $data;

	}
	public function getOPstock()
	{
		$this->db->select('*,SUM(item_quantity) as op');
		$this->db->from('tbl_shopstock');
		$this->db->group_by('tbl_shopstock.shop_id_fk');
		$this->db->group_by('tbl_shopstock.item_id_fk');
		$query = $this->db->get();
		$data['data'] = $query->result();
		return $data;
		// echo $this->db->last_query();
	}
	public function getRqstock()
	{
		$this->db->select('*,SUM(request_quantity) as request_q');
		$this->db->from('tbl_request_item');
		$this->db->group_by('item_id_fk');
		$this->db->group_by('branch_id_fk');
		$query = $this->db->get();
		$data['data'] = $query->result();
		return $data;
	}
	public function getBmaxdate(){
		
		$sql="SELECT item_id_fk,shop_id_fk,max(updated_date) as maxdate from tbl_shopstock GROUP by item_id_fk,shop_id_fk";

        $query = $this->db->query($sql);

		$data['data'] = $query->result();
        return $data;

	}

public function getImaxdate(){
		
		$sql="SELECT COALESCE(t1.issue_date,0) AS mdate,COALESCE(t1.branch_id_fk,0) AS bid,COALESCE(t1.item_id_fk,0) AS iss_id FROM (SELECT item_id_fk,branch_id_fk,max(issue_date) as issue_date,SUM(issue_quantity) AS issue_quantity FROM tbl_issueitem GROUP BY branch_id_fk,item_id_fk) t1 RIGHT JOIN (SELECT id,shop_id_fk,item_id_fk FROM tbl_shopstock GROUP BY shop_id_fk,item_id_fk) t2 ON t2.item_id_fk=t1.item_id_fk and t2.shop_id_fk=t1.branch_id_fk";

        $query = $this->db->query($sql);
		$data['data'] = $query->result();
        return $data;

	}



	public function getStockTotalCount($param = NULL){
		
		$branch =(isset($param['branch']))?$param['branch']:'';
		if($branch){
            $this->db->where('tbl_branch.branch_name', $branch); 
        }
		$this->db->where('tbl_shopstock.status',1);
		if ($param['start'] != 'false' and $param['length'] != 'false') {
        	$this->db->limit($param['length'],$param['start']);
        }
		$sql="SELECT t4.branch_name,t3.item_name,(CASE WHEN t1.issue_date IS NULL THEN t2.updated_date ELSE t1.issue_date END) AS date,t2.item_id_fk,t2.total_qty-COALESCE(t1.total_issue_qty,0) as total FROM (SELECT item_id_fk,issue_date,SUM(issue_quantity) as total_issue_qty,issue_quantity FROM tbl_issueitem ORDER BY issue_id DESC) t1 RIGHT JOIN (SELECT item_id_fk,SUM(item_quantity) as total_qty,updated_date,shop_id_fk FROM tbl_shopstock GROUP BY shop_id_fk,item_id_fk) t2 ON t2.item_id_fk=t1.item_id_fk Join tbl_item t3 on t3.item_id=t2.item_id_fk join tbl_branch t4 on t2.shop_id_fk=t4.branch_id";

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
	public function getitems($ref_number)
	{
		$this->db->select('*');
		$this->db->from('tbl_apurchase');
		$this->db->where('pr_status',1);
		$this->db->where('ref_number',$ref_number);
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
}
?>