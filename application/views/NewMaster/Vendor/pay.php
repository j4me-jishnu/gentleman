
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Vendor Payment
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url();?>designation"><i class="fa fa-dashboard"></i> Back to View</a></li>
      <li class="active">Vendor Payment</li>
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
          <form class="form-horizontal" method="POST" action="<?php echo base_url();?>NewMaster/addpaymentVendor">
            <!-- radio -->
            <div class="form-group">
              <input type="hidden" name="ven_id" value="<?php if(isset($records[0]->vendor_id)) echo $records[0]->vendor_id ?>"/>

              <label for="inputEmail3" class="col-sm-2 control-label"></label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">Vendor Name<span style="color:red">*</span></label>
                <div class="col-sm-6">
                  <input type="text" data-pms-required=""  class="form-control" name="v_name" id="designation" placeholder="Vendor Name" value="<?php if(isset($records[0]->vendor_name)) echo $records[0]->vendor_name ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="description" class="col-sm-1 control-label">Payment Amount</label>

                <div class="col-sm-6">
                  <input type="text" data-pms-required=""  class="form-control" name="v_payment_amt" id="designation" placeholder="Vendor Payment" value="<?php if(isset($records[0]->purchase_amts)) echo $records[0]->purchase_amts ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">Paying Amount<span style="color:red">*</span></label>

                <div class="col-sm-6">
                  <input type="text" data-pms-required=""  class="form-control" name="ve_pay_amt" id="designation" placeholder="Enter Pay Amount" value="<?php if(isset($records[0]->vendor_payed_amt)) echo $records[0]->vendor_payed_amt ?>">
                  <?php echo validation_errors(); ?>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-6">
                  <input class="btn btn-primary" type="submit" value="PAY" name="submit">
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
