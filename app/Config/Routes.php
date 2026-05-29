<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'ItemController::index');
$routes->get('/items', 'ItemController::index');
$routes->get('/items/create', 'ItemController::create');
$routes->post('/items/store', 'ItemController::store'); // The POST destination
$routes->get('/image/(:segment)', 'ImageController::show/$1');

$routes->get('/items/manage/(:num)/(:any)', 'ItemController::manage/$1/$2');

$routes->post('/items/update/(:num)', 'ItemController::update/$1');