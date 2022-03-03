
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Master ROP Details
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url();?>designation"><i class="fa fa-dashboard"></i> Back to View</a></li>
      <li class="active">Master ROP Details</li>
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
          <form class="form-horizontal" method="POST" action="<?php echo base_url();?>NewMaster/addROPmasterList">
            <!-- radio -->
            <div class="form-group">
              <input type="hidden" name="rop_master_id" value="<?php if(isset($records[0]->rop_master_id)) echo $records[0]->rop_master_id ?>"/>
              <?php echo validation_errors(); ?>
              <label for="inputEmail3" class="col-sm-2 control-label"></label>
            </div>
            <div class="box-body">
            <div class="form-group">
                    <label for="sel1" class="col-sm-1 control-label">Item List</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="item_list_id" id="item_list">
                            <option>SELECT</option>
                            <?php foreach($item as $item_list){ ?>
                            <option <?php if(isset($records[0]->item_id)){ echo($records[0]->item_id == $item_list->item_id)?'selected':''; } ?> value="<?php echo $item_list->item_id ?>"><?php echo $item_list->item_name ?></option>    
                            <?php } ?>  
                        </select>
                    </div>
              </div>
            
             
              <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">ROP<span style="color:red">*</span></label>

                <div class="col-sm-6">
                  <input type="text" data-pms-required=""  class="form-control" name="rop_no" id="designation" placeholder="Enter ROP Number" value="<?php if(isset($records[0]->rop_master_ROP)) echo $records[0]->rop_master_ROP ?>">
                </div>
              </div>
             
              <div class="form-group">
                <label for="size_name" class="col-sm-1 control-label">ROP Date<span style="color:red">*</span></label>

                <div class="col-sm-6">
                  <input type="date" data-pms-required=""  class="form-control" name="rop_date" id="designation" placeholder="" value="<?php if(isset($records[0]->rop_master_date)) echo $records[0]->rop_master_date ?>">
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
