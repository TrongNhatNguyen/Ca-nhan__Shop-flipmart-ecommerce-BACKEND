<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
/// === ĐƯỜNG DẪN URL CHO GIAO DIỆN:
$routes->setDefaultNamespace('App\Controllers\Frontend');
// Trang home
$routes->get('/', 'HomeController::index');



/// === ĐƯỜNG DẪN URL CHO ADMIN: Tạo middleware để kiểm tra việc đăng nhập
$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'authenticate'], function ($routes) {
    // Trang dashboard
    $routes->get('/', 'DashboardController::index');

    // Quản lý người dùng

});
