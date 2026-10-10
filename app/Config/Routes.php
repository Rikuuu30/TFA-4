<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Pages::index', ['as' => 'home']);
$routes->get('about', 'Pages::about', ['as' => 'about']);
$routes->get('login', 'Auth::login', ['as' => 'login']);
$routes->post('login', 'Auth::attempt', ['filter' => 'csrf', 'as' => 'login.attempt']);
$routes->post('logout', 'Auth::logout', ['filter' => 'csrf', 'as' => 'logout']);

$routes->group('', ['filter' => 'auth'], static function ($routes): void {
    $routes->get('customers', 'Customers::index', ['as' => 'customers']);
    $routes->get('customers/new', 'Customers::new', ['as' => 'customers.new']);
    $routes->post('customers', 'Customers::create', ['filter' => 'csrf', 'as' => 'customers.create']);
    $routes->get('customers/(:num)/edit', 'Customers::edit/$1', ['as' => 'customers.edit']);
    $routes->post('customers/(:num)', 'Customers::update/$1', ['filter' => 'csrf', 'as' => 'customers.update']);
    $routes->get('users', 'Users::index', ['as' => 'users']);
    $routes->get('users/new', 'Users::new', ['as' => 'users.new']);
    $routes->post('users', 'Users::create', ['filter' => 'csrf', 'as' => 'users.create']);
    $routes->get('users/(:num)/edit', 'Users::edit/$1', ['as' => 'users.edit']);
    $routes->post('users/(:num)', 'Users::update/$1', ['filter' => 'csrf', 'as' => 'users.update']);
});
