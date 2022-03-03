<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Stockmovement extends MY_Controller {
	public $tbl_branchstock = ' tbl_shopstock';
	public $tbl_br_stock = ' tbl_branch_stock';
	public $tbl_branch_request = 'tbl_branchrequest_approval';
	public $tbl_stock = ' tbl_stock';
	public $page  = 'issueitem';
	public function __construct() {
		parent::__construct();
       if(! $this->is_logged_in()){
            redirect('/login');
        }
        $this->load->library('email');
        $this->load->model('General_model');
        $this->load->model('Issueitem_model');
        $this->load->model('Apurchase_model');
         $this->load->model('Stock_model');
    }
	public function add(){
		$this->form_validation->set_rules('itemid', 'Name', 'required');
		if ($this->form_validation->run() == FALSE)
		 {
			//$br= 0;
			//$template['item'] = $this->Stock_model->get_item($br);
			$template['item'] = $this->Stock_model->get_items();
			$template['branch'] = $this->Stock_model->get_branch();
			$template['body'] = 'Stockmovement/add';
			$template['script'] = 'Stockmovement/script';
			$this->load->view('template', $template);
		}
		else {
			$issue_date = str_replace('/', '-', $this->input->post('issue_date'));
			$issue_date =  date("Y-m-d",strtotime($issue_date));
			$itemid = $this->input->post('itemid');
			$branchid = $this->input->post('branchid');
			$quantity = $this->input->post('quantity');
			// $template['item'] = $this->Issueitem_model->get_stock($itemid,$branch_id);
			// $stockqua = $template['item'][0]->item_quantity;
			// $stockid = $template['item'][0]->stock_id;
			// $usedqua = $template['item'][0]->used_quantity;
			// $usedqua = $usedqua + $quantity;
			// $qua = $stockqua - $quantity; 
			$data = array(
						'item_id_fk' => $itemid,
						'shop_id_fk'=>$branchid,
						'item_quantity' => $quantity,
						'used_quantity' => 0,
						'updated_date' => $issue_date,
						'com' => 2,
						'agm' =>0,
						'delivery ' =>0,
						'reject' =>0
						);
					$ite =$this->General_model->getI($itemid);
					$bran =$this->General_model->getB($branchid);
                    $result = $this->General_model->add_returnID($this->tbl_br_stock,$data);
					$super_user = $this->General_model->getSuperUsers();
					
					$Frommail = $this->General_model->getMail();
					if(isset($Frommail[0]->email)){
					$from_mail = $Frommail[0]->email;
					$message="A new request for moving ".$ite[0]->item_name." of ".$quantity." from master stock to ".$bran[0]->branch_name."is waiting for your approval";
					for($j = 0;$j<count($super_user);$j++)
					{
						$da = array(
								'issue_id_fk' =>$result,
								'su_id_fk' =>$super_user[$j]->id,
								'designation' =>$super_user[$j]->designation,
								'is_approved' =>0,
								'reject' =>0
						);
						$k =$this->General_model->add($this->tbl_branch_request,$da);
						$udata = $this->General_model->getSuMail($super_user[$j]->id);
						$useremail = $udata[0]->user_email;
						//var_dump($useremail);
						$this->email->from($from_mail); 
						$this->email->to($useremail);
						$this->email->subject('Request approval');
						$this->email->message($message);
						$this->email->set_newline("\r\n");
						if($this->email->send())
						{
						
						}
						else
						{
						 //show_error($this->email->print_debugger());
						}
					}
				}
                    if($result)
					{	
						$operation = array(
						 'user_id' => $this->session->userdata('id'),
						 'operation' => 'Stock Moved to branch',
						 'to_whom' => $branchid,
						 'date' => date('Y-m-d'),
						 'operation_id' => 11,
						 'value' =>$itemid
					 );
					 $this->General_model->add_operation($operation);
						$response_text = 'Request added  successfully';
						
						$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
					}
			else{
			$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
	        redirect('/Moveto_branch/', 'refresh');
		}
	}

	public function checkstock()
    {
    	$this->load->model('Masterstock_model');
        // $branchid = $this->input->post('branchid');
        $itemid = $this->input->post('itemid');
        $param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        $data = $this->Masterstock_model->getStockTable($param);
    	$bstock =$this->Masterstock_model->getBstock();
		//$bstock =$this->Masterstock_model->getopstock();

    	for($i=0;$i<count($data['data']);$i++)
        {   
            $tot=0;
            for($j=0;$j<count($bstock['data']);$j++)
            {
                if($data['data'][$i]->item_id_fk == $bstock['data'][$j]->item_id_fk)
                {
                    $tot = $bstock['data'][$j]->total;
                    break;
                }
            }
			$data['data'][$i]->btotal = $tot;
			// echo $data['data'][$i]['item_id_fk'];
			// exit();
			$issued = $this->Masterstock_model->get_issued($data['data'][$i]->item_id_fk);
			$request = $this->Masterstock_model->get_request($data['data'][$i]->item_id_fk);  
			// print_r($issued[0]->issued);
			// exit();
			$data['data'][$i]->requestquantity = $request[0]->request;
			$data['data'][$i]->issuedquantity = $issued[0]->issued;     
			$data['data'][$i]->t_quantity = $data['data'][$i]->opening_stock + $data['data'][$i]->purchase_quantity - $issued[0]->issued - $request[0]->request; 
        }
        for($i=0;$i<count($data['data']);$i++)
        { 
        	if($data['data'][$i]->item_id_fk == $itemid)
            {
            	$data=$data['data'][$i]->t_quantity;
            	break;
            }
        }
     // //    $period = $this->General_model->getBenchPeriod();
    	// // $idate = $period[0]->initial_date;
    	// // $fdate = $period[0]->final_date;

    	// $master = $this->General_model->getMasterBenchmark($branchid,$itemid);
    	// $benchmark = $master[0]->bench;
    	// $idate = $master[0]->idate;
    	// $fdate = $master[0]->fdate;
    	// $_data = $this->General_model->getTotalMoveStock($branchid,$itemid,$idate,$fdate);
    	// $_data[0]->benchmark = $benchmark;
     //    $data=$this->Stock_model->checkstock($itemid);
     //    $data->sum = $_data[0]->sum;
     //    $data->benchmark = $_data[0]->benchmark;
        echo json_encode($data);
    }

    public function getBenchPeriod()
    {
    	$data = $this->General_model->getBenchPeriod();
    	
    }

    public function getMasterBenchmark()
    {	
    	$period = $this->General_model->getBenchPeriod();
    	$idate = $period[0]->initial_date;
    	$fdate = $period[0]->final_date;
    	$master = $this->General_model->getMasterBenchmark($branch_id,$item_id);
    	$benchmark = $master[0]->bench;
    	$data = $this->General_model->getTotalMoveStock($branch_id,$item_id,$idate,$fdate);
    	$data[0]->benchmark = $benchmark;
    	
    	
    }





}
?>