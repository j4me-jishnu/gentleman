<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Dashboard <?php
    $s = $this->session->userdata('designation');
    $u = $this->session->userdata('user_type');
    ?>
  <ol class="breadcrumb"></ol>
  </section>

  <br />
  <!-- Main content -->
  <section class="content">
      <div class="row">

        <div>
          <!-- ./col -->
          <!-- <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?php foreach ($total_users as $total) {
                  if ($total->totalusers == 0) {
                    echo '0';
                  } else {
                    echo $total->totalusers;
                  }
                } ?></h3>
                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <?php if ($u == 'A') { ?>
                <a href="<?php echo base_url(); ?>Users" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a><?php } ?>
              </div>
            </div> -->
          </div>
          <!-- col -->
          <!-- <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
              <div class="inner">
                <h3><?php foreach ($Puchase_delivery as $deliverys) {
                  if ($deliverys->delivery == 0) {
                    echo '0';
                  } else {
                    echo $deliverys->delivery;
                  }
                }
                ?></h3>
                <p>Delivered</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="<?php echo base_url(); ?>Apurchaserequest" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php foreach ($designation as $designations) {
                if ($designations->designation == 0) {
                  echo '0';
                } else {
                  echo $designations->designation;
                }
              }
              ?></h3>

              <p><b>Designation</b></p>
            </div>
            <div class="icon">
              <i class="fa fa-spinner"></i>
            </div>
            <a href="<?php echo base_url(); ?>NewMaster/showDesignation" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php foreach ($product as $products) {
                if ($products->item == 0) {
                  echo '0';
                } else {
                  echo $products->item;
                }
              }
              ?></h3>
              <p><b>Items</b></p>
            </div>
            <div class="icon">
              <i class="fa fa-sliders"></i>
            </div>
            <a href="<?php echo base_url(); ?>NewMaster/showMasterOpeningStock" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php foreach ($brtobr as $br) {
                if ($br->total == 0) {
                  echo '0';
                } else {
                  echo $br->total;
                }
              }
              ?></h3>
              <p><b>Mutual branch transfer request</b></p>
            </div>
            <div class="icon">
              <i class="fa fa-exchange"></i>
            </div>
            <a href="<?php echo base_url(); ?>newMaster/showB2bRequest" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php foreach ($productrequest as $req) {
                if ($req->product_request == 0) {
                  echo '0';
                } else {
                  echo $req->product_request;
                }
              }
              ?></h3>

              <p><b>Branch Stock Request Approval</b></p>
            </div>
            <div class="icon">
              <i class="fa fa-thumbs-up"></i>
            </div>
            <a href="<?php echo base_url(); ?>NewMaster/showBranchItemRequestsPage" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php foreach ($branch as $branchs) {
                if ($branchs->branch == 0) {
                  echo $branchs->branch;
                } else {
                  echo $branchs->branch;
                }
              }
              ?>
            </h3>
            <p><b>Branches</b></p>
          </div>
          <div class="icon">
            <i class="fa fa-snowflake-o"></i>
          </div>
          <a href="<?php echo base_url(); ?>NewMaster/showBranchLists" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3><?php if(!empty($total_stock)){echo $total_stock;} else{ echo 0; } ?></h3>
            <p><b>Stock</b></p>
          </div>
          <div class="icon">
            <i class="fa fa-database"></i>
          </div>
          <a href="<?php echo base_url(); ?>NewMaster/showMasterStock" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <!-- <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?php foreach ($pending_purchase_dashboard as $row) {
              if ($row->purchase == 0) {
                echo '0';
              } else {
                echo $row->purchase;
              }
            }
            ?></h3>

            <p>Purchase Pending Approval</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="<?php echo base_url(); ?>Apurchaserequest" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div> -->
      <!-- </div> -->

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?php foreach ($categorys as $category) {
              if ($category->category == 0) {
                echo '0';
              } else {
                echo $category->category;
              }
            }
            ?></h3>

            <p><b>Categorys</b></p>
          </div>
          <div class="icon">
            <i class="fa fa-random"></i>
          </div>
          <a href="<?php echo base_url(); ?>NewMaster/showCategory" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?php foreach ($employee as $employees) {
              if ($employees->emp_counts == 0) {
                echo '0';
              } else {
                echo $employees->emp_counts;
              }
            }
            ?></h3>
            <p><b>Total Employees</b></p>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
          <a href="<?php echo base_url(); ?>NewMaster/ShowEmployeeList" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?php echo $branch_return_count; ?></h3>
            <p><b>Branch Returns</b></p>
          </div>
          <div class="icon">
            <i class="fa fa-fast-backward"></i>
          </div>
          <a href="<?php echo base_url(); ?>newMaster/showBranchReturn" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
          <div class="inner">
            <h3><?php foreach ($vendors as $totalvendor) {
              if ($totalvendor->vendor == 0) {
                echo '0';
              } else {
                echo $totalvendor->vendor;
              }
            }
            ?></h3>
            <p><b>Vendors</b></p>
          </div>
          <div class="icon">
            <i class="fa fa-street-view"></i>
          </div>
          <a href="<?php echo base_url(); ?>NewMaster/showVendor" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- reorder point -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>
              <?php foreach ($reorder as $reorders) {
              if ($reorders->mrop_count == 0) {
                echo '0';
              } else {
                echo $reorders->mrop_count;
              }
            }
            ?>
            </h3>
            <p><b>Reorder Notification Master</b></p>
          </div>
          <div class="icon">
            <i class="fa fa-hourglass-half"></i>
          </div>
          <a href="<?php echo base_url(); ?>NewMaster/showMasterReorder" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <!-- <div class="small-box bg-red">
          <div class="inner">
            <h3>
            <?php foreach ($breorder as $breorders) {
              if ($breorders->brop_count == 0) {
                echo '0';
              } else {
                echo $breorders->brop_count;
              }
            }
            ?>
            </h3>
            <p>Reorder Notification Branch</p>
          </div>
          <div class="icon">
            <i class="fa fa-cube"></i>
          </div>
          <a href="<?php echo base_url(); ?>Reordernotification/show" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div> -->
      <!-- </div> -->

    </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
