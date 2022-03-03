<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Dashboard</h1>
        <!-- <small>Optional description</small> -->
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dash_board"><i class="fa fa-dashboard"></i> Home</a></li>
        <!--<li><a href="<?php echo base_url();?>index.php/sale/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>-->
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
		<div class="row">
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->

          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php foreach ($items_Issued as $issue){
                    if($issue->issued == 0){
                      echo '0';
                    }
                    else{
                      echo $issue->issued;
                    }
                  } ?></h3>
              <p>Items Issued</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php foreach ($total_users as $total){
                    if($total->totalusers == 0){
                      echo '0';
                    }
                    else{
                      echo $total->totalusers;
                    }
                  } ?></h3>
              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3 ><?php foreach ($stock_items as $stock_itemss){
                    if($stock_itemss->br_total_stck == 0){
                      echo '0';
                    }
                    else{
                      echo $stock_itemss->br_total_stck;
                    }
                  } ?></h3>
              <p>Items InStock</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>
              <?php foreach ($breorder as $breorders){
                    if($breorders->br_rop_count == 0){
                      echo '0';
                    }
                    else{
                      echo $breorders->br_rop_count;
                    }
                  } ?>
              </h3>
              <p>Reorder Notification</p>
            </div>
            <div class="icon">
            <i class="fa fa-cube"></i>
          </div>
          <a href="<?php echo base_url();?>Reordernotification/bshow" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>
              <?php foreach ($emp_count as $emp_counts){
                    if($emp_counts->emp_id == 0){
                      echo '0';
                    }
                    else{
                      echo $emp_counts->emp_id;
                    }
                  } ?>
              </h3>
              <p>Employee Count</p>
            </div>
            <div class="icon">
            <i class="fa fa-cube"></i>
          </div>
        </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
              <?php foreach ($btob_count as $btob_counts){
                    if($btob_counts->btob_id == 0){
                      echo '0';
                    }
                    else{
                      echo $btob_counts->btob_id;
                    }
                  } ?>
              </h3>
              <p>Branch to Branch Count</p>
            </div>
            <div class="icon">
            <i class="fa fa-cube"></i>
          </div>
        </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
              <?php echo $branch_return_count; ?>
              </h3>
              <p>Branch Return to Master</p>
            </div>
            <div class="icon">
            <i class="fa fa-cube"></i>
          </div>
        </div>
        </div>
        <!-- ./col -->
		</div>

		<div class="box">
            <div class="box-header">
              <h3 class="box-title">Users Deatils</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="user_table" class="table table-bordered table-striped">
                <thead>
                <tr>
				 <th>Slno</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Phone</th>
                  <th>Email</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
			</div>
            <!-- /.box-body -->
		</div>
		<div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Branch Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
				<table class="table table-bordered">
                <tr>
                  <th>Si</th>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Address</th>
				  <th>Phone</th>
				  <th>Email</th>
                </tr>
				<?php $i=1; foreach ($brns as $row)
					{ ?>
				<tr>
				<td><?php echo $i;?></td>
				<td><?php echo $row->br_id; ?></td>
				<td><?php echo $row->branch_name; ?></td>
				<td><?php echo $row->branch_address; ?></td>
				<td><?php echo $row->branch_phone; ?></td>
				<td><?php echo $row->branch_email; ?></td>
				</tr>
                <?php $i++; } ?>
				</table>
			</div>
            <!-- /.box-body
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="<?php echo base_url();?>branch">View Details</a></li>
              </ul>
            </div>-->
	    </div>
	</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
