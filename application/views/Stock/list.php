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
             <div class="col-md-4">
          <div class="input-group margin">
          <div class="input-group-btn">
            <button type="button" class="btn btn-primary nohover">Item name</button>
          </div><!-- /btn-group -->
          <select id="item"  name="item" data-pms-required="true" data-pms-type="alphanumericsOnly"  class="form-control pull-right select2" >
            <option value="">----Please Select----</option>
              <?php
                foreach($items as $item){
              ?>
            <option  value="<?php echo $item->item_id; ?>"><?php echo $item->item_name; ?></option>
              <?php
                }
              ?>
          </select>
          </div><!-- /input-group -->
        </div>
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <div class="col-md-8"><h2 class="box-title"></h2> </div>
      </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="stocktable" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>Sino <input type="hidden" id="branch" value="<?php echo $branch->user_branch ?>" />  </th>
                  <th>Item</th>
                  <!-- <th>Last Updated</th>
                  <th>Last Issued Quantity</th>
                  <th>Stock Balance(Old+New)</th>
                  <th>Status</th> -->
                  <th>Opening stock</th>
                  <th>Recieved from master</th>
                  <th>Total Stock</th>
                  <th>Last Updated</th>
                  <th>Used Quantity</th>
                  <!-- <th>Used Quantity</th> -->
                  <th>Total stock returns</th>
                  <th>Branch to Branch Issued</th>
                  <th>ROP</th>
                  <th>Stock Balance(Old+New)</th>
                  <th>Status</th>
                  <!-- <th>Total Stock Returns</th> -->
                </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <div align="center"><b>Total Stock:</b> <span id = "tot"></span></div>
     </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
