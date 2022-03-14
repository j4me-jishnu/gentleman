<div class="content-wrapper">
<?php
if($this->session->flashdata('message')!=NULL){
	echo '<script>swal("'.$this->session->flashdata('message').'", "", "'.$this->session->flashdata('type').'");</script>';
}

?>
	<section class="content-header">

		<h1>

			Stock Request Details

		</h1>

		<ol class="breadcrumb">

			<li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

			<li><a href="<?php echo base_url();?>Employee/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>

			<li class="active">Stock Request Details</li>

		</ol>

	</section>

	<section class="content">

		<div class="row">

			<div class="box">

				<div class="box-header">

					<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />

					<div class="col-md-8"><h2 class="box-title"></h2> </div>
				</div>

				<div class="box-body table-responsive">

					<table id="requestTable" class="table table-bordered table-striped">


						<thead>

							<tr>

								<th>Sl no.</th>

								<th>Request Item</th>

								<th>Item Quantity</th>

								<th>Branch</th>

								<th>Requested at</th>

								<th>Status</th>

								<th>Reject Reason</th>

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

<!-- add stock request modal -->

<div class="modal fade" id="requestApprovalModal" tabindex="-1">
	<form class="form-control" action="<?php echo base_url() ?>NewMaster/approveStockRequest" method="post">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Request stock from master</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			</div>
			<div class="modal-body">
				<div class="row mb-3">
					<div class="col-sm-8">
						<input type="hidden" name="requested_branch" id="requested_branch" value="">
						<input type="hidden" name="request_id" id="request_id" value="">
						<input type="hidden" name="request_item_id" id="request_item_id" value="">
					</div>
				</div><br>
				<div class="row mb-3">
					<div class="col-sm-8">
						<h5><b>Available Stock : </b></h5>
						<h5 id="currentStock"></h5>
						<input type="hidden" name="current_stock" id="avbl_stock" value="">
					</div>
				</div><br>
				<div class="row mb-3">
					<div class="col-sm-8">
						<h5><b>Requested Stock : </b></h5>
						<input type="text" id="requested_stock" name="requested_stock" value="">
					</div>
				</div><br>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Approve</button>
				</div>
			</form>
		</div>
	</div>
</div>
</div>

<!-- rejectModal -->

<!-- Modal -->

<div id="rejectModel" class="modal fade" role="dialog">

  <div class="modal-dialog">



    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Reject</h4>

      </div>

      <div class="modal-body">

        <form class="" action="<?php echo base_url() ?>NewMaster/rejectStockRequestMaster" method="post">

					<input type="hidden" name="req_id" value="" id="hidden_req_id">

        	<div class="form-group">

        		<label for="reject_reason" class="form-label">Reject Description</label>

						<div class="col-md-4">

							<textarea name="reject_descp" placeholder="Enter Rejection Reason......" rows="2" cols="60"></textarea>

						</div>

        	</div>

					<br><br>

					<input type="submit" name="submit" class="btn btn-danger" value="REJECT">

        </form>

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>

    </div>



  </div>

</div>

<!-- End rejectModal -->

<!-- Ajax Approval -->
<div class="modal fade" id="ajaxapprovals" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Request stock from master</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			</div>
			<div class="modal-body">
				<form class="" action="<?php echo base_url(); ?>NewMaster/approveStockRequestMaster" method="post">
				<input type="hidden" name="req_id" value="" id="req_id_">
				<div class="row mb-3">
					<div class="col-sm-8">
						<!-- <input type="number" placeholder="Item quantity" name="item_quantity" class="form-control" required> -->
						<label for="" class="control-label">ITEM NAME</label>
						<input class="form-control" type="text" id="item_namedes" value="" readonly>
					</div>
				</div><br>

				<div class="row mb-3">
					<div class="col-sm-8">
						<!-- <input type="number" placeholder="Item quantity" name="item_quantity" class="form-control" required> -->
						<label for="" class="control-label">TOTAL STOCK</label>
						<input class="form-control" type="text" id="ttl_stck_amt" value="" readonly>
					</div>
				</div><br>
				<div class="row mb-3">
					<div class="col-sm-8">
						<!-- <input type="number" placeholder="Item quantity" name="item_quantity" class="form-control" required> -->
						<label for="" class="control-label">REQUESTED STOCK</label>
						<input class="form-control" type="text" id="req_ttl_stcks" value="" readonly>
					</div>
				</div><br>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button id="submits" type="submit" class="btn btn-success">Approved</button>
				</div>

			</form>

		</div>

	</div>

</div>

</div>
<!-- End Ajax Approval -->
