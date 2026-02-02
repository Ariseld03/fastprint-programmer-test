<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('fastprintapi', 'Fastprint::index');
$routes->get('produk', 'ProductController::index', ['as' => 'produk.index']);
$routes->get('/produk/create', 'ProductController::create', ['as' => 'produk.create']);
$routes->post('/produk/store', 'ProductController::store', ['as' => 'produk.store']);
$routes->get('/produk/edit/(:num)', 'ProductController::edit/$1', ['as' => 'produk.edit']);
$routes->post('/produk/update/(:num)', 'ProductController::update/$1', ['as' => 'produk.update']);
$routes->post('/produk/delete/(:num)', 'ProductController::delete/$1', ['as' => 'produk.delete']);