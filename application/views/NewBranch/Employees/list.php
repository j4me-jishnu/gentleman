<div class="content-wrapper">

	<section class="content-header">

		<h1>

			Employee Details

		</h1>

		<ol class="breadcrumb">

			<li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

			<li><a href="#"><i class="fa fa-dashboard"></i> Back to Add</a></li>

			<li class="active">Employee Details</li>

		</ol>

	</section>

	<section class="content">

		<div class="row">

			<div class="box">

				<div class="box-header">

					<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />

					<div class="col-md-8"><h2 class="box-title"></h2> </div>



          <!-- <button type="button" name="button" class="btn btn-success" id="addEmployeeBtn" onclick="showAddEmployeeModal()" style="float:right;">Add Employee</button> -->

				</div>

				<div class="box-body table-responsive">

					<table id="branch_table" class="table table-bordered table-striped">

						<thead>

							<tr>

								<th>Sl no.</th>

								<th>Employee Name</th>

								<th>Branch Name</th>

								<th>Designation</th>

								<th>Address</th>

								<th>Phone No</th>

								<th>Email</th>



								<!-- <th>Action</th> -->

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



<!-- add employee modal -->



<div class="modal fade" id="addEmployeeModal" tabindex="-1">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<h5 class="modal-title">Add Employee Form</h5>

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">

				<span aria-hidden="true">&times;</span>

			</button>

			</div>

			<div class="modal-body">

				<form class="" action="<?php echo base_url(); ?>NewBranch/addEmployee" method="post">

					<div class="row mb-3">

						<div class="col-sm-8">

							<input type="text" placeholder="Employee name" name="emp_name" class="form-control" required>

						</div>

					</div><br>

					<div class="row mb-3">

					</div>

				</div>

				<div class="modal-footer">

					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

					<button type="submit" class="btn btn-primary">Submit</button>

				</div>

			</form>

		</div>

	</div>

</div>



<!-- Edit PopUp Modal -->

<!-- Modal -->

<div id="editMOdals" class="modal fade" role="dialog">

  <div class="modal-dialog">



    <!-- Modal content-->

		<form class="" action="<?php echo base_url() ?>NewBranch/editEmployee" method="post">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Edit Employee</h4>

      </div>

      <div class="modal-body">



        	<div class="col-md-6">

        		<div class="form-group">

							<input type="hidden" name="emp_id" id="emp_ides" value="">

        			<label class="form-label" for="emp_names">Employee Name</label>

							<input type="text" class="form-control" id="emp_names" name="emp_name" value="">

        		</div>

        	</div>

      </div>

      <div class="modal-footer">

				<input type="submit" class="btn btn-primary" name="submit" value="UPDATE">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>

    </div>

		</form>



  </div>

</div>

<!-- End Edit PopUp Modal -->

