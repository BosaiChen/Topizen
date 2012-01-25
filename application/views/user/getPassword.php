<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<?php
	 	header ( "Cache-Control: no-store, no-cache, must-revalidate" );
	 	header ( "Cache-Control: post-check=0, pre-check=0", false );
	 	header ( "Pragma: no-cache" );
	 	header ( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
	 	header ( "Last-Modified: " . gmdate ( "D, d M Y H:i:s" ) . " GMT" ); 
?>
<title>Topizen Reset password</title>
<!--[if IE]><link rel="stylesheet" href="includes/css/IE/ie.css" type="text/css" media="screen, projection" /><![endif]-->
<link rel="stylesheet" href="<?php echo base_url();?>includes/css/reset.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>includes/css/register_page/get_password_page.css" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>includes/jscript/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>includes/jscript/CONSTANT.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>includes/jscript/register_page/get_password.js"></script>
</head>
<body>
	<div id="pwd_wrap">
		<div id="logo">
			<a href="/index.php"><img src="/includes/images/hp_text.png" /></a>
		</div>
		<div id="reset_box">
			<label for="email">Email</label>
			<input id="email"  type="text" class="pwd-input" placeholder="yourname@example.com"/>
			<input id="reset_btn" type="button" class="pwd-btn" value="Reset" />
		</div>
		<div id="msg" style="display:none;">We have sent you email to reset your password.Please check it.</div>
	</div>
</body>
</html>