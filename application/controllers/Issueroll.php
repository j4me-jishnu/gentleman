<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Issueroll extends MY_Controller {
	public $table = ' tbl_issueroll';
	public $tbl_stock = ' tbl_stock';
	public $page  = 'issueroll';
	public function __construct() {
		parent::__construct();
       if(! $this->is_logged_in()){
            redirect('/login');
        }
        
        $this->load->model('General_model');
        $this->load->model('Issueroll_model');
    }
	public function index()
	{
		$template['body'] = 'Issueroll/list';
		$template['script'] = 'Issueroll/script';
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('userid', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['refno'] = $this->Issueroll_model->Refno();
			$branch_id = $template['refno'][0]->branch_id;
			$template['brmname'] = $this->Issueroll_model->brmname($branch_id);
			if(isset($template['brmname'][0]->user_branch))
			{
			$br = $template['brmname'][0]->user_branch;
			}
			else
			{
			$br = 0;
			}
			$template['userid'] = $this->Issueroll_model->get_id($br);
			$template['item'] = $this->Issueroll_model->get_item($br);
			$template['body'] = 'Issueroll/add';
			$template['script'] = 'Issueroll/script';
			$this->load->view('template', $template);
		}
		else {
			$issue_date = str_replace('/', '-', $this->input->post('issue_date'));
			$issue_date =  date("Y-m-d",strtotime($issue_date));
			$itemid = $this->input->post('itemid');
			$quantity = $this->input->post('quantity');
			$template['refno'] = $this->Issueroll_model->Refno();
			$branch_id = $template['refno'][0]->branch_id;
			$template['item'] = $this->Issueroll_model->get_stock($itemid,$branch_id);
			$stockqua = $template['item'][0]->item_quantity;
			$stockid = $template['item'][0]->stock_id;
			$usedqua = $template['item'][0]->used_quantity;
			$usedqua = $usedqua + $quantity;
			$qua = $stockqua - $quantity; 
			$ticket_count = 150 * $quantity;
			$cutoff_ticket = 10 * $quantity;
			$expect_ticket = $ticket_count - $cutoff_ticket;
			$data = array(
						'user_id_fk' => $this->input->post('userid'),
						'item_id_fk' => $itemid,
						'branch_id_fk'=>$branch_id,
						'roll_quantity' => $quantity,
						'ticket_count' => $ticket_count,
						'cutoff_ticket'=> $cutoff_ticket,
						'expect_ticket'=> $expect_ticket,
						'issue_date' => $issue_date,
						'issue_status' => 1
						);
			$stockupdate = array('issuedqua' => $qua,'used_quantity' => $quantity);
			$branch_id = $this->input->post('branch_id');
			if($branch_id){
					 
                    $data['branch_id'] = $branch_id;
                    $result = $this->General_model->update($this->table,$data,'branch_id',$branch_id);
                    $response_text = 'Item updated successfully';
			}
			else{
                    $result = $this->General_model->add($this->table,$data);
					$this->General_model->update($this->tbl_stock,$stockupdate,'stock_id',$stockid);
                    $response_text = 'Item issued  successfully';
			}
			if($result){
			$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			}
			else{
			$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
	        redirect('/Issueroll/', 'refresh');
		}
	}
	public function get(){
        $this->load->model('Issueroll_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
    	$data = $this->Issueroll_model->getIssueTable($param);
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
        $template['records'] = $this->General_model->get_row($this->tbl_issueitem,'branch_id',$branch_id);
        $this->load->view('template', $template);
    }
    public function checkstock()
    {
        $template['refno'] = $this->Issueroll_model->Refno();
        $br = $template['refno'][0]->branch_id;
        $itemid = $this->input->post('itemid');
        $data=$this->Issueitem_model->checkstock($itemid,$br);
        echo json_encode($data);
    }
	public function getPrevious()
    {
        $itemid = $this->input->post('itemid');
		$userid = $this->input->post('userid');
        $data=$this->Issueroll_model->getPrevious($itemid,$userid);
        echo json_encode($data);
    }
}