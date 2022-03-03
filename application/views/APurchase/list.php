<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Purchase Request
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Purchase Request</li>
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
          <?php $s = $this->session->userdata('designation');
          $u = $this->session->userdata('user_type');
          ?>
          <a href="<?php echo base_url();?>Vendor/add" class="btn btn-primary"><i class="fa fa-plus-square"></i> Add Vendors</a>

          <a href="<?php echo base_url();?>Apurchaserequest/add_new_purchase" class="btn btn-primary"><i class="fa fa-plus-square"></i> Purchase</a>
          <a href="<?php echo base_url();?>Apurchaserequest/add" class="btn btn-primary"><i class="fa fa-plus-square"></i> New Purchase</a>

        </div>



        <div style="display:none" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title">Add Reason</h4>
              </div>
              <form method="post" action="<?php echo base_url(); ?>Apurchaserequest/reject">

                <div class="modal-body">
                  <div class="form-group">
                    <input type="text" name="purchase_id" id="purchase_id" >
                    <input type="text" name="reference" id="reference" >
                    <textarea class="form-control" name="reason"></textarea>

                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->



        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <input type="hidden" id="designation" value="<?php echo $this->session->userdata('designation');?>" />
          <input type="hidden" value="<?php if(isset($is_head[0]->is_head)) echo $is_head[0]->is_head;?>" id="is_head"/>
          <table id="purchase_table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Slno</th>
                <th>Invoice No</th>
                <th>Reference No</th>
                <th>Vendor Name</th>
                <th>Date</th>
                <th>ItemCount</th>
                <th>Status</th>
                <th>view</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->




      <div id="reject" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" onclick="rejectmodalclose()" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Enter Narration</h4></div>

              <div class="form-group clearfix">
                <div class="col-md-2">
                  <label for="exampleInputEmail1">Narration</label>
                </div>

                <div class="col-md-5">
                  <textarea class="form-control" id="reject_narration"></textarea>
                  <input type="hidden" id="prid" />
                  <input type="hidden" id="refno" />
                </div>

              </div>

              <div class="modal-footer">
                <button type="button"  onclick="rejectok()" class="btn btn-primary option" data-dismiss="modal">OK</button>

              </div>
            </div>
          </div>
        </div>
        <div id="narration" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Rejection Details</h4>
              </div>
              <div class="form-group clearfix">
                <span id="owner"></span>
              </div>
              <div class="form-group clearfix">
                <span>Narration: <span id="desc"> </span></span>
              </div>
              <div class="modal-footer">
                <button type="button"  class="btn btn-primary option" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
