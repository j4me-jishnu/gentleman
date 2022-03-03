<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit opening stock
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
          <form class="form-horizontal" method="POST" action="<?php echo base_url();?>openigstock/">
            <table>

              <tr>
                <!-- <td><h3> Branch name &nbsp&nbsp&nbsp</h3></td> -->
                <td> <select name="branch" id="branch" class="form-control">
                  <option value="">Choose branch name</option>
                  <option value="master">Master stock</option>
                  <?php foreach($branches as $branch) { ?>
                    <option value=<?php echo $branch['branch_id']; ?>><?php echo $branch['branch_name']; ?></option>
                  <?php } ?>
                </select> </td>
              </tr>
              <tr>
                <!-- <td><h3>Item Name   <h3></td> -->
                  <td> <select name="item_name" id="item_name" class="form-control">
                    <option value="">Select item</option>
                    <?php foreach($stock_items as $item) { ?>
                      <option value=<?php echo $item['item_id']; ?>><?php echo $item['item_name']; ?></option>
                    <?php } ?>
                  </select></td>
                </tr>
                <tr>
                  <td><h4>Current opening stock in hand</h4></td>
                  <td><h3>&nbsp;&nbsp;&nbsp;<span id="current_stock"></span></h3></td>
                </tr>
              </table>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- Div to show opening stock history and edit it -->
      <div class='container '>
        <table id="OpeningStockHistory" class="table table-bordered table-striped">
          <thead>
            <tr class="danger">
              <th>Item name</th>
              <th>Quantity</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>

    </section>
    <!-- /.content -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </div>
