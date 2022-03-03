<?php $arTax = array(""=>'---Please Select---',1=>'Yes',2=>'No') ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Purchase Details Form
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>index.php/dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>index.php/Purchase/"><i class="fa fa-dashboard"></i> Back to List</a></li>
        <li class="active">Purchase Form</li>
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
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			<input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
            <form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/purchase/add">
              <!-- radio -->
               <div class="form-group">
			   <input type="hidden" name="purchase_id" value="<?php if(isset($records->purchase_id)) echo $records->purchase_id ?>"/>
			   <input type="hidden" name="old_quantity" value="<?php if(isset($records->product_purchase_quantity)) echo $records->product_purchase_quantity ?>"/>
			   <input type="hidden" name="old_product_id" value="<?php if(isset($records->product_id_fk)) echo $records->product_id_fk ?>"/>
			   <input type="hidden" name="old_total_amount" value="<?php if(isset($records->purchase_total_price)) echo $records->purchase_total_price ?>"/>
                           <input type="hidden" id="productname"/> 
                <?php echo validation_errors(); ?>
                 <label for="inputEmail3" class="col-sm-2 control-label"></label> 
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="product_name" class="col-sm-2 control-label">Vender Name</label>
                            <div class="col-sm-4">
                                    <input type="text" data-pms-required="true" name="vendor_name" id="customer_name" class="form-control" placeholder="Vendor Name" value="<?php if(isset($records->vendor_name)) echo $records->vendor_name ?>" />
                                    <input type="hidden" name="vendor_id_fk" id="vendor_id" class="form-control" value="<?php if(isset($records->vendor_id_fk)) echo $records->vendor_id_fk ?>"/>
                            </div>
                        <div class="pull-right">
                        <label for="product_name" class="col-sm-2 control-label ">Date: </label>
                            <div class="col-sm-7">
                                <input type="text" placeholder="Date" data-pms-required="true" class="form-control" name="purchase_date" id="date" value="<?php if(isset($records->purchase_date)) { echo $records->purchase_date;} else{ echo date('d/m/Y');} ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="purchase_quantity" class="col-sm-2 control-label">Address</label>

                      <div class="col-sm-4">
                          <textarea class="form-control" id="vendor_address" name="vendor_address"><?php if(isset($records->vendor_address)) echo $records->vendor_address ?></textarea>
                      </div> 
                    </div>
		
                    <div class="form-group">
                        <label for="sale_price" class="col-sm-2 control-label">Email Id</label>

                        <div class="col-sm-4">
                                <input type="text" data-pms-required="true" id="vender_mail" data-pms-type="email" class="form-control" name="vendor_email" placeholder="Email Id" value="<?php if(isset($records->vendor_email)) echo $records->vendor_email ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="sale_price" class="col-sm-2 control-label">Phone Number</label>

                        <div class="col-sm-4">
                                <input type="text" data-pms-required="true" id="vendor_phone" data-pms-type="digitsOnly" class="form-control" name="vendor_phone" placeholder="Phone Number" value="<?php if(isset($records->vendor_phone)) echo $records->vendor_phone ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sale_price" class="col-sm-2 control-label">Include Tax ?</label>

                        <div class="col-sm-2">
                                <select name ="tax_include" class="form-control" data-pms-required="true" id="include_tax"  data-pms-type="dropDown" >

                                    <?php foreach($arTax as $key => $value){

                                            $tax = isset($records->tax_include)?$records->tax_include:'';
                                            ?>

                                    <option value="<?php echo $key; ?>" <?php if($tax == $key) echo "selected=selected"?>><?php  echo $value;?></option>

                                    <?php }?>
                                </select>
                        </div>
                        <div class="col-sm-2">
                            <select name="tax_id_fk" data-pms-type="dropDown" style="display:none;" id="taxClass" class="form-control" >
                                        <?php
                                                foreach($tax_type as $taxtype){
                                                        $taxtypes = isset($records->tax_id_fk)?$records->tax_id_fk:'';
                                                        ?>
                                                <option value="<?php echo $taxtype->tax_id?>"<?php if($taxtypes == $taxtype->tax_id) echo "selected=selected"?>><?php echo $taxtype->tax_name ?></option>
                                                 <?php
                                                        }
                                        ?>
                            </select>
                            <input type="hidden" id="tax_amount">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="sale_price" class="col-sm-2 control-label">Tin No.</label>

                        <div class="col-sm-4">
                                <input type="text" data-pms-required="true" id="vendor_tin" class="form-control" name="vendor_tin" placeholder="Tin Number" value="<?php if(isset($records->vendor_tin)) echo $records->vendor_tin ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="sale_price" class="col-sm-2 control-label">Pan No.</label>

                        <div class="col-sm-4">
                                <input type="text" data-pms-required="true" id="vendor_pin" class="form-control" name="vendor_pin" placeholder="Pan Number" value="<?php if(isset($records->vendor_pan)) echo $records->vendor_pan ?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="sale_price" class="col-sm-2 control-label">Purchase Remarks</label>

                        <div class="col-sm-4">
                            <textarea name="purchase_remarks" class="form-control"></textarea>
                        </div>
                    </div>

                   <div class="box-body no-padding">
					<DIV id="product" class="box-body no-padding" ></div>
					<button class="btn btn-primary" type="button" style="margin-left:10%;" onClick="addMore();">New Purchase</button>
					<button class="btn btn-primary" type="button" style="margin-left:10%;" onClick="deleteRow();">Delete</button>
          <div class="NetTotalAmount pull-right" style="display: none;">
              <div class="pull-right" ><p><b>Sub Total : <input type="hidden" value="0" id="netAmount_hidden"/><span id="netAmount"></span></b></p></div><br>
              <div class="pull-right" ><p>Tax Amount(<span id="tax_class"></span>%) : <input type="hidden" value="0" id="netTax_hidden"/><span id="netTax"></span></p></div><br>
              <div class="pull-right" ><h3>Total : <b><input type="hidden" value="0" id="grand_total_hidden"/><span id="grand_total"></span><input type="hidden" name="grand_total" id="tax_total"/></b></h3></div>
        </div>
	</div>
                
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info">Next</button>
                <button type="reset" class="btn pull-right">Cancel</button>
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