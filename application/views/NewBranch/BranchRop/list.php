<div class="content-wrapper">

	<section class="content-header">

		<h1>

		Branch ROP Details

		</h1>

		<ol class="breadcrumb">

			<li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

			<li><a href="#"><i class="fa fa-dashboard"></i> Back to Add</a></li>

			<li class="active">Branch ROP Details</li>

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

								<th>Item Name</th>

                                <th>ROP</th>

                                <th>Status</th>
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




