1<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Opening Details
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Opening Details</li>
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

				<div class="col-md-2">
                  <a href="<?php echo base_url();?>openigstock/add" class="btn btn-primary"><i class="fa fa-plus-square"></i>  Add Opening</a>
				</div>
				<div class="col-md-2">
                  <a href="<?php echo base_url();?>openigstock/openingStockEdit" class="btn btn-success"><i class="fa fa-plus-square"></i>  Edit Opening Stock </a>
				</div>
				<div class="col-md-4">
        <div class="input-group margin">
          <div class="input-group-btn">
          </div>
          <input type="date" id="pmsDateStart" class="form-control" name="start_date">
          <input type="date" id="pmsDateEnd" class="form-control" name="end_date">
        </div>
        </div>
        <div class="col-sm-1">
          <div class="input-group">
            <button type="button" id="search" class="btn bg-orange btn-flat margin" onclick="<?php if(isset($values->mainhead_id))echo $values->mainhead_id;?>">Search</button>
          </div>
        </div>
            </div>
            <!-- /.box-header -->
          <div class="box-body table-responsive">
           <center><b>Master Stock</b></center>
             <table id="Stock_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sl no</th>
                  <th>Item Name</th>
                  <th>Quantity</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
              </tbody>
              </table>
              </div>
              </div>

            <!-- /.box-body -->
             <div class="box-body table-responsive">
              <center><b>Branch stock</b></center>
              <table id="Branch_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                   <th>Sl no</th>
                  <th>Item Name</th>
                  <th>Branch Name</th>
                  <th>Quantity</th>
                </tr>
                </thead>
                <tbody>
              </tbody>
              </table>
            </div>

          </div>



          <!-- /.box -->


     </div>
     <div class="box-body table-responsive">
              <center><b>Branch stock</b></center>
              <table id="os_history_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Branch name/th>
                  <th>Opening stok date</th>
                  <th>Quantity</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
              </tbody>
              </table>
            </div>
    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->
