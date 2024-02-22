<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
// $routes->get('etu', 'Etudiants::index');
// $routes->get('grp', 'Groupes::index');
// $routes->get('grpchoose', 'Groupes::choose');

$routes->group('', ['filter' => 'AuthCheck'], function ($routes) {
   $routes->get('/dashboard', 'Dashboard::index');
});
