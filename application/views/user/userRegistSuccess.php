<?php
/**
*  @FILE_NAME : userRegistSuccess.php
*  @APPLICATION : www.topizen.com
*  @VERSION: 1.0
*  @CREATED_DATE: May 15, 2011
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
* ver 1.0 : May 15, 2011
* - first release
*/
?>
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
</head>
<body id="reg_page_success">
	<div id="reg_success_wrap">
		<div id="reg-sus-logo">
			<a href="/index.php"><img src="/includes/images/hp_text.png" /></a>
		</div>
		<div class="congr-txt">Congradulation</div>
		<div id="success_msg_box">
			<p>We have received your sign-up information!please check your email from <span class="blue">qlu03@syr.edu</span></p>
			<p>If you have not received your email for long time, click <a href="javascript:void(0);">re-send the email</a></p>
		</div>
	</div>
</body>
</html>