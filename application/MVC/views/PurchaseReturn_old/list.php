<?php $arReason = array(""=>'---Please Select---',1=>'Damage',2=>'Exchange',3=>'No use'); ?>

 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Purchase Returns
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>index.php/dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>index.php/PurchaseReturns/add"><i class="fa fa-dashboard"></i> Back To Add</a></li>
        <li class="active">Purchase Returns Details</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="input-group margin">
                             <div class="input-group-btn">
                                     <button type="button" class="btn btn-primary nohover">Invoice No.</button>
                             </div><!-- /btn-group -->
                             <input type="text" name="purchase_invoice_no" placeholder="Invoice No" id="invoice_number" class="form-control">
                     </div><!-- /input-group -->
            </div>
            <div class="col-md-3">
                <div class="input-group margin">
                             <div class="input-group-btn">
                                     <button type="button" class="btn btn-primary nohover">Product Name</button>
                             </div><!-- /btn-group -->
                             <input type="text" name="vendor_name" placeholder="Product Name" id="product_name" class="form-control">
                     </div><!-- /input-group -->
            </div>
            
            <div class="col-md-5">
                <div class="input-group margin">
                        <div class="input-group-btn">
                        <button type="button" class="btn btn-primary nohover">Date </button>
                        </div><!-- /btn-group -->
                        <input id="pmsDateStart" type="text" data-validation-optional="true" data-pms-max-date="today" data-pms-type="date" name="start_date" data-pms-date-to="pmsDateEnd" class="col-md-5 form-control" placeholder="dd/mm/yyyy" >
                        <span tabindex="-1" class="input-group-btn select-calendar date-range"><button type="button" tabindex="-1" class="btn btn-default"><i class=" fa fa-calendar"></i></button></span>

                        <input id="pmsDateEnd" type="text" data-validation-optional="true" data-pms-type="date" name="end_date" data-pms-date-from="pmsDateStart" class="col-md-5 form-control" placeholder="dd/mm/yyyy" >
                        <span tabindex="-1" class="input-group-btn select-calendar date-range"><button type="button" tabindex="-1" class="btn btn-default"><i class=" fa fa-calendar"></i></button></span>
                </div>
            </div>
            
            <div class="col-sm-3">
                <div class="input-group margin">
                             <div class="input-group-btn">
                                     <button type="button" class="btn btn-primary nohover">Type</button>
                             </div><!-- /btn-group -->
                             <select name ="type" id="return_reason" class="form-control">

                                     <?php foreach($arReason as $key => $value){
                                             ?>

                                     <option value="<?php echo $key; ?>"><?php  echo $value;?></option>

                                     <?php
                                     }
                                     ?>
                             </select>
                     </div><!-- /input-group -->
            </div>
            
            <div class="col-sm-1">
                <div class="input-group">
                        <button type="button" id="search" class="btn bg-orange btn-flat margin" onclick="<?php if(isset($values->mainhead_id))echo $values->mainhead_id;?>">Search</button>
                </div>
            </div>
            
            <div class="col-sm-1">
                    <div class="input-group">
                            <a href="<?php echo base_url();?>index.php/PurchaseReturns"><button class="btn bg-navy btn-flat margin" >Refresh</button></a>
                    </div>
            </div>
        </div>
        
    <div class="row">
        <div class="box">
            <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <div class="col-md-10"><h2 class="box-title">Purchase Returns Details</h2> </div>
		<div class="col-md-2">
                  <a href="<?php echo base_url();?>index.php/PurchaseReturns/add" class="btn btn-primary"><i class="fa fa-plus-square"></i> Add Returns</a>
		</div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="category_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Invoice No.</th>
                  <th>Product Name</th>
                  <th>Category</th>
                  <th>Sub Category</th>
                  <th>Size</th>
                  <th>Colour</th>
                  <th>Reason</th>
                  <th>Return Quantity</th>
                  <th>Date</th>
                  <th>Delete</th>
                  
                  <th></th>
                  
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






