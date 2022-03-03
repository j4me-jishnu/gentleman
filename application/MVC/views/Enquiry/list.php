

 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Enquiry Listing Form
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
        <div class="box">
            <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <div class="col-md-10"><h2 class="box-title">Enquiry details</h2> </div>
              <div class="col-md-2">
                  <a href="<?php echo base_url();?>index.php/enquiry/add" class="btn btn-primary"><i class="glyphicon glyphicon-user"></i>Add new enquiry</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="enquiry_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Customer Name</th>
                  <th>Customer Phone</th>
                  <th>Date</th>
                  <th>Enquiry type</th>
                  <th></th>
                  
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






