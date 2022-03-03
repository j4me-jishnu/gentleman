<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Master Stock Details
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Stock Details</li>
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
      </div>

      <?php
          $u = $this->session->userdata('user_type');
          ?>
            <!-- /.box-header -->
            <div class="box-body table-responsive">

              <button type="button" class="btn btn-success" name="button" data-toggle="modal" data-target="#addItem">Add New Item</button>

              <button type="button" id="addstock" class="btn btn-success" name="button" data-toggle="modal" data-target="#addStock">Add stock</button>

              <table id="stocktable" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>Slno</th>
                  <th>Item</th>
                  <th>Total Stock</th>
                  <th>Mater Stock</th>
                  <th>Opening Stock</th>
                </tr>
               </thead>
               <?php foreach ($newmasterstock as $item_data): ?>
                 <tr>
                 <td><?php echo $item_data->stock_id; ?></td>
                 <td><?php echo $item_data->item_name; ?></td>
                 <td><?php echo $item_data->stock_quantity+$item_data->os_quantity; ?></td>
                 <td><?php echo $item_data->stock_quantity; ?></td>
                 <td><?php echo $item_data->os_quantity; ?></td>
               </tr>
               <?php endforeach; ?>
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



  <!-- Start add Item modal -->
  <div class="modal fade" id="addItem" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New Item</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <form class="" action="#" method="post">
            <div class="row mb-3">
              <!-- <label for="inputEmail" class="col-sm-4 col-form-label">Item Name</label> -->
              <div class="col-sm-8">
                <input type="text" placeholder="Enter new item name" name="" class="form-control" required>
              </div>
            </div><br>
            <div class="row mb-3">
              <!-- <label for="inputEmail" class="col-sm-4 col-form-label">Opening Stock Quantity</label> -->
              <div class="col-sm-8">
                <input type="text" placeholder="Opening stock" name="" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End add Item modal -->
  <!-- Start add Stock modal -->
  <div class="modal fade" id="addStock" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Stock to Existing Item</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <form class="" action="#" method="post">
            <div class="row mb-3">
              <!-- <label for="inputEmail" class="col-sm-4 col-form-label">Select Item</label> -->
              <div class="col-sm-8">
                <select class="form-control" id="mySelect" name="">
                  <option value="">Select Item</option>
                </select>
              </div>
            </div><br>
            <div class="row mb-3">
              <!-- <label for="inputEmail" class="col-sm-4 col-form-label">Item Name</label> -->
              <div class="col-sm-8">
                <input type="text" placeholder="Stock quantity"  class="form-control" required>
              </div>
            </div><br>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End add Stock modal -->
