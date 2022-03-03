
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Update Master Opening Stock
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
          <form class="form-horizontal" method="POST" action="<?php echo base_url();?>NewMaster/updatMasterStock">
            <!-- radio -->
            <div class="form-group">
              <input type="hidden" name="ven_id" value="<?php if(isset($records->desig_id)) echo $records->desig_id ?>"/>
              <?php echo validation_errors(); ?>
              <label for="inputEmail3" class="col-sm-2 control-label"></label>
            </div>
            <div class="box-body">

            <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">Item Name<span style="color:red">*</span></label>
                <input type="hidden" name="ms_item_id" value="<?php if(isset($records->item_id)) echo $records->item_id ?>">
                <div class="col-sm-6">
                  <input type="text" data-pms-required=""  class="form-control" name="item" id="designation" placeholder="Item Name" value="<?php if(isset($records->item_name)) echo $records->item_name ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">Stock Quantity<span style="color:red">*</span></label>

                <div class="col-sm-6">
                  <input type="text" data-pms-required=""  class="form-control" name="stck_qty" id="designation" placeholder="Stock Quantity" value="<?php if(!empty($records->os_quantity)) { echo $records->os_quantity; } else { echo'0'; } ?>">
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
