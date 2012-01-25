<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['db_table_prefix']	= '';
$config['upload_path'] = 'http://localhost/Topizen/includes/uploads/';
$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
$config['max_size']	= '100';//size in kb
$config['max_width']  = '30';
$config['max_height']  = '30';

//for all topics tab
$config['topic_list_start']=0;
$config['topic_list_more']=1;

//for upcoming topics tab
$config['voting_topic_list_start']=0;
$config['voting_topic_list_more']=1;


/*
 * -CSS files
 * */
//register-related page
$config['regfollows_page_css']=array(
	'includes/css/register_page/register_page.css'
);
$config['regprofile_page_css']=array(
	'includes/css/register_page/register_page.css'
);
//settings page
$config['settings_page_css']=array(
	'includes/jscript/plugin/jcrop/jquery.Jcrop.css',
	'includes/css/settings/settings.css'
);
//personal page
$config['citizen_page_css']=array(
	'includes/css/personal_page/personal_page.css'
);
//public page
$config['public_page_css']=array(
	'includes/css/public_page/public_page.css'
);
//topic page
$config['topic_page_css']=array(
	'includes/css/topic_page/topic_page.css'
);
$config['add_topic_page_css']=array(
	'includes/css/topic_page/suggest.css'
);
//orginazor page
$config['orgz_page_css']=array(
	'includes/css/orginazor/orgz_add_topic.css'
);
$config['orgz_all_topic_css']=array(
	'includes/css/orginazor/orgz_all_topic.css'
);
$config['orgz_single_topic_css']=array(
	'includes/css/orginazor/orgz_single_topic.css'
);
$config['orgz_topic_voting_all_css']=array(
	'includes/css/orginazor/orgz_topic_voting_all.css'
);

/*
 * Jscripts
 * */

/* global */
$config['global_jscript']=array(
	'includes/jscript/jquery-1.6.1.min.js',
	'includes/jscript/jquery-ui-1.8.14.custom.min.js',
	'includes/jscript/modernizr.custom.js',
	'includes/jscript/global/global.js'
);

/* page specific */
//regprofile page
$config['regprofile_page_jscript']=array(
	'includes/jscript/register_page/regprofile.js'
);
$config['regfollows_page_jscript']=array(
	'includes/jscript/register_page/regfollows.js'
);
//settings page
$config['settings_page_jscript']=array(
	'includes/jscript/settings/settings.js',
	'includes/jscript/plugin/jcrop/jquery.Jcrop.min.js'
);
//personal page
$config['citizen_page_jscript']=array(
	'includes/jscript/personal/personal.js'
);
//public page
$config['public_page_jscript']=array(
	'includes/jscript/plugin/slider/slides.min.jquery.js',
	'includes/jscript/plugin/jquery.tinysort.min.js',
	'includes/jscript/public/public.js'
);
//topic page
$config['topic_page_jscript']=array(
	'includes/jscript/plugin/xheditor/xheditor-1.1.8-en.min.js',
	'includes/jscript/topic/topic.js'
);
$config['add_topic_page_jscript']=array(
	'includes/jscript/topic/suggest.js'
);
//orginizor page
$config['orgz_page_jscript']=array(

);
$config['orgz_all_topic_jscript']=array(

);
$config['orgz_single_topic_jscript']=array(

);
$config['orgz_topic_voting_all_jscript']=array(

);






