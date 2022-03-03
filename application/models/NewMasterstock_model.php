<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class NewMasterstock_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function getNewMasterStock(){
		$query=$this->db->select('*')
			->join('ntbl_items','ntbl_master_stock.stock_item_id_fk = ntbl_items.item_id')
			->join('ntbl_master_os','ntbl_master_stock.stock_item_id_fk = ntbl_master_os.os_item_id_fk')
			->get('ntbl_master_stock');
		$result=$query->result();
		return $result;
	}
}
