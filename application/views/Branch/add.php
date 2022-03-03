<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
Branch Form
<!-- <small>Optional description</small> -->
</h1>
<ol class="breadcrumb">
<li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
<li><a href="<?php echo base_url();?>branch"><i class="fa fa-dashboard"></i> Back to View</a></li>
<li class="active">Branch Form</li>
</ol>
</section>
<!-- Main content -->
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
<!-- form start -->
<form class="form-horizontal" method="POST" action="<?php echo base_url();?>branch/add">
<!-- radio -->
<div class="form-group">
<input type="hidden" name="branch_id" value="<?php if(isset($records->branch_id)) echo $records->branch_id ?>"/>
<?php echo validation_errors(); ?>
<label for="inputEmail3" class="col-sm-2 control-label"></label>
</div>
<div class="box-body">
<div class="form-group">
<label for="size_name" class="col-sm-1 control-label">Door No: <span style="color:red">*</span></label>

<div class="col-sm-3">
<input type="text" data-pms-required="true"  class="form-control" name="br_id" placeholder="Door no" value="<?php if(isset($records->br_id)) echo $records->br_id ?>">
</div>
					
<label for="size_name" class="col-sm-1 control-label">Name <span style="color:red">*</span></label>

<div class="col-sm-3">
<input type="text" data-pms-required="true"  class="form-control" name="branch_name" placeholder="Name" value="<?php if(isset($records->branch_name)) echo $records->branch_name ?>">
</div>
</div>
</div>
<div class="box-body">
					
</div>   
<div class="box-body">
<div class="form-group">
<label for="description" class="col-sm-1 control-label">Address</label>

<div class="col-sm-3">
<textarea class="form-control" name="branch_address"><?php if(isset($records->branch_address)) echo $records->branch_address ?></textarea>
</div>

<label for="size_name" class="col-sm-1 control-label">Phone <span style="color:red">*</span></label>

<div class="col-sm-3">
<input type="text" data-pms-required="true"  data-pms-type="digitsOnly"  class="form-control" name="branch_phone" placeholder="Phone" value="<?php if(isset($records->branch_phone)) echo $records->branch_phone ?>">
</div>
</div>	
</div>
<div class="box-body">
<div class="form-group">
<label for="size_name" class="col-sm-1 control-label">Email <span style="color:red">*</span></label>
<div class="col-sm-3">
<input type="text" data-pms-required="true"  data-pms-type="email" class="form-control" name="branch_email" placeholder="Email" value="<?php if(isset($records->branch_email)) echo $records->branch_email ?>">
</div>
<!--<label for="size_name" class="col-sm-1 control-label">Type <span style="color:red">*</span></label>-->
<!--<div class="col-sm-3">
					  <select class="form-control" name="branch_type" id="branch_type"> 
						<option value="1">1 Star</option>
						<option value="2">2 Star</option>
						<option value="3">3 Star</option>
						<option value="4">4 Star</option>
						<option value="5">5 Star</option>
					  </select>
					  <input type="hidden" id="branchtype" value="<?php if(isset($records->branch_type)) echo $records->branch_type ?>"/>
					  </div>
					</div>
                </div>-->
				<!--<div class="box-body">
					<div class="form-group">
					 <label for="description" class="col-sm-1 control-label">Is Active</label>

					  <div class="col-sm-3">
						<input type="checkbox"  id="is_active" name="is_active" value="1"/>
						<input type="hidden" id="isactive" value="<?php if(isset($records->is_active)) echo $records->is_active ?>"/>
					  </div>
					<?php $ad = $this->session->userdata('user_type'); if($ad=='A') { ?>
					<label for="description" class="col-sm-1 control-label">Headoffice?</label>
					<div class="col-sm-3">
					<input type="checkbox"  id="is_head" name="is_head" value="1"/>
					<input type="hidden" id="ishead" value="<?php if(isset($records->is_head)) echo $records->is_head ?>"/>
					</div>
					<?php } ?>
					</div>
				</div>-->
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="reset" class="btn ">Cancel</button>
				<button type="submit" class="btn btn-info pull-right">Next</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
          
        </div>
        <!--/.col (right) -->
     </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->






