<?php

use App\Controllers\AdminController;
use App\Controllers\AuthController;
use App\Controllers\HomeController;

return function ($router) {
    $router->addRoute('GET', '/', [HomeController::class, 'index']);

    // Auth
    $router->addRoute('GET', '/auth/login', [AuthController::class, 'login']);

    // Admin
    $router->addRoute('GET', '/admin/dashboard', [AdminController::class, 'dashboard']);
    $router->addRoute('GET', '/admin/customers', [AdminController::class, 'customer']);
};