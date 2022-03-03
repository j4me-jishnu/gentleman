<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Vendor Payment Details
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>designation/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
        <li class="active">Vendor Payment Details</li>
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
          <?php $u = $this->session->userdata('user_type');
           if($u == 'A'){ ?>
                  <!-- <a href="<?php echo base_url();?>NewMaster/addVendorPayment" class="btn btn-primary"><i class="fa fa-plus-square"></i>  Pay Vendor</a> -->
                <?php } ?>
				</div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="vendor_pay" class="table table-bordered table-striped">
                <thead>
                <tr>
				          <th>Slno</th>
                  <th>Vendor Name</th>
                  <th>Vendor Payment</th>
                  <th>Paid Amount</th>
                  <th>Paid Date</th>
                  <th>Pay</th>
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
