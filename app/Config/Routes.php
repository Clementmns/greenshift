<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('login', 'Auth::index');
$routes->get('register', 'Auth::register');
$routes->get('etu', 'Etudiants::index');
$routes->get('grp', 'Groupes::index');
$routes->get('grpchoose', 'Groupes::choose');
