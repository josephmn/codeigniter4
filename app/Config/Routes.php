<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'login::index');
$routes->get('/inicio', 'inicio::index');