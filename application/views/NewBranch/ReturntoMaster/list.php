<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Stock Return to Master Details
		</h1>
		<?php if($this->session->flashdata('message')!=NULL){
		  echo '<script>swal("'.$this->session->flashdata('message').'", "", "'.$this->session->flashdata('type').'");</script>';
		} ?>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo base_url();?>Employee/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
			<li class="active">Stock Return to Master Details</li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="box">
				<div class="box-header">
					<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
					<div class="col-md-8"><h2 class="box-title"></h2> </div>
          <button type="button" name="button" class="btn btn-success" style="float:right;" onclick="addReturnStockModal();">Return stock</button>
				</div>
				<div class="box-body table-responsive">
					<table id="returnToMasterTable" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Sl no.</th>
								<th>Item Name</th>
								<th>Item Quantity</th>
								<th>Requested at</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
</div>

<div class="modal fade" id="addReturnStockModal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Return Stock to Master Request</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			</div>
			<div class="modal-body">
				<form class="" action="<?php echo base_url(); ?>NewBranch/addReturntomasterRequest" method="post">
					<div class="row mb-3">
						<div class="col-sm-8">
							<label for="">Item List</label>
							<select class="form-control" name="item" id="selectItem">
								<option value="" readonly>Select Item</option>
							</select>
						</div>
				</div><br>
				<div class="row mb-3">
					<div class="col-sm-8">
						<label for="">Item Quantity</label>
						<input type="number" class="form-control" placeholder="Item quantity" name="item_quantity" class="form-control" required>
					</div>
				</div><br>

				<div class="row mb-3">
					<div class="col-sm-8">
						<label for="">Remarks</label>
						<textarea name="remarks" class="form-control" id="" placeholder="Enter Remark If any"></textarea>
					</div>
				</div><br>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
