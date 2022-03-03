<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Updateusage extends MY_Controller {
	public $table = ' tbl_usageitem';
	public $tbl_return = ' tbl_return';
	public $tbl_stock = ' tbl_stock';
	public $page  = 'updateusage';
	public function __construct() {
		parent::__construct();
       if(! $this->is_logged_in()){
            redirect('/login');
        }
        
        $this->load->model('Updateusage_model');
		$this->load->model('General_model');
    }
	public function index()
	{
		$template['refno'] = $this->Updateusage_model->Refno();
		$branch_id = $template['refno'][0]->branch_id;
		$template['brmname'] = $this->Updateusage_model->brmname($branch_id);
		if(isset($template['brmname'][0]->user_branch))
		{
		$br = $template['brmname'][0]->user_branch;
		}
		else
		{
		$br = 0;
		}
		$template['userid'] = $this->Updateusage_model->get_id($br);
		$template['item'] = $this->Updateusage_model->get_item($br);
		$template['body'] = 'Updateusage/add';
		$template['script'] = 'Updateusage/script';
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('userid', 'UserId', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['refno'] = $this->Updateusage_model->Refno();
			$branch_id = $template['refno'][0]->branch_id;
			$template['brmname'] = $this->Updateusage_model->brmname($branch_id);
			$br = $template['brmname'][0]->user_branch;
			$template['userid'] = $this->Updateusage_model->get_id($br);
			$template['item'] = $this->Updateusage_model->get_item($br);
			$template['body'] = 'Updateusage/add';
			$template['script'] = 'Updateusage/script';
			$this->load->view('template', $template);
		}
		else {
			$template['refno'] = $this->Updateusage_model->Refno();
			$branch_id = $template['refno'][0]->branch_id;
			$userid = $this->input->post('userid'); 
			$itemid = $this->input->post('itemid'); 
			$usage = $this->input->post('usage_update');
			if($usage==1)
			{
				$data = array(
						'user_id_fk' => $userid,
						'item_id_fk' => $itemid,
						'branch_id_fk' => $branch_id,
						'usage_quantity' => $this->input->post('item_quantity'),
						'usage_date' => date('Y-m-d'),
						'usage_status' => 1
						);
				$result = $this->General_model->add($this->table,$data);
				$response_text = 'Usage Updated  successfully';
			}
			else{
				$returnData = array(
						'user_id_fk' => $userid,
						'item_id_fk' => $itemid,
						'branch_id_fk' => $branch_id,
						'item_quantity' => $this->input->post('item_quantity'),
						'return_narration'=> $this->input->post('narration'),
						'return_date' => date('Y-m-d'),
						'return_status' => 1
				);
				$template['refno'] = $this->Updateusage_model->Refno();
				$branch_id = $template['refno'][0]->branch_id;
				$template['item'] = $this->Updateusage_model->get_stock($itemid,$branch_id);
				$stockqua = $template['item'][0]->issuedqua;
				$stockid = $template['item'][0]->stock_id;
				$usedqua = $template['item'][0]->used_quantity;
				$quantity = $this->input->post('item_quantity');
				$usedqua = $usedqua - $quantity;
				$qua = $stockqua + $quantity;
				$stockupdate = array('issuedqua' => $qua,'used_quantity' => $usedqua);
				$this->General_model->update($this->tbl_stock,$stockupdate,'stock_id',$stockid);
				$result = $this->General_model->add($this->tbl_return,$returnData);
				$response_text = 'Usage Updated  successfully';
				
			}
			if($result){
			$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			}
			else{
			$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
	        redirect('/updateusage/', 'refresh');
		}
	}
	public function get(){
		$this->load->model('Branch_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
    	$data = $this->Branch_model->getBranchTable($param);
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
	public function checkissue(){
		$itemid = $this->input->post('itemid');
		$userid = $this->input->post('userid');
		$template['refno'] = $this->Updateusage_model->Refno();
		$branch_id = $template['refno'][0]->branch_id;
		$data = $this->Updateusage_model->get_issue($itemid,$userid,$branch_id);
		echo json_encode($data);
	}
	public function checkuse(){
		$itemid = $this->input->post('itemid');
		$userid = $this->input->post('userid');
		$template['refno'] = $this->Updateusage_model->Refno();
		$branch_id = $template['refno'][0]->branch_id;
		$data = $this->Updateusage_model->get_usage($itemid,$userid,$branch_id);
		echo json_encode($data);
	}
	public function returned(){
		$itemid = $this->input->post('itemid');
		$userid = $this->input->post('userid');
		$template['refno'] = $this->Updateusage_model->Refno();
		$branch_id = $template['refno'][0]->branch_id;
		$data = $this->Updateusage_model->get_returned($itemid,$userid,$branch_id);
		echo json_encode($data);
	}
}