<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Branch to Branch Stock Details
		</h1>
		<?php
		if($this->session->flashdata('message')!=NULL){
			echo '<script>swal("'.$this->session->flashdata('message').'", "", "'.$this->session->flashdata('type').'");</script>';
		}
		?>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo base_url();?>Employee/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
			<li class="active">Branch to Branch Stock Details</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="box">
				<div class="box-header">
					<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
					<div class="col-md-8"><h2 class="box-title"></h2> </div>
					<button type="button" name="button" class="btn btn-success" style="float:right;" onclick="showBtoBRequestModal();">Request</button>
				</div>
				<div class="box-body table-responsive">
					<table id="branchtobranch_table" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Sl no.</th>
								<th>Requested Branch</th>
								<th>Item</th>
								<th>Quantity</th>
								<th>Requested at</th>
								<th>Status</th>
								<th>Action</th>
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

<div class="modal fade" id="requestBtoBModal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Request Branch to Branch Transfer</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="" action="<?php echo base_url(); ?>NewBranch/addBtoBRequest" method="post">
					<br>
					<div class="row mb-3">
						<div class="col-sm-4">
							<label for="selectBranch">Trasfer to</label>
							<select class="form-control" name="transfer_branch_id" id="selectBranch" required>
								<option value="">Select Branch</option>
							</select>
						</div>
						<div class="col-sm-4">
							<label for="selectItem">Item</label>
							<select class="form-control" name="item" id="selectItem">
								<option value="" readonly>Select Item</option>
							</select>
						</div>
						<div class="col-sm-4">
							<label for="item_qty">Quantity</label>
							<input type="number" id="item_qty" placeholder="Item quantity" name="item_quantity" class="form-control" required>
						</div>
					</div>
					<br>
					<div class="row mb-3">
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

<div class="modal fade" id="editrequestBtoBModal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Request Branch to Branch Transfer</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form class="" action="<?php echo base_url(); ?>NewBranch/addBtoBRequest" method="post">
					<br>
					<div class="row mb-3">
						<input type="hidden" name="btob_ide" id="btob_id2" value="">
						<div class="col-sm-4">
							<select class="form-control" name="transfer_branch_id" id="selectBranch2" required>

							</select>
						</div>
						<div class="col-sm-4">
							<select class="form-control" name="item" id="selectItem2">

							</select>
						</div>
						<div class="col-sm-4">
							<input type="number" placeholder="Item quantity" name="item_quantity" id="item_quantity2" class="form-control" required>
						</div>
					</div>
					<br>
					<div class="row mb-3">
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
