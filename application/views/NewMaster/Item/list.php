<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Item details
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>Iteem"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url();?>Item"><i class="fa fa-dashboard"></i> Back to Add</a></li>
      <li class="active">Item Details</li>
    </ol>
    <?php
    if($this->session->flashdata('message')!=NULL){
      echo '<script>swal("'.$this->session->flashdata('message').'", "", "'.$this->session->flashdata('type').'");</script>';
    }

     ?>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="box">
        <div class="box-header">
          <button type="button" class="btn btn-success" name="button" id="addItemBtn" onclick="showAddItemModal()">Add Item</button>
          <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
          <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
          <div class="col-md-8"><h2 class="box-title"></h2> </div>
          <div class="col-md-2">

          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table id="items_table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Slno</th>
                <th>Item name</th>
                <th>Category</th>
                <!-- <th>Action</th> -->
              </tr>
            </thead>
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


<div id="addItemModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Reject</h4>
      </div>
      <div class="modal-body">
        <form class="" action="<?php echo base_url() ?>NewMaster/addItem" method="post">
          <div class="form-group">
            <label for="item_name" class="form-label">Select Category</label>
            <select class="form-control" name="category">
              <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category->cate_id; ?>"><?php echo $category->cate_name; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="item_name" class="form-label">Item Name</label>
            <input type="text" class="form-control" name="item_name" id="item_name" required>
          </div>
          <div class="form-group">
            <label for="openingstock" class="form-label">Opening stock</label>
            <input type="number" class="form-control" name="opening_stock" id="openingstock">
          </div>
          <br>
          <div class="form-group">
            <input type="submit" name="submit" class="btn btn-success" value="Add">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
