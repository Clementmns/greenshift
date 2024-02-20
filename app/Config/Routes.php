<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('test', 'Home::dudule');
$routes->get('etu', 'Etudiants::index');
$routes->get('grp', 'Groupes::index');
$routes->get('grpchoose', 'Groupes::choose');
$routes->get('login', 'Auth::index');
$routes->get('register', 'Auth::register');