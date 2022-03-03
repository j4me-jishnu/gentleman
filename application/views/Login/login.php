<!DOCTYPE>
<html>

<head>    
<title>Gentleman | Welcome </title>
<link rel="stylesheet" href="<?php echo base_url();?>/assets/bootstrap/css/login_css/style.css">
</head>
<body>
    
<div class="login-page">
<div class="form">
<form class="login-form" method='post'>
<input type="text" name="username" placeholder="name" required="required" />
<span style="color:#b30000"><?php echo form_error('username'); ?></span>
<input type="password" name="password" placeholder="password" required="required"/>
<span style="color:#b30000"><?php echo form_error('password'); ?></span>
<button>login</button>
</form>
<br>Forgot Password? <a href="<?php echo site_url('login/forgot_pass'); ?>"><span class="btn ">Click Here</span></a>
</div>


</div>
<script src='<?php echo base_url();?>/assets/js/jquery.min.js'></script>
<script src="<?php echo base_url();?>/assets/js/login_js/index.js"></script>
<script>
$(function () {
$('input').iCheck({
checkboxClass: 'icheckbox_square-blue',
radioClass: 'iradio_square-blue',
increaseArea: '20%' // optional
});
});
</script>
		
</body>
</html>



