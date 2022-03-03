<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users Details
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>users/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
        <li class="active">Users Details</li>
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
			
				<div class="btn-group">
                      <button type="button" class="btn btn-success">Action</button>
                      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
						<li><a href="<?php echo base_url();?>dashboard">Dashboard</a></li>
                        <li><a href="<?php echo base_url();?>branch">Branch</a></li>
						<li><a href="<?php echo base_url();?>users">Users</a></li>
						<li><a href="<?php echo base_url();?>designation">Designation</a></li>
                      </ul>
				</div>
            </div>
            <input type="hidden" name="a" id="uid">
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="user_table" class="table table-bordered table-striped">
                <thead>
                <tr>
				          <th>Date</th>
                  <th>User</th>
                  <th>Action</th>
                  <th>Operator</th>
                  <th>User Type</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                   foreach($results as $row){
                  echo '<tr><td>'.$row->date.'</td>
                        <td>'.$row->user.'</td>
                        <td>'.$row->operation.'</td>
                        <td>'.$row->operator.'</td>';
                        if($row->user_type=='S'){
                        echo '<td>User</td>';
                        }
                        if($row->user_type=='Su'){
                            echo '<td>Super User</td>';
                            }
                       if($row->user_type=='A'){
                          echo '<td>Admin</td>';
                            }    

                            echo '</tr>';
                   }
                  
                  ?>

                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

         
     </div>
     <button style="color: red" onclick="window.print()">Print</button>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->






