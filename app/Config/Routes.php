<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'login::index');
$routes->get('/registrar', 'login::registrar');
$routes->get('/recuperar', 'login::recuperar');
$routes->post('/login', 'login::login');
$routes->get('/salir', 'login::salir');

$routes->get('/inicio', 'inicio::index');