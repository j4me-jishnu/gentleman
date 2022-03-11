<div class="content-wrapper">
	<section class="content-header">
		<!-- <h1>Change Password</h1> -->
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
							<h1>Change Account Password</h1>
					<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
					<div class="col-md-8"><h2 class="box-title"></h2> </div>
				</div>
				<!-- USE THIS -->
				<!-- <form class="form-control" action="<?php ?>" method="post">
					<label for="current_pass"></label>
					<input type="text" name="current_pass" id="current_pass" value="" placeholder="Enter current password" class="form-control">
				</form> -->
			</div>
		</div>
	</section>
</div>
