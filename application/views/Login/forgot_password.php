<!DOCTYPE>
<html>
<head>    
<title>Gentleman | Welcome </title>
<link rel="stylesheet" href="<?php echo base_url();?>/assets/bootstrap/css/login_css/style.css">
</head>
<body>
<div class="login-page">
<div class="form">
<form method="post" action="" class="log">
<label>Enter your registered email:</label>
<p><input type="email" name="email" id="name" placeholder="Email ID" required/></p>    
<center><input type="submit" class="btn form-butn materialbtn" name="forgot_pass" value="Submit"></center>
</form>
</div>
<div class="text-center"  style="color: green;">
<h2 ><?php
echo $message; ?></h2>
</div>
<div class="text-center"  style="color: red;">
<h2 ><?php
echo @$error; ?></h2>
</div>
</div>
</div>
</div>
</div>
</div>
</div>