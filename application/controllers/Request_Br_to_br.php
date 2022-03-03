<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Request_Br_to_br extends MY_Controller {
	public $table = 'tbl_stock';
	public $tbl_stockup = 'tbl_stockup';
	public $tbl_purchase = 'tbl_apurchase';
	public $page  = 'stock';
	public function __construct() {
		parent::__construct();
       if(! $this->is_logged_in()){
            redirect('/login');
        }
        $this->load->library('email');
        $this->load->model('General_model');
		    $this->load->model('Branchstock_model');
        $this->load->model('Returnmodel');
        $this->load->model('Stock_model');
        $this->load->model('Admin_view_Request_model');
        $this->load->model('Request_Br_to_br_model');
	}
	public function index()
	{

		$template['body'] = 'Request_Br_to_br/list';
		$template['script'] = 'Request_Br_to_br/script';
		$this->load->view('template', $template);
	}

    public function getRequest()
    {
        $param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        $param['branch'] = (isset($_REQUEST['branch']))?$_REQUEST['branch']:
        $data=$this->Request_Br_to_br_model->getRequest($param);
        $json_data = json_encode($data);
        echo $json_data;

    }

		public function updateToapprove($id){
			$sid = $this->session->userdata('id');
			$data= $this->Returnmodel->getoperator($sid);
			$data=$this->Request_Br_to_br_model->updateToapprove($id);
			$data1 = $this->Request_Br_to_br_model->getBrtobr_row($id);
			$c = array(
				'shop_id_fk' =>$data1[0]->to_branch_id_fk,
				'item_id_fk' =>$data1[0]->item_id_fk,
				'item_quantity' =>$data1[0]->item_quantity,
				'used_quantity' =>0,
				'updated_date' =>date('Y-m-d'),
				'status' =>0
			);
			$frombranch = $this->Request_Br_to_br_model->getFromBranch($id);
			$tobranch = $this->Request_Br_to_br_model->getToBranch($id);
			$com= $this->Request_Br_to_br_model->getCom();
			$agm= $this->Request_Br_to_br_model->getAgm();
			$admin= $this->Request_Br_to_br_model->getAdmin();
			$brm = $this->Request_Br_to_br_model->getBrm($tobranch[0]->branch_name);
			$i = $this->Request_Br_to_br_model->addtoShop($c);

			$response_text = 'Approved successfully';
			if($i){
				$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			}
			else{
				$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
			redirect('/Request_Br_to_br/', 'refresh');
		}
   //  public function updateToapprove($id)
   //  {
	 //
   //      $sid = $this->session->userdata('id');
   // $data= $this->Returnmodel->getoperator($sid);
   //    $data=$this->Request_Br_to_br_model->updateToapprove($id);
   //    $data1 = $this->Request_Br_to_br_model->getBrtobr_row($id);
	 //
   //    $c = array(
   //              'shop_id_fk' =>$data1[0]->to_branch_id_fk,
   //              'item_id_fk' =>$data1[0]->item_id_fk,
   //              'item_quantity' =>$data1[0]->item_quantity,
   //              'used_quantity' =>0,
   //              'updated_date' =>date('Y-m-d'),
   //              'status' =>0
   //    );
	 //
   //    $frombranch = $this->Request_Br_to_br_model->getFromBranch($id);
   //    $tobranch = $this->Request_Br_to_br_model->getToBranch($id);
   //    $com= $this->Request_Br_to_br_model->getCom();
   //    $agm= $this->Request_Br_to_br_model->getAgm();
   //    $admin= $this->Request_Br_to_br_model->getAdmin();
   //    $brm = $this->Request_Br_to_br_model->getBrm($tobranch[0]->branch_name);
   //    // var_dump($frombranch[0]->branch_name);
   //    // var_dump($tobranch[0]->branch_name);
   //    // var_dump($com[0]->user_email);
   //    // var_dump($agm[0]->user_email);
   //    // var_dump($admin[0]->user_email);
   //    // var_dump($brm[0]->user_email);
   //    $i = $this->Request_Br_to_br_model->addtoShop($c);
   //    /*if($i)
   //    {
   //         $Frommail = $this->General_model->getMail();
   //         if($Frommail != null)
   //             {
   //             $from_mail = $Frommail[0]->email;
   //             $message="Mutual branch request Aprroved---->Item name:".$frombranch[0]->item_name.",Item quantity:".$frombranch[0]->item_quantity.",From:".$frombranch[0]->branch_name;
   //              $this->email->from($from_mail);
   //              $this->email->to($agm[0]->user_email,$admin[0]->user_email,$brm[0]->user_email,$com[0]->user_email);
   //             // $this->email->to($agm[0]->user_email);
   //              //$this->email->to($admin[0]->user_email);
   //              //$this->email->to($brm[0]->user_email);
   //              $this->email->subject('Stock transfer');
   //              $this->email->message($message);
   //              $this->email->set_newline("\r\n");
   //              if($this->email->send())
   //              {
	 //
   //              }
   //              else
   //              {
   //                   //show_error($this->email->print_debugger());
   //              }
   //         }
   //    }*/
	 //
   //    redirect('/Request_Br_to_br/', 'refresh');
	 //
   //  }

    public function updateToreject()
    {

       $id = $this->input->post('req_id');
       $reason = $this->input->post('reason');
       $data=$this->Request_Br_to_br_model->updateToreject($id,$reason);
       redirect('/Request_Br_to_br/', 'refresh');

    }


    function get_operator(){

        $rt = $this->input->post('id');

         // print_r($pr_id);
         // exit();
        $data = $this->Request_Br_to_br_model->get_operator($rt);

//echo $data[0]->user_name;
        echo json_encode("Rejected by ".$data[0]->user_name." Reason: ".$data[0]->reject_reason." On ".$data[0]->updated_date);
   }


   function get_operator_approve(){

    $rt = $this->input->post('id');

     // print_r($pr_id);
     // exit();
    $data = $this->Request_Br_to_br_model->get_operator($rt);

//echo $data[0]->user_name;
    echo json_encode("Approved by ".$data[0]->user_name." On ".$data[0]->updated_date);
}
public function edit()
{
  $this->load->model('Users_model');
  $id = $this->uri->segment(3);

  $template['body'] = 'Request_Br_to_br/edit';
  $template['script'] = 'Request_Br_to_br/script';
  // $template['branch'] = $this->General_model->get_branches($id);
  // $template['item'] = $this->General_model->get_items($id);
  $template['branch'] = $this->Users_model->get_branch();
  $template['item'] = $this->Users_model->get_items();
  $template['records'] = $this->General_model->get_row('tbl_branch_to_branch','id',$id);



  $this->load->view('template', $template);
}
public function checkstock()
{
  $this->load->model('Branch_to_branch_model');
    $br = $this->input->post('branch');
    $itemid = $this->input->post('itemid');
    $data=$this->Branch_to_branch_model->checkstock($itemid,$br);
    if ($data == null)
    {
      $data=array('total'=>0);
      echo json_encode($data);
    }
    else
    {
      echo json_encode($data);
    }

}
  public function addAction()
  {
    $req_id = $this->input->post('req_id');
    $itemid = $this->input->post('itemid');
    $quantity = $this->input->post('quantity');
    $data=array('item_quantity'=>$quantity,'item_id_fk'=>$itemid);
    $this->General_model->update('tbl_branch_to_branch',$data,'id',$req_id);
    redirect('/Request_Br_to_br/', 'refresh');
  }

}
?>
