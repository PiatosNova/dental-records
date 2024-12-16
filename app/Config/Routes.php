<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/authenticate', 'Auth::authenticate');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/store', 'Auth::store');
$routes->get('auth/logout', 'Auth::logout');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('appointments', 'Appointments::index');
$routes->get('appointments/create', 'Appointments::create');
$routes->post('appointments/store', 'Appointments::store');
$routes->get('appointments/cancel/(:num)', 'Appointments::cancel/$1');
$routes->get('appointments/edit/(:num)', 'Appointments::edit/$1');
$routes->post('appointments/update/(:num)', 'Appointments::update/$1');
$routes->get('appointments/delete/(:num)', 'Appointments::delete/$1');

// Admin routes
$routes->group('admin', ['filter' => 'admin'], function($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
    $routes->get('appointments', 'Admin::appointments');
    $routes->post('appointments/update-status/(:num)', 'Admin::updateStatus/$1');
    // Add other admin routes here
});
