<div class="content-wrapper">

	<section class="content-header">

		<h1>

			Total Stock Details

		</h1>

		<ol class="breadcrumb">

			<li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

			<li><a href="<?php echo base_url();?>Employee/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>

			<li class="active">Total Stock Details</li>

		</ol>

	</section>

	<section class="content">
		
		<div class="row">

			<div class="box">

				<div class="row">
					<div class="col-md-3">
						<div class="input-group margin">
							<div class="input-group-btn">
								<button type="button" class="btn btn-primary nohover">Branch List</button>
							</div><!-- /btn-group -->
							<select name="branch_id" class="form-control" id="branch_id">
								<option value="">Chertala</option>
							</select>
						</div><!-- /input-group -->
					</div>
				</div>
				<div class="box-header">

					<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />

					<!-- <div class="col-md-8"><h2 class="box-title"></h2> </div> -->

          <!-- <button type="button" onclick="addOpeningStock()" name="button" class="btn btn-success" style="float:right;">Request Item</button> -->

				</div>

				<div class="box-body table-responsive">

					<table id="Branch_Opening_Stock" class="table table-bordered table-striped">

						<thead>

							<tr>

								<th>Sl no.</th>

								<th>Branch Name</th>

								<th>Item Name</th>

								<th>Opening Stock</th>

								<th>Requested From Master</th>

								<th>Recieved From Branch</th>

								<th>Total Stock</th>

								<th>Given To Branch</th>

								<th>Issued</th>

								<th>Return To Master</th>

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



<!-- Start Add Opening Stock -->

<!-- Modal -->

<div id="addOpeningStocks" class="modal fade" role="dialog">

  <div class="modal-dialog">



    <!-- Modal content-->

<form action="<?php echo base_url() ?>NewBranch/addBranchOpeningStock" method="POST">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Add Opening Stock</h4>

      </div>

      <div class="modal-body">

        <div class="row">

			<div class="col-md-6">

				<div class="from-group">

					<label for="Item_lists">Select Item</label>

					<select name="item_id" class="form-control" id="Item_lists" >

						<option value="">Select</option>

					</select>

				</div>

			</div>

			<div class="col-md-6">

				<div class="form-group">

					<label for="Item_qtys">Item Qty</label>

					<input type="text" class="form-control" name="item_qty" placeholder="Enter Quantity" >

				</div>

			</div>

		</div>

      </div>

      <div class="modal-footer">

		<input type="submit" class="btn btn-primary" value="ADD" name="submit">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>

    </div>

</form>	

  </div>

</div> 

  <!-- End Add Opening Stock -->