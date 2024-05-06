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
$route['default_controller'] = 'Auth/AccountController/loginIndex';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// GET METHOD ROUTES

$route['home'] = 'Auth/AccountController/homePage';

// AUTH Routes
$route['register'] = 'Auth/AccountController/registerIndex';
$route['login'] = 'Auth/AccountController/loginIndex';
$route['logout'] = 'Auth/AccountController/logout';

// PROFILE Routes
$route['profile'] = 'Auth/ProfileController/index';
$route['profile/edit'] = 'Auth/ProfileController/edit';

// GUIDE Routes
$route['guide'] = 'Guide/GuideController/index';

// POST (Blog) Routes
$route['posts'] = 'Post/PostController/index';
$route['posts/create'] = 'Post/PostController/createPost';
$route['posts/view/(:num)'] = 'Post/PostController/viewPost/$1';
$route['posts/delete/(:num)'] = 'Post/PostController/deletePost/$1';

// COMMENT Routes
$route['comments/getComments/(:num)'] = 'Post/PostController/getComments/$1';
$route['comments/delete/(:num)'] = 'Comment/CommentController/deleteComment/$1';
