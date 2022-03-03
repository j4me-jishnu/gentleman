<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
Change Password Form
<!-- <small>Optional description</small> -->
</h1>
<ol class="breadcrumb">
<li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>

<li class="active">Change Password Form</li>
</ol>
</section>
<section class="content">
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Change Password</h3>
		</div>
		<div class="box-body">
			<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
			<form  method="post" action="<?php echo base_url();?>change_password/add"> 
				<label for="user_name" class="col-sm-2 control-label">New Password<span style="color:red">*</span></label>
				<div class="col-sm-4">
					<input type="password" data-pms-required="true" class="form-control" name="new_password" placeholder="new password" value="<?php if(isset($records->user_name)) echo $records->user_name ?>" required="required">
				</div>
				<label for="user_name" class="col-sm-2 control-label">Email:<span style="color:red">*</span></label>
				<div class="col-sm-4">
					<input type="email" data-pms-required="true" class="form-control" name="email" placeholder="" value="<?php if(isset($email[0]->user_email)) echo $email[0]->user_email ?>" required="required">
				</div>
				<br><br>
				<div class="col-md-12">
					<div class="row">
	                  	<div class="col-md-4">
	                  	</div>
	                  	<div class="col-md-4" align="center">
	                  		<input type="submit" name="submit" class="btn btn-primary" value="Submit">
	                      <button type="button" class="btn btn-danger" onclick="window.location.reload();">Cancel</button>
	                      <!-- <button type="submit" class="btn btn-primary">Save</button> -->

	                  	</div>
	                  	<div class="col-md-4">
	                  	</div>
                	</div>
				</div>
			</form>
		</div>	
	</div>	
</section>