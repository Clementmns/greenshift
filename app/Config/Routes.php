<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group('', ['filter' => 'AuthCheck'], function ($routes) {
   $routes->get('/dashboard', 'Dashboard::index');
});
