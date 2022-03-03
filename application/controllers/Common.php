<?php
ob_start();
/*
 This is used to write all common functions mainly for ajax calls.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Common extends MY_Controller{

    private $branch_name;
	private $branch_id;
	private $params;
	private $result;

    public function __construct() {
        parent::__construct();
        $this->load->model('Commonmodel');
        $this->load->model('NewCommonModel');

        if(!empty($this->session->userdata('user_branch'))){
			$this->branch_name=$this->session->userdata('user_branch');
			$this->branch_id=$this->NewCommonModel->getBranchID($this->branch_name);
		}
    }
    public function getVendorList(){
        $vendorname = ($this->input->get('searchTerm'))?$this->input->get('searchTerm'):'';
        $result = $this->Commonmodel->getVendorModel($vendorname);
        $json = json_encode($result);
        echo $json;

    }
    public function getItemList(){
        $itemname = ($this->input->get('searchTerm'))?$this->input->get('searchTerm'):'';
        $result = $this->Commonmodel->getItem($itemname);
		$json = json_encode($result);
        echo $json;
    }
	public function getbranchItemList(){
        $itemname = ($this->input->get('searchTerm'))?$this->input->get('searchTerm'):'';
        $result = $this->Commonmodel->getbranchItem($itemname);
		$json = json_encode($result);
        echo $json;
    }
    public function getPurchaseListusingID(){
        $purchaseid = ($this->input->get('searchTerm'))?$this->input->get('searchTerm'):'';
        $result = $this->Commonmodel->getProductDetails($purchaseid);
        // print_r($result);
        // exit();
        $json = json_encode($result);
        echo $json;
    }
    public function getCustomerList(){
        $customername = ($this->input->get('searchTerm'))?$this->input->get('searchTerm'):'';
        $result = $this->Commonmodel->getCustomerModel($customername);
        $json = json_encode($result);
        echo $json;
    }
	public function getDealerList(){
        $customername = ($this->input->get('searchTerm'))?$this->input->get('searchTerm'):'';
        $result = $this->Commonmodel->getDealerModel($customername);
        $json = json_encode($result);
        echo $json;
    }
    public function getEmployeeList(){
		$uid = $this->Commonmodel->getBranchId();
		$br = $uid[0]->user_branch;
        $employeename = ($this->input->get('searchTerm'))?$this->input->get('searchTerm'):'';
        $result = $this->Commonmodel->getEmployeeModel($employeename,$br);
        $json = json_encode($result);
        echo $json;
    }
    public function getInvoiceList(){
        $invoiceNo = ($this->input->get('searchTerm'))?$this->input->get('searchTerm'):'';
        $result = $this->Commonmodel->getInvoiceModel($invoiceNo);
        $json = json_encode($result);
        echo $json;
    }
    public function getSaleInvoiceList(){
        $invoiceNo = ($this->input->get('searchTerm'))?$this->input->get('searchTerm'):'';
        $result = $this->Commonmodel->getSaleInvoiceModel($invoiceNo);
        $json = json_encode($result);
        echo $json;
    }
	// public function getEmployeeList(){
    //     $empmname = ($this->input->get('searchTerm'))?$this->input->get('searchTerm'):'';
    //     $result = $this->Commonmodel->getEmploye($empmname);
	// 	$json = json_encode($result);
    //     echo $json;
    // }
    //branch Single item Stock
    public function branchTotalStock()
	{
		$item_id = 2;
		//$branch_name = $this->session->userdata('user_branch');
		// $branch_id = $this->session->userdata('id');
		$branch_id = $this->branch_id;

		//branch 2 Branch Given
		$b2bcountGiven = $this->Commonmodel->b2bcountlist($item_id,$branch_id);
        if($b2bcountGiven[0]->btb_sum_item == NULL){
        $b2bcountGiven = 0;
        }
        else
        {
        $b2bcountGiven = $b2bcountGiven[0]->btb_sum_item;
        }
		//opening stock
		$opening_stock = $this->Commonmodel->branchOpeningStock($item_id,$branch_id);
        if($opening_stock[0]->os_sum_item == NULL){
        $opening_stock = 0;
        }
        else
        {
        $opening_stock = $opening_stock[0]->os_sum_item   ;
        }
		//item request to master
		$req_2_master = $this->Commonmodel->btomreqList($item_id,$branch_id);
        if($req_2_master[0]->req_sum_item == NULL){
        $req_2_master = 0;
        }
        else
        {
        $req_2_master = $req_2_master[0]->req_sum_item;
        }
		//issued_items
		$issued_items = $this->Commonmodel->issuedItemList($item_id,$branch_id);
        if($issued_items[0]->issue_sum_item == NULL){
        $issued_items = 0;
        }
        else
        {
        $issued_items = $issued_items[0]->issue_sum_item;
        }
        //recieved from branch
        $recieved_b_items = $this->Commonmodel->recievedFromBItemList($item_id,$branch_id);
        if($recieved_b_items[0]->btb_sum_item == NULL){
        $recieved_b_items = 0;
        }
        else
        {
        $recieved_b_items = $recieved_b_items[0]->btb_sum_item;
        }
		//recieved from Master
		$recievedFromMaster = $this->Commonmodel->recievedItemList($item_id,$branch_id);
        if($recievedFromMaster[0]->recive_sum_item == NULL){
        $recievedFromMaster = 0;
        }
        else
        {
        $recievedFromMaster = $recievedFromMaster[0]->recive_sum_item;
        }
        //return Master
        $rtom_master = $this->Commonmodel->returnToMasterList($item_id,$branch_id);
        if($rtom_master[0]->rtom_sum_item == NULL){
        $rtom_master = 0;
        }
        else
        {
        $rtom_master = $rtom_master[0]->rtom_sum_item;
        }

        $total_stock = $opening_stock + $recievedFromMaster + $recieved_b_items - $issued_items - $b2bcountGiven - $rtom_master;
        $data = [
            'opening_stock' =>$opening_stock,
            'recieved_f_master' =>$recievedFromMaster,
            'recieved_f_branch' =>$recieved_b_items,
            'issued_items' =>$issued_items,
            'branch_t_branch_given' =>$b2bcountGiven,
            'return_t_master' =>$rtom_master,
            'total_stock' => $total_stock
        ];

		//var_dump($recievedFromMaster,$issued_items,$req_2_master,$opening_stock,$b2bcountGiven,$rtom_master);die;
		echo json_encode($data);

	}

    //branch stock lists
    public function BranchStockLists()
    {
        $branch_id = $this->branch_id;

        //Items List
        $itemslists = $this->Commonmodel->getItemsListss();

		//branch 2 Branch Given
		$b2bcountGiven = $this->Commonmodel->b2bcountlist2($branch_id);

		//opening stock
		$opening_stock = $this->Commonmodel->branchOpeningStock2($branch_id);

		//item request to master
		$req_2_master = $this->Commonmodel->btomreqList2($branch_id);

		//issued_items
		$issued_items = $this->Commonmodel->issuedItemList2($branch_id);

        //recieved from branch
        $recieved_b_items = $this->Commonmodel->recievedFromBItemList2($branch_id);

		//recieved from Master
		$recievedFromMaster = $this->Commonmodel->recievedItemList2($branch_id);

        //return Master
        $rtom_master = $this->Commonmodel->returnToMasterList2($branch_id);
       $i= 0;
       $total_b2b_given =[];
       $total_opening =[];
       $total_recieved_master =[];
       $total_issued_items =[];
       $total_recbranitems =[];
       $total_returns =[];
       $total_opstck_qty =[];
        foreach($itemslists as $items){
            foreach($b2bcountGiven as $btb_qty){
                if($items->item_id == $btb_qty->btob_item_id_fk){
                    array_push($total_b2b_given,$btb_qty);
                }
            }

            foreach($opening_stock as $opstck){
                if($items->item_id == $opstck->os_item_id_fk){
                    array_push($total_opening,$opstck);
                }
            }

            // foreach($req_2_master as $reqmaster){
            //     if($items->item_id == $reqmaster->req_item_id_fk){
            //         array_push($total_recieved_master,$reqmaster);
            //     }
            // }

            foreach($issued_items as $issueditems){
                if($items->item_id == $issueditems->issued_item_id_fk){
                    array_push($total_issued_items,$issueditems);
                }
            }

            foreach($recieved_b_items as $recbranitems){
                if($items->item_id == $recbranitems->btob_item_id_fk){
                    array_push($total_recbranitems,$recbranitems);
                }
            }

            foreach($recievedFromMaster as $recievedFromMasters){
                if($items->item_id == $recievedFromMasters->req_item_id_fk){
                    array_push($total_recieved_master,$recievedFromMasters);
                }
            }

            foreach($rtom_master as $rtom_master3){
                if($items->item_id == $rtom_master3->return_item_id_fk){
                    array_push($total_returns,$rtom_master);
                }
            }
        }

        return $total_opening;

        //var_dump($itemslists);die;
		//var_dump($b2bcountGiven,$opening_stock,$req_2_master,$issued_items,$recieved_b_items,$recievedFromMaster,$rtom_master);die;
		// echo json_encode($data);
    }

    public function getItemsList()
    {
        return $itemslists = $this->Commonmodel->getItemsListss();
    }

    public function getRecievedFromMaster()
    {
        $total_recieved_master = [];
        $branch_id = $this->branch_id;
        $recievedFromMaster = $this->Commonmodel->recievedItemList2($branch_id);
        $itemslists = $this->Commonmodel->getItemsListss();
        foreach($itemslists as $items){
            foreach($recievedFromMaster as $recievedFromMasters){
                if($items->item_id == $recievedFromMasters->req_item_id_fk){
                    array_push($total_recieved_master,$recievedFromMasters);
                }
            }
        }
        return $total_recieved_master;

    }
    public function getB2Brecieved()
    {
        $total_recbranitems =[];
        $branch_id = $this->branch_id;
        $recieved_b_items = $this->Commonmodel->recievedFromBItemList2($branch_id);
        $itemslists = $this->Commonmodel->getItemsListss();
        foreach($itemslists as $items){
            foreach($recieved_b_items as $recbranitems){
                if($items->item_id == $recbranitems->btob_item_id_fk){
                    array_push($total_recbranitems,$recbranitems);
                }
            }
        }
        return $total_recbranitems;
    }

    public function getIssuedItems()
    {
        $total_issued_items =[];
        $branch_id = $this->branch_id;
        $issued_items = $this->Commonmodel->issuedItemList2($branch_id);
        $itemslists = $this->Commonmodel->getItemsListss();
        foreach($itemslists as $items){
            foreach($issued_items as $issueditems){
                if($items->item_id == $issueditems->issued_item_id_fk){
                    array_push($total_issued_items,$issueditems);
                }
            }
        }
            return $total_issued_items;
    }

    public function getRetunToMaster()
    {
        $total_returns =[];
        $branch_id = $this->branch_id;
        $rtom_master = $this->Commonmodel->returnToMasterList2($branch_id);
        $itemslists = $this->Commonmodel->getItemsListss();
        foreach($itemslists as $items){
            foreach($rtom_master as $rtom_master3){
                if($items->item_id == $rtom_master3->return_item_id_fk){
                    array_push($total_returns,$rtom_master);
                }
            }
        }
        return $total_returns;
    }

    public function getB2Blist()
    {
        $total_b2b_given = [];
        $branch_id = $this->branch_id;
        $b2bcountGiven = $this->Commonmodel->b2bcountlist2($branch_id);
        $itemslists = $this->Commonmodel->getItemsListss();
        foreach($itemslists as $items){
            foreach($b2bcountGiven as $btb_qty){
                if($items->item_id == $btb_qty->btob_item_id_fk){
                    array_push($total_b2b_given,$btb_qty);
                }
            }
        }
        return $total_b2b_given;
    }

    public function getBranchStockTotal()
    {
        $branch_id = $this->branch_id;

        //Items List
        $itemslists = $this->Commonmodel->getItemsListss();

		//branch 2 Branch Given
		$b2bcountGiven = $this->Commonmodel->b2bcountlist2($branch_id);

		//opening stock
		$opening_stock = $this->Commonmodel->branchOpeningStock2($branch_id);

		//item request to master
		$req_2_master = $this->Commonmodel->btomreqList2($branch_id);

		//issued_items
		$issued_items = $this->Commonmodel->issuedItemList2($branch_id);

        //recieved from branch
        $recieved_b_items = $this->Commonmodel->recievedFromBItemList2($branch_id);

		//recieved from Master
		$recievedFromMaster = $this->Commonmodel->recievedItemList2($branch_id);

        //return Master
        $rtom_master = $this->Commonmodel->returnToMasterList2($branch_id);
       $i= 0;
       $total_b2b_given =[];
       $total_opening =[];
       $total_recieved_master =[];
       $total_issued_items =[];
       $total_recbranitems =[];
       $total_returns =[];
       $total_opstck_qty =[];
       $i=0;
       $total= [];
        foreach($itemslists as $items){
            @$total[$i]['item_id_fks'] = $total[$i]['item_id_fks'] + $items->item_id;
            foreach($b2bcountGiven as $btb_qty){
                if($items->item_id == $btb_qty->btob_item_id_fk){
                    array_push($total_b2b_given,$btb_qty);
                   @$total[$i]['item_count'] = $total[$i]['item_count'] - $btb_qty->btb_item_count;
                }
            }

            foreach($opening_stock as $opstck){
                if($items->item_id == $opstck->os_item_id_fk){
                    array_push($total_opening,$opstck);
                    @$total[$i]['item_count'] = $total[$i]['item_count'] + $opstck->os_item_count;
                }
            }


            foreach($issued_items as $issueditems){
                if($items->item_id == $issueditems->issued_item_id_fk){
                    array_push($total_issued_items,$issueditems);
                    @$total[$i]['item_count'] = $total[$i]['item_count'] - $issueditems->total_issued_qty;
                }
            }

            foreach($recieved_b_items as $recbranitems){
                if($items->item_id == $recbranitems->btob_item_id_fk){
                    array_push($total_recbranitems,$recbranitems);
                    @$total[$i]['item_count'] = $total[$i]['item_count'] + $recbranitems->total_btb_qty;
                }
            }

            foreach($recievedFromMaster as $recievedFromMasters){
                if($items->item_id == $recievedFromMasters->req_item_id_fk){
                    array_push($total_recieved_master,$recievedFromMasters);
                    @$total[$i]['item_count'] = $total[$i]['item_count'] + $recievedFromMasters->total_req_qty;
                }
            }

            foreach($rtom_master as $rtom_master3){
                if($items->item_id == $rtom_master3->return_item_id_fk){
                    array_push($total_returns,$rtom_master);
                    @$total[$i]['item_count'] = $total[$i]['item_count'] - $rtom_master3->total_return_qty;
                }

            }


            $i++;
        }
         //var_dump($total);die;
        return $total;

    }

    public function ShowTotalStock()
    {
        $template['items'] = $this->getItemsList();
        $template['opening_stock'] =  $this->BranchStockLists();
        $template['b2b_givens'] =  $this->getB2Blist();
        $template['recieved_by_master'] =  $this->getRecievedFromMaster();
        $template['b2b_recieved'] =  $this->getB2Brecieved();
        $template['issued_items'] =  $this->getIssuedItems();
        $template['return_master'] =  $this->getRetunToMaster();
        $template['total_stock'] =  $this->getBranchStockTotal();
        //var_dump($template['total_stock']);die;
        $template['body'] = 'NewBranch/NewStockDetails/list';
        $template['script'] = 'NewBranch/NewStockDetails/script';
        $this->load->view('template',$template);
    }


    //Master Stock single item
    public function masterTotalStock()
	{
		$item_id = $this->input->post('item_id');
		//Branch to Branch
		$b2bCount = $this->Commonmodel->b2bCountListMaster($item_id);
		//opening Stock
		$opening_stock = $this->Commonmodel->masterOpeningStock($item_id);
		//item rquest to master
		$req_2_master = $this->Commonmodel->btomreqMasterList($item_id);
		//issued_items
		$issued_items = $this->Commonmodel->issuedItemMasterList($item_id);
		//recieved from admin
		$recievedFromAdmin = $this->Commonmodel->recievedItemMasterList($item_id);
		var_dump($b2bCount);die;
	}

  public function getDatabase(){
  $this->load->dbutil();
  $prefs=array(
    'format'      => 'zip',
    'filename'    => 'my_db_backup_.sql'
  );
  $backup =& $this->dbutil->backup($prefs);
  $db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
  // $save = 'pathtobkfolder/'.$db_name;
  // $this->load->helper('file');
  // write_file($save, $backup);
  $this->load->helper('download');
  force_download($db_name, $backup);
}

}

?>
