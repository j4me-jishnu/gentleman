<?php

// list


if($this->session->flashdata('message')!=NULL){
  echo '<script>swal("'.$this->session->flashdata('message').'", "", "'.$this->session->flashdata('type').'");</script>';
}

// controller
if($is_os){
  $message="Cannot add opening stock! Data existing already";
  $this->session->set_flashdata('message',$message);
  $this->session->set_flashdata('type',"warning");
  redirect('NewMaster/showMasterOpeningStock', 'refresh');
}

"data": "is_approved",
"render": function ( data, type, row ) {
    if(data == 0){
        return '<button class="btn btn-warning">Pending</button>';
    }else if(data == 1){
        return '<button class="btn btn-success">Approved</button>';
    }else{
        return '<button class="btn btn-danger">Rejected</button>';
    }
}

approval of request

public function approveStockRequest(){
	$item_id=$_POST['request_item_id'];
	$current_master_stock=intval($_POST['current_stock']);
	$requested_stock=$_POST['requested_stock'];
	$requested_branch_id=$_POST['requested_branch'];
	if(intval($current_master_stock)>intval($requested_stock)){
		$condition=['req_id'=>$_POST['request_id']];
		$update_array=['req_status'=>1];
		$result=$this->NewCommonModel->update_stock_request_status($condition,$update_array);
		$new_stock=intval($current_master_stock)-intval($requested_stock);
		$master_branch=$this->NewCommonModel->get_master_id();
		$master_update_condition=[
			'branch_id'=>$master_branch,
			'item_id'=>$item_id,
		];
		$master_update_array=['stock_balance'=>$new_stock];
		$master_update_result=$this->NewCommonModel->update_data('ntbl_stock_balances',$master_update_array,$master_update_condition);
		$check_existance=$this->NewCommonModel->get_single_item_current_stock($requested_branch_id,$item_id);
		if($check_existance!=0){
			$branch_update_condition=[
				'branch_id'=>$requested_branch_id,
				'item_id'=>$item_id
			];
			$branch_current_stock=$this->NewCommonModel->get_single_item_current_stock($requested_branch_id,$item_id);
			$new_branch_stock=intval($branch_current_stock)+intval($requested_stock);
			$branch_update_array=['stock_balance'=>$new_branch_stock];
			$branch_update_result=$this->NewCommonModel->update_data('ntbl_stock_balances',$branch_update_array,$branch_update_condition);
		}
		else{
			$branch_insert_array=[
				'branch_id'=>$requested_branch_id,
				'item_id'=>$item_id,
				'stock_balance'=>$requested_stock
			];
			$branch_update_result=$this->NewCommonModel->add_data('ntbl_stock_balances',$branch_insert_array);
		}
		if($result&&$master_update_result&&$branch_update_result){
			$message="Stock updated successfully";
			$this->session->set_flashdata('message',$message);
			$this->session->set_flashdata('type',"success");
			redirect('newMaster/showBranchItemRequestsPage', 'refresh');
		}
		else{
			$message="Stock updation failed!";
			$this->session->set_flashdata('message',$message);
			$this->session->set_flashdata('type',"error");
			redirect('newMaster/showBranchItemRequestsPage', 'refresh');
		}
	}
	else{
		$message="Current balance is less than mentioned quantity";
		$this->session->set_flashdata('message',$message);
		$this->session->set_flashdata('type',"warning");
		redirect('newMaster/showBranchItemRequestsPage', 'refresh');
	}
}



 ?>
