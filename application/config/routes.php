<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Login';
$route['login'] = 'Login';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['frontpage'] = 'login/frontpage';
$route['forget_password'] = 'login/forget_password';
$route['reset_password/(:any)'] = 'login/reset_password';
$route['reset_password_success'] = 'login/reset_password_success';
$route['create_password'] = 'Login/create_password';
$route['logout'] = 'Login/logout';


$route['about-us'] = 'Site';
$route['customized-holidays'] = 'Site';
$route['corporate-travels'] = 'Site';
$route['india'] = 'Site/page';
$route['international'] = 'Site';
$route['search'] = 'Site';

  