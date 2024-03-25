<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setAutoRoute(true);

$routes->group('', ['filter' => 'AuthCheck'], function ($routes) {
   $routes->get('/', 'Dashboard::index');
   $routes->get('/classement', 'Dashboard::classement');
   $routes->get('/badges', 'Dashboard::badges');
   $routes->get('/boutique', 'Boutique::index');

   // Routes pour les demandes AJAX seulement
   $routes->group('', ['filter' => 'ajax_request'], function ($routes) {
      $routes->get('/dashboard/relation', 'Dashboard::relation');
      $routes->get('/dashboard/relationView', 'Dashboard::relationView');
      $routes->get('/dashboard/addFriend', 'Dashboard::addFriend');
   });
});

$routes->get('/login', 'Auth::index');
$routes->get('/register', 'Auth::register');
