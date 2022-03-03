<?php $arUser = array(""=>"---Select---",2=>"Supervisor",3=>"Accountant",4=>"employees"); ?>

 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Privilege Settings
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        
        <li><a href="<?php echo base_url();?>index.php/User/"><i class="fa fa-dashboard"></i> Back to List</a></li>
        <li class="active">User Privilege Settings</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">

          <!-- right column -->
        <div class="col-md-8">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/User/add">
              <!-- radio -->
                <div class="form-group">
					<input type="hidden" name="user_id" value="<?php if(isset($records->id)) echo $records->id ?>"/>
					
					<?php echo validation_errors(); ?>
					<label for="inputEmail3" class="col-sm-2 control-label"></label>
                </div>
            <div class="box-body">
                <div class="form-group">
                  <label for="product_name" class="col-sm-4 control-label">User Name <span style="color:red;"><b>*</b></span></label> 

                  <div class="col-sm-8">
                    <input type="text" data-pms-required="true" class="form-control" name="user_name" placeholder="User Name" value="<?php if(isset($records->user_name)) echo $records->user_name ?>">
                  </div>
		</div>
				
		<div class="form-group">
                    <label for="product_category"  class="col-sm-4 control-label">User Designation <span style="color:red;"><b>*</b></span></label>
                    <div class="col-sm-8">
                        <?php if(isset($records->id) && ($records->id) != null){ ?>
                        <input type="hidden" name="user_type" value="<?php if(isset($records->admin_type)) echo $records->admin_type ?>"
                        <span><b><?php foreach ($arUser as $key => $value) { $month = isset($records->admin_type)?$records->admin_type:'';?>
                        <?php if($month == $key) { echo $value; } ?>
                          
                      <?php } ?></b></span>
                        <?php } else {
                            ?>
                        
                        <select name ="user_type" data-pms-required="true" data-pms-type="dropDown"  class="form-control">

                            <?php foreach($arUser as $key => $value){
                                $month = isset($records->admin_type)?$records->admin_type:'';
                                    ?>

                            <option value="<?php echo $key; ?>" <?php if($month == $key) echo "selected=selected"?>><?php  echo $value;?></option>

                            <?php
                            }
                            ?>
                        </select>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group">
                  <label for="sale_amount" class="col-sm-4 control-label">Mail Id</label> 

                  <div class="col-sm-8">
                    <input type="text"  data-pms-type="email" class="form-control" name="admin_email" placeholder="Mail Id" value="<?php if(isset($records->admin_email)) echo $records->admin_email ?>">
                  </div>
		</div>
                
                <div class="form-group">
                  <label for="sale_amount" class="col-sm-4 control-label">Password</label> 

                  <div class="col-sm-8">
                    <input type="password" data-pms-required="true" class="form-control" name="admin_password" placeholder="password" value="<?php if(isset($records->admin_password)) echo $records->admin_password ?>">
                  </div>
		</div>
                
                <h3><center>User Privilege</center></h3>
                
                <div class="form-group">
                    <div class="col-sm-3">
                        <label for="measurement">Enquiry Details<span>  </span>  </label> 
                        <?php if(isset($records->enquiry_details) && ($records->enquiry_details)=="Y") {?>
                        <input type="checkbox" name="enquiry_details"  value="Y" checked/>
                        <?php }
                        else {?>
                        <input type="checkbox" name="enquiry_details" value="Y"/>
                        <?php } ?>
                    </div>
                    
                    <div class="col-sm-3">
                        <label for="measurement">Quotation Details<span>  </span>  </label> 
                        <?php if(isset($records->quotation_details) && ($records->quotation_details)=="Y") {?>
                        <input type="checkbox" name="quotation_details" value="Y" checked/>
                        <?php }
                        else {?>
                        <input type="checkbox" name="quotation_details" value="Y"/>
                        <?php } ?>
                    </div>
                    
                    <div class="col-sm-3">
                        <label for="measurement">Aproval Pending<span>  </span>  </label> 
                        <?php if(isset($records->aproval_pending) && ($records->aproval_pending)=="Y") {?>
                        <input type="checkbox" name="aproval_pending"  value="Y" checked/>
                        <?php }
                        else {?>
                        <input type="checkbox" name="aproval_pending" value="Y"/>
                        <?php } ?>
                    </div>
                    
                    <div class="col-sm-3">
                        <label for="measurement">Jobincoming<span>  </span>  </label> 
                        <?php if(isset($records->job_incoming) && ($records->job_incoming)=="Y") {?>
                        <input type="checkbox" name="job_incoming" value="Y" checked/>
                        <?php }
                        else {?>
                        <input type="checkbox" name="job_incoming" value="Y"/>
                        <?php } ?>
                    </div>
                </div>
                
                <div class="form-group">
                    
                    <div class="col-sm-3">
                        <label for="measurement">Job Production<span>  </span>  </label> 
                        <?php if(isset($records->job_production) && ($records->job_production)=="Y") {?>
                        <input type="checkbox" name="job_pending" value="Y" checked=""/>
                        <?php }
                        else {?>
                        <input type="checkbox" name="job_pending" value="Y"/>
                        <?php } ?>
                    </div>
                    <div class="col-sm-3">
                        <label for="measurement">Job Register<span>  </span>  </label>
                        <?php if(isset($records->job_register) && ($records->job_register)=="Y") {?>
                        <input type="checkbox" name="job_register" value="Y" checked/>
                        <?php }
                        else {?>
                        <input type="checkbox" name="job_register" value="Y"/>
                        <?php } ?>
                    </div>
                    
                    <div class="col-sm-3">
                        <label for="measurement">Pending Works<span>  </span>  </label>
                        <?php if(isset($records->pending_works) && ($records->pending_works)=="Y") {?>
                        <input type="checkbox" name="pending_works" value="Y" checked/>
                        <?php }
                        else {?>
                        <input type="checkbox" name="pending_works" value="Y"/>
                        <?php } ?>
                    </div>
                    <div class="col-sm-3">
                        <label for="measurement">Purchase Details<span>  </span>  </label> 
                        <?php if(isset($records->purchase_details) && ($records->purchase_details)=="Y") {?>
                        <input type="checkbox" name="purchase_details" value="Y" checked=""/>
                        <?php }
                        else {?>
                        <input type="checkbox" name="purchase_details" value="Y"/>
                        <?php } ?>
                    </div>
                </div>
                
                <div class="form-group">
                    
                    
                    <div class="col-sm-3">
                        <label for="measurement">Salary Details<span>  </span>  </label>
                        <?php if(isset($records->salary_details) && ($records->salary_details)=="Y") {?>
                        <input type="checkbox" name="salary_details" value="Y" checked/>
                        <?php }
                        else {?>
                        <input type="checkbox" name="salary_details" value="Y"/>
                        <?php } ?>
                    </div>
                    
                    <div class="col-sm-3">
                        <label for="measurement">Stock Details<span>  </span>  </label>
                        <?php if(isset($records->stock_details) && ($records->stock_details)=="Y") {?>
                        <input type="checkbox" name="stock_details" value="Y" checked/>
                        <?php }
                        else {?>
                        <input type="checkbox" name="stock_details" value="Y"/>
                        <?php } ?>
                    </div>
                    <div class="col-sm-3">
                        <label for="measurement">Accounting<span>  </span>  </label>
                        <?php if(isset($records->account) && ($records->account)=="Y") {?>
                        <input type="checkbox" name="account" value="Y" checked/>
                        <?php }
                        else {?>
                        <input type="checkbox" name="account" value="Y"/>
                        <?php } ?>
                    </div>
                    <div class="col-sm-3">
                        <label for="measurement">Reports Details<span>  </span>  </label>
                        <?php if(isset($records->reports) && ($records->reports)=="Y") {?>
                        <input type="checkbox" name="reports" value="Y" checked/>
                        <?php }
                        else {?>
                        <input type="checkbox" name="reports" value="Y"/>
                        <?php } ?>
                    </div>
                </div>
                
                <div class="form-group">
                    
                    
                    
                    <h3><center>Quotation Privilege</center></h3>
                        
                        
                        
                    
                    
                    <div class="col-sm-4">
                        <label for="measurement">Net Totoal<span>  </span>  </label>
                        <?php if(isset($records->nettotal_admin) && ($records->nettotal_admin)=="Y") {?>
                        <input type="checkbox" name="nettotal_admin" value="Y" checked/>
                        <?php }
                        else {?>
                        <input type="checkbox" name="nettotal_admin" value="Y"/>
                        <?php } ?>
                    </div>
                    <div class="col-sm-4">
                        <label for="measurement">Customer View<span>  </span>  </label>
                        <?php if(isset($records->customer_view) && ($records->customer_view)=="Y") {?>
                        <input type="checkbox" name="customer_view" value="Y" checked/>
                        <?php }
                        else {?>
                        <input type="checkbox" name="customer_view" value="Y"/>
                        <?php } ?>
                    </div>
                    <div class="col-sm-4">
                        <label for="measurement">Owner View<span>  </span>  </label>
                        <?php if(isset($records->owner_view) && ($records->owner_view)=="Y") {?>
                        <input type="checkbox" name="owner_view" value="Y" checked/>
                        <?php }
                        else {?>
                        <input type="checkbox" name="owner_view" value="Y"/>
                        <?php } ?>
                    </div>
                </div>
                
                
                <div class="form-group">
                  <label for="measurement" class="col-sm-2 control-label"></span></label> 

                  <div class="col-sm-3"><label>Add</label></div>
                  <div class="col-sm-3"><label>Edit</label></div>
                  <div class="col-sm-3"><label>Delete</label></div>
                </div>
		<div class="form-group">
                  <label for="measurement" class="col-sm-2 control-label">Enquiry</label> 

                  <div class="col-sm-3">
                    <?php if(isset($records->enquiry_add) && ($records->enquiry_add)=="Y") {?>
                    <input type="checkbox" name="enquiry_add" value="Y" checked/>
                    <?php }
                    else { ?>
                    <input type="checkbox" name="enquiry_add" value="Y" />
                    <?php } ?>
                  </div>
                  <div class="col-sm-3">
                    <?php if(isset($records->enquiry_edit) && ($records->enquiry_edit)=="Y") {?>
                    <input type="checkbox" name="enquiry_edit" value="Y" checked/>
                    <?php }
                    else { ?>
                    <input type="checkbox" name="enquiry_edit" value="Y"/>
                    <?php } ?>
                  </div>
                  <div class="col-sm-3">
                    <?php if(isset($records->enquiry_delete) && ($records->enquiry_delete)=="Y") {?>
                    <input type="checkbox" name="enquiry_delete" value="Y" checked/>
                    <?php } 
                    else { ?>
                    <input type="checkbox" name="enquiry_delete" value="Y"/>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="measurement" class="col-sm-2 control-label">Quotation</label> 

                  <div class="col-sm-3">
                    <?php if(isset($records->quotation_add) && ($records->quotation_add)=="Y") {?>
                    <input type="checkbox" name="quotation_add" value="Y" checked/>
                    <?php }
                    else { ?>
                    <input type="checkbox" name="quotation_add" value="Y"/>
                    <?php }?>
                  </div>
                  <div class="col-sm-3">
                     <?php if(isset($records->quotation_edit) && ($records->quotation_edit)=="Y") {?> 
                    <input type="checkbox" name="quotation_edit" value="Y" checked/>
                     <?php }
                     else { ?>
                    <input type="checkbox" name="quotation_edit" value="Y"/>
                    <?php } ?>
                  </div>
                  <div class="col-sm-3">
                       <?php if(isset($records->quotation_delete) && ($records->quotation_delete)=="Y") {?> 
                    <input type="checkbox" name="quotation_delete" value="Y" checked/>
                       <?php } 
                       else { ?>
                    <input type="checkbox" name="quotation_delete" value="Y"/>
                    <?php } ?>
                  </div>
                </div>
                
                 <div class="form-group">
                  <label for="measurement" class="col-sm-2 control-label">Product</label> 

                  <div class="col-sm-3">
                      <?php if(isset($records->product_add) && ($records->product_add)=="Y") {?> 
                    <input type="checkbox" name="product_add" value="Y" checked/>
                      <?php }
                      else { ?>
                    <input type="checkbox" name="product_add" value="Y"/>
                    <?php } ?>
                  </div>
                  <div class="col-sm-3">
                    <?php if(isset($records->product_edit) && ($records->product_edit)=="Y") {?>
                    <input type="checkbox" name="product_edit" value="Y" checked/>
                    <?php } 
                    else { ?>
                       <input type="checkbox" name="product_edit" value="Y"/>
                    <?php } ?>
                  </div>
                  <div class="col-sm-3">
                    <?php if(isset($records->product_delete) && ($records->product_delete)=="Y") {?>  
                    <input type="checkbox" name="product_delete" value="Y" checked/>
                    <?php } 
                    else { ?>
                    <input type="checkbox" name="product_delete" value="Y"/>
                    <?php } ?>
               
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="measurement" class="col-sm-2 control-label">Product Category</label> 

                  <div class="col-sm-3">
                        <?php if(isset($records->category_add) && ($records->category_add)=="Y") {?>  
                        <input type="checkbox" name="category_add" value="Y" checked/>
                        <?php } 
                        else { ?>
                            <input type="checkbox" name="category_add" value="Y"/>
                       <?php } ?>
                  </div>
                  <div class="col-sm-3">
                       <?php if(isset($records->category_edit) && ($records->category_edit)=="Y") {?> 
                    <input type="checkbox" name="category_edit" value="Y" checked/>
                       <?php }
                       else { ?>
                    <input type="checkbox" name="category_edit" value="Y"/>
                       <?php } ?>
                  </div>
                  <div class="col-sm-3">
                      <?php if(isset($records->category_delete) && ($records->category_delete)=="Y") {?> 
                    <input type="checkbox" name="category_delete" value="Y" checked/>
                      <?php } 
                      else { ?>
                    <input type="checkbox" name="category_delete" value="Y"/>
                      <?php } ?>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="measurement" class="col-sm-2 control-label">Vendors</label> 

                  <div class="col-sm-3">
                      <?php if(isset($records->vendor_add) && ($records->vendor_add)=="Y") {?> 
                    <input type="checkbox" name="vendor_add" value="Y" checked/>
                      <?php } 
                      else { ?>
                    <input type="checkbox" name="vendor_add" value="Y"/>
                      <?php } ?>
                  </div>
                  <div class="col-sm-3">
                       <?php if(isset($records->vendor_edit) && ($records->vendor_edit)=="Y") {?> 
                    <input type="checkbox" name="vendor_edit" value="Y" checked/>
                       <?php }
                       else { ?>
                    <input type="checkbox" name="vendor_edit" value="Y"/>
                       <?php } ?>
                  </div>
                  <div class="col-sm-3">
                      <?php if(isset($records->vendor_delete) && ($records->vendor_delete)=="Y") {?>
                    <input type="checkbox" name="vendor_delete" value="Y" checked/>
                      <?php }
                      else { ?>
                    <input type="checkbox" name="vendor_delete" value="Y"/>
                      <?php } ?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="measurement" class="col-sm-2 control-label">Purchase</label> 

                  <div class="col-sm-3">
                   <?php if(isset($records->purchase_add) && ($records->purchase_add)=="Y") {?>
                      <input type="checkbox" name="purchase_add" value="Y" checked/>
                   <?php } 
                   else { ?>
                    <input type="checkbox" name="purchase_add" value="Y"/>
                    <?php } ?>
                  </div>
                  <div class="col-sm-3">
                      <?php if(isset($records->purchase_edit) && ($records->purchase_edit)=="Y") {?>
                      <input type="checkbox" name="purchase_edit" value="Y" checked/>
                      <?php } 
                      else { ?>
                    <input type="checkbox" name="purchase_edit" value="Y"/>
                      <?php } ?>
                  </div>
                  <div class="col-sm-3">
                      <?php if(isset($records->purchase_delete) && ($records->purchase_delete)=="Y") {?>
                    <input type="checkbox" name="purchase_delete" value="Y" checked/>
                      <?php }
                      else { ?>
                    <input type="checkbox" name="purchase_delete" value="Y"/>
                      <?php } ?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="measurement" class="col-sm-2 control-label">Employee</label> 

                  <div class="col-sm-3">
                      <?php if(isset($records->employee_add) && ($records->employee_add)=="Y") {?>
                    <input type="checkbox" name="employee_add" value="Y" checked/>
                      <?php } 
                      else { ?>
                    <input type="checkbox" name="employee_add" value="Y"/>
                      <?php } ?>
                  </div>
                  <div class="col-sm-3">
                      <?php if(isset($records->employee_edit) && ($records->employee_edit)=="Y") {?>
                    <input type="checkbox" name="employee_edit" value="Y" checked/>
                      <?php } 
                      else { ?>
                    <input type="checkbox" name="employee_edit" value="Y"/>
                      <?php } ?>
                  </div>
                  <div class="col-sm-3">
                       <?php if(isset($records->employee_delete) && ($records->employee_delete)=="Y") {?>
                    <input type="checkbox" name="employee_delete" value="Y" checked/>
                       <?php }
                       else { ?> 
                        <input type="checkbox" name="employee_delete" value="Y"/>
                       <?php } ?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="measurement" class="col-sm-2 control-label">Salary</label> 

                  <div class="col-sm-3">
                   <?php if(isset($records->salary_add) && ($records->salary_add)=="Y") {?>
                    <input type="checkbox" name="salary_add" value="Y" checked/>
                   <?php } 
                   else { ?>
                    <input type="checkbox" name="salary_add" value="Y"/>
                   <?php } ?>
                  </div>
                  <div class="col-sm-3">
                    <?php if(isset($records->salary_edit) && ($records->salary_edit)=="Y") {?>
                    <input type="checkbox" name="salary_edit" value="Y" checked/>
                    <?php } 
                    else { ?>
                    <input type="checkbox" name="salary_edit" value="Y"/>
                    <?php } ?>
                  </div>
                  <div class="col-sm-3">
                      <?php if(isset($records->salary_delete) && ($records->salary_delete)=="Y") {?>
                    <input type="checkbox" name="salary_delete" value="Y" checked/>
                      <?php }
                      else { ?>
                    <input type="checkbox" name="salary_delete" value="Y"/>
                      <?php } ?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="measurement" class="col-sm-2 control-label">Sale</label> 

                  <div class="col-sm-3">
                      <?php if(isset($records->sale_add) && ($records->sale_add)=="Y") {?>
                    <input type="checkbox" name="sale_add" value="Y" checked/>
                      <?php } 
                      else { ?>
                          <input type="checkbox" name="sale_add" value="Y"/>
                      <?php } ?>
                  </div>
                  <div class="col-sm-3">
                      <?php if(isset($records->sale_edit) && ($records->sale_edit)=="Y") {?>
                    <input type="checkbox" name="sale_edit" value="Y" checked/>
                      <?php }
                      else { ?> 
                    <input type="checkbox" name="sale_edit" value="Y"/>
                      <?php } ?>
                  </div>
                  <div class="col-sm-3">
                      <?php if(isset($records->sale_delete) && ($records->sale_delete)=="Y") {?>
                    <input type="checkbox" name="sale_delete" value="Y" checked/>
                      <?php }
                      else { ?>
                    <input type="checkbox" name="sale_delete" value="Y"/>
                      <?php } ?>
                   
                  </div>
                </div>
                
                <div class="form-group">
                    <h3><center>REPORTS</center></h3>
                    
                    <div class="col-sm-3">
                        <label for="measurement">Customer Reports<span>  </span>  </label> 
                        <?php if(isset($records->customer_reports) && ($records->customer_reports)=="Y") {?>
                        <input type="checkbox" name="customer_reports" value="Y" checked=""/>
                        <?php }
                        else {?>
                        <input type="checkbox" name="customer_reports" value="Y"/>
                        <?php } ?>
                    </div>
                    <div class="col-sm-3">
                        <label for="measurement">Sale Reports<span>  </span>  </label>
                        <?php if(isset($records->sale_reports) && ($records->sale_reports)=="Y") {?>
                        <input type="checkbox" name="sale_reports" value="Y" checked/>
                        <?php }
                        else {?>
                        <input type="checkbox" name="sale_reports" value="Y"/>
                        <?php } ?>
                    </div>
                    
                    <div class="col-sm-3">
                        <label for="measurement">Purchase Reports<span>  </span>  </label>
                        <?php if(isset($records->purchase_reports) && ($records->purchase_reports)=="Y") {?>
                        <input type="checkbox" name="purchase_reports" value="Y" checked/>
                        <?php }
                        else {?>
                        <input type="checkbox" name="purchase_reports" value="Y"/>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group">
                    <h3><center>DUE DETAILS</center></h3>
                    
                    <div class="col-sm-6">
                        <label for="measurement">Customer Due<span>  </span>  </label> 
                        <?php if(isset($records->customer_due) && ($records->customer_due)=="Y") {?>
                        <input type="checkbox" name="customer_due" value="Y" checked=""/>
                        <?php }
                        else {?>
                        <input type="checkbox" name="customer_due" value="Y"/>
                        <?php } ?>
                    </div>
                    <div class="col-sm-6">
                        <label for="measurement">Purchase Due<span>  </span>  </label>
                        <?php if(isset($records->purchase_due) && ($records->purchase_due)=="Y") {?>
                        <input type="checkbox" name="purchase_due" value="Y" checked/>
                        <?php }
                        else {?>
                        <input type="checkbox" name="purchase_due" value="Y"/>
                        <?php } ?>
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






