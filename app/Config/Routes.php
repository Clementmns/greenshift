<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setAutoRoute(true);

$routes->group('', ['filter' => 'AuthCheck'], function ($routes) {
   $routes->get('/', 'Dashboard::index');

   // Routes pour les demandes AJAX seulement
   $routes->group('', ['filter' => 'ajax_request'], function ($routes) {
      $routes->get('/dashboard/relation', 'Dashboard::relation');
      $routes->get('/dashboard/relationView', 'Dashboard::relationView');
      $routes->get('/dashboard/addFriend', 'Dashboard::addFriend');
      $routes->get('/user/getUserInfos', 'UserController::getUserInfos');
   });
});


$routes->get('/login', 'Auth::index');
$routes->get('/register', 'Auth::register');
