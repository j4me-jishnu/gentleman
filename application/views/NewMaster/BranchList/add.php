<div class="content-wrapper">
    <section class="content-header">
        <h1>Branch Form</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>branch"><i class="fa fa-dashboard"></i> Back to View</a></li>
            <li class="active">Branch Form</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                    </div>
                    <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>NewMaster/addBranch">
                        <div class="box-body">
                            <div class="form-group">
                                <input type="hidden" name="branch_id" value="<?php if(isset($records[0]->branch_id)) echo $records[0]->branch_id; ?>">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Branch Name:<span style="color: red;">*</span></label>
                                    <input type="text" name="branch_name" class="form-control" id="name" placeholder="Enter Branch Name" value="<?php if(isset($records[0]->branch_name)) echo $records[0]->branch_name; ?>">
                                    <p style="color:red;"><?php echo validation_errors(); ?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="address" class="form-label">Branch Address:</label>
                                    <textarea name="branch_address" id="address" class="form-control" placeholder="Enter Branch Address"><?php if(isset($records[0]->branch_address)) echo $records[0]->branch_address; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Branch Phone Number:</label>
                                    <input type="tel" name="branch_phone" id="phone" class="form-control" placeholder="Enter Branch Phone Number" value="<?php if(isset($records[0]->branch_phone)) echo $records[0]->branch_phone; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Branch Email Id:</label>
                                    <input type="email" name="branch_email" id="email" class="form-control" placeholder="Enter Branch Email Id" value="<?php if(isset($records[0]->branch_email)) echo $records[0]->branch_email; ?>">
                                </div>
                            </div>
                            <button type="reset" class="btn btn-warning">CLEAR</button>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="submit" class="btn btn-primary">SAVE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>