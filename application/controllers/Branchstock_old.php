<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Branchstock extends MY_Controller {
	public $table = 'tbl_stock';
	public $tbl_stockup = 'tbl_stockup';
	public $tbl_purchase = 'tbl_apurchase';
	public $page  = 'stock';
	public function __construct() {
		parent::__construct();
       if(! $this->is_logged_in()){
            redirect('/login');
        }
 $this->load->model('General_model');
$this->load->model('Branchstock_model');
$this->load->model('Users_model');
	}
	public function index()
	{
		$template['branch'] = $this->Users_model->get_branch();
        $template['items'] = $this->Users_model->get_items();
		$template['body'] = 'Branchstock/list';
		$template['script'] = 'Branchstock/script';
		$this->load->view('template', $template);
	}

	public function get(){
		
    	 $param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        //$param['user_branch'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        $param['user_branch'] = (isset($_REQUEST['user_branch']))?$_REQUEST['user_branch']:'';
        $param['item'] = (isset($_REQUEST['item']))?$_REQUEST['item']:'';
		
    	$data = $this->Branchstock_model->getStockTable($param);
    	$bstock =$this->Branchstock_model->getUsedQuantity();
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

        
    	$json_data = json_encode($data);
    	echo $json_data;
    }
}
?>