<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users List
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>designation/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
        <li class="active">Users List</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="box">
            <div class="box-header">
            <?php if(!empty($this->session->flashdata('response'))){ echo "<script>alert('".$this->session->flashdata('response')."')</script>"; } ?>
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <div class="col-md-8"><h2 class="box-title"></h2> </div>
				<div class="col-md-2">
        <a href="<?php echo base_url() ?>NewMaster/addLoginUsersDetails"><button type="button" class="btn btn-success" name="button">Add Users Details</button></a>
				</div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="designation_table" class="table table-bordered table-striped">
                <thead>
                <tr>
				  <th>Slno</th>
                  <th>Employee Name</th>
                  <th>Branch Name</th>
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
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->




