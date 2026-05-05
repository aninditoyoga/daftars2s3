<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// 🏠 Default Home
$routes->get('/', 'RegistrationController::index');

// 🎓 Registration Module
$routes->group('registration', function ($routes) {
    // Tampilkan form
    $routes->get('/', 'RegistrationController::index', ['as' => 'reg.form']);

    // Proses submit (POST)
    $routes->post('submit', 'RegistrationController::store', ['as' => 'reg.store']);

    // Halaman sukses/konfirmasi
    $routes->get('success', 'RegistrationController::success', ['as' => 'reg.success']);

    // AJAX validasi email (opsional tapi disarankan)
    $routes->post('check-email', 'RegistrationController::checkEmail', ['as' => 'reg.check.email']);
});

// 👨‍💼 Admin Authentication
$routes->get('admin', 'AdminController::login');
$routes->get('admin/login', 'AdminController::login', ['as' => 'admin.login']);
$routes->post('admin/login', 'AdminController::authenticate', ['as' => 'admin.authenticate']);
$routes->get('admin/logout', 'AdminController::logout', ['as' => 'admin.logout']);

// 👨‍💼 Admin Dashboard Module
$routes->group('admin', ['filter' => 'adminauth'], function ($routes) {
    // Dashboard
    $routes->get('dashboard', 'AdminController::dashboard', ['as' => 'admin.dashboard']);

    // Applicants management
    $routes->get('applicants', 'AdminController::applicants', ['as' => 'admin.applicants']);
    $routes->get('applicants/(:num)', 'AdminController::detail/$1', ['as' => 'admin.detail']);
    $routes->post('applicants/(:num)/status', 'AdminController::updateStatus/$1', ['as' => 'admin.updateStatus']);
    $routes->get('applicants/(:num)/status', 'AdminController::updateStatus/$1', ['as' => 'admin.updateStatus.get']);
    $routes->post('applicants/(:num)/payment-status', 'AdminController::updatePaymentStatus/$1', ['as' => 'admin.updatePaymentStatus']);

    // Statistics
    $routes->get('statistics', 'AdminController::statistics', ['as' => 'admin.statistics']);

    // Export data
    $routes->get('export', 'AdminController::export', ['as' => 'admin.export']);
});

// �🔒 Security: Matikan auto-routing (wajib untuk production)
$routes->setAutoRoute(false);

// 🌐 Fallback 404
$routes->get('404', 'Errors::show404');