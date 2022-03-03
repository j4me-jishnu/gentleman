
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
      <li><a href="<?php echo base_url();?>designation"><i class="fa fa-dashboard"></i> Back to View</a></li>
      <li class="active">Vendor Details</li>
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
          <form class="form-horizontal" method="POST" action="<?php echo base_url();?>NewMaster/addVendorList">
            <!-- radio -->
            <div class="form-group">
              <input type="hidden" name="ven_id" value="<?php if(isset($records->desig_id)) echo $records->desig_id ?>"/>
              <?php echo validation_errors(); ?>
              <label for="inputEmail3" class="col-sm-2 control-label"></label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">Vendor Name<span style="color:red">*</span></label>

                <div class="col-sm-6">
                  <input type="text" data-pms-required=""  class="form-control" name="v_name" id="designation" placeholder="Vendor Name" value="<?php if(isset($records->designation)) echo $records->designation ?>">
                </div>
              </div>
              <div class="form-group">  
                <label for="description" class="col-sm-1 control-label">Address</label>

                <div class="col-sm-6">
                  <textarea class="form-control" placeholder="Enter Address" name="v_address"><?php if(isset($records->description)) echo $records->description ?></textarea>
                </div>
              </div>
             
              <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">Email<span style="color:red">*</span></label>

                <div class="col-sm-6">
                  <input type="text" data-pms-required=""  class="form-control" name="v_email" id="designation" placeholder="Enter Email Id" value="<?php if(isset($records->designation)) echo $records->designation ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">Phone No<span style="color:red">*</span></label>

                <div class="col-sm-6">
                  <input type="text" data-pms-required=""  class="form-control" name="v_phone" id="designation" placeholder="Enter Phone Number" value="<?php if(isset($records->designation)) echo $records->designation ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">GST<span style="color:red">*</span></label>

                <div class="col-sm-6">
                  <input type="text" data-pms-required=""  class="form-control" name="ve_gst" id="designation" placeholder="Ex: 10AABCU9603R1Z2" value="<?php if(isset($records->designation)) echo $records->designation ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">PAN<span style="color:red">*</span></label>

                <div class="col-sm-6">
                  <input type="text" data-pms-required=""  class="form-control" name="v_pan" id="designation" placeholder="Pan: BAPR2323OP" value="<?php if(isset($records->designation)) echo $records->designation ?>">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-6">
                  <input class="btn btn-primary" type="submit" value="SAVE" name="submit">
                </div>
              </div>
            </div>

            <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </div>
      <!--/.col (right) -->
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
