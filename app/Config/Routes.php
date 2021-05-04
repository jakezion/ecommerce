<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Dashboard');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//account
$routes->match(['get', 'post'], '/login', 'Account::login');
$routes->match(['get', 'post'], '/logout', 'Account::logout');
$routes->match(['get', 'post'], '/register', 'Account::register');
$routes->get('/', 'Dashboard::index');

//inventory
$routes->post('inv/get', 'Dashboard::ajax/$1');
$routes->match(['get', 'post'], 'inv/(:alpha)', 'Dashboard::inventory/$1');
$routes->match(['get', 'post'], 'inv/(:alpha)/(:alpha)', 'Dashboard::inventory/$1');
$routes->match(['get', 'post'], 'inv/(:num)', 'Dashboard::product/$1');
$routes->match(['get', 'post'], '/inv', 'Dashboard::inventory/all');


//basket
//$routes->post('/basket/purchase', 'Basket::purchase'); //TODO stop user from purchasing without pressing the checkout button
//$routes->get('/basket/add/(:num)/(:num)', 'Basket::add/$1/$2'); //TODO check
$routes->get('/basket', 'Basket::getBasket'); //TODO check


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
