<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Login
$routes->get('/', 'login::index');
$routes->get('/registrar', 'login::registrar');
$routes->get('/recuperar', 'login::recuperar');
$routes->post('/login', 'login::login');
$routes->get('/salir', 'login::salir');

// Inicio
$routes->get('/inicio', 'inicio::index');

// Perfil
$routes->get('/perfil', 'perfil::index');

// Configuraciones
$routes->get('/conperfiles', 'configuracion::conperfiles');
$routes->post('/configuracion/mantperfil', 'configuracion::mantperfil');
$routes->get('/configuracion/getperfil', 'configuracion::getperfil');
$routes->get('/accesos', 'configuracion::accesos');

$routes->get('/conusuarios', 'configuracion::conusuarios');
