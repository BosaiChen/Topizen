<?php
/**
*  @FILE_NAME : content.php
*  @APPLICATION : www.topizen.com
*  @VERSION: 1.0
*  @CREATED_DATE: May 1, 2011
*  @AUTHOR: Sungjun Ma
*  @CONTACT: firegun17@gmail.com
*  @BRIEF_FILE_DESCRIPTION: descriptions here...
*
* Module Operations:
* ==================
* This module blah blah...
*
* Public Interface Usage:
* =================
*
* Maintenance History:
* ====================
* ver 1.0 : May 1, 2011
* - first release
*/?>
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
<title>Topizen</title>
<meta name="description" content="Topizen help discover option leaders!" />
<!--[if IE]><link rel="stylesheet" href="includes/css/IE/ie.css" type="text/css" media="screen, projection" /><![endif]-->
<link rel="stylesheet" href="<?php echo base_url();?>includes/css/reset.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>includes/css/homepage/homepage.css" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>includes/jscript/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>includes/jscript/plugin/marquee/jquery.marquee.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>includes/jscript/homepage/homepage.js"></script>
</head>
<body>
	<div id="hp_wrap">
		<div class="hp-logo">
			<img src="/includes/images/hp_text.png" />
		</div>
		
		<section class="hp-login-box">
			<form id="login_form"  method="post" action="/index.php/user/log_in">
				<ul class="clearfix">
					<li>
						<label for="email">email</label> 
						<input type="text" id="email" class="login-input" name="email" placeholder="yourname@example.com" />
					</li>
					<li>
						<label for="password">password</label> 
						<input type="password" id="password" class="login-input" name="password" />
					</li>
					<li>
						<input type="button" id="button_login" class="login-btn" value="login" />
					</li>
				</ul>
				<input id="remember_me" name="remember" type="checkbox"/>
				<label for="remember_me" class="rmb-me-txt">Remember me</label>
				<a href="/index.php/user_c/show_get_pwd_page" class="forget-pwd">Forget your password?</a>
			</form>
			<a href="/register" class="sign-up">
				Register
			</a>
		</section>
	</div>
</body>
</html>