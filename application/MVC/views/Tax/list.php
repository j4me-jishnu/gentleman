

 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Tax Details 
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>index.php/dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>index.php/Tax/add"><i class="fa fa-dashboard"></i> Back To Add</a></li>
        <li class="active">Tax Details</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="box">
            <div class="box-header">
                
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
            <div class="col-md-10"><h2 class="box-title"></h2> </div>
             <div class="col-md-2">
                  <a href="<?php echo base_url();?>index.php/Tax/add" class="btn btn-primary"><i class="glyphicon glyphicon-user"></i> Add New Details</a>
              </div>   
                
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="tax_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Tax Name</th>
                  <th>Tax Amount</th>
                  <th>Tax Type</th>
                  <th>Description</th>
                  <th>Edit / Delete</th>
                  
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






