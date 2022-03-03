<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reordernotification extends MY_Controller {
	public $page  = 'Dashboard';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
        redirect('/login');
		  
		$this->load->helper('url');
		$this->load->helper('file');
		$this->load->helper('download');
		$this->load->library('zip');
        }

        $this->load->model('Dashboard_model');
	}
	public function index()
	{
		$template['body'] = 'Reordernotification/list';
		$template['script'] = 'Reordernotification/script';
		$this->load->view('template', $template);
	}
	public function get()
	{
		$this->load->model('Masterstock_model');
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
			$data['data'][$i]->t_quantity = $data['data'][$i]->opening_stock + $data['data'][$i]->purchase_quantity - $issued[0]->issued - $issued[0]->issued - $request[0]->request; 
        }
        $j=0;
        $data1['data']='';
        for ($i=0 ; $i < count($data['data']) ; $i++ ) 
        {
        	$remaining=$data['data'][$i]->remaining_qty;
        	$rop=$data['data'][$i]->master_rop;
        	if ($remaining < $rop) 
        	{
        		$data1['data'][$j]=$data['data'][$i];
        	}
        	$j=$j+1;
        }

        echo json_encode($data1);	
	}
    public function show()
    {
        $this->load->model('Users_model');
        $template['branch'] = $this->Users_model->get_branch();
        $template['items'] = $this->Users_model->get_items();
        $template['body'] = 'Reordernotification/blist';
        $template['script'] = 'Reordernotification/bscript';
        $this->load->view('template', $template);
    }
    public function bget()
    {
        $this->load->model('Branchstock_model');
        $param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
         $param['user_branch'] = (isset($_REQUEST['user_branch']))?$_REQUEST['user_branch']:'';
        $param['item'] = (isset($_REQUEST['item']))?$_REQUEST['item']:'';
        
        $data = $this->Branchstock_model->getStockTable($param);
        $bstock =$this->Branchstock_model->getUsedQuantity();
        $opstock=$this->Branchstock_model->getOPstock();
        $req=$this->Branchstock_model->getRqstock();
        $b_maxdate =$this->Branchstock_model->getBmaxdate();
        $i_maxdate =$this->Branchstock_model->getImaxdate();
        for($i=0;$i<count($data['data']);$i++)
        {   
            $uqty=0;
            for($j=0;$j<count($bstock['data']);$j++)
            {
                if($data['data'][$i]->item_id_fk == $bstock['data'][$j]->iid  && $data['data'][$i]->shop_id_fk == $bstock['data'][$j]->br_id)
                {
                    $uqty = $bstock['data'][$j]->used_quantity;
                    //$data['data'][$i]->used_qty=$bstock['data'][$i]->used_quantity;
                    break;
                }
            }
            $data['data'][$i]->used_qty = $uqty;                
        }
        for ($i=0; $i < count($data['data']) ; $i++) { 
            $op = 0;
            for($j=0;$j<count($opstock['data']);$j++)
            { 
                if($data['data'][$i]->item_id_fk == $opstock['data'][$j]->item_id_fk  && $data['data'][$i]->shop_id_fk == $opstock['data'][$j]->shop_id_fk)
                {
                    $op=$opstock['data'][$j]->op;
                    break;
                }
            }
            $data['data'][$i]->op_qty = $op;
        }
        for ($i=0; $i < count($data['data']) ; $i++) { 
            $requests=0;$update=0;
            for($j=0;$j<count($req['data']);$j++)
            { 
                if($data['data'][$i]->item_id_fk == $req['data'][$j]->item_id_fk  && $data['data'][$i]->shop_id_fk == $req['data'][$j]->branch_id_fk)
                {
                    $requests = $req['data'][$j]->request_q;
                    $update = $req['data'][$j]->updated_date;
                    break;
                }
            }
            $data['data'][$i]->requests = $requests;
            $data['data'][$i]->update = $update;
        }  

        for($i=0;$i<count($data['data']);$i++)
        {   
           $date = $data['data'][$i]->date;
            for($j=0;$j<count($i_maxdate['data']);$j++)
            {
                if(($data['data'][$i]->item_id_fk == $i_maxdate['data'][$j]->iss_id)  && ($data['data'][$i]->shop_id_fk == $i_maxdate['data'][$j]->bid))
                {   
                   
                    if($data['data'][$i]->date < $i_maxdate['data'][$j]->mdate)
                    {       
                        
                       $date = $i_maxdate['data'][$j]->mdate;
                        
                       break;
                    }
                }
            }
            $data['data'][$i]->date=$date;
                            
        }

        $all_total =0;
        for($i=0;$i<count($data['data']);$i++)
        {  
          
           $all_total = $data['data'][$i]->total +$all_total;  
        }

        for($i=0;$i<count($data['data']);$i++)
        {  
          
           $data['data'][$i]->all_total = $all_total;  
        }
        $j=0;
        $data1['data']='';
        for ($i=0; $i < count($data['data']); $i++) { 
            $remaining=$data['data'][$i]->total;
            $rop=$data['data'][$i]->item_rop;
            if ($remaining <= $rop) 
            {
                $data1['data'][$j]=$data['data'][$i];
            }
            $j=$j+1;
            // echo $remaining;echo '         ';echo $rop;echo"<br>";
        }
        echo json_encode($data1);
    }
    public function bshow()
    {
        $this->load->model('Stock_model');
        $this->load->model('Users_model');
        $uid = $this->session->userdata('id');
         $template['items'] = $this->Users_model->get_items();
        $template['branch'] = $this->Stock_model->getbranch($uid);
        $template['body'] = 'Reordernotification/blists';
        $template['script'] = 'Reordernotification/bscripts';
        $this->load->view('template', $template);
    }
    public function getBstock()
    {
        $this->load->model('Stock_model');
        $uid = $this->session->userdata('id');
        $data = $this->Stock_model->getBranchid($uid);
        $br_id = $data[0] ->user_branch;
        $param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        $param['branch'] = (isset($_REQUEST['branch']))?$_REQUEST['branch']:''; 
        $param['item'] = (isset($_REQUEST['item']))?$_REQUEST['item']:'';   
        $data = $this->Stock_model->getBstock($param,$br_id);
        $bstock =$this->Stock_model->getIssuedQuantity($br_id);
        //var_dump(count($data['data']));
        for($i=0;$i<count($data['data']);$i++)
        {   

                $last = 0;
            for($j=0;$j<count($bstock['data']);$j++)
            {
                if($data['data'][$i]->item_id_fk == $bstock['data'][$j]->iid){

                    //$data['data'][$i]->last_issued_qty=$bstock['data'][$j]->last_issued;
                    $last = $bstock['data'][$j]->last_issued;
                    break;
                }

            }

            $data['data'][$i]->last_issued_qty = $last;
                
        }

         $all_total =0;
        for($i=0;$i<count($data['data']);$i++)
        {  
          
           $all_total = $data['data'][$i]->total +$all_total;  
        }

        for($i=0;$i<count($data['data']);$i++)
        {  
          
           $data['data'][$i]->all_total = $all_total;  
        }
        $j=0;
        $data1['data']='';
        for ($i=0; $i < count($data['data']); $i++) { 
            $remaining=$data['data'][$i]->total;
            $rop=$data['data'][$i]->item_rop;
            if ($remaining < $rop) 
            {
                $data1['data'][$j]=$data['data'][$i];
            }
            $j=$j+1;
            // echo $remaining;echo '         ';echo $rop;echo"<br>";
        }

        echo json_encode($data1);
    }
}	