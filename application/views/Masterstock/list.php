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
      <div class="" align="right">

                  <a href="<?php echo base_url();?>Stockmovement/add" class="btn btn-primary margin">Move Product</a>
        </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="stocktable" class="table table-bordered table-striped">
                <thead>
                <tr>
			       	  <th>Slno <input type="hidden" id="branch" value="0" /></th>
                  <th>Item</th>
                  <th>Opening Stock</th>
                  <th>Purchase Stock</th>
                  <th>Return from Branches (SUM)</th>
                  <th>Total Stock</th>
                  <th>Issued Quantity</th>
				          <th>Master Stock Balance</th>
                  <th>ROP</th>
                  <th>Last Updated</th>
                  <th>Status</th>
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

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
