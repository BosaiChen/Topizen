<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html>
	<head>
      <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
      <?php
	 	header ( "Cache-Control: no-store, no-cache, must-revalidate" );
	 	header ( "Cache-Control: post-check=0, pre-check=0", false );
	 	header ( "Pragma: no-cache" );
	 	header ( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
	 	header ( "Last-Modified: " . gmdate ( "D, d M Y H:i:s" ) . " GMT" ); 
	  ?>
      <title>{title}</title>
        <!--[if IE]><link rel="stylesheet" href="<?php echo base_url();?>includes/css/IE/ie.css" type="text/css" media="screen, projection" /><![endif]-->
		<link rel="stylesheet" href="<?php echo base_url();?>includes/css/reset.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url();?>includes/css/jquery-ui-1.8.14.custom.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url();?>includes/css/global.css" type="text/css" />
		<?php if(isset($css_external_links)):?>
			<?php foreach($css_external_links as $path){?>
				<link rel="stylesheet" href="<?=base_url().$path?>" type="text/css" />
			<?php }?>
		<?php endif;?>
		<!--[if IE 7]>
			<link rel="stylesheet" href="<?php echo base_url();?>includes/css/IE/ie7.css" type="text/css" />
		<![endif]-->
		<!--[if IE 8]>
			<link rel="stylesheet" href="<?php echo base_url();?>includes/css/IE/ie.css" type="text/css" />
		<![endif]-->
    </head>
	<body>
	{header}
	{content}
	<div id="footer">{footer}</div>
	
	
	<?php if(isset($global_jscript_external_links)):?>
		<?php foreach($global_jscript_external_links as $path){?>
			<script src="<?=base_url().$path?>" type="text/javascript" charset="utf-8"></script>
		<?php }?>
	<?php endif;?>
	
	<?php if(isset($jscript_constants_init)){
		echo $jscript_constants_init;		
	}?>
	
	<?php if(isset($jscript_external_links)):?>
		<?php foreach($jscript_external_links as $path){?>
			<script src="<?=base_url().$path?>" type="text/javascript" charset="utf-8"></script>
		<?php }?>
	<?php endif;?>
	
	
</body>
</html>
