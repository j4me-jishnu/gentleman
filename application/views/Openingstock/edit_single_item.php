<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Opening stock edit
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">OpeningStock Details</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- right column -->
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title"></h3>
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal " method="POST" action="<?php echo base_url();?>Openigstock/updateOS">
            <table class="">
              <tr>
                <td>Hidden ID</td>
                <td> <input type="text" class="form-control" name="item_id" value="<?php echo $single_os_data->opening_id; ?>"> </td>
              </tr>
              <tr>
                <td>Item Name</td>
                <td> <input type="text" class="form-control" name="item_name" value="<?php echo $single_os_data->item_name; ?>"> </td>
              </tr>
              <tr>
                <td>Quantity</td>
                <td> <input type="text" class="form-control" name="item_quantity" value="<?php echo $single_os_data->item_quantity; ?>"> </td>
              </tr>
              <tr>
                <td>Date</td>
                <td> <input type="date" class="form-control" name="item_date" value="<?php echo $single_os_data->date; ?>"> </td>
              </tr>
              <tr>
                <td>Action</td>
                <td> <input type="submit" name="submit" value="Update"> </td>
              </tr>
              </table>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- Div to show opening stock history and edit it -->
      <!-- <div class='container '>
        <table id="OpeningStockHistory" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Item name</th>
              <th>Quantity</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div> -->

    </section>
    <!-- /.content -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </div>
