<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Branch_to_branch extends MY_Controller
{
	public $table = ' tbl_branch_to_branch';
	public $tbl_return = ' tbl_return';
	public $tbl_stock = ' tbl_stock';
	public $page  = 'updateusage';
	public function __construct()
	{
		parent::__construct();
		if (!$this->is_logged_in()) {
			redirect('/login');
		}
		$this->load->library('email');
		$this->load->model('Request_item_model');
		$this->load->model('Branch_to_branch_model');
		$this->load->model('Purchase_model');
		$this->load->model('Stock_model');
		$this->load->model('General_model');
		$this->load->model('Users_model');
		$this->load->model('Request_Br_to_br_model');
	}
	public function index()
	{
		$template['refno'] = $this->Request_item_model->Refno();
		$branch_id = $template['refno'][0]->branch_id;
		$template['brmname'] = $this->Request_item_model->brmname($branch_id);
		if (isset($template['brmname'][0]->user_branch)) {
			$br = $template['brmname'][0]->user_branch;
		} else {
			$br = 0;
		}
		$template['userid'] = $this->Request_item_model->get_id($br);
		$template['item'] = $this->Request_item_model->get_item();
		$template['body'] = 'Branch_to_branch/list';
		$template['script'] = 'Branch_to_branch/script';
		$this->load->view('template', $template);
	}

	public function add()
	{

		$template['branch'] = $this->Stock_model->get_branch();
		$template['refno'] = $this->Purchase_model->Refno();
		$branch_id = $template['refno'][0]->branch_id;
		$template['item'] = $this->Stock_model->get_Branchitem($branch_id);
		$template['body'] = 'Branch_to_branch/add';
		$template['script'] = 'Branch_to_branch/script';
		$this->load->view('template', $template);
	}
	public function addAction()
	{
		$this->form_validation->set_rules('itemid', 'itemid', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['refno'] = $this->Request_item_model->Refno();
			$branch_id = $template['refno'][0]->branch_id;
			$template['brmname'] = $this->Request_item_model->brmname($branch_id);
			$br = $template['brmname'][0]->user_branch;
			$template['userid'] = $this->Request_item_model->get_id($br);
			$template['item'] = $this->Request_item_model->get_item($br);
			$template['body'] = 'Request_item/add';
			$template['script'] = 'Request_item/script';
			$this->load->view('template', $template);
		} else {
			$template['refno'] = $this->Purchase_model->Refno();
			$branch_id = $template['refno'][0]->branch_id;
			$to_branchid = $this->input->post('branchid');
			$itemid = $this->input->post('itemid');
			$quantity = $this->input->post('quantity');
			$date = $this->input->post('issue_date');

			$data = array(

				'item_id_fk' => $itemid,
				'from_branch_id_fk' => $branch_id,
				'to_branch_id_fk' => $to_branchid,
				'item_quantity' => $this->input->post('quantity'),
				'date' => date('Y-m-d'),
				'status' => 0
			);
			$result = $this->General_model->add($this->table, $data);
			$response_text = 'Updated  successfully';
			$frombranch = $this->Branch_to_branch_model->getBranch($branch_id);
			$tobranch = $this->Branch_to_branch_model->getBranch($to_branchid);
			$item = $this->Branch_to_branch_model->getItemm($itemid);
			$admin = $this->Request_Br_to_br_model->getAdmin();
			$com = $this->Request_Br_to_br_model->getCom();
			$agm = $this->Request_Br_to_br_model->getAgm();
			// var_dump($frombranch[0]->branch_name);
			// var_dump($tobranch[0]->branch_name);
			// var_dump($admin[0]->user_email);
			// var_dump($item[0]->item_name);

			if ($result) {
				$Frommail = $this->General_model->getMail();
				if ($Frommail) {
					$from_mail = $Frommail[0]->email;
					$message = "Mutual Branch Request ---> Item name:" . $item[0]->item_name . ",Item quantity:" . $quantity . ",From:" . $frombranch[0]->branch_name . ",To:" . $tobranch[0]->branch_name;
					$this->email->from($from_mail);
					$this->email->to($admin[0]->user_email, $agm[0]->user_email, $com[0]->user_email);
					//$this->email->to($agm[0]->user_email);
					//$this->email->to($admin[0]->user_email);
					//$this->email->to($brm[0]->user_email);
					$this->email->subject('Stock transfer');
					$this->email->message($message);
					$this->email->set_newline("\r\n");
					if ($this->email->send()) {
					} else {
						//show_error($this->email->print_debugger());
					}
				}


				$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			} else {
				$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
			redirect('/Branch_to_branch/', 'refresh');
		}
	}
	public function get()
	{
		$this->load->model('Branch_to_branch_model');
		$param['draw'] = (isset($_REQUEST['draw'])) ? $_REQUEST['draw'] : '';
		$param['length'] = (isset($_REQUEST['length'])) ? $_REQUEST['length'] : '10';
		$param['start'] = (isset($_REQUEST['start'])) ? $_REQUEST['start'] : '0';
		$param['order'] = (isset($_REQUEST['order'][0]['column'])) ? $_REQUEST['order'][0]['column'] : '';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir'])) ? $_REQUEST['order'][0]['dir'] : '';
		$param['searchValue'] = (isset($_REQUEST['search']['value'])) ? $_REQUEST['search']['value'] : '';
		$template['refno'] = $this->Purchase_model->Refno();
		$branch_id = $template['refno'][0]->branch_id;

		$data = $this->Branch_to_branch_model->getData($param, $branch_id);
		$json_data = json_encode($data);
		echo $json_data;
	}
	public function delete()
	{

		$request_id = $this->input->post('request_id');

		$data = $this->Request_item_model->delete($request_id);
		if ($data) {
			$response['text'] = 'Deleted successfully';
			$response['type'] = 'success';
		} else {
			$response['text'] = 'Something went wrong';
			$response['type'] = 'error';
		}
		$response['layout'] = 'topRight';
		$data_json = json_encode($response);
		echo $data_json;
		redirect('/Request_item/', 'refresh');
	}

	public function edit($id)
	{
		$template['body'] = 'Branch_to_branch/add';
		$template['script'] = 'Branch_to_branch/script';
		$template['branch'] = $this->General_model->get_branches($id);
		$template['item'] = $this->General_model->get_items($id);
		$template['records'] = $this->General_model->get_row($this->table, 'id', $id);
		$this->load->view('template', $template);
	}




	public function checkissue()
	{
		$itemid = $this->input->post('itemid');
		$userid = $this->input->post('userid');
		$template['refno'] = $this->Request_item_model->Refno();
		$branch_id = $template['refno'][0]->branch_id;
		$data = $this->Request_item_model->get_issue($itemid, $userid, $branch_id);
		echo json_encode($data);
	}
	public function checkuse()
	{
		$itemid = $this->input->post('itemid');
		$userid = $this->input->post('userid');
		$template['refno'] = $this->Request_item_model->Refno();
		$branch_id = $template['refno'][0]->branch_id;
		$data = $this->Request_item_model->get_usage($itemid, $userid, $branch_id);
		echo json_encode($data);
	}
	public function returned()
	{
		$itemid = $this->input->post('itemid');
		$userid = $this->input->post('userid');
		$template['refno'] = $this->Request_item_model->Refno();
		$branch_id = $template['refno'][0]->branch_id;
		$data = $this->Request_item_model->get_returned($itemid, $userid, $branch_id);
		echo json_encode($data);
	}

	public function checkstock()
	{		
		$template['refno'] = $this->Purchase_model->Refno();
		$br = $template['refno'][0]->branch_id;
		$itemid = $this->input->post('itemid');
		$data = $this->Branch_to_branch_model->checkstock($itemid, $br);
		echo json_encode($data);
	}
}
