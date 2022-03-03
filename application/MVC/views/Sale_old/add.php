

 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sale Details Form
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>index.php/dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>index.php/Sale/"><i class="fa fa-dashboard"></i> Back to List</a></li>
        <li class="active">Sale Form</li>
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
            <form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/sale/add">
              <!-- radio -->
               <div class="form-group">
			   <input type="hidden" name="sale_id" value="<?php if(isset($records->sale_id)) echo $records->sale_id ?>"/>
               <input type="hidden" name="old_quantity" value="<?php if(isset($records->sale_quantity)) echo $records->sale_quantity ?>"/>
			   <input type="hidden" name="old_total_amount" value="<?php if(isset($records->sale_total_price)) echo $records->sale_total_price ?>"/>
			   <input type="hidden" name="cust_details" value="<?php if(isset($getcustid[0]->cust_details)) echo $getcustid[0]->cust_details ?>"/>
                           <input type="hidden" id="productname"/>
                           <input type="hidden" id="checkquantity"/>
                           
                <?php echo validation_errors(); ?>
                 <label for="inputEmail3" class="col-sm-2 control-label"></label>
                    
                 
                </div>
				
                    <div class="form-group">
                        <label for="sale_remarks" class="col-sm-2 control-label">Date</label>
                        <div class="col-sm-3">
                            <input type="text" placeholder="Date" class="form-control" name="sale_date" id="date" value="<?php if(isset($records->sale_date)) { echo $records->sale_date;} else{ echo date('d/m/Y');} ?>">
                        </div>
                        
                    </div>
                   
                    <div class="form-group">
                        <input type="hidden" id="tax_amount">
                        <label for="sale_remarks" class="col-sm-2 control-label">Tax Type</label>
                            <div class="col-sm-3">
                                <select name="tax_id_fk" autofocus data-pms-required="true" id="tax_type" class="form-control pull-right" >
                                        <?php
                                                foreach($tax_type as $taxtype){
                                                        $taxtypes = isset($records->tax_id_fk)?$records->tax_id_fk:'';
                                                        ?>
                                                <option value="<?php echo $taxtype->tax_id?>"<?php if($taxtypes == $taxtype->tax_id) echo "selected=selected"?>><?php echo $taxtype->tax_name ?></option>
                                                 <?php
                                                        }
                                        ?>
                                </select>
                            </div>
                </div>
              
                <div class="form-group">
                   <label for="sale_remarks" class="col-sm-2 control-label">Remarks : </label>
                   <div class="col-sm-3">
                       <textarea class="form-control" name="sale_remarks" ></textarea>
                    </div>
                </div>
			
                
				
				<div class="box-body no-padding">
					<DIV id="product" class="box-body no-padding" ></div>
					<button class="btn btn-primary" type="button" style="margin-left:10%;" onClick="addMore();">New Sale</button>
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






