<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Purchase Return Details
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url();?>designation"><i class="fa fa-dashboard"></i> Back to View</a></li>
      <li class="active">Purchase Return Details</li>
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
          <form class="form-horizontal" method="POST" action="<?php echo base_url();?>NewMaster/updatePurchaseReturns">
            <!-- radio -->
            <div class="form-group">
              <input type="hidden" name="purcahse_id" value="<?php if(isset($records[0]->purcahse_id)) echo $records[0]->purcahse_id ?>"/>
              <input type="hidden" name="item_id_fk" value="<?php if(isset($records[0]->purchase_item_id_fk)) echo $records[0]->purchase_item_id_fk ?>"/>
              <input type="hidden" name="pur_amt" value="<?php if(isset($records[0]->purchase_price)) echo $records[0]->purchase_price ?>"/>
              <?php echo validation_errors(); ?>
              <label for="inputEmail3" class="col-sm-2 control-label"></label>
            </div>
            <div class="box-body">

              <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">Bill No</label>
                <div class="col-sm-6">
                  <input type="text" data-pms-required=""  class="form-control" name="bill_no" id="designation" placeholder="Enter Bill Number" value="<?php if(isset($records[0]->purchase_bill_no)) echo $records[0]->purchase_bill_no ?>" readonly>
                  <input type="hidden"  name="bill_no_fk" id="designation" value="<?php if(isset($records[0]->purchase_bill_no)) echo $records[0]->purchase_bill_no ?>">
                </div>
              </div>


              <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">Purchase Qty</label>
                <div class="col-sm-6">
                  <input type="text" data-pms-required=""  class="form-control" name="pur_qty" id="designation" placeholder="Enter Purchase Quantity" value="<?php if(isset($records[0]->purchase_qty)) echo $records[0]->purchase_qty ?>" readonly>
                  <input type="hidden"  name="pur_qty_fk" id="designation" value="<?php if(isset($records[0]->purchase_qty)) echo $records[0]->purchase_qty ?>">
                </div>
              </div>

              <div class="form-group">
                  <label for="" class="col-sm-1 control-label">Return Qty<span style="color: red;">*</span></label>
                  <div class="col-sm-6">
                      <input type="number" class="form-control" name="pur_return_qty" placeholder="Enter Purchase Return Quantity">
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
