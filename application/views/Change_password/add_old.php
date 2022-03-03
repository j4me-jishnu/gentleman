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

<!-- Main content -->
<form class="form-horizontal" method="POST" action="<?php echo base_url();?>Change_password/add"> 
<section class="content">
<div class="row">

<!-- right column -->
<div class="col-md-12">
<!-- Horizontal Form -->
<div class="box box-info">
<div class="box-header with-border">
<h3 class="box-title"></h3>
</div>
<!-- /.box-header -->
<!-- radio -->
<div class="form-group">
<input type="hidden" id="id" name="id" value="<?php if(isset($records->id)) echo $records->id ?>"/>
<?php echo validation_errors(); ?>
<label for="inputEmail3" class="col-sm-2 control-label"></label>
</div>
<div class="box-body">
<div class="form-group">
</div>
<label for="user_name" class="col-sm-2 control-label">New Password<span style="color:red">*</span></label>

<div class="col-sm-4">
<input type="password" data-pms-required="true" class="form-control" name="new_password" placeholder="new password" value="<?php if(isset($records->user_name)) echo $records->user_name ?>" required="required">
</div>
<label for="user_name" class="col-sm-2 control-label">Email:<span style="color:red">*</span></label>

<div class="col-sm-4">
<input type="email" data-pms-required="true" class="form-control" name="email" placeholder="" value="<?php if(isset($email[0]->user_email)) echo $email[0]->user_email ?>" required="required">
</div>
</div>
				<div class="form-group">
                  
				  <label for="product_size" class="col-sm-2 control-label"><span style="color:red"></span></label>

                  <div class="col-sm-4">
                   
                  </div>

				
			</div>
              <!-- /.box-body -->
          </div>
          
          <!-- /.box -->
        </div>
        <!-- /.col -->
        
      </div>
    </section>
	<div class="box-footer">                
                <div class="row">
                  <div class="col-md-6">
                  </div>
                  <div class="col-md-4">
                      <button type="button" class="btn btn-danger" onclick="window.location.reload();">Cancel</button>
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                  </div>
	</div>
	</form>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->






