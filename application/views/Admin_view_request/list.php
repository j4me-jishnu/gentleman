<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Branch request for stock approval
      <!-- <small>Optional description</small> -->
    </h1>
    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"> -->
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

        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table id="requesttable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Slno</th>
                <th>Request From</th>
                <th>Item</th>
                <th>Request Date</th>
                <th>Request quantity</th>
                <th>Edit</th>
                <th>Action</th>
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

<!-- Modal -->

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <form class="" action="<?php echo base_url(); ?>Admin_view_Request/adminUpdateBranchRequestQuantity" method="post">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalCenterTitle">Edit Requested quantity</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" class="form-group" id="req_id" name="request_id" value="">
          Quantity
          <input type="text" class="form-group" id="req_quantity" name="new_quantity" value="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Confirm changes</button>
        </div>
      </div>
    </form>
  </div>
</div>
<input type="text" name="req_id" id="req_id">
<div class="modal" tabindex="-1" id="myModal">
  <form class="" onsubmit="modal_submit()" method="post">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Reject request</h5>
        </div>
        <div class="modal-body">
          <label for="">Reason</label>
          <input id="reject_reason" type="text" name="reject_reason" value="" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </form>
</div>

