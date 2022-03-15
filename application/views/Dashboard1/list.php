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

          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php if(!empty($total_branch_stock)){echo $total_branch_stock;}else{ echo 0; } ?></h3>
              <p>Total stock</p>
            </div>
            <div class="icon">
              <i class="fa fa-database"></i>
            </div>
          </div>
        </div>
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
              <i class="fa fa-share"></i>
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
              <h3 ><?php if($emp_count>0){ echo $emp_count; } else{ echo 0; } ?></h3>
              <p>Employees Count</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-orange">
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
            <i class="fa fa-arrows-alt"></i>
          </div>
        </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>
              <?php if(!empty($branch_return_count)){ echo $branch_return_count; } else { echo 0; } ?>
              </h3>
              <p>Branch Return to Master</p>
            </div>
            <div class="icon">
            <i class="fa fa-backward"></i>
          </div>
        </div>
        </div>
		</div>
	</section>
  </div>
