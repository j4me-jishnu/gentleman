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
			  <?php $s = $this->session->userdata('designation'); if($s==6 || $s==0){?>
				<div class="col-md-2">
                  <a href="<?php echo base_url();?>purchaserequest/add" class="btn btn-primary"><i class="fa fa-plus-square"></i> New Purchase</a>
				</div>
			  <?php } ?>
			</div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
			<input type="hidden" id="designation" value="<?php echo $this->session->userdata('designation');?>" />
			<input type="hidden" value="<?php if(isset($is_head[0]->is_head)) echo $is_head[0]->is_head;?>" id="is_head"/>
              <table id="purchase_table" class="table table-bordered table-striped">
                <thead>
                <tr>
				        <th>Slno</th>
                  <th>Reference No</th>
                  <th>Date</th>
                  <th>ItemCount</th>
                  <th>Remark</th>
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
										<input type="hidden" id="brid" />
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






