<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'ItemController::index');
$routes->get('items', 'ItemController::index');
$routes->get('items/create', 'ItemController::create');
$routes->post('items', 'ItemController::store');
