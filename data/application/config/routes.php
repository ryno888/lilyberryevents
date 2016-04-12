<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//$route['default_controller'] = 'welcome';
//$route['404_override'] = '';
//$route['translate_uri_dashes'] = FALSE;
//$route['default_controller'] = '';

//index routes
$route['home'] = "index/home";
$route['main_page'] = "index/main_page";
$route['logout'] = "index/xlogout";
$route['login'] = "index/login";
$route['clear_error'] = "index/xclear_error";
$route['send_mail'] = "index/xsend_mail";
$route['stream_file'] = "index/xstream_file";

//album routes
$route['album_list'] = 'album/album_list';
$route['add_album'] = 'album/add_album';
$route['edit_album'] = 'album/edit_album';
$route['album_modal'] = 'album/album_modal';
$route['xadd_album'] = 'album/xadd_album';
$route['xedit_album'] = 'album/xedit_album';
$route['xdelete_album'] = 'album/xdelete_album';
$route['xdelete_image'] = 'album/xdelete_image';
$route['xset_main_image'] = 'album/xset_main_image';


//request routes
$route['request_list'] = 'request/request_list';
$route['view_request'] = 'request/view_request';
$route['xmark_email'] = 'request/xmark_email';