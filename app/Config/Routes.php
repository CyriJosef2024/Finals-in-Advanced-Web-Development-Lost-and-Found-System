<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'ItemController::index');
$routes->get('/items', 'ItemController::index');
$routes->get('/items/create', 'ItemController::create');
$routes->post('/items/store', 'ItemController::store'); // The POST destination
$routes->get('/image/(:segment)', 'ImageController::show/$1');