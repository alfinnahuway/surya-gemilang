<?php

use CodeIgniter\Router\RouteCollection;

$routes->setDefaultController('');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(true);
$routes->set404Override();
$routes->setAutoRoute(true);
/**
 * @var RouteCollection $routes
 */
// create route match for login
$routes->match(['get', 'post'], '/', 'Auth::index');
$routes->get('/logout', 'Auth::logout');
$routes->match(['get', 'post'], '/users/add', 'Users::add');
$routes->match(['get', 'post'], '/suppliers/add', 'Suppliers::add');
$routes->get('/suppliers/edit/(:num)', 'Suppliers::edit/$1');
$routes->delete('/suppliers/(:num)', 'Suppliers::delete/$1');
$routes->match(['get', 'post'], '/customers/add', 'Customers::add');
$routes->delete('/customers/(:num)', 'Customers::delete/$1');
$routes->get('/products/categories', 'Products\Categories::index');
$routes->match(['get', 'post'], '/products/categories/add', 'Products\Categories::add');
$routes->get('/products/units', 'Products\Units::index');
$routes->match(['get', 'post'], '/products/units', 'Products\Units::add');
$routes->delete('/products/units/(:num)', 'Products\Units::delete/$1');
$routes->get('/products/items', 'Products\Items::index');
$routes->match(['get', 'post'], '/products/items/add', 'Products\Items::add');
$routes->match(['get', 'post'], '/products/items/edit/(:num)', 'Products\Items::edit/$1');
$routes->delete('/products/items/(:num)', 'Products\Items::delete/$1');
$routes->post('/transaction/proccess', 'Transaction::proccess');
$routes->post('/transaction/printout/(:any)', 'Transaction::printout/$1');
$routes->delete('/transaction/delete/(:num)', 'Transaction::delete/$1');
