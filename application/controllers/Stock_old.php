<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Stock extends MY_Controller {
	public $table = 'tbl_stock';
	public $tbl_stockup = 'tbl_stockup';
	public $tbl_purchase = 'tbl_apurchase';
	public $page  = 'stock';
	public function __construct() {
		parent::__construct();
       if(! $this->is_logged_in()){
            redirect('/login');
        }
        
        $this->load->model('General_model');
		$this->load->model('Stock_model');
		$this->load->model('Users_model');
	}
	public function index()
	{
		$uid = $this->session->userdata('id');
		 $template['items'] = $this->Users_model->get_items();
		$template['branch'] = $this->Stock_model->getbranch($uid);
		$template['body'] = 'Stock/list';
		$template['script'] = 'Stock/script';
		$this->load->view('template', $template);
	}
	public function get(){
		$this->load->model('Stock_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		
    	$data = $this->Stock_model->getStockTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }

    public function getBstock(){
		$this->load->model('Stock_model');
		$uid = $this->session->userdata('id');
		$data = $this->Stock_model->getBranchid($uid);
		$br_id = $data[0] ->user_branch;
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        $param['branch'] = (isset($_REQUEST['branch']))?$_REQUEST['branch']:'';	
        $param['item'] = (isset($_REQUEST['item']))?$_REQUEST['item']:'';	
    	$data = $this->Stock_model->getBstock($param,$br_id);
    	$bstock =$this->Stock_model->getIssuedQuantity($br_id);
    	//var_dump(count($data['data']));
    	for($i=0;$i<count($data['data']);$i++)
    	{	

    			$last = 0;
    		for($j=0;$j<count($bstock['data']);$j++)
    		{
    			if($data['data'][$i]->item_id_fk == $bstock['data'][$j]->iid){

    				//$data['data'][$i]->last_issued_qty=$bstock['data'][$j]->last_issued;
    				$last = $bstock['data'][$j]->last_issued;
    				break;
    			}

    		}

    		$data['data'][$i]->last_issued_qty = $last;
    			
    	}

    	 $all_total =0;
        for($i=0;$i<count($data['data']);$i++)
        {  
          
           $all_total = $data['data'][$i]->total +$all_total;  
        }

        for($i=0;$i<count($data['data']);$i++)
        {  
          
           $data['data'][$i]->all_total = $all_total;  
        }

    	
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function addtoStock($ref_number){
		$template['items'] = $this->Stock_model->getitems($ref_number);
		$template['body'] = 'Addstock/list';
		$template['script'] = 'Addstock/script';
		$this->load->view('template', $template);
	}
	public function updateStock(){
		$prid = $this->input->post('prid');
		$data=$this->Stock_model->getPurchase($prid);
		if($data){
			$itemid =  $data[0]->item_id_fk;
			$item_name =  $data[0]->item_name;
			$quantity =  $data[0]->item_quantity;
			$branch_id_fk =  $data[0]->branch_id_fk;
			$refno = $data[0]->ref_number;
			
			$itemsrop = $this->Stock_model->get_rop($branch_id_fk,$itemid);
			 if(isset($itemsrop->item_rop))
			 {
			 	$rop=$itemsrop->item_rop;
			 }
			 else{
			 	$rop=0;
			 }
			$getCount = $this->Stock_model->getCount($refno);
			$count = $getCount->cnt;
			$checkitem = $this->Stock_model->checkitem($branch_id_fk,$itemid);
			if($count<=0 || $count==1){ $udata=array('delivery'=>0,'cc'=>0,'finaldelivery'=>0); } else { $udata=array('delivery'=>0,'cc'=>0); }
			$this->General_model->update($this->tbl_purchase,$udata,'pr_id',$prid);
			if($checkitem)
			{
				$stock_id = $checkitem->stock_id;
				$iteid = $checkitem->item_id_fk;
				$br = $checkitem->branch_id_fk;
				$qty = $checkitem->issuedqua;
				$qnty = $qty + $quantity;
				$up_stockdata = array('issuedqua'=>$qnty,'item_quantity'=>$qnty);
				$result = $this->Stock_model->update($this->table,$up_stockdata,'branch_id_fk',$br,'item_id_fk',$iteid);
				$tbl_stockup = array('up_date'=>date('Y-m-d'));
				$this->Stock_model->update($this->tbl_stockup,$tbl_stockup,'branch_id_fk',$br,'item_id_fk',$iteid);
			}
			else
			{
				$add_stockdata = array('item_id_fk'=>$itemid,'branch_id_fk'=>$branch_id_fk,'item_name'=>$item_name,'item_quantity'=>$quantity,'issuedqua'=>$quantity,'item_rop'=>$rop,'stock_status'=>1,'used_quantity'=>0);
				$result = $this->General_model->add($this->table,$add_stockdata);
				$stock_id_fk = $this->db->insert_id(); 
				$tbl_stockup = array('stock_id_fk'=>$stock_id_fk,'item_id_fk'=>$itemid,'branch_id_fk'=>$branch_id_fk,'up_date'=>date('Y-m-d'),'up_status'=>1);
				$this->General_model->add($this->tbl_stockup,$tbl_stockup);
			}
			
            $response['text'] = 'Updated successfully';
            $response['type'] = 'success';
			
			$response['layout'] = 'topRight';
			$data_json = json_encode($response);
			echo $data_json;
		}
		
	}
}