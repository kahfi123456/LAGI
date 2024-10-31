<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use Config\Services;

$routes = Services::routes();

// Rute default
$routes->get('/', 'FileManagerController::index');

// Halaman indeks file manager
$routes->get('filemanager', 'FileManagerController::index');

// Halaman fakultas
$routes->get('filemanager/faculty/(:any)', 'FileManagerController::faculty/$1');

// Halaman pencarian
$routes->get('filemanager/search', 'FileManagerController::search');

// Rute untuk download file
$routes->get('filemanager/download/(:num)', 'FileManagerController::download/$1');

// Rute untuk menambahkan file ZIP Swit Routing
$routes->get('filemanager/addSwitRoutingZip', 'FileManagerController::addSwitRoutingZip');

$routes->group('admin', function($routes) {
    $routes->get('login', 'AdminController::login');
    $routes->post('authenticate', 'AdminController::authenticate');
    $routes->get('logout', 'AdminController::logout');
    $routes->get('dashboard', 'AdminController::dashboard');
    $routes->get('upload', 'AdminController::uploadForm'); // GET untuk menampilkan form upload
    $routes->post('upload', 'AdminController::uploadFile'); // POST untuk memproses upload
    $routes->get('insert-faculty-files', 'AdminController::insertFacultyFiles'); // Hapus 'admin/' di sini
    $routes->get('deleteFile/(:num)', 'AdminController::deleteFile/$1'); // Hapus 'admin/' di sini
   

});



// Rute untuk Auth
$routes->group('auth', function($routes) {
    $routes->get('login', 'Auth::login');
    $routes->post('loginSubmit', 'Auth::loginSubmit');
    $routes->get('logout', 'Auth::logout');
});