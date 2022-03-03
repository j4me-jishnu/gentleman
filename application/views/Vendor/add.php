<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Vendor Details
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>Vendor/"><i class="fa fa-dashboard"></i> Back to View</a></li>
        <li class="active">Vendor Details</li>
      </ol>
    </section>
	<form class="form-horizontal" method="POST" action="<?php echo base_url();?>Vendor/add">
     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
		  <fieldset>
		    <legend>Vendor Details</legend>
			<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
            
              <!-- radio -->
               <div class="form-group">
			   <input type="hidden" name="vendor_id" value="<?php if(isset($records->vendor_id)) echo $records->vendor_id ?>"/>
                <?php echo validation_errors(); ?>
			    <div class="box-body">
				<div class="form-group">
					  <label for="size_name" class="col-sm-4 control-label">Name <span style="color:red">*</span></label>

					  <div class="col-sm-5">
						<input type="text"  required  class="form-control" name="vendorname" id="vendorname"  value="<?php if(isset($records->vendorname)) echo $records->vendorname ?>">
					  </div>
				</div>
				<div class="form-group">
					  <label for="size_name" class="col-sm-4 control-label">Address<span style="color:red">*</span></label>

					  <div class="col-sm-5">
						<textarea class="form-control" name="vendoraddress"> <?php if(isset($records->vendoraddress)) echo $records->vendoraddress ?> </textarea>
					  </div>
				</div>
                <div class="form-group">
					  <label for="size_name" class="col-sm-4 control-label">Phone</label>
					  <div class="col-sm-5">
						<input type="text"  required  class="form-control" name="vendorphone" id="vendorphone"  value="<?php if(isset($records->vendorphone)) echo $records->vendorphone ?>">
					  </div>
				</div>
                <div class="form-group">
					  <label for="size_name" class="col-sm-4 control-label">Email</label>

					  <div class="col-sm-5">
						<input type="text"  required  class="form-control" name="vendoremail" id="vendoremail"  value="<?php if(isset($records->vendoremail)) echo $records->vendoremail ?>">
					  </div>
				</div>
				<div class="form-group">
					  <label for="size_name" class="col-sm-4 control-label">GST</label>

					  <div class="col-sm-5">
						<input type="text"  required  class="form-control" name="vendorgst" id="vendorgst"  value="<?php if(isset($records->vendorgst)) echo $records->vendorgst ?>">
					  </div>
				</div>
				<div class="form-group">
					  <label for="size_name" class="col-sm-4 control-label">PAN</label>

					  <div class="col-sm-5">
						<input type="text"  required  class="form-control" name="vendorpan" id="vendorpan"  value="<?php if(isset($records->vendorpan)) echo $records->vendorpan ?>">
					  </div>
				</div>
				<div class="form-group">
					  <label for="size_name" class="col-sm-4 control-label">State</label>

					  <div class="col-sm-5">
						<input type="text"  required  class="form-control" name="vendorstate" id="vendorstate"  value="<?php if(isset($records->vendorstate)) echo $records->vendorstate ?>">
					  </div>
				</div>
				<div class="form-group">
					  <label for="size_name" class="col-sm-4 control-label">Code</label>

					  <div class="col-sm-5">
						<input type="text"  required  class="form-control" placeholder="State Code" name="vendor_stcode" id="vendor_stcode"  value="<?php if(isset($records->vendor_stcode)) echo $records->vendor_stcode ?>">
					  </div>
				</div>
                </div>
              <!-- /.box-body -->
              
            
			</fieldset>
          </div>
          
          <!-- /.box -->
        </div>
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
        <!-- /.col -->
        </div>
      
    </section>
	
	</form>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->






