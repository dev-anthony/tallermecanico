<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

// Grupo de rutas para roles: http://localhost:8080/api/roles
$routes->group('api/roles', ['namespace' => 'App\Controllers\API'], function ($routes) {
  // http://localhost:8080/api/roles -> GET
  $routes->get('', 'RolController::index');
  // http://localhost:8080/api/roles/1 --> SHOW
  $routes->get('(:num)', 'RolController::show/$1');
  // http://localhost:8080/api/roles/create -> POST
  $routes->post('create', 'RolController::create');
  // http://localhost:8080/api/roles/edit -> PUT
  $routes->put('edit/(:num)', 'RolController::edit/$1');
  // http://localhost:8080/api/roles/delete/1 --> DELETE
  $routes->delete('delete/(:num)', 'RolController::delete/$1');
});

// Grupo de rutas para almacen: http://localhost:8080/api/almacen
$routes->group('api/almacen', ['namespace' => 'App\Controllers\API'], function ($routes) {
  // http://localhost:8080/api/almacen -> GET
  $routes->get('', 'AlmacenController::index');
  // http://localhost:8080/api/almacen/1 --> SHOW
  $routes->get('(:num)', 'AlmacenController::show/$1');
  // http://localhost:8080/api/almacen/create -> POST
  $routes->post('create', 'AlmacenController::create');
  // http://localhost:8080/api/almacen/edit -> PUT
  $routes->put('edit/(:num)', 'AlmacenController::edit/$1');
  // http://localhost:8080/api/almacen/delete/1 --> DELETE
  $routes->delete('delete/(:num)', 'AlmacenController::delete/$1');
});

// Grupo de rutas para empleado: http://localhost:8080/api/empleado
$routes->group('api/empleado', ['namespace' => 'App\Controllers\API'], function ($routes) {
  // http://localhost:8080/api/empleado -> GET
  $routes->get('', 'EmpleadoController::index');
  // http://localhost:8080/api/empleado/1 --> SHOW
  $routes->get('(:num)', 'EmpleadoController::show/$1');
  // http://localhost:8080/api/empleado/create -> POST
  $routes->post('create', 'EmpleadoController::create');
  // http://localhost:8080/api/empleado/edit -> PUT
  $routes->put('edit/(:num)', 'EmpleadoController::edit/$1');
  // http://localhost:8080/api/empleado/delete/1 --> DELETE
  $routes->delete('delete/(:num)', 'EmpleadoController::delete/$1');
});

// Grupo de rutas para vehiculo: http://localhost:8080/api/vehiculo
$routes->group('api/vehiculo', ['namespace' => 'App\Controllers\API'], function ($routes) {
  // http://localhost:8080/api/vehiculo -> GET
  $routes->get('', 'VehiculoController::index');
  // http://localhost:8080/api/vehiculo/1 --> SHOW
  $routes->get('(:num)', 'VehiculoController::show/$1');
  // http://localhost:8080/api/vehiculo/create -> POST
  $routes->post('create', 'VehiculoController::create');
  // http://localhost:8080/api/vehiculo/edit -> PUT
  $routes->put('edit/(:num)', 'VehiculoController::edit/$1');
  // http://localhost:8080/api/vehiculo/delete/1 --> DELETE
  $routes->delete('delete/(:num)', 'VehiculoController::delete/$1');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
