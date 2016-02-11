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

$route['default_controller'] = "users";
$route['404_override'] = '';
$route['login_view'] = '/users/login_view';
$route['regis_view'] = '/users/regis_view';
$route['admin_edit_view/(:any)'] = '/users/admin_edit_view/$1';
$route['removie_view'] = '/users/remove_view';
$route['logoff_act'] = '/users/logoff_act';
$route['addnew_view'] = '/users/addnew_view';
$route['user_edit_view/(:any)'] = '/users/user_edit_view/$1';
$route['remove_act/(:any)'] = '/users/remove_act/$1';
$route['messages'] = 'messages';
$route['messages/show/(:any)'] = '/messages/show/$1';
$route['message/add_msg'] = '/messages/addmsg_act';


/* End of file routes.php */
/* Location: ./application/config/routes.php */