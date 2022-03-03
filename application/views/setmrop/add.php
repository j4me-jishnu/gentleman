<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Reorder Details
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Reorder Details</li>
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
            <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Setmrop/add">
              <!-- radio -->
               <div class="form-group">
			   <input type="hidden" name="branch_id" value="<?php if(isset($records->branch_id)) echo $records->branch_id ?>"/>
                <?php echo validation_errors(); ?>
                 <label for="inputEmail3" class="col-sm-2 control-label"></label>
                </div>
				<div class="box-body">
					<div class="form-group">
					  <label for="size_name" class="col-sm-2 control-label">Itemname<span style="color:red">*</span></label>

					  <div class="col-sm-2">
<select id="item_id"  name="item_id" data-pms-required="true" data-pms-type="alphanumericsOnly" class="form-control pull-right select2" >
<option value="">----Please Select----</option>

<?php
if(isset($a)){
foreach($item as $it){

?>
<option  value="<?php echo $it->item_id?>"><?php echo $it->item_name ?></option>
<?php
}
}
else{
  echo '<option value="'.$item[0]->item_id_fk.'" selected>'.$item[0]->item_name.'</option>';
}
?>
</select>

</div>
					  <label for="description" class="col-sm-1 control-label"></label>
						<div class="col-sm-3">
						
					    </div>
					  <label for="size_name" class="col-sm-1 control-label">Rop<span style="color:red">*</span></label>

					  <div class="col-sm-2">
						<input type="text" data-pms-required="true"  class="form-control" name="item_rop" placeholder="Reorderpoint"  value="<?php if(isset($records->item_rop)) echo $records->item_rop ?>">
					  </div>
					</div>
                </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="reset" class="btn ">Cancel</button>
				<button type="submit" class="btn btn-info pull-right">Next</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
          
        </div>
        <!--/.col (right) -->
     </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->






