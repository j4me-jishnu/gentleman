<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Stock Return Details
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
								<th>Return Item</th>
								<th>Item Quantity</th>
								<th>Branch</th>
								<th>Remarks</th>
								<th>Approval</th>
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
        <form class="" action="<?php echo base_url() ?>NewMaster/rejectBReturn" method="post">
					<input type="hidden" name="return_id" value="" id="hidden_req_id">
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


<!-- Accept Modal -->
<!-- Modal -->
<div id="accept_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Reject</h4>
      </div>
      <div class="modal-body">
        <form class="" action="<?php echo base_url() ?>NewMaster/approveBReturns" method="post">
			<input type="hidden" name="return_id" value="" id="accept_req_id">
        	<div class="form-group">
					<label for="scrap_qtyty" class="form-label">Scrap Quantity</label>
					<input type="text" class="form-control" value="0" name="scrap_qty" id="scrap_qtyty">
        	</div>
			<br>
			<div class="form-group">
					<input type="submit" name="submit" class="btn btn-success" value="APPROVE">
			</div>
			
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- End rejectModal -->
