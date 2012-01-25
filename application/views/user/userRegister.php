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
<title>Join Topizen</title>
<!--[if IE]><link rel="stylesheet" href="includes/css/IE/ie.css" type="text/css" media="screen, projection" /><![endif]-->
<link rel="stylesheet" href="<?php echo base_url();?>includes/css/reset.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>includes/css/register_page/register_page.css" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>includes/jscript/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>includes/jscript/register_page/sign_up_page.js"></script>
</head>
<body>
	<div id="reg_page_wrap">
		<a href="/" class="logo"></a>
		<section>
			<form id="register" method="post" action="/index.php/user/register">
				<label for="email">Email</label>
				<input id="email" name="email" type="text"  placeholder="yourname@example.com"/>
				<label for="password">Password</label>
				<input id="password" name="password" type="password" class="reg-input" placeholder="Password"/>
				<input id="reg_save_btn_1" type="button" class="reg-btn" value="Sign Up" />
			</form>
		</section>
	</div>
</body>
</html>