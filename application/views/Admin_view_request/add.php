<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Return item
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Item return Form</li>
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
              <h3 class="box-title pull-right"><span style="display: none;" id="available">Available balance:<span id="avail"></span></span></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="<?php echo base_url();?>Admin_view_Request/add">
              <!-- radio -->
               <div class="form-group">
			   <input type="hidden" name="request_id" value="<?php echo $record[0]->request_id; ?>"/>
                <?php echo validation_errors(); ?>
                 <label for="inputEmail3" class="col-sm-2 control-label"></label>
                </div>
				<div class="box-body">
					<div class="form-group">
					
					  <label for="size_name" class="col-sm-1 control-label">ItemName<span style="color:red">*</span></label>

					  <div class="col-sm-2">
						<select id="itemid"  name="itemid"  data-pms-type="alphanumericsOnly" class="form-control pull-right select2" >
              <?php
              foreach($items as $item){

              ?>
              <option <?php if ($item->item_name == $record[0]->item_name) { echo 'selected';} ?> value="<?php echo $item->item_id; ?>"><?php echo $item->item_name; ?></option>
              <?php
              }
              ?>
						<!-- <option value=""><?php echo $record[0]->item_name; ?></option> -->
							
						</select>
           
					  </div>
					  
					  <label for="size_name" class="col-sm-1 control-label">Quantity<span style="color:red">*</span></label>

					  <div class="col-sm-2">
						<input type="text" data-pms-required="true"  class="form-control" id="quantity" name="quantity" placeholder="Quantity" value="<?php echo $record[0]->request_quantity; ?>" >
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