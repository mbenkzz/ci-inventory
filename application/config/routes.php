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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['template'] = 'welcome/template';

$route['admin_dapur'] = 'authController/redirect_admin'; // go to dashboard if auth else login
$route['admin_dapur/login']['GET'] = 'authController/login';
$route['admin_dapur/login']['POST'] = 'authController/login_process';
$route['admin_dapur/logout'] = 'authController/logout';

$route['admin_dapur/dashboard'] = 'dashboardController/index';

$route['admin_dapur/inventory'] = 'inventoryController/index';

$route['admin_dapur/user'] = 'userController/index';
$route['admin_dapur/user/add']['GET'] = 'userController/create';
$route['admin_dapur/user/add']['POST'] = 'userController/insert';
$route['admin_dapur/user/edit/(:num)']['GET'] = 'userController/edit/$1';
$route['admin_dapur/user/edit/(:num)']['POST'] = 'userController/update/$1';
$route['admin_dapur/user/delete'] = 'userController/delete';

// category
$route['admin_dapur/category'] = 'categoryController/index';
$route['admin_dapur/category/add']['GET'] = 'categoryController/create';
$route['admin_dapur/category/add']['POST'] = 'categoryController/insert';
$route['admin_dapur/category/edit/(:num)']['GET'] = 'categoryController/edit/$1';
$route['admin_dapur/category/edit/(:num)']['POST'] = 'categoryController/update/$1';
$route['admin_dapur/category/delete'] = 'categoryController/delete';

// Items
$route['admin_dapur/items'] = 'itemsController/index';
$route['admin_dapur/items/datatables'] = 'itemsController/datatables_items';
$route['admin_dapur/items/select2'] = 'itemsController/select2_items';
$route['admin_dapur/items/add']['POST'] = 'itemsController/insert';
$route['admin_dapur/items/edit_stock']['GET'] = 'itemsController/edit_stock';
$route['admin_dapur/items/update_stock']['POST'] = 'itemsController/update_stock';
$route['admin_dapur/items/edit/(:num)']['GET'] = 'itemsController/edit/$1';
$route['admin_dapur/items/edit/(:num)']['POST'] = 'itemsController/update/$1';
$route['admin_dapur/items/delete'] = 'itemsController/delete';

$route['admin_dapur/transaction/cashier'] = 'cashierController/index';
$route['admin_dapur/transaction/add']['POST'] = 'cashierController/insert';
$route['admin_dapur/transaction/history'] = 'cashierController/history';
$route['admin_dapur/transaction/history/data'] = 'cashierController/data_history';