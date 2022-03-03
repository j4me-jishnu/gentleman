<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>

        Branch To Branch Requests

        <!-- <small>Optional description</small> -->

      </h1>

      <ol class="breadcrumb">

        <li><a href="<?php echo base_url();?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="<?php echo base_url();?>designation/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>

        <li class="active">Branch To Branch Details</li>

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

          <?php $u = $this->session->userdata('user_type');

           if($u == 'A'){ ?>

                  <!-- <a href="<?php echo base_url();?>NewMaster/addVendorList" class="btn btn-primary"><i class="fa fa-plus-square"></i>  Add Vendor</a> -->

                <?php } ?>

				</div>

            </div>

            <!-- /.box-header -->

            <div class="box-body table-responsive">

              <table id="designation_table" class="table table-bordered table-striped">

                <thead>

                <tr>

				  <th>Slno</th>

                  <th>Item Name</th>

                  <th>Branch Giving</th>

                  <th>Branch Recieving</th>

                  <th>Qty</th>

                  <th>Remark</th>

                  <th>Approval</th>

                  <th>Edit / Delete</th>

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





  <div id="updateApproval" class="modal fade" role="dialog">

  <div class="modal-dialog">



    <!-- Modal content-->

    <form action="<?php echo base_url() ?>NewMaster/rejectajaxb2b" method="POST">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Modal Header</h4>

      </div>

      <input type="hidden" name="b2b_id" value="" id="b2b_ides">

      <div class="modal-body">

        <div class="form-group">

            <label for="">REMARK</label>

            <!-- <input type="text" class="form-control" value="" placeholder="Enter Remark For Reject"> -->

            <textarea name="remarks" class="form-control" id="" cols="30" rows="5"></textarea>

        </div>

        <div class="form-group">

            <input type="submit" class="btn btn-danger" value="REJECT">

        </div>

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>

    </div>

    </form>

  </div>

</div>







