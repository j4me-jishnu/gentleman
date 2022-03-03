<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Branch Details
            <!-- <small>Optional description</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>Branch/add"><i class="fa fa-dashboard"></i> Back to Add</a></li>
            <li class="active">Branch Details</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="box">
                <div class="box-header">
                    <input type="hidden" id="response" value="<?php echo $this->session->flashdata('response'); ?>" />
                    <!-- <h3 class="box-title">Data Table With Full Features</h3> -->
                    <div class="col-md-8">
                        <h2 class="box-title"></h2>
                    </div>
                    <div class="col-md-2">
                        <?php $u = $this->session->userdata('user_type');
                        if ($u == 'A') { ?>
                            <a href="<?php echo base_url(); ?>NewMaster/addBranch" class="btn btn-primary"><i class="fa fa-plus-square"></i> Add Branch</a>
                        <?php } ?>
                    </div>
                    <!-- <div class="btn-group">
                        <button type="button" class="btn btn-success">Action</button>
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
                            <li><a href="<?php echo base_url(); ?>branch">Branch</a></li>
                            <li><a href="<?php echo base_url(); ?>users">Users</a></li>
                            <li><a href="<?php echo base_url(); ?>designation">Designation</a></li>
                        </ul>
                    </div> -->
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="branch_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Slno</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Edit / Delete</th>
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