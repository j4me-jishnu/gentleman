<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GENTLEMAN</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

  <link href='<?php echo base_url();?>assets/dist/css/jquery.noty.css' rel='stylesheet'>
        <link href='<?php echo base_url();?>assets/dist/css/noty_theme_default.css' rel='stylesheet'>

  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.css">

  <!-- Ionicons -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>assets/plugins/combogrid/css/smoothness/jquery-ui-1.10.1.custom.css"/>
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>assets/plugins/combogrid/css/smoothness/combogrid.css"/>
<!--  <link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />-->
	<link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datepicker/datepicker3.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/iCheck/all.css">
  <!-- Theme select2 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/select2/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
<!--  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.14/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.2/css/select.dataTables.min.css">-->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/skin-blue.min.css">
  <!--<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/editor.dataTables.min.css">-->
  <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/resources/syntax/shCore.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/resources/demo.css">
   HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
  <link href="http://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.css" rel="stylesheet" type="text/css">
  <link href="http://www.jqueryscript.net/demo/Sliding-Growl-Notification-Plugin-For-jQuery-jsnotify/dist/css/notify.css" rel="stylesheet"/>
  <link href="http://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <!-- ################################sweetAlert######################################## -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css"> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script> -->
  <script src="<?php echo base_url();?>assets/js/swal.min.js"></script>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/swal.min.css">

</head>

<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>GN</b>M</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">GENTLEMAN Chits</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only"></span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!--<li class="dropdown messages-menu">-->
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!--<i class="fa fa-envelope-o"></i>-->
              <span class="label label-success"></span>
            </a>

          <?php
            $u = $this->session->userdata('user_type');
            if (isset($branch_stock) && $u == 'A') {
              $i=0;
              foreach ($branch_stock as $bstock) {
                if($bstock->total < $bstock->item_rop) {
                  $i++;
                }
              }
              ?>

              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <?php if($i > 0) {
                  ?>
                    <span class="label label-warning"><?= $i ?></span>
                  <?php } ?>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have <?= $i ?> notifications</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">

                      <?php foreach ($branch_stock as $bstock) {
                        if($bstock->total <= 0) {
                      ?>
                        <li>
                          <a href="<?php echo base_url();?>Branchstock">
                            <i class="fa fa-warning text-yellow"></i>
                            <?php echo $bstock->branch_name ?>'s <?php echo $bstock->item_name ?> out of stock
                          </a>
                        </li>
                      <?php
                        }
                         if($bstock->total < $bstock->item_rop && $bstock->total !=0) {
                      ?>
                        <li>
                          <a href="<?php echo base_url();?>Branchstock">
                            <i class="fa fa-warning text-yellow"></i>
                            <?php echo $bstock->branch_name ?>'s <?php echo $bstock->item_name ?> stock reached below
                          </a>
                        </li>
                      <?php
                        }
                      }
                      ?>

                      <?php

                      if(isset($pending_purchase)){

                       foreach($pending_purchase as $row){

                      echo '<li>
                      <a href="'.base_url().'Apurchaserequest">
                        <i class="fa fa-warning text-yellow"></i>Purchase From'.
                          $row->vendorname
                        .' is pending for approval from   '.  $row->user_name.'</a>
                    </li>';

                      }

                    }

                      ?>

<?php

                      if(isset($rop)){

                       foreach($rop as $row){
                       if($row->total==$row->item_rop){
                      echo '<li>
                      <a href="'.base_url().'Branchstock">
                        <i class="fa fa-warning text-yellow"></i>'.
                          $row->item_name
                        .' at   '.  $row->branch_name.'reached ROP</a>
                    </li>';
                  }

                      }

                    }

                      ?>

                    </ul>
                  </li>
                </ul>
              </li>
          <?php
            }
          ?>
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
			       <span class="hidden-xs">Welcome: <?php echo $this->session->userdata('user_name')?></span>
              <!--<img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">-->
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              &nbsp;&nbsp;&nbsp;<span>Branch: <?php echo $this->session->userdata('user_branch'); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="<?php echo base_url();?>assets/dist/img/logo-logo.png" class="img-circle" alt="User Image">
			       	<h5><?php echo $this->session->userdata('user_email'); ?></h5>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                 <!--  <a href="<?php echo base_url();?>user" class="btn btn-default btn-flat">Profile</a> -->
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url();?>login/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <!--<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>-->
          </li>
        </ul>
      </div>
    </nav>
  </header>
