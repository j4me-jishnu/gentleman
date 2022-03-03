<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends MY_Controller
{
    public $page  = 'Dashboard';
    public function __construct()
    {
        parent::__construct();
        if (!$this->is_logged_in()) {
            redirect('/login');

            $this->load->helper('url');
            $this->load->helper('file');
            $this->load->helper('download');
            $this->load->library('zip');
        }

        $this->load->model('Dashboard_model');
    }
    public function index() {

        // print_r($this->session->userdata());
        // exit();
        $template['total_users'] = $this->Dashboard_model->gettotal_users();
        $template['return_request'] = $this->Dashboard_model->gettotal_return();
        // $template['brtobr'] = $this->Dashboard_model->gettotal_brtobr();
        $template['branch_stock'] = $this->Dashboard_model->getBranchstock();
        $template['pending_purchase'] = $this->Dashboard_model->get_purchasepending();


        $template['pending_purchase_dashboard'] = $this->Dashboard_model->get_purchasepending_dashboard();
        //	$template['stock_benchmark'] = $this->Dashboard_model->get_stock_benchmark();
        // $template['productrequest'] = $this->Dashboard_model->gettotal_requests();
        //$template['total_stock'] = $this->Dashboard_model->gettotal_stock();
        $template['purchase_orders'] = $this->Dashboard_model->getPuchaseOder();
        $template['rop'] = $this->Dashboard_model->get_rop();
        $template['Puchase_Request'] = $this->Dashboard_model->getPuchaseRequest();
        $template['Puchase_delivery'] = $this->Dashboard_model->getPuchaseDelivery();
        //$template['designation'] = $this->Dashboard_model->getDesignation();
        // $template['product'] = $this->Dashboard_model->getPoducts();
        // $template['branch'] = $this->Dashboard_model->getBranch();
        // $template['categorys'] = $this->Dashboard_model->getCategorys();
        // $template['vendors'] = $this->Dashboard_model->getVendors();
        $template['brns'] = $this->Dashboard_model->getallBranch();
        // $template['reorder'] = $this->reOrderdetails();
        // $template['breorder'] = $this->breordercount();
        //$template['total_users'] = $this->Dashboard_model->gettotal_users2();
        $template['designation'] = $this->Dashboard_model->getDesignation2();
        $template['product'] = $this->Dashboard_model->getPoducts2();
        $template['brtobr'] = $this->Dashboard_model->gettotal_brtobr2();
        $template['productrequest'] = $this->Dashboard_model->gettotal_requests2();
        $template['branch'] = $this->Dashboard_model->getBranch2();
        $template['total_stock'] = $this->Dashboard_model->gettotal_stock2();
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
        //$bstock =$this->Masterstock_model->getopstock();

        for ($i = 0; $i < count($data['data']); $i++) {
            $tot = 0;
            for ($j = 0; $j < count($bstock['data']); $j++) {
                if ($data['data'][$i]->item_id_fk == $bstock['data'][$j]->item_id_fk) {
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
                    //$data['data'][$i]->used_qty=$bstock['data'][$i]->used_quantity;
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
                // $data1['data'][$j]=$data['data'][$i];
                $j = $j + 1;
            }

            // echo $remaining;echo '         ';echo $rop;echo"<br>";
        }
        return $j;
    }
    // public function get(){
    // $this->load->model('Dashboard_model');
    // $param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
    // $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
    // $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
    // $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
    // $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
    // $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
    // $param['product_name'] =(isset($_REQUEST['product_name']))?$_REQUEST['product_name']:'';
    // $data = $this->Dashboard_model->getoldstock($param);
    // $json_data = json_encode($data);
    // echo $json_data;
    // }
    // public function database_backup()
    // {
    // $this->load->dbutil();
    // $db_format=array('format'=>'zip','filename'=>'wh_erp.sql');
    // $backup= $this->dbutil->backup($db_format);
    // $dbname='backup-on-'.date('Y-m-d').'.zip';
    // $save='assets/db_backup/'.$dbname;
    // write_file($save,$backup);
    // force_download($dbname,$backup);
    // }
}
