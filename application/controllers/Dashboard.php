<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends MY_Controller
{
    public $page  = 'Dashboard';
    public function __construct(){
        parent::__construct();
        if (!$this->is_logged_in()) {
            redirect('/login');
            $this->load->helper('url');
            $this->load->helper('file');
            $this->load->helper('download');
            $this->load->library('zip');
        }
        $this->load->model('Dashboard_model');
        $this->load->model('NewCommonModel');
        if(isset($_POST)){
    			$this->params=$_POST;
    		}
    		if(isset($_REQUEST)){
    			$this->param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
    			$this->param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
    			$this->param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
    			$this->param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
    			$this->param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
    			$this->param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
    		}
    		date_default_timezone_set("Asia/Kolkata");
    		if(!empty($this->session->userdata('user_branch'))){
    			$this->branch_name=$this->session->userdata('user_branch');
    			$this->branch_id=$this->NewCommonModel->getBranchID($this->branch_name);
    		}
    }
    public function index() {
        $template['total_users'] = $this->Dashboard_model->gettotal_users();
        $template['return_request'] = $this->Dashboard_model->gettotal_return();
        $template['purchase_orders'] = $this->Dashboard_model->getPuchaseOder();
        $template['rop'] = $this->Dashboard_model->get_rop();
        $template['Puchase_Request'] = $this->Dashboard_model->getPuchaseRequest();
        $template['Puchase_delivery'] = $this->Dashboard_model->getPuchaseDelivery();
        $template['brns'] = $this->Dashboard_model->getallBranch();
        $template['designation'] = $this->Dashboard_model->getDesignation2();
        $template['product'] = $this->Dashboard_model->getPoducts2();
        $template['brtobr'] = $this->Dashboard_model->gettotal_brtobr2();
        $template['productrequest'] = $this->Dashboard_model->gettotal_requests2();
        $template['branch'] = $this->Dashboard_model->getBranch2();
        $template['total_stock'] = $this->Dashboard_model->gettotal_stock2($this->branch_id);
        $template['categorys'] = $this->Dashboard_model->getCategorys2();
        $template['vendors'] = $this->Dashboard_model->getVendors2();
        $template['reorder'] = $this->Dashboard_model->reOrderdetails2();
        $template['breorder'] = $this->Dashboard_model->breordercount2();
        $template['employee'] = $this->Dashboard_model->empcounts2();
        $template['breturn'] = $this->Dashboard_model->breturncount2();
        $template['body'] = 'Dashboard/list2';
        $template['script'] = 'Dashboard/script2';
        $this->load->view('template', $template);
    }
    public function reOrderdetails()
    {
        $this->load->model('Masterstock_model');
        $param['draw'] = (isset($_REQUEST['draw'])) ? $_REQUEST['draw'] : '';
        $param['length'] = (isset($_REQUEST['length'])) ? $_REQUEST['length'] : '10';
        $param['start'] = (isset($_REQUEST['start'])) ? $_REQUEST['start'] : '0';
        $param['order'] = (isset($_REQUEST['order'][0]['column'])) ? $_REQUEST['order'][0]['column'] : '';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir'])) ? $_REQUEST['order'][0]['dir'] : '';
        $param['searchValue'] = (isset($_REQUEST['search']['value'])) ? $_REQUEST['search']['value'] : '';
        $data = $this->Masterstock_model->getStockTable($param);
        $bstock = $this->Masterstock_model->getBstock();
        for ($i = 0; $i < count($data['data']); $i++) {
            $tot = 0;
            for ($j = 0; $j < count($bstock['data']); $j++) {
                if ($data['data'][$i]->item_id_fk == $bstock['data'][$j]->item_id_fk) {
                    $tot = $bstock['data'][$j]->total;
                    break;
                }
            }
            $data['data'][$i]->btotal = $tot;
            $issued = $this->Masterstock_model->get_issued($data['data'][$i]->item_id_fk);
            $request = $this->Masterstock_model->get_request($data['data'][$i]->item_id_fk);
            $data['data'][$i]->requestquantity = $request[0]->request;
            $data['data'][$i]->issuedquantity = $issued[0]->issued;
            $data['data'][$i]->t_quantity = $data['data'][$i]->opening_stock + $data['data'][$i]->purchase_quantity - $issued[0]->issued - $issued[0]->issued - $request[0]->request;
        }
        $count = 0;
        for ($i = 0; $i < count($data['data']); $i++) {
            $remaining = $data['data'][$i]->remaining_qty;
            $rop = $data['data'][$i]->master_rop;
            if ($remaining < $rop) {
                $count = $count + 1;
            }
        }
        return $count;
    }
    public function breordercount()
    {
        $this->load->model('Branchstock_model');
        $param['draw'] = (isset($_REQUEST['draw'])) ? $_REQUEST['draw'] : '';
        $param['length'] = (isset($_REQUEST['length'])) ? $_REQUEST['length'] : '10';
        $param['start'] = 0;
        $param['length'] = 0;
        $param['dir'] = (isset($_REQUEST['order'][0]['dir'])) ? $_REQUEST['order'][0]['dir'] : '';
        $param['user_branch'] = (isset($_REQUEST['user_branch'])) ? $_REQUEST['user_branch'] : '';
        $param['item'] = (isset($_REQUEST['item'])) ? $_REQUEST['item'] : '';

        $data = $this->Branchstock_model->getStockTable($param);
        $bstock = $this->Branchstock_model->getUsedQuantity();
        $opstock = $this->Branchstock_model->getOPstock();
        $req = $this->Branchstock_model->getRqstock();
        $b_maxdate = $this->Branchstock_model->getBmaxdate();
        $i_maxdate = $this->Branchstock_model->getImaxdate();
        for ($i = 0; $i < count($data['data']); $i++) {
            $uqty = 0;
            for ($j = 0; $j < count($bstock['data']); $j++) {
                if ($data['data'][$i]->item_id_fk == $bstock['data'][$j]->iid  && $data['data'][$i]->shop_id_fk == $bstock['data'][$j]->br_id) {
                    $uqty = $bstock['data'][$j]->used_quantity;
                    break;
                }
            }
            $data['data'][$i]->used_qty = $uqty;
        }
        for ($i = 0; $i < count($data['data']); $i++) {
            $op = 0;
            for ($j = 0; $j < count($opstock['data']); $j++) {
                if ($data['data'][$i]->item_id_fk == $opstock['data'][$j]->item_id_fk  && $data['data'][$i]->shop_id_fk == $opstock['data'][$j]->shop_id_fk) {
                    $op = $opstock['data'][$j]->op;
                    break;
                }
            }
            $data['data'][$i]->op_qty = $op;
        }
        for ($i = 0; $i < count($data['data']); $i++) {
            $requests = 0;
            $update = 0;
            for ($j = 0; $j < count($req['data']); $j++) {
                if ($data['data'][$i]->item_id_fk == $req['data'][$j]->item_id_fk  && $data['data'][$i]->shop_id_fk == $req['data'][$j]->branch_id_fk) {
                    $requests = $req['data'][$j]->request_q;
                    $update = $req['data'][$j]->updated_date;
                    break;
                }
            }
            $data['data'][$i]->requests = $requests;
            $data['data'][$i]->update = $update;
        }

        for ($i = 0; $i < count($data['data']); $i++) {
            $date = $data['data'][$i]->date;
            for ($j = 0; $j < count($i_maxdate['data']); $j++) {
                if (($data['data'][$i]->item_id_fk == $i_maxdate['data'][$j]->iss_id)  && ($data['data'][$i]->shop_id_fk == $i_maxdate['data'][$j]->bid)) {

                    if ($data['data'][$i]->date < $i_maxdate['data'][$j]->mdate) {

                        $date = $i_maxdate['data'][$j]->mdate;

                        break;
                    }
                }
            }
            $data['data'][$i]->date = $date;
        }

        $all_total = 0;
        for ($i = 0; $i < count($data['data']); $i++) {

            $all_total = $data['data'][$i]->total + $all_total;
        }

        for ($i = 0; $i < count($data['data']); $i++) {

            $data['data'][$i]->all_total = $all_total;
        }
        $j = 0;
        for ($i = 0; $i < count($data['data']); $i++) {
            $remaining = $data['data'][$i]->total;
            $rop = $data['data'][$i]->item_rop;
            if ($remaining <= $rop) {
                $j = $j + 1;
            }
        }
        return $j;
    }
}
