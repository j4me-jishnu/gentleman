<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Request Details
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i>Home</a></li>
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
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
          <h4 class="modal-title">Add Reason</h4>
        </div>
         <form method="post" action="<?php echo base_url(); ?>Request_Br_to_br/updateToreject">

        <div class="modal-body">
         <div class="form-group">
         <input type="hidden" name="req_id" id="new_id" >
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
              <table id="requesttable" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>Slno</th>
                  <th>Issue From</th>
                  <th>Issue To</th>
                  <th>Item</th>
                  <th>Quantity</th>
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
