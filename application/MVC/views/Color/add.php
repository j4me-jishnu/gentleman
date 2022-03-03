

 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product Colour Form
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>index.php/dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>index.php/color/"><i class="fa fa-dashboard"></i> Back to View</a></li>
        <li class="active">Colour Form</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">

          <!-- right column -->
        <div class="col-md-8">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/color/add">
              <!-- radio -->
               <div class="form-group">
			   <input type="hidden" name="color_id" value="<?php if(isset($records->color_id)) echo $records->color_id ?>"/>
                <?php echo validation_errors(); ?>
                 <label for="inputEmail3" class="col-sm-2 control-label"></label>
                <!--<div class="col-sm-10 input-group date">
                  <label class="col-sm-4 control-label">
                  <input type="radio" name="customer_type" class="flat-red customerType" value="N" checked>
                  New customer
                  </label>

                  <label class="col-sm-4 control-label">
                  <input type="radio" name="customer_type" value="O" class="flat-red customerType">
                  Old customer
                  </label>
                </div>-->
                 
                </div>
              <div class="box-body">
                <div class="form-group">
                  <label for="size_name" class="col-sm-2 control-label">Colour <span style="color:red">*</span></label>

                  <div class="col-sm-4">
                    <input type="text" data-pms-required="true" autofocus class="form-control" name="color_name" placeholder="Name" value="<?php if(isset($records->color_name)) echo $records->color_name ?>">
                  </div>
				  
				 <label for="description" class="col-sm-2 control-label">Description</label>

                  <div class="col-sm-4">
                    <textarea class="form-control" name="color_remarks"><?php if(isset($records->color_remarks)) echo $records->color_remarks ?></textarea>
                  </div>
                </div>  
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info">Next</button>
                <button type="reset" class="btn pull-right">Cancel</button>
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






