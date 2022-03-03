


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       <h1>Purchase Details</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Dash_board/"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo base_url();?>Apurchaserequest"><i class="fa fa-dashboard"></i> Back to List</a></li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">

          <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">



<div id="reject" class="">
<div class="modal-header">

<h4 class="modal-title">Enter Narration</h4></div>
<div class="col-md-2">
<label for="exampleInputEmail1" name="narration">Rejected by</label>
<input type="text"     class="form-control" name="Rejected" placeholder="Rejected by">
</div>
<div class="form-group clearfix">

<div class="col-md-2">
<label for="exampleInputEmail1" name="narration">Reason</label>
</div>

<div class="col-md-5">
<textarea class="form-control" id="reject_narration"></textarea>
<input type="hidden" id="prid" />
<input type="hidden" id="refno" />
</div>

</div>

<div class="modal-footer">

<button type="button"  id="rejected" class="btn btn-primary option" data-dismiss="modal">OK</button>

</div>
</div>


</section>
<!-- /.content -->
</div><!-- Content Wrapper. Contains page content -->

              <!-- /.box-footer -->

          </div>
          <!-- /.box -->

        </div>
        <!--/.col (right) -->
     </div>

    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->
