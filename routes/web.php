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
    $router->addRoute('GET', '/admin/coaches', [AdminController::class, 'coach']);
    $router->addRoute('GET', '/admin/customers', [AdminController::class, 'customer']);
    $router->addRoute('GET', '/admin/customers/plan', [AdminController::class, 'customerPlan']);
    $router->addRoute('GET', '/admin/users', [AdminController::class, 'user']);
    $router->addRoute('GET', '/admin/plans', [AdminController::class, 'plan']);
    $router->addRoute('GET', '/admin/routines', [AdminController::class, 'routine']);
    $router->addRoute('GET', '/admin/attendances', [AdminController::class, 'attendance']);
};