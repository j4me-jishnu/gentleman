Left side column. contains the logo and sidebar
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" id="navi">
      <!--<li class="header"></li>-->
      <!-- Optionally, you can add icons to the links -->
      <?php $u = $this->session->userdata('user_type');$d = $this->session->userdata('designation');

      if( $u== "A") {?>
        <li class="<?php if($this->uri->segment(1)=="dashboard"){echo "active";}?>" ><a  href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

        <!-- <li class="<?php if($this->uri->segment(1)=="dashboard"){echo "active";}?>" ><a  href="<?php echo base_url();?>Apurchaserequest"><i class="fa fa-file-powerpoint-o"></i> <span>Purchase</span></a></li> -->


        <!-- ###################################################################################################################### -->

          <!-- <li class="treeview <?php //if($this->uri->segment(1)=="showVendor")
          // {echo "active";}
          // else if($this->uri->segment(1)=="showPurchase")
          // {echo "active";}
          // else if($this->uri->segment(1)=="showReoderMaster")
          // {echo "active";}
          // else if($this->uri->segment(1)=="showReoderBranch")
          // {echo "active";}
          // else if($this->uri->segment(1)=="showMasterOpeningStock")
          // {echo "active";}
          // else if($this->uri->segment(1)=="showPurchaseStock")
          // {echo "active";}
          // else if($this->uri->segment(1)=="showMasterStock")
          // {echo "active";}
          // else if($this->uri->segment(1)=="showBranchItemRequestsPage")
          // {echo "active";}
          // else if($this->uri->segment(1)=="showB2bRequest")
          // {echo "active";}
          // else if($this->uri->segment(1)=="showBranchReturn")
          // {echo "active";}
          // else if($this->uri->segment(1)=="showPurcahseReport")
          // {echo "active";}
          // ?>"> -->

          <!-- <li class="" ><a><i class="fa fa-gear"></i> <span>New Section</span><br> <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span></a>
          <ul class="treeview-menu">

            <li class="" ><a  href="<?php echo base_url(); ?>NewMaster/showVendor"><i class="fa  fa-gear"></i> <span>Vendors</span></a></li>
            <li class="" ><a  href="<?php echo base_url(); ?>NewMaster/showPurchase"><i class="fa  fa-gear"></i> <span>Purchase</span></a></li>
            <li class="" ><a><i class="fa fa-gear"></i> <span>Reorder Point</span><br> <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span></a>
            <ul class="treeview-menu">
              <li class=""><a  href="<?php echo base_url(); ?>NewMaster/showReoderMaster"><i class="fa  fa-gear"></i> <span>Master</span></a></li>
              <li class=""><a  href="<?php echo base_url(); ?>NewMaster/showReoderBranch"><i class="fa  fa-gear"></i> <span>Branch</span></a></li>
            </ul>
            <!-- <li class="" ><a  href="<?php echo base_url(); ?>NewMasterstock"><i class="fa  fa-gear"></i> <span>Masterstock data</span></a></li> -->
            <!-- <li class="" ><a  href="<?php echo base_url(); ?>NewMaster/showDesignation"><i class="fa  fa-gear"></i> <span>Designation</span></a></li>
            <li class="" ><a  href="<?php echo base_url(); ?>NewMaster/ShowEmployeeList"><i class="fa  fa-gear"></i> <span>Employee</span></a></li>
            <li class="" ><a  href="<?php echo base_url(); ?>NewMaster/showMasterOpeningStock"><i class="fa  fa-gear"></i> <span>Opening Stock</span></a></li>
            <li class="" ><a  href="<?php echo base_url(); ?>NewMaster/showPurchaseStock"><i class="fa  fa-gear"></i> <span>Purchase Stock</span></a></li>
            <li class="" ><a  href="<?php echo base_url(); ?>NewMaster/showPurchaseReturn"><i class="fa  fa-gear"></i> <span>Purchase Return</span></a></li>
            <li class="" ><a  href="<?php echo base_url(); ?>NewMaster/showMasterStock"><i class="fa  fa-gear"></i> <span>Master Stock</span></a></li>
            <!-- <li class="" ><a  href="#"><i class="fa  fa-gear"></i> <span>Set Re-order point</span></a></li> -->
            <!-- <li class="" ><a  href="<?php echo base_url(); ?>newMaster/showBranchItemRequestsPage"><i class="fa  fa-gear"></i> <span>Branch Item Requests</span></a></li>
            <li class="" ><a  href="<?php echo base_url(); ?>newMaster/showB2bRequest"><i class="fa  fa-gear"></i> <span>Branch to Branch Requests</span></a></li>
            <li class="" ><a  href="<?php echo base_url(); ?>newMaster/showBranchReturn"><i class="fa  fa-gear"></i> <span>Branch Returns</span></a></li>
            <li class="" ><a><i class="fa fa-gear"></i> <span>Reports</span><br> <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span></a>
            <ul class="treeview-menu">
              <li class=""><a  href="<?php echo base_url(); ?>NewReport/showPurcahseReport"><i class="fa  fa-gear"></i> <span>Purchase Report</span></a></li>

            </ul> -->
          <!-- </ul>
        </li> -->

        <!-- new Menu list -->
        <li class="<?php if($this->uri->segment(2)=="showLoginUsersList"){echo "active";} ?>" ><a  href="<?php echo base_url(); ?>NewMaster/showLoginUsersList"><i class="fa fa-users"></i> <span>Users List</span></a></li>
            <li class="<?php if($this->uri->segment(2)=="showVendor"){echo "active";} ?>" ><a  href="<?php echo base_url(); ?>NewMaster/showVendor"><i class="fa fa-user"></i> <span>Vendors</span></a></li>
            <li class="<?php if($this->uri->segment(2)=="showVendor"){echo "active";} ?>" ><a  href="<?php echo base_url(); ?>NewMaster/showVendorPaymentList"><i class="fa fa-user"></i> <span>Vendor Payment</span></a></li>
            <li class="<?php if($this->uri->segment(2)=="showPurchase"){echo "active";} ?>" ><a  href="<?php echo base_url(); ?>NewMaster/showPurchase"><i class="fa fa-shopping-cart"></i> <span>Purchase</span></a></li>
            <li class="" ><a><i class="fa fa-bars"></i> <span>Reorder Point</span><br> <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span></a>
            <ul class="treeview-menu">
              <li class="<?php if($this->uri->segment(2)=="showReoderMaster"){echo "active";} ?>"><a  href="<?php echo base_url(); ?>NewMaster/showReoderMaster"><i class="fa fa-clipboard"></i> <span>Master</span></a></li>
              <li class="<?php if($this->uri->segment(2)=="showReoderBranch"){echo "active";} ?>"><a  href="<?php echo base_url(); ?>NewMaster/showReoderBranch"><i class="fa fa-sitemap"></i> <span>Branch</span></a></li>
            </ul>
            </li>
            <!-- <li class="" ><a  href="<?php echo base_url(); ?>NewMasterstock"><i class="fa  fa-gear"></i> <span>Masterstock data</span></a></li> -->
            <li class="<?php if($this->uri->segment(2)=="showCategory"){echo "active";} ?>" ><a  href="<?php echo base_url(); ?>NewMaster/showCategory"><i class="fa fa-briefcase"></i> <span>Item Category</span></a></li>
            <li class="<?php if($this->uri->segment(2)=="showCategory"){echo "active";} ?>" ><a  href="<?php echo base_url(); ?>NewMaster/showItem"><i class="fa fa-briefcase"></i> <span>Items</span></a></li>
            <li class="<?php if($this->uri->segment(2)=="showDesignation"){echo "active";} ?>" ><a  href="<?php echo base_url(); ?>NewMaster/showDesignation"><i class="fa fa-briefcase"></i> <span>Designation</span></a></li>
            <li class="<?php if($this->uri->segment(2)=="ShowEmployeeList"){echo "active";} ?>" ><a  href="<?php echo base_url(); ?>NewMaster/ShowEmployeeList"><i class="fa fa-users"></i> <span>Employee</span></a></li>
            <li class="<?php if($this->uri->segment(2)=="showMasterOpeningStock"){echo "active";} ?>" ><a  href="<?php echo base_url(); ?>NewMaster/showMasterOpeningStock"><i class="fa fa-cubes"></i> <span>Opening Stock</span></a></li>
            <li class="<?php if($this->uri->segment(2)=="showPurchaseStock"){echo "active";} ?>" ><a  href="<?php echo base_url(); ?>NewMaster/showPurchaseStock"><i class="fa fa-archive"></i> <span>Purchase Stock</span></a></li>
            <li class="<?php if($this->uri->segment(2)=="showPurchaseReturn"){echo "active";} ?>" ><a  href="<?php echo base_url(); ?>NewMaster/showPurchaseReturn"><i class="fa fa-undo"></i> <span>Purchase Return</span></a></li>
            <li class="<?php if($this->uri->segment(2)=="showMasterStock"){echo "active";} ?>" ><a  href="<?php echo base_url(); ?>NewMaster/showMasterStock"><i class="fa fa-building"></i> <span>Master Stock</span></a></li>
            <li class="<?php if($this->uri->segment(2)=="showMasterStock"){echo "active";} ?>" ><a  href="<?php echo base_url(); ?>NewMaster/showBranchStock"><i class="fa fa-building"></i> <span>Branch Stock</span></a></li>
            <!-- <li class="" ><a  href="#"><i class="fa  fa-gear"></i> <span>Set Re-order point</span></a></li> -->
            <li class="<?php if($this->uri->segment(2)=="showBranchItemRequestsPage"){echo "active";} ?>" ><a  href="<?php echo base_url(); ?>newMaster/showBranchItemRequestsPage"><i class="fa fa-arrow-circle-left"></i> <span>Stock Requests</span></a></li>
            <li class="<?php if($this->uri->segment(2)=="showB2bRequest"){echo "active";} ?>" ><a  href="<?php echo base_url(); ?>newMaster/showB2bRequest"><i class="fa fa-gavel"></i> <span>Branch to Branch Requests</span></a></li>
            <li class="<?php if($this->uri->segment(2)=="showBranchReturn"){echo "active";} ?>" ><a  href="<?php echo base_url(); ?>newMaster/showBranchReturn"><i class="fa fa-desktop"></i> <span>Branch Returns</span></a></li>
            <li class="" ><a><i class="fa fa-table"></i> <span>Reports</span><br> <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span></a>
            <ul class="treeview-menu">
              <li class="<?php if($this->uri->segment(2)=="showPurcahseReport"){echo "active";} ?>"><a  href="<?php echo base_url(); ?>NewReport/showPurcahseReport"><i class="fa fa-table"></i> <span>Purchase Report</span></a></li>

            </ul>
            </li>

        <!-- ################################################################################################################### -->

        <!-- <li class="treeview <?php if($this->uri->segment(1)=="designation")
        {echo "active";}
        else if($this->uri->segment(1)=="branch")
        {echo "active";}
        else if($this->uri->segment(1)=="Employee")
        {echo "active";}
        else if($this->uri->segment(1)=="Users")
        {echo "active";}
        else if($this->uri->segment(1)=="Vendor")
        {echo "active";}
        else if($this->uri->segment(1)=="UserPrivilages")
        {echo "active";}
        ?>">
        <a><i class="fa fa-line-chart"></i> <span>Master modules</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="<?php if($this->uri->segment(1)=="designation"){echo "active";}?>" ><a  href="<?php echo base_url();?>designation"><i class="fa fa-user"></i> <span>Designation</span></a>
            <li class="<?php if($this->uri->segment(1)=="branch"){echo "active";}?>" ><a  href="<?php echo base_url();?>branch"><i class="fa fa-cubes"></i>Branch</a></li>
            <li class="<?php if($this->uri->segment(1)=="Employee"){echo "active";}?>" ><a  href="<?php echo base_url();?>Employee"><i class="fa fa-cubes"></i>Employee</a></li>
            <li class="<?php if($this->uri->segment(1)=="users"){echo "active";}?>" ><a  href="<?php echo base_url();?>Users"><i class="fa fa-users"></i> <span>Users</span></a></li>
            <li class="<?php if($this->uri->segment(1)=="Vendor"){echo "active";}?>" ><a  href="<?php echo base_url();?>Vendor"><i class="fa fa-circle-o"></i> <span>Vendor details <span></a></li>
            <li class="<?php if($this->uri->segment(1)=="UserPrivilages"){echo "active";}?>" ><a  href="<?php echo base_url();?>UserPrivilages"><i class="fa fa-circle-o"></i> <span>User Privilages<span></a></li>
            </ul>
          </li> -->

          <!-- <li class="treeview <?php if($this->uri->segment(1)=="Moveto_branch")
          {echo "active";}
          else if($this->uri->segment(1)=="Masterstock")
          {echo "active";}
          else if($this->uri->segment(1)=="Branchstock")
          {echo "active";}

          else if($this->uri->segment(1)=="Returnstock")
          {echo "active";}
          ?>">
          <a><i class="fa fa-line-chart"></i> <span>Stock</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($this->uri->segment(1)=="Moveto_branch"){echo "active";}?>" ><a  href="<?php echo base_url();?>Moveto_branch"><i class="fa fa-circle-o"></i>Stock move request</a></li>
            <li class="<?php if($this->uri->segment(1)=="Masterstock"){echo "active";}?>" ><a href="<?php echo base_url();?>Masterstock"><i class="fa fa-circle-o"></i>Master Stock</a></li>
            <li class="<?php if($this->uri->segment(1)=="Branchstock"){echo "active";}?>" ><a  href="<?php echo base_url();?>Branchstock"><i class="fa fa-circle-o"></i> <span>Branch Stock</span></a></li>
            <li class="<?php if($this->uri->segment(1)=="Returnstock"){echo "active";}?>" ><a href="<?php echo base_url();?>Returnstock"><i class="fa fa-circle-o"></i>Return Stock</a></li>
          </ul>
        </li> -->

        <!-- <li class="<?php if($this->uri->segment(1)=="dashboard"){echo "active";}?>" ><a  href="<?php echo base_url();?>Request_Br_to_br"><i class="fa fa-th"></i> <span>Branch to branch request</span></a></li> -->
        <!--	<li class="<?php if($this->uri->segment(1)=="branch"){echo "active";}?>" ><a  href="<?php echo base_url();?>branch"><i class="fa fa-cubes"></i> <span>Branch</span></a></li>-->
        <!-- <li class="<?php if($this->uri->segment(1)=="branch"){echo "active";}?>" ><a  href="<?php echo base_url();?>Scrap"><i class="fa fa-cubes"></i> <span>Scrap items</span></a></li> -->
        <!-- <li class="<?php if($this->uri->segment(1)=="designation"){echo "active";}?>" ><a  href="<?php echo base_url();?>designation"><i class="fa fa-user"></i> <span>Designation</span></a>-->
        <!-- </li> -->
        <!--	<li class="<?php if($this->uri->segment(1)=="users"){echo "active";}?>" ><a  href="<?php echo base_url();?>Users"><i class="fa fa-users"></i> <span>Users</span></a></li>-->
        <!--<li class="<?php if($this->uri->segment(1)=="Vendor"){echo "active";}?>" ><a href="<?php echo base_url();?>Vendor"><i class="fa fa-circle-o"></i> <span>Vendor details</span></a></li>-->

        <!-- <li class="<?php if($this->uri->segment(1)=="Vendor"){echo "active";}?>" ><a href="<?php echo base_url();?>Admin_view_Request"><i class="fa fa-circle-o"></i> <span>Product Request</span></a></li> -->
        <!-- <li class="treeview <?php if($this->uri->segment(1)=="category")
        {echo "active";}
        else if($this->uri->segment(1)=="item")
        {echo "active";}
        else if($this->uri->segment(1)=="openigstock")
        {echo "active";}
        ?>">
        <a><i class="fa fa-line-chart"></i> <span>Inventory</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="<?php if($this->uri->segment(1)=="category"){echo "active";}?>" ><a  href="<?php echo base_url();?>category"><i class="fa fa-circle-o"></i>Category</a></li>
          <li class="<?php if($this->uri->segment(1)=="item"){echo "active";}?>" ><a href="<?php echo base_url();?>item"><i class="fa fa-circle-o"></i>Item</a></li>
          <li class="<?php if($this->uri->segment(1)=="openigstock"){echo "active";}?>" ><a  href="<?php echo base_url();?>openigstock"><i class="fa fa-circle-o"></i> <span>Opening Stock</span></a></li>
        </ul>
      </li> -->
      <!-- <li class="<?php if($this->uri->segment(1)=="Setrop"){echo "active";}?>" ><a><i class="fa fa-sort-amount-desc"></i> <span>ResetRop</span><br> <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span></a>
      <ul class="treeview-menu">
        <li class="<?php if($this->uri->segment(1)=="item"){echo "active";}?>" ><a href="<?php echo base_url();?>Setmrop"><i class="fa fa-circle-o"></i>Master ROP</a></li>
        <li class="<?php if($this->uri->segment(1)=="openigstock"){echo "active";}?>" ><a  href="<?php echo base_url();?>Setrop"><i class="fa fa-circle-o"></i> <span>Branch ROP</span></a></li>
      </ul> -->

    <!-- </li> -->
    <!-- <li class="<?php if($this->uri->segment(1)=="setrop"){echo "active";}?>" ><a><i class="fa fa-sort-amount-desc"></i> <span>Report</span><br> <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span></a>
    <ul class="treeview-menu">
      <li class="<?php if($this->uri->segment(1)=="userwise_conception_report"){echo "active";}?>" ><a  href="<?php echo base_url();?>Purchase_report"><i class="fa  fa-file-text-o"></i> <span>Purchase report</span></a>
      </li>
      <li class="<?php if($this->uri->segment(1)=="branch_conception_report"){echo "active";}?>" ><a  href="<?php echo base_url();?>branch_conception_report"><i class="fa  fa-file-text-o"></i> <span>Center stock issue report</span></a></li>
      <li class="<?php if($this->uri->segment(1)=="branch_conception_report"){echo "active";}?>" ><a  href="<?php echo base_url();?>Branch_issue_report"><i class="fa  fa-file-text-o"></i> <span>Branchwise issue report</span></a></li>
      <li class="<?php if($this->uri->segment(1)=="branch_conception_report"){echo "active";}?>" ><a  href="<?php echo base_url();?>Mutual_branch_transfer_report"><i class="fa  fa-file-text-o"></i> <span>Mutual branch transfer report</span></a></li>
      <li class="<?php if($this->uri->segment(1)=="Consolidated"){echo "active";}?>" ><a  href="<?php echo base_url();?>Consolidated"><i class="fa  fa-file-text-o"></i> <span>Consolidated report</span></a></li>

    </ul>
  </li> -->
  <!-- <li class="<?php if($this->uri->segment(1)=="setrop"){echo "active";}?>" ><a><i class="fa fa-gear"></i> <span>Settings</span><br> <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
  </span></a>
  <ul class="treeview-menu">

    <li class="<?php if($this->uri->segment(1)=="branch_conception_report"){echo "active";}?>" ><a  href="<?php echo base_url();?>Change_password"><i class="fa  fa-gear"></i> <span>Change password</span></a></li>
    <li class="<?php if($this->uri->segment(1)=="Privilages"){echo "active";}?>" ><a  href="<?php echo base_url();?>Privilages"><i class="fa  fa-gear"></i><span>User Privilages</span></a></li>
    <li class="<?php if($this->uri->segment(1)=="branch_conception_report"){echo "active";}?>" ><a  href="<?php echo base_url();?>SetMail"><i class="fa  fa-gear"></i> <span>Set Mail</span></a></li>
  </ul>
</li> -->




<!-- <li class="<?php if($this->uri->segment(1)=="branch_conception_report"){echo "active";}?>" ><a  href="<?php echo base_url();?>Log_file"><i class="fa  fa-gear"></i> <span>Log</span></a></li>

<li class="<?php if($this->uri->segment(1)=="setrop"){echo "active";}?>" ><a><i class="fa fa-gear"></i> <span>Bench mark</span><br> <span class="pull-right-container">
  <i class="fa fa-angle-left pull-right"></i>
</span></a>
<ul class="treeview-menu">

  <li class="<?php if($this->uri->segment(1)=="branch_conception_report"){echo "active";}?>" ><a  href="<?php echo base_url();?>SetBenchmark"><i class="fa  fa-gear"></i> <span>Benchmark Report</span></a></li>
  <li class="<?php if($this->uri->segment(1)=="branch_conception_report"){echo "active";}?>" ><a  href="<?php echo base_url();?>SetMasterBenchmark"><i class="fa  fa-gear"></i> <span>Set Branch Benchmark</span></a></li>
  <li class="<?php if($this->uri->segment(1)=="branch_conception_report"){echo "active";}?>" ><a  href="<?php echo base_url();?>SetUserBenchmark"><i class="fa  fa-gear"></i> <span>Set User Benchmark</span></a></li>
</ul> -->

</li>
<?php }else if($u =="Su") { ?>
  <li class="<?php if($this->uri->segment(1)=="dashboard"){echo "active";}?>" ><a  href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
  <?php if($this->session->userdata('purchase')==1){ ?>
    <li class="<?php if($this->uri->segment(1)=="dashboard"){echo "active";}?>" ><a  href="<?php echo base_url();?>Apurchaserequest"><i class="fa fa-file-powerpoint-o"></i> <span>Purchase</span></a></li>
  <?php } ?>
  <?php if($this->session->userdata('stockmove')==1){ ?>
    <li class="<?php if($this->uri->segment(1)=="dashboard"){echo "active";}?>" ><a  href="<?php echo base_url();?>Moveto_branch"><i class="fa fa-file-powerpoint-o"></i> <span>Stock move request</span></a></li>
  <?php } ?>
  <?php if($this->session->userdata('masterstock')==1){ ?>
    <li class="<?php if($this->uri->segment(1)=="dashboard"){echo "active";}?>" ><a  href="<?php echo base_url();?>Masterstock"><i class="fa fa-th"></i> <span>Master Stock</span></a></li>
  <?php } ?>
  <?php if($this->session->userdata('branchstock')==1){ ?>
    <li class="<?php if($this->uri->segment(1)=="dashboard"){echo "active";}?>" ><a  href="<?php echo base_url();?>Branchstock"><i class="fa fa-th"></i> <span>Branch Stock</span></a></li>
  <?php } ?>
  <?php if($this->session->userdata('returnstock')==1){ ?>
   <li class="<?php if($this->uri->segment(1)=="dashboard"){echo "active";}?>" ><a  href="<?php echo base_url();?>Returnstock"><i class="fa fa-th"></i> <span>Return Stock</span></a></li>
 <?php } ?>
 <?php if($this->session->userdata('branchrequest')==1){ ?>
  <li class="<?php if($this->uri->segment(1)=="dashboard"){echo "active";}?>" ><a  href="<?php echo base_url();?>Request_Br_to_br"><i class="fa fa-th"></i> <span>Branch to branch request</span></a></li>
<?php } ?>
<?php if($this->session->userdata('branch')==1){ ?>
  <li class="<?php if($this->uri->segment(1)=="branch"){echo "active";}?>" ><a  href="<?php echo base_url();?>branch"><i class="fa fa-cubes"></i> <span>Branch</span></a></li>
<?php } ?>
<?php if($this->session->userdata('scrap')==1){ ?>
  <li class="<?php if($this->uri->segment(1)=="branch"){echo "active";}?>" ><a  href="<?php echo base_url();?>Scrap"><i class="fa fa-cubes"></i> <span>Scrap items</span></a></li>
<?php } ?>
<?php if($this->session->userdata('designationaccess')==1){ ?>
  <li class="<?php if($this->uri->segment(1)=="designation"){echo "active";}?>" ><a  href="<?php echo base_url();?>designation"><i class="fa fa-user"></i> <span>Designation</span></a></li>
<?php } ?>
<?php if($this->session->userdata('users')==1){ ?>
 <li class="<?php if($this->uri->segment(1)=="users"){echo "active";}?>" ><a  href="<?php echo base_url();?>Users"><i class="fa fa-users"></i> <span>Users</span></a></li>
<?php } ?>
<?php if($this->session->userdata('vendor')==1){ ?>
  <li class="<?php if($this->uri->segment(1)=="Vendor"){echo "active";}?>" ><a href="<?php echo base_url();?>Vendor"><i class="fa fa-circle-o"></i> <span>Vendor details</span></a></li>
<?php } ?>
<?php if($this->session->userdata('product')==1){ ?>
  <li class="<?php if($this->uri->segment(1)=="Vendor"){echo "active";}?>" ><a href="<?php echo base_url();?>Admin_view_Request"><i class="fa fa-circle-o"></i> <span>Product Request</span></a></li>
<?php } ?>
<?php if($this->session->userdata('inventory')==1){ ?>
  <li class="treeview <?php if($this->uri->segment(1)=="category")
  {echo "active";}
  else if($this->uri->segment(1)=="item")
  {echo "active";}
  else if($this->uri->segment(1)=="openigstock")
  {echo "active";}
  ?>">
  <a><i class="fa fa-line-chart"></i> <span>Inventory</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li class="<?php if($this->uri->segment(1)=="category"){echo "active";}?>" ><a  href="<?php echo base_url();?>category"><i class="fa fa-circle-o"></i>Category</a></li>
    <li class="<?php if($this->uri->segment(1)=="item"){echo "active";}?>" ><a href="<?php echo base_url();?>item"><i class="fa fa-circle-o"></i>Item</a></li>
    <li class="<?php if($this->uri->segment(1)=="openigstock"){echo "active";}?>" ><a  href="<?php echo base_url();?>openigstock"><i class="fa fa-circle-o"></i> <span>Opening Stock</span></a></li>
  </ul>
</li>
<?php } ?>
<?php if($this->session->userdata('rop')==1){ ?>
  <li class="<?php if($this->uri->segment(1)=="Setrop"){echo "active";}?>" ><a><i class="fa fa-sort-amount-desc"></i> <span>ResetRop</span><br> <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
  </span></a>
  <ul class="treeview-menu">
    <li class="<?php if($this->uri->segment(1)=="item"){echo "active";}?>" ><a href="<?php echo base_url();?>Setmrop"><i class="fa fa-circle-o"></i>Master ROP</a></li>
    <li class="<?php if($this->uri->segment(1)=="openigstock"){echo "active";}?>" ><a  href="<?php echo base_url();?>Setrop"><i class="fa fa-circle-o"></i> <span>Branch ROP</span></a></li>
  </ul>

</li>
<?php } ?>
<?php if($this->session->userdata('report')==1){ ?>
  <li class="<?php if($this->uri->segment(1)=="setrop"){echo "active";}?>" ><a><i class="fa fa-sort-amount-desc"></i> <span>Report</span><br> <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
  </span></a>
  <ul class="treeview-menu">
    <li class="<?php if($this->uri->segment(1)=="userwise_conception_report"){echo "active";}?>" ><a  href="<?php echo base_url();?>Purchase_report"><i class="fa  fa-file-text-o"></i> <span>Purchase report</span></a>
    </li>
    <li class="<?php if($this->uri->segment(1)=="branch_conception_report"){echo "active";}?>" ><a  href="<?php echo base_url();?>branch_conception_report"><i class="fa  fa-file-text-o"></i> <span>Center stock issue report</span></a></li>
    <li class="<?php if($this->uri->segment(1)=="branch_conception_report"){echo "active";}?>" ><a  href="<?php echo base_url();?>Branch_issue_report"><i class="fa  fa-file-text-o"></i> <span>Branchwise issue report</span></a></li>
    <li class="<?php if($this->uri->segment(1)=="branch_conception_report"){echo "active";}?>" ><a  href="<?php echo base_url();?>Mutual_branch_transfer_report"><i class="fa  fa-file-text-o"></i> <span>Mutual branch transfer report</span></a></li>


  </ul>
</li>
<?php } ?>
<li class="<?php if($this->uri->segment(1)=="setrop"){echo "active";}?>" ><a><i class="fa fa-gear"></i> <span>Settings</span><br> <span class="pull-right-container">
  <i class="fa fa-angle-left pull-right"></i>
</span></a>
<ul class="treeview-menu">

  <li class="<?php if($this->uri->segment(1)=="branch_conception_report"){echo "active";}?>" ><a  href="<?php echo base_url();?>Change_password"><i class="fa  fa-gear"></i> <span>Change password</span></a></li>
</ul>
</li>
<?php if($this->session->userdata('log')==1){ ?>
  <li class="<?php if($this->uri->segment(1)=="branch_conception_report"){echo "active";}?>" ><a  href="<?php echo base_url();?>Log_file"><i class="fa  fa-gear"></i> <span>Log</span></a></li>
<?php } ?>

<?php } else if( $u== "S") { ?>
  <li class="<?php if($this->uri->segment(1)=="dashboard"){echo "active";}?>" ><a  href="<?php echo base_url();?>Dash_board"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
  <!--<li class="<?php if($this->uri->segment(1)=="selfopretion"){echo "active";}?>" ><a  href="<?php echo base_url();?>selfopretion"><i class="fa fa-sticky-note-o"></i> <span>Self-operation Report</span></a></li>-->

  <!-- <li class="<?php if($this->uri->segment(1)=="setrop"){echo "active";}?>" ><a><i class="fa fa-sort-amount-desc"></i> <span>Stock details</span><br> <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
  </span></a>
  <ul class="treeview-menu">
    <li class="<?php if($this->uri->segment(1)=="stock"){echo "active";}?>" ><a  href="<?php echo base_url();?>stock"><i class="fa fa-cart-plus"></i> <span>Stock Details</span></a></li>
    <li class="<?php if($this->uri->segment(1)=="issueitem"){echo "active";}?>" ><a  href="<?php echo base_url();?>issueitem"><i class="fa  fa-angle-double-down"></i> <span>Issue item</span></a></li>
    <li class="<?php if($this->uri->segment(1)=="updateusage"){echo "active";}?>" ><a  href="<?php echo base_url();?>Request_item"><i class="fa  fa-check-square-o"></i> <span>Request Item</span></a></li>
    <li class="<?php if($this->uri->segment(1)=="issueroll"){echo "active";}?>" ><a  href="<?php echo base_url();?>Return_item"><i class="fa  fa-angle-double-down"></i> <span>Return Item</span></a></li>



  </ul>
</li> -->

<!-- <li class="<?php if($this->uri->segment(1)=="dashboard"){echo "active";}?>" ><a  href="<?php echo base_url();?>Users_branch"><i class="fa fa-angle-left"></i> <span>Users</span></a></li> -->


<!--<li class="<?php if($this->uri->segment(1)=="stock"){echo "active";}?>" ><a  href="<?php echo base_url();?>stock"><i class="fa fa-cart-plus"></i> <span>Stock Details</span></a></li>-->
<!--	<li class="<?php if($this->uri->segment(1)=="issueitem"){echo "active";}?>" ><a  href="<?php echo base_url();?>issueitem"><i class="fa  fa-angle-double-down"></i> <span>Issue item</span></a></li>-->
	<!--	<li class="<?php if($this->uri->segment(1)=="updateusage"){echo "active";}?>" ><a  href="<?php echo base_url();?>Request_item"><i class="fa  fa-check-square-o"></i> <span>Request Item</span></a></li>
		<li class="<?php if($this->uri->segment(1)=="issueroll"){echo "active";}?>" ><a  href="<?php echo base_url();?>Return_item"><i class="fa  fa-angle-double-down"></i> <span>Return Item</span></a></li>-->
    <!-- <li class="<?php if($this->uri->segment(1)=="issueroll"){echo "active";}?>" ><a  href="<?php echo base_url();?>Branch_to_branch"><i class="fa  fa-angle-double-down"></i> <span>Branch to Branch</span></a></li> -->
    <!-- <li class="<?php if($this->uri->segment(1)=="setrop"){echo "active";}?>" ><a><i class="fa fa-sort-amount-desc"></i> <span>Report</span><br> <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span></a>
    <ul class="treeview-menu">

      <li class="<?php if($this->uri->segment(1)=="branch_conception_report"){echo "active";}?>" ><a  href="<?php echo base_url();?>Branch_report"><i class="fa  fa-file-text-o"></i> <span>Stock report</span></a></li>
      <li class="<?php if($this->uri->segment(1)=="branch_conception_report"){echo "active";}?>" ><a  href="<?php echo base_url();?>Issue_report"><i class="fa  fa-file-text-o"></i> <span>Item issue report</span></a></li>
    </ul>
  </li> -->

  <!-- <li class="<?php if($this->uri->segment(1)=="setrop"){echo "active";}?>" ><a><i class="fa fa-gear"></i> <span>Settings</span><br> <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
  </span></a>
  <ul class="treeview-menu">

    <li class="<?php if($this->uri->segment(1)=="branch_conception_report"){echo "active";}?>" ><a  href="<?php echo base_url();?>Change_password"><i class="fa  fa-gear"></i> <span>Change password</span></a></li>
  </ul> -->
  <?php if($d ==3){?>
    <li class="<?php if($this->uri->segment(1)=="setrop"){echo "active";}?>" ><a><i class="fa fa-gear"></i> <span>Bench mark</span><br> <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span></a>
    <ul class="treeview-menu">


      <li class="<?php if($this->uri->segment(1)=="branch_conception_report"){echo "active";}?>" ><a  href="<?php echo base_url();?>SetBranchBenchmark"><i class="fa fa-gear"></i> <span>Set User Benchmark</span></a></li>
    </ul>
  </li>
<?php } ?>
</li>
<!-- ############################################## NEW SECTION ######################################### -->
  <!--  -<li class="<?php if($this->uri->segment(1)=="setrop"){echo "active";}?>" ><a><i class="fa  fa-file-text-o"></i> <span>New section</span><br> <span class="pull-right-container">
    <i class="fa fa-angle-left pull-right"></i>
  </span></a>
  <ul class="treeview-menu">
    <!-- <li class="<?php if($this->uri->segment(1)=="showStockDetails"){echo "active";}?>" ><a  href="<?php echo base_url(); ?>NewBranch/showStockDetails"><i class="fa  fa-gear"></i> <span>Stock Details</span></a></li> -->
    <!-- <li class="<?php if($this->uri->segment(1)=="showIssuedItemsPage"){echo "active";}?>" ><a  href="<?php echo base_url(); ?>NewBranch/showIssuedItemsPage"><i class="fa  fa-gear"></i> <span>Issue Item</span></a></li>
    <li class="<?php if($this->uri->segment(1)=="showStockRequestsPage"){echo "active";}?>" ><a  href="<?php echo base_url(); ?>NewBranch/showStockRequestsPage"><i class="fa  fa-gear"></i> <span>Request stock</span></a></li>
    <li class="<?php if($this->uri->segment(1)=="showBranchtoBranchPage"){echo "active";}?>" ><a  href="<?php echo base_url(); ?>NewBranch/showBranchtoBranchPage"><i class="fa  fa-gear"></i> <span>Branch to Branch</span></a></li>
    <li class="<?php if($this->uri->segment(1)=="showReturntoMasterPage"){echo "active";}?>" ><a  href="<?php echo base_url(); ?>NewBranch/showReturntoMasterPage"><i class="fa  fa-gear"></i> <span>Return stock</span></a></li>
    <li class="<?php if($this->uri->segment(1)=="showReturntoMasterPage"){echo "active";}?>" ><a  href="<?php echo base_url(); ?>NewBranch/showEmployeesPage"><i class="fa  fa-gear"></i> <span>Employees</span></a></li>
    <li class="<?php if($this->uri->segment(1)=="ShowTotalStock"){echo "active";}?>" ><a  href="<?php echo base_url(); ?>Common/ShowTotalStock"><i class="fa  fa-gear"></i> <span>New Total Stock</span></a></li>
</li> -->
    <li class="<?php if($this->uri->segment(1)=="showIssuedItemsPage"){echo "active";}?>" ><a  href="<?php echo base_url(); ?>NewBranch/showIssuedItemsPage"><i class="fa fa-sitemap"></i> <span>Issue Item</span></a></li>
    <li class="<?php if($this->uri->segment(1)=="showStockRequestsPage"){echo "active";}?>" ><a  href="<?php echo base_url(); ?>NewBranch/showStockRequestsPage"><i class="fa fa-cubes"></i> <span>Request stock</span></a></li>
    <li class="<?php if($this->uri->segment(1)=="showBranchtoBranchPage"){echo "active";}?>" ><a  href="<?php echo base_url(); ?>NewBranch/showBranchtoBranchPage"><i class="fa fa-exchange"></i> <span>Branch to Branch</span></a></li>
    <li class="<?php if($this->uri->segment(1)=="showReturntoMasterPage"){echo "active";}?>" ><a  href="<?php echo base_url(); ?>NewBranch/showReturntoMasterPage"><i class="fa fa-refresh"></i> <span>Return stock</span></a></li>
    <li class="<?php if($this->uri->segment(1)=="showReturntoMasterPage"){echo "active";}?>" ><a  href="<?php echo base_url(); ?>NewBranch/showEmployeesPage"><i class="fa fa-users"></i> <span>Employees</span></a></li>
    <!-- <li class="<?php if($this->uri->segment(1)=="ShowTotalStock"){echo "active";}?>" ><a  href="<?php echo base_url(); ?>Common/ShowTotalStock"><i class="fa fa-archive"></i> <span>New Total Stock</span></a></li> -->
    <li class="<?php if($this->uri->segment(1)=="showStockDetails"){echo "active";}?>" ><a  href="<?php echo base_url(); ?>NewBranch/showStockDetails"><i class="fa fa-archive"></i> <span>Stock Details</span></a></li>
    <li class="<?php if($this->uri->segment(1)=="Change Password"){echo "active";}?>" ><a  href="<?php echo base_url(); ?>NewBranch/changeAccountPassword"><i class="fa fa-user-o"></i> <span>Change Password</span></a></li>
<!-- ###################################################################################################################### -->


<?php } ?>
</ul>
<!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>
