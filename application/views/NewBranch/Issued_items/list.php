	<div class="content-wrapper">
		<section class="content-header">
			<h1>
				Issued Stock Details
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="<?php echo base_url();?>Employee/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
				<li class="active">Issued Stock details</li>
			</ol>
		</section>
		<section class="content">
			<div class="row">
				<div class="box">
					<div class="box-header">
						<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
						<div class="col-md-8"><h2 class="box-title"></h2> </div>
					<button type="button" name="button" onclick="addIssuedStock()" class="btn btn-success" style="float:right;">Issue Stock</button>
					</div>
					<div class="box-body table-responsive">
						<table id="issued_table" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Sl no.</th>
									<th>Employee Name</th>
									<th>Iteam Name</th>
									<th>Item Quantity</th>
									<th>Create Date</th>
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

	<!-- Add Issued Stock Modal -->
	<div id="addIssuedStock" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
	<form action="<?php echo base_url() ?>NewBranch/addIssuedStock" method="POST">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Issue Item Stock</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="item_list">Item List</label>
							<select class="form-control" name="item_id" id="item_list">
								<option>SELECT</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="item_list">Employee List</label>
							<select class="form-control" name="emp_id" id="emp_list">
								<option>SELECT</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="item_list">Item Qty</label>
							<input type="text" class="form-control" name="item_qty" placeholder="Enter Quantity" id="item_qty">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<input type="submit" class="btn btn-success" name="submit" value="APPROVE">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</form>
	</div>
	</div>
	<!-- end Add Issued Stock Modal -->