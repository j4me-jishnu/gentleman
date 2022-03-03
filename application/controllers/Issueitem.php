<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Issueitem extends MY_Controller {
	public $tbl_issueitem = ' tbl_issueitem';
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
        $this->load->model('Purchase_model');
        $this->load->model('Apurchase_model');
        $this->load->model('Stock_model');
        $this->load->model('Request_Br_to_br_model');
    }
	public function index()
	{
		$template['body'] = 'Issueitem/list';
		$template['script'] = 'Issueitem/script';
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('itemid', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {

			$template['refno'] = $this->Purchase_model->Refno();
			$branch_id = $template['refno'][0]->branch_id;
			$template['item'] = $this->Stock_model->get_Branchitem($branch_id);
			$template['users'] = $this->Issueitem_model->get_users($branch_id);
			$template['brmname'] = $this->Purchase_model->brmname($branch_id);
			if(isset($template['brmname'][0]->user_branch))
			{
			$br = $template['brmname'][0]->user_branch;
			}
			else
			{
			$br = 0;
			}
			$template['userid'] = $this->Issueitem_model->get_id($br);
			$template['body'] = 'Issueitem/add';
			$template['script'] = 'Issueitem/script';
			$this->load->view('template', $template);
		}
		else {
			$issue_date = str_replace('/', '-', $this->input->post('issue_date'));
			$issue_date =  date("Y-m-d",strtotime($issue_date));
			$itemid = $this->input->post('itemid');
			$quantity = $this->input->post('quantity');
			$template['refno'] = $this->Purchase_model->Refno();
			$branch_id = $template['refno'][0]->branch_id;
			$template['item'] = $this->Issueitem_model->get_stock($itemid,$branch_id);
			//$stockqua = $template['item'][0]->item_quantity;
			//$stockid = $template['item'][0]->stock_id;
			//$usedqua = $template['item'][0]->used_quantity;
			//$usedqua = $usedqua + $quantity;
			//$qua = $stockqua - $quantity;
			$data = array(
						'user_id_fk' => $this->input->post('user_id'),
						'item_id_fk' => $itemid,
						'branch_id_fk'=>$branch_id,
						'issue_quantity' => $quantity,
						'issue_date' => $issue_date,
						'issue_status' => 1
						);
			//$stockupdate = array('issuedqua' => $qua,'used_quantity' => $quantity);
			$b_id = $template['refno'][0]->branch_id;
			$branch_id = $this->input->post('branch_id');

			if($branch_id){

                    $data['branch_id'] = $branch_id;
                    $result = $this->General_model->update($this->table,$data,'branch_id',$branch_id);
                    $response_text = 'Item updated successfully';
			}
			else{
                    $result = $this->General_model->add($this->tbl_issueitem,$data);
					// $this->General_model->update($this->tbl_stock,$stockupdate,'stock_id',$stockid);
					$res = $this->Issueitem_model->getBS($b_id,$itemid);
					if(isset($res[0])){
					$iqty = $res[0] ->total;
					$irop = $res[0] ->item_rop;
					$iname= $res[0] ->item_name;
					$bname= $res[0] ->branch_name;
					$message="Stock of ".$iname." Reached below  in ".$bname;
					$Frommail = $this->General_model->getMail();
					if(isset($Frommail[0])){
					$from_mail = $Frommail[0]->email;
					if($iqty < $irop)
					{

						   $super_user = $this->General_model->getSuperUsers();
						   for($j = 0;$j<count($super_user);$j++)
						   {

							   	$udata = $this->General_model->getSuMail($super_user[$j]->id);
								$useremail = $udata[0]->user_email;
								//var_dump($useremail);
								$this->email->from($from_mail);
								$this->email->to($useremail);
								$this->email->subject('Stock Balance ');
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
							$admin= $this->Request_Br_to_br_model->getAdmin();
							$this->email->from($from_mail);
							$this->email->to($admin[0]->user_email);
							$this->email->subject('Stock balance');
							$this->email->message($message);
							$this->email->set_newline("\r\n");
							if($this->email->send())
							{

							}
							else
							{

							}
					}
				}
			}

                    $response_text = 'Item issued  successfully';
			}
			if($result){
				$operation = array(
						 'user_id' => $this->session->userdata('id'),
						 'operation' => 'Item issued',
						 'to_whom' => $itemid,
						 'date' => date('Y-m-d'),
						 'operation_id' => 12,
						 'value' =>$quantity
					 );
					 $this->General_model->add_operation($operation);
			$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			}
			else{
			$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
	        redirect('/issueitem/', 'refresh');
		}
	}
	public function get(){
        $this->load->model('Issueitem_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';

		$start_date = (isset($_REQUEST['start_date']))?$_REQUEST['start_date']:'';
		$end_date = (isset($_REQUEST['end_date']))?$_REQUEST['end_date']:'';
    	if($start_date){
			$start_date = str_replace('/', '-', $start_date);
			$param['start_date'] =  date("Y-m-d",strtotime($start_date));
		}
		if($end_date){
			$end_date = str_replace('/', '-', $end_date);
			$param['end_date'] =  date("Y-m-d",strtotime($end_date));
		}


    	$data = $this->Issueitem_model->getIssueTable($param);
    	 $all_total =0;
        for($i=0;$i<count($data['data']);$i++)
        {

           $all_total = $data['data'][$i]->issue_quantity +$all_total;
        }

        for($i=0;$i<count($data['data']);$i++)
        {

           $data['data'][$i]->all_total = $all_total;
        }
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function delete(){
        $branch_id = $this->input->post('branch_id');
        $updateData = array('branch_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'branch_id',$branch_id);
        if($data) {
            $response['text'] = 'Deleted successfully';
            $response['type'] = 'success';
        }
        else{
            $response['text'] = 'Something went wrong';
            $response['type'] = 'error';
        }
        $response['layout'] = 'topRight';
        $data_json = json_encode($response);
        echo $data_json;
        redirect('/branch/', 'refresh');
    }
    public function edit($branch_id){
        $template['body'] = 'Branch/add';
        $template['script'] = 'Branch/script';
        $template['records'] = $this->General_model->get_row($this->table,'branch_id',$branch_id);
        $this->load->view('template', $template);
    }
    public function checkstock(){
    	$itemid = $this->input->post('itemid');
      $userid = $this->session->userdata('user_id');
    	// $period = $this->General_model->getBenchPeriod();
    	// $idate = $period[0]->initial_date;
    	// $fdate = $period[0]->final_date;
    	$branch = $this->General_model->getBranchBenchmark($userid,$itemid);
    	$benchmark = $branch[0]->bench;
    	$idate = $branch[0]->idate;
    	$fdate = $branch[0]->fdate;
    	$_data = $this->General_model->getTotalIssue($userid,$itemid,$idate,$fdate);
    	$_data[0]->benchmark = $benchmark;
        $template['refno'] = $this->Purchase_model->Refno();
        $br = $template['refno'][0]->branch_id;
        $data=$this->Issueitem_model->checkstock($itemid,$br);
        $data->sum = $_data[0]->sum;
        $data->benchmark = $_data[0]->benchmark;

				print_r($data); die;
        echo json_encode($data);
    }

    public function getBranchBenchmark(){
    	$period = $this->General_model->getBenchPeriod();
    	$idate = $period[0]->initial_date;
    	$fdate = $period[0]->final_date;
    	$branch = $this->General_model->getBranchBenchmark(4,9);
    	$benchmark = $branch[0]->bench;
    	$data = $this->General_model->getTotalIssue(4,9,$idate,$fdate);
    	$data[0]->benchmark = $benchmark;
    	//var_dump($data);

    }

		public function get_item_name(){
			// $_POST['branch_id']=8;
			$result=$this->Issueitem_model->get_item_name($_POST['branch_id']);
			echo json_encode($result);
			return $result;
		}
}
