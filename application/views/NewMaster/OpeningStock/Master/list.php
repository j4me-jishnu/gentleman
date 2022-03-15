<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Master Opening Stock Details
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url();?>designation/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
      <li class="active">Master Opening Stock Details</li>
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
          <div class="col-md-2">
            <?php
            if($this->session->flashdata('message')!=NULL){
              echo '<script>swal("'.$this->session->flashdata('message').'", "", "'.$this->session->flashdata('type').'");</script>';
            }
            ?>
            <!-- <button type="button" class="btn btn-success" name="button" data-toggle="modal" data-target="#addItem">Add New Item</button> -->
            <button type="button" class="btn btn-success" name="button" data-toggle="modal" data-target="#addItem">Add Opening Stock</button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table id="designation_table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Slno</th>
                <th>Item Name</th>
                <th>Category Name</th>
                <th>Opening Stock</th>
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


<div class="modal fade" id="addItem" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Opening stock</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  action="<?php echo base_url() ?>NewMaster/addNewOpeningStock" method="post">
          <div class="form-group">
            <label for="cate_id" class="form-label">Branch</label>
            <select name="branch_id" class="form-control" id="branch_id" required>
              <option value="">SELECT BRANCH</option>
              <?php foreach($branch_list as $item){ ?>
                <option value="<?php echo $item->branch_id ?>"><?php echo $item->branch_name ?></option>
              <?php } ?>
            </select>
          </div><br>
          <div class="form-group">
            <label for="cate_id" class="form-label">ITEM</label>
            <select name="item_id" class="form-control" id="item_id" required>
              <option value="">SELECT ITEM</option>
              <?php foreach($item_list as $item){ ?>
                <option value="<?php echo $item->item_id ?>"><?php echo $item->item_name ?></option>
              <?php } ?>
            </select>
          </div><br>
          <div class="form-group">
            <label for="inputEmail" class="col-sm-4 col-form-label">Opening Stock</label>
            <input type="number" name="os_quantity" class="form-control" required>
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

</div>
</div>
</div>
