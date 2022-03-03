<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class NewCommon extends MY_Controller {

	private $params;
	private $result;
	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
			redirect('/login');
		}
		$this->load->model('General_model');
		$this->load->model('Masterstock_model');
		$this->load->model('NewMasterstock_model');
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
		if(!empty($this->session->userdata('user_branch'))){
			$this->branch_name=$this->session->userdata('user_branch');
			$this->branch_id=$this->NewCommonModel->getBranchID($this->branch_name);
		}
		date_default_timezone_set("Asia/Kolkata");
	}
	//create table dynamic code - edit needed from below code to add a new table
	public function createTable(){
		$this->load->dbforge();
		$fields=[
			'scrap_id'=>[
				'type'=>'INT',
				'constraint'=>'11',
				'auto_increment'=>TRUE
			],
			'scrap_item_id_fk'=>[
				'type'=>'INT',
				'constraint'=>'11',
			],
			'scrap_qty'=>[
				'type'=>'INT',
				'constraint'=>'11',
			],
			// 'vendor_pay_date'=>[
			// 	'type'=>'DATE',
			// 	'default'=>date('Y-m-d'),
			// ],
			// 'vendor_payed_amt'=>[
			// 	'type'=>'VARCHAR',
			// 	'constraint'=>'255',
			// ],
			// 'pur_rtrn_amt'=>[
			// 	'type'=>'DOUBLE',
			// ],
			'scrap_status'=>[
				'type'=>'TINYINT',
				'constraint'=>'2',
				'default'=>'1'
			],
			'created_at'=>[
				'type'=>'DATETIME',
				'default'=>date('Y-m-d H:i:s')
			],
			'updated_at'=>[
				'type'=>'TIMESTAMP',
				'default'=>date('Y-m-d H:i:s')
			],
		];
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('scrap_id',TRUE);
		//edit here table name
		$query=$this->dbforge->create_table('ntbl_scrap_items');
		if($query){	echo "Success"; } else { echo "failed"; }
	}

	public function modifyTable(){
		$this->load->dbforge();
		$fields=[
			'branch_address'=>[
				'type'=>'TEXT',
				'default'=>NULL,
			],
			'branch_phone'=>[
				'type'=>'VARCHAR',
				'constraint'=>'30',
				'default'=>NULL,
			],
			'branch_email'=>[
				'type'=>'VARCHAR',
				'constraint'=>'255',
				'default'=>NULL,
			],
		];
		$query=$this->dbforge->modify_column('ntbl_branches', $fields);
		if($query){	echo "Success"; } else { echo "failed"; }
	}

	public function alterTable(){
		$this->load->dbforge();
		$fields=[
			'branch_address'=>[
				'type'=>'TEXT',
			],
			'branch_phone'=>[
				'type'=>'VARCHAR',
				'constraint'=>'30',
			],
			'branch_email'=>[
				'type'=>'VARCHAR',
				'constraint'=>'255',
			],
		];
		//$query = $this->dbforge->add_column('ntbl_branches',$fields);  //uncomment this line
		if($query){	echo "Success"; } else { echo "failed"; }
	}

	public function truncateTable(){
		$this->load->dbforge();
		//$query=$this->db->truncate('ntbl_category');
		if($query){	echo "Success"; } else { echo "failed"; }
	}

	public function dropTable()
	{
		$this->load->dbforge();
		//$query = $this->dbforge->drop_table('ntbl_stock_incoming');
		if($query){	echo "Success"; } else { echo "failed"; }
	}

	public function getItemList(){
		$records=$this->NewCommonModel->get_data('ntbl_items');
		echo json_encode($records);
	}
	//List all the employees from a particular branch
	public function getAllBranchEmployees(){
		$condition=[
			'branch_name'=>$this->session->userdata('user_branch')
		];
		$this->result=$this->NewCommonModel->getBranchEmployeesList($condition);
	}
	//Get all stock ntbl_items
	public function getAllStockItems(){
		$this->result=$this->NewCommonModel->getAllItems();
	}

	// get all branch list
	public function getAllBranches(){
		$this->result=$this->NewCommonModel->getAllBranches();
	}

	public function editBtoBrequest()
	{
		$btob_id = $this->input->post('btob_id');
		$data = $this->NewCommonModel->getEditAllBranches($btob_id);
		echo json_encode($data);
	}

	public function insertData(){
		$response=$this->NewCommonModel->insertValues();
		if($response){
			echo "Success";
		}
		die();
	}

	public function test(){
		$result=$this->NewCommonModel->get_data('ntbl_bs_returntomaster');
		var_dump($result); die;
	}

	public function __destruct(){
		if(isset($this->result)){
			echo json_encode($this->result);
		}
	}

public function dbBack()
{
	$this->load->dbutil();

$prefs = array(
    'format'      => 'zip',
    'filename'    => 'my_db_backup.sql'
    );


@$backup =& $this->dbutil->backup($prefs);

$db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
// $save = 'pathtobkfolder/'.$db_name;
//
// $this->load->helper('file');
// write_file($save, $backup);


$this->load->helper('download');
force_download($db_name, $backup);
}

}
?>
