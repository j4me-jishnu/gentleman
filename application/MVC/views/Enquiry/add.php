

 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Job Enquiry Form
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
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
              <h3 class="box-title">Customer Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/enquiry/add">
              <!-- radio -->
                <div class="form-group">
                <?php echo validation_errors(); ?>
                 <label for="inputEmail3" class="col-sm-2 control-label"></label>
                <div class="col-sm-10 input-group date">
                  <label class="col-sm-4 control-label">
                  <input type="radio" name="customer_type" class="flat-red customerType" value="N" checked>
                  New customer
                  </label>

                  <label class="col-sm-4 control-label">
                  <input type="radio" name="customer_type" value="O" class="flat-red customerType">
                  Old customer
                  </label>
                </div>
                  
                </div>
              <div class="box-body">
                <div class="form-group">
                  <label for="customer_name" class="col-sm-2 control-label">Name</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Name">
                    <input type="hidden" class="form-control" name="customer_id" id="customer_id" placeholder="Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="customer_address" class="col-sm-2 control-label">Address</label>

                  <div class="col-sm-10">
                    <textarea class="form-control" id="customer_address" name="customer_address"></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="customer_phone" class="col-sm-2 control-label">Phone</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="customer_phone" id="customer_phone" placeholder="Phone">
                  </div>
                </div>
                <!-- Date -->
                <div class="form-group">
                  <label for="date" class="col-sm-2 control-label">Date:</label>

                  <div class="col-sm-10 ">
                    
                    <input type="text" class="form-control pull-right" name="date" id="date">
                  </div>
                  <!-- /.input group -->
                </div>
                <div class="form-group">
                  <label for="customer_email" class="col-sm-2 control-label">Type</label>
                  <div class="col-sm-10">
                    <select name="type" class="form-control pull-right" id="type">
                      <option value="">Select</option>
                      <?php foreach ($enquiry_type as $key => $value) { ?>
                        <option value="<?php echo $key;?>"><?php echo $value;?> </option>
                      <?php } ?>
                      
                    </select>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="customer_email" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control" name="customer_email" id="customer_email" placeholder="Email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="details" class="col-sm-2 control-label">Enquiry details</label>

                  <div class="col-sm-10">
                    <textarea class="form-control" id="details" name="details"></textarea>
                  </div>
                </div>

                
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="reset" class="btn btn-default">Cancel</button>
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






