 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <!--<div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Anup</p>-->
          <!-- Status -->
          <!--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>-->

      <!-- search form (Optional) -->
      <!--<form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>-->
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <!--<li class="header"></li>-->
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="<?php echo base_url();?>index.php/dashboard/"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
       <!--<li class="active"><a href="<?php echo base_url();?>index.php/subcategory/"><i class="fa fa-link"></i> <span>Sub Category</span></a></li>-->
		<li><a href="<?php echo base_url();?>index.php/product/"><i class="fa fa-product-hunt"></i> <span>Product Details</span></a></li>
		<li><a href="<?php echo base_url();?>index.php/purchase/"><i class="glyphicon glyphicon-shopping-cart"></i> <span>Purchase Details</span></a></li>
		<li><a href="<?php echo base_url();?>index.php/sale/"><i class="fa fa-shopping-bag"></i> <span>Sale Details</span></a></li>
		<li><a href="<?php echo base_url();?>index.php/stock/"><i class="fa fa-cart-arrow-down"></i> <span>Stock Management </span></a></li>
        <li class="treeview">
          <a><i class="fa fa-gear"></i><span>Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu ">
            <li><a href="<?php echo base_url();?>index.php/category/" ><i class="fa fa-circle-o"></i>Category</a></li>
            <li><a href="<?php echo base_url();?>index.php/subcategory/"><i class="fa fa-circle-o"></i>Subcategory</a></li>
            <li><a href="<?php echo base_url();?>index.php/size/"><i class="fa fa-circle-o"></i>Size</a></li>
            <li><a href="<?php echo base_url();?>index.php/color/"><i class="fa fa-circle-o"></i>Colour</a></li>
            <li><a href="<?php echo base_url();?>index.php/Tax/"><i class="fa fa-circle-o"></i>Tax</a></li>
          </ul>
        </li>
		
		<li class="treeview">
          <a><i class="fa  fa-repeat"></i><span>Returns</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu ">
            <li><a href="<?php echo base_url();?>index.php/PurchaseReturns/" ><i class="fa fa-circle-o"></i>Purchase returns</a></li>
            <li><a href="<?php echo base_url();?>index.php/SaleReturn/"><i class="fa fa-circle-o"></i>Sale returns</a></li>
          </ul>
        </li>
		
		<li class="treeview">
          <a><i class="fa fa-line-chart"></i> <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url();?>index.php/SaleReport/"><i class="fa fa-circle-o"></i>Sale Reports</a></li>
            <li><a href="<?php echo base_url();?>index.php/PurchaseReport/"><i class="fa fa-circle-o"></i>Purchase Reports</a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>