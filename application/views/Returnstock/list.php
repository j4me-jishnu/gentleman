<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Stock Details
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Stock Details</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="box">
            <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <div class="col-md-8"><h2 class="box-title"></h2> </div>
      </div>
      <?php 
          $u = $this->session->userdata('user_type');
          ?>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="stocktable" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>Slno</th>
                  <th>Return From</th>
                  <th>Item</th>
                  <th>Return Date</th>
                  <th>Narration</th>
                  <th>Return quantity</th>
                  <th>Action</th>
                </tr>
               </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </div>
     <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add stock</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <form method="post">
                <input type="hidden" id="return_id" name="return_id">
                <input type="hidden" id="branch_id_fk" name="branch_id">
                <input type="hidden" id="item_id_fk" name="item_id">
                <input type="hidden" id="item_quantity" name="quantity">
                <input type="hidden" id="return_date" name="date">
                <div class="form-group">
                  <label for="size_name" class="col-sm-4 control-label">Enter Quantity<span style="color:red">*</span></label>
                  <div class="col-sm-4">
                    <input type="text" name="add_quantity" id="add_quantity" required="required">
                  </div>
                </div>
                
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" id="branch_update" data-dismiss="modal" class="btn btn-default">Submit</button>
          </div>  
        </div>
      </div>
    </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->






