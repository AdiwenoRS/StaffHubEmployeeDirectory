<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
// Authentication Forms & Actions (Public access)
$routes->get('auth', 'AuthController::index');
$routes->post('auth/login', 'AuthController::login');
$routes->get('auth/logout', 'AuthController::logout');

// Protected Routes Group (Protected by 'auth' filter)
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'EmployeeController::index');
    $routes->get('employees', 'EmployeeController::index');
    $routes->get('employees/create', 'EmployeeController::create');
    $routes->post('employees/store', 'EmployeeController::store');
    $routes->get('employees/edit/(:num)', 'EmployeeController::edit/$1');
    $routes->post('employees/update/(:num)', 'EmployeeController::update/$1');
    $routes->get('employees/delete/(:num)', 'EmployeeController::delete/$1');
    $routes->get('employees/export', 'EmployeeController::export');
});