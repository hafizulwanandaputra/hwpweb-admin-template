<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// AUTH
$routes->get('/', 'Auth::index');
$routes->post('/(?i)check-login', 'Auth::check_login');
$routes->get('/(?i)register', 'Auth::register');
$routes->post('/(?i)register/(?i)create', 'Auth::create');
$routes->get('/(?i)logout', 'Auth::logout');
$routes->delete('/(?i)delete/(:any)', 'Auth::delete');

// HOME
$routes->get('/(?i)home', 'Home::index');

// EXAMPLE CRUD
// You can specify this name for your project
$routes->get('/(?i)examples', 'Example::index');
$routes->get('(?i)examples/(?i)getexample/(:num)', 'Example::getExample/$1');
$routes->post('/(?i)examples/(?i)addexample', 'Example::addExample');
$routes->post('/(?i)examples/(?i)updateexample', 'Example::updateExample');
$routes->delete('/(?i)examples/(?i)deleteexample/(:num)', 'Example::deleteExample/$1');
$routes->get('/(?i)examples/(?i)getexamples', 'Example::getExamples');

// USERS
$routes->get('/(?i)users', 'Users::index');
$routes->get('(?i)users/(?i)getuser/(:num)', 'Users::getUser/$1');
$routes->post('/(?i)users/(?i)adduser', 'Users::addUser');
$routes->post('/(?i)users/(?i)updateuser', 'Users::updateUser');
$routes->delete('/(?i)users/(?i)deleteuser/(:num)', 'Users::deleteUser/$1');
$routes->get('/(?i)users/(?i)getusers', 'Users::getUsers');

// SETTINGS
$routes->get('/(?i)settings', 'Settings::index');

// CHANGE USER INFORMATION
$routes->get('/(?i)settings/(?i)edit', 'Settings::edit');
$routes->post('/(?i)settings/(?i)update', 'Settings::update');

// CHANGE PASSWORD
$routes->get('/(?i)settings/(?i)changepassword', 'ChangePassword::index');
$routes->post('/(?i)settings/(?i)changepassword/(?i)update', 'ChangePassword::update');

// EDIT PERSONAL INFORMATION
$routes->get('/(?i)settings/(?i)deleteaccount', 'Settings::deleteaccount');

// ABOUT SYSTEM
$routes->get('/(?i)settings/(?i)about', 'Settings::about');
