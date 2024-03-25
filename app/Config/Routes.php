<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setAutoRoute(false);

$routes->get('/login', 'Auth::index');
$routes->get('/register', 'Auth::register');

$routes->group('', ['filter' => 'AuthCheck'], function ($routes) {
   $routes->get('/', 'Dashboard::index');
   $routes->get('/classement', 'Dashboard::classement');
   $routes->get('/badges', 'Dashboard::badges');
   $routes->get('/boutique', 'Boutique::index');
});
