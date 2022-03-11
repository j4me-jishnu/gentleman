<div class="content-wrapper">
  <section class="content-header">
    <h1>Vendor Details</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url();?>designation"><i class="fa fa-dashboard"></i> Back to View</a></li>
      <li class="active">Vendor Details</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title"></h3>
          </div>
          <form class="form-horizontal" method="POST" action="<?php echo base_url();?>NewMaster/addPurchaseList">
            <div class="form-group">
              <input type="hidden" name="pur_id" value="<?php if(isset($records->desig_id)) echo $records->desig_id ?>"/>
              <?php echo validation_errors(); ?>
              <label for="inputEmail3" class="col-sm-2 control-label"></label>
            </div>
            <div class="box-body">
              <div class="form-group">
                    <label for="sel1" class="col-sm-1 control-label">Vendor List</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="v_list_id" id="v_list">
                            <option>SELECT</option>
                            <?php foreach($vendor as $v_list){ ?>
                            <option value="<?php echo $v_list->vendor_id ?>"><?php echo $v_list->vendor_name ?></option>
                            <?php } ?>
                        </select>
                    </div>
              </div>
              <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">Bill No<span style="color:red">*</span></label>
                <div class="col-sm-6">
                  <input type="text" data-pms-required=""  class="form-control" name="bill_no" id="designation" placeholder="Enter Bill Number" value="<?php if(isset($records->designation)) echo $records->designation ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">Gst No<span style="color:red">*</span></label>
                <div class="col-sm-6">
                  <input type="text" data-pms-required=""  class="form-control" name="gst_no" id="designation" placeholder="Enter Gst Number" value="<?php if(isset($records->designation)) echo $records->designation ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">Purchase Date<span style="color:red">*</span></label>
                <div class="col-sm-6">
                  <input type="date" data-pms-required=""  class="form-control" name="pur_date" id="designation" placeholder="" value="">
                </div>
                </div>
              <div class="row">
              <div class="col-md-1">
                  <label>Select</label>
                </div>
                <div class="col-md-2">
                  <label>Item List</label>
                </div>
                <div class="col-md-2">
                  <label>Purchase Qty</label>
                </div>
                <div class="col-md-2">
                  <label>Purchase Price</label>
                </div>
                <div class="col-md-2">
                  <label>Purchase Tax</label>
                </div>
                <div class="col-md-2">
                  <label>Total</label>
                </div>
              </div>
              <input type="hidden" name="counter" id="counter" value="0">
              <DIV id="service" class="box-body no-padding" ></div>
            <i class="fa fa-fw fa-plus-square fa-2x" onClick="addMore();" Style="color:green;"></i>
            <i class="fa fa-fw fa-minus-square pull-right fa-2x" onClick="deleteRow();" Style="color:red;"></i>

              <div class="form-group">
                <div class="col-sm-6">
                  <input class="btn btn-primary" type="submit" value="SAVE" name="submit">
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </section>
</div>
