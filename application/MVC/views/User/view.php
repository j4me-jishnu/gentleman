

 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Admin Details 
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        
        <li class="active">Admin Details</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="box">
            <div class="box-header">
            <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response');?>" />
              <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
              <div class="col-md-11"><center><h2 class="box-title">Details of <span class="label label-success"><b><?php if(isset($admin_data->shop_name)) echo $admin_data->shop_name ?> </b></span> </center></h2> </div>
              <div class="row">
                  
                  <div class="col-md-12"><br></div>
                  
                  <div class="col-md-12">
                    <div class="col-md-3"></div>
                    <div class="col-md-2"><span style="font-size:16px;"><b>Shop Name : </b></span></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-4"><span style="font-size:16px;"><b><?php if(isset($admin_data->shop_name)) echo $admin_data->shop_name ?></b></span></div>
                  </div>
                  
                  <div class="col-md-12"><br></div>
                  
                  <div class="col-md-12">
                    <div class="col-md-3"></div>
                    <div class="col-md-2"><span style="font-size:16px;"><b>Shop Address : </b></span></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-4"><span style="font-size:16px;"><b><?php if(isset($admin_data->shop_address)) echo $admin_data->shop_address ?></b></span></div>
                  </div>
                  
                  <div class="col-md-12"><br></div>
                  
                  <div class="col-md-12">
                    <div class="col-md-3"></div>
                    <div class="col-md-2"><span style="font-size:16px;"><b>Tin No. : </b></span></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-4"><span style="font-size:16px;"><b><?php if(isset($admin_data->tin_no)) echo $admin_data->tin_no ?></b></span></div>
                  </div>
                  
                  <div class="col-md-12"><br></div>
                  
                  <div class="col-md-12">
                    <div class="col-md-3"></div>
                    <div class="col-md-2"><span style="font-size:16px;"><b>Phone No. : </b></span></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-4"><span style="font-size:16px;"><b><?php if(isset($admin_data->phone_no)) echo $admin_data->phone_no ?></b></span></div>
                  </div>
                  
                  <div class="col-md-12"><br></div>
                  
                   <div class="col-md-12">
                    <div class="col-md-3"></div>
                    <div class="col-md-2"><span style="font-size:16px;"><b>User Name : </b></span></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-4"><span style="font-size:16px;"><b><?php if(isset($admin_data->user_name)) echo $admin_data->user_name ?></b></span></div>
                  </div>
                  
                  <div class="col-md-12"><br></div>
                  
                  <div class="col-md-12">
                    <div class="col-md-3"></div>
                    <div class="col-md-2"><span style="font-size:16px;"><b>Password : </b></span></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-4"><span style="font-size:16px;"><b><?php if(isset($admin_data->admin_password)) echo $admin_data->admin_password ?></b></span></div>
                  </div>
                  
                  <div class="col-md-12"><br></div>
                  
                   <div class="col-md-12">
                    <div class="col-md-3"></div>
                    <div class="col-md-2"><span style="font-size:16px;"><b>Mali Id : </b></span></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-4"><span style="font-size:16px;"><b><?php if(isset($admin_data->admin_email)) echo $admin_data->admin_email ?></b></span></div>
                  </div>
                  
                  <div class="col-md-12"><br></div>
                  
                  <div class="col-md-12">
                    <div class="col-md-3"></div>
                    <div class="col-md-2"><span style="font-size:16px;"><b>Created Date : </b></span></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-4"><span style="font-size:16px;"><b><?php if(isset($admin_data->created_date)) echo $admin_data->created_date ?></b></span></div>
                  </div>
                  
                  <div class="col-md-12"><br></div>
                  
                  <div class="col-md-12">
                    <div class="col-md-3"></div>
                    <div class="col-md-2"><span style="font-size:16px;"><b>Updated Date : </b></span></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-4"><span style="font-size:16px;"><b><?php if(isset($admin_data->updated_date)) echo $admin_data->updated_date ?></b></span></div>
                  </div>
                  
                  <div class="col-md-12"><br></div>
                  
                 
                  <div class="col-md-12">
                    <div class="col-md-3"></div>
                    <div class="col-md-2"><a href="<?php echo base_url();?>index.php/dashboard/"><botton class="btn btn-default">Back to dashboard</botton></a></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-2"><botton onclick="return confirmUpdate('<?php echo $admin_data->id ?>')"  class="btn btn-danger">Edit Details</botton></div>
                  </div>
              </div>
              
              
              
            </div>
           
          </div>
          <!-- /.box -->
          <div id="EditUser" class="modal fade" role="dialog">
                <div class="modal-dialog">
                        <div class="modal-content">
                                <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Edit User details</h4></div>
                                <form>
                                <div class="form-group clearfix">
                                    <div class="col-md-3">
                                    <label for="exampleInputEmail1">Shop name</label>
                                    </div>

                                    <div class="col-md-6">
                                    <input type="text" data-pms-required="true" class="form-control" id="Shop_name" placeholder="Product Name" >
                                    <input type="hidden"  class="form-control" id="Id">
                                    </div>
                                    
                                </div>
                            
                                <div class="form-group clearfix">
                                    <div class="col-md-3">
                                    <label for="exampleInputEmail1">Address</label>
                                    </div>

                                    <div class="col-md-6">
                                        <textarea id="Address" class="form-control"></textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group clearfix">
                                    <div class="col-md-3">
                                    <label for="exampleInputEmail1">Tin No.</label>
                                    </div>

                                    <div class="col-md-6">
                                    <input type="text" data-pms-required="true"  class="form-control" id="Tin_no" placeholder="Category" >
                                    </div>
                                </div>
                                
                                <div class="form-group clearfix">
                                    <div class="col-md-3">
                                    <label for="exampleInputEmail1">Phone No.: </label>
                                    </div>

                                    <div class="col-md-6">
                                    <input type="text" data-pms-required="true" data-pms-type="digitsOnly"  class="form-control" id="Phone_number" placeholder="Category" >
                                    </div>
                                </div>
                            
                                 <div class="form-group clearfix">
                                    <div class="col-md-3">
                                    <label for="exampleInputEmail1">Mail Id: </label>
                                    </div>

                                    <div class="col-md-6">
                                    <input type="text" data-pms-type="email"  class="form-control" id="Admin_email" placeholder="Category" >
                                    </div>
                                </div>
                            
                                <div class="form-group clearfix">
                                    <div class="col-md-3">
                                    <label for="exampleInputEmail1">User Name</label>
                                    </div>

                                    <div class="col-md-6">
                                    <input type="text"  class="form-control" id="User_name" placeholder="Category" >
                                    </div>
                                </div>
                                
                            <div class="form-group clearfix">
                                    <div class="col-md-3">
                                    <label for="exampleInputEmail1">Password : </label>
                                    </div>

                                    <div class="col-md-6">
                                        <input type="password"  class="form-control" id="Password" placeholder="Category" >
                                    </div>
                                </div>
                                
                        <div class="modal-footer">

                        <button type="button"  onclick="EditUser()" class="btn btn-primary option" data-dismiss="modal">OK</button>
                        </div>
                        </form>

                        </div>
                </div>
            </div>
         
     </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->






