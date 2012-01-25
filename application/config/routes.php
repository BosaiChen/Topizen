<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "welcome";
$route['404_override'] = '';

$route['register'] = 'user/show_register_page';
$route['regsuccess'] = 'user/show_register_success';
$route['regprofile'] = 'user/show_regprofile_page';
$route['regfollows'] = 'user/show_regfollows_page';
//do not change the order
$route['citizens/(:any)/(:any)'] = 'citizens/$2/$1';
$route['citizens/(:any)'] = 'citizens/my_topics/$1';

$route['topics/suggest'] = 'topic/add_topic_page';
$route['topics/(:any)/(:any)'] = 'topic/get_$2/$1';
$route['topics/(:any)'] = 'topic/get_begining/$1';

$route['explore'] = 'public_c/topics';
$route['explore/topics'] = 'public_c/topics';
$route['explore/upcoming'] = 'public_c/voting_topics';

$route['settings'] = 'settings/account';

$route['orginazor'] = 'organizor/show_topic_all_page';
$route['orginazor/new_topic'] = 'organizor/show_topic_add_page';
$route['orginazor/single_topic'] = 'organizor/show_topic_single_page';
$route['orginazor/suggestions'] = 'organizor/show_topic_voting_all_page';
/* End of file routes.php */
/* Location: ./application/config/routes.php */