<!DOCTYPE>
<html>

<head>    
    <title>Textiles | Welcome </title>
	<link rel="stylesheet" href="<?php echo base_url();?>/assets/bootstrap/css/login_css/style.css">
</head>
<body>
    
	<div class="login-page">
	  <div class="form">
		<form class="login-form" method='post'>
		  <input type="text" name="username" placeholder="name"/>
		  <span style="color:#b30000"><?php echo form_error('username'); ?></span>
		  <input type="password" name="password" placeholder="password"/>
		  <span style="color:#b30000"><?php echo form_error('password'); ?></span>
		  <button>login</button>
		  
		</form>
	  </div>
	</div>
	 <script src='<?php echo base_url();?>/assets/js/jquery.min.js'></script>

        <script src="<?php echo base_url();?>/assets/js/login_js/index.js"></script>
</body>
</html>



