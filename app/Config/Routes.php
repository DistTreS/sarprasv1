<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->get('/login', 'Auth::index');
$routes->post('/login', 'Auth::login');

$routes->get('/dashboard', 'Dashboard::index');

//modul latsar
$routes->get('/pesertaLatsar', 'PesertaLatsar::index');
$routes->get('/pesertaLatsar/create', 'PesertaLatsar::create');
$routes->post('/pesertaLatsar/store', 'PesertaLatsar::store');
$routes->get('/pesertaLatsar/view/(:num)', 'PesertaLatsar::view/$1');
$routes->get('/pesertaLatsar/edit/(:num)', 'PesertaLatsar::edit/$1');
$routes->post('/pesertaLatsar/update/(:num)', 'PesertaLatsar::update/$1');
$routes->get('/pesertaLatsar/delete/(:num)', 'PesertaLatsar::delete/$1');
$routes->post('pesertaLatsar/importExcel', 'PesertaLatsar::importExcel');
