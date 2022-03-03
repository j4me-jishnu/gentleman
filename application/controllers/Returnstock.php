<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Returnstock extends MY_Controller {
	public $table = 'tbl_stock';
    public $tablescrap = 'tbl_scrap';
	public $tbl_stockup = 'tbl_stockup';
	public $tbl_purchase = 'tbl_apurchase';
	public $page  = 'stock';
	public function __construct() {
		parent::__construct();
       if(! $this->is_logged_in()){
            redirect('/login');
        }

        $this->load->model('General_model');
		$this->load->model('Branchstock_model');
        $this->load->model('Returnmodel');
        $this->load->model('Stock_model');
	}
	public function index()
	{

		$template['body'] = 'Returnstock/list';
		$template['script'] = 'Returnstock/script';
		$this->load->view('template', $template);
	}

	public function get(){

    	 $param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        $param['branch'] = (isset($_REQUEST['branch']))?$_REQUEST['branch']:'';

    	$data = $this->Branchstock_model->getStockTable($param);
    	$bstock =$this->Branchstock_model->getUsedQuantity();
    	//var_dump(count($data['data']));
    	for($i=0;$i<count($data['data']);$i++)
    	{
    		$data['data'][$i]->used_qty=$bstock['data'][$i]->used_quantity;
    	}

    	$json_data = json_encode($data);
    	echo $json_data;
    }

    public function getreturn()
    {
        $param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        $param['branch'] = (isset($_REQUEST['branch']))?$_REQUEST['branch']:
        $data=$this->Returnmodel->getReturn($param);
        $json_data = json_encode($data);
        echo $json_data;


    }

    public function update($id)
    {
        $data=$this->Returnmodel->updatereturn($id);
        redirect('/Returnstock/', 'refresh');

    }

    public function updateToReturn($id)
    {
        $data=$this->Returnmodel->updateToReturn($id);
        redirect('/Returnstock/', 'refresh');

    }

    public function updateToMaster($id)
    {
    $sid = $this->session->userdata('id');
   $data= $this->Returnmodel->getoperator($sid);
   // print_r($data);
        $data=$this->Returnmodel->updateToMaster($id);
        $data1=$this->Returnmodel->getRtn($id);
        $quantity =  $data1[0]->item_quantity;
        $itemid = $data1[0]->item_id_fk;
        $checkitem = $this->Returnmodel->checkitem($itemid);
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
                $_data = array(
                            'item_date'=>date('Y-m-d'),
                            'ref_number'=>"GEN",
                            'invoice_no'=>"0",
                            'item_id_fk' => $iteid,
                            'item_name' =>"0",
                            'item_quantity' => $quantity,
                            'item_price' => 0,
                            'taxamount'=>0,
                            'item_total'=>0,
                            'grand_total'=>0,
                            'cc' => 0,
                            'brm' =>0,
                            'cm' => 0,
                            'fm' => 0,
                            'agm' => 0,
                            'pm' => 0,
                            'delivery'=>0,
                            'finaldelivery'=>0,
                            'remark'=>'Null',
                            'order_file'=>'',
                            'pr_status' => 0
                        );
            $result = $this->General_model->add($this->tbl_purchase,$_data);
            }
        redirect('/Returnstock/', 'refresh');

    }

    public function updateScrap()
    {

        $sid = $this->session->userdata('id');
        $data= $this->Returnmodel->getoperator($sid);
        $id = $this->input->post('return_id');
        $item_id_fk = $this->input->post('item_id_fk');
        $branch_id_fk = $this->input->post('branch_id_fk');
        $item_quantity = $this->input->post('item_quantity');
        $add_quantity = $this->input->post('add_quantity');
        $return_date = $this->Returnmodel->getDate($id);
        $balance = $item_quantity - $add_quantity;
        $data=$this->Returnmodel->updateToMaster($id);
        // $data1=$this->Returnmodel->getRtn($id);
        // $quantity =  $data1[0]->item_quantity;
        // $itemid = $data1[0]->item_id_fk;
        $checkitem = $this->Returnmodel->checkitem($item_id_fk);
        if($checkitem)
        {

                $stock_id = $checkitem->stock_id;
                $iteid = $checkitem->item_id_fk;
                $br = $checkitem->branch_id_fk;
                $qty = $checkitem->issuedqua;
                $qnty = $qty + $add_quantity;
                $up_stockdata = array('issuedqua'=>$qnty,'item_quantity'=>$qnty);
                $result = $this->Stock_model->update($this->table,$up_stockdata,'branch_id_fk',$br,'item_id_fk',$iteid);
                $tbl_stockup = array('up_date'=>date('Y-m-d'));
                $this->Stock_model->update($this->tbl_stockup,$tbl_stockup,'branch_id_fk',$br,'item_id_fk',$iteid);
                if($balance > 0)
                {
                    $data1 = array('item_id_fk' =>$item_id_fk ,
                    'branch_id_fk' =>$branch_id_fk,
                    'item_quantity' =>$balance,
                    'return_date' => $return_date[0]->return_date,
                    'status' =>1);
                    $re= $this->General_model->add($this->tablescrap,$data1);
                }
        }

        if($result)
        {
            $_data = array(
                            'item_date'=>date('Y-m-d'),
                            'ref_number'=>"GEN",
                            'invoice_no'=>"0",
                            'item_id_fk' => $item_id_fk,
                            'item_name' =>"0",
                            'item_quantity' => $add_quantity,
                            'item_price' => 0,
                            'taxamount'=>0,
                            'item_total'=>0,
                            'grand_total'=>0,
                            'cc' => 0,
                            'brm' =>0,
                            'cm' => 0,
                            'fm' => 0,
                            'agm' => 0,
                            'pm' => 0,
                            'delivery'=>0,
                            'finaldelivery'=>0,
                            'remark'=>'Null',
                            'order_file'=>'',
                            'pr_status' => 0
                        );
            $result = $this->General_model->add($this->tbl_purchase,$_data);
            $response['text'] = 'Added successfully';
            $response['type'] = 'success';
        }
        else{
            $response['text'] = 'Sorry';
            $response['type'] = 'success';
        }

        $response['layout'] = 'topRight';
        $data_json = json_encode($response);
        echo $data_json;


    }

    public function updateScrapReturn($id)
    {
         $data = $this->Returnmodel->updateToReturn($id);
         $data1=$this->Returnmodel->getRtn($id);
         $quantity =  $data1[0]->item_quantity;
         $itemid = $data1[0]->item_id_fk;
         $branchid = $data1[0]->branch_id_fk;
         $returndate = $data1[0]->return_date;
         $reason = $data1[0]->return_comment;
         $scrap =array('item_id_fk' => $itemid,
         'branch_id_fk' =>$branchid,
         'item_quantity'=>$quantity,
         'return_date'=>$returndate,
         'scrap_reason'=>$reason,
         'status' =>1 );
         $k = $this->General_model->add($this->tablescrap,$scrap);

        redirect('/Returnstock/', 'refresh');

    }




    function get_operator(){

        $rt = $this->input->post('return_id');

         // print_r($pr_id);
         // exit();
        $data = $this->Returnmodel->get_operator($rt);

//echo $data[0]->user_name;
        echo json_encode($data[0]->user_name);
   }
}
?>
