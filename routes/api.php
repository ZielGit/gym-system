<?php

use App\Controllers\Api\AuthController;
use App\Controllers\Api\CoachController;
use App\Controllers\Api\CustomerController;
use App\Controllers\Api\HomeController;

return function ($router) {
    $router->addRoute('GET', '/home', [HomeController::class, 'index']);

    // Auth
    $router->addRoute('POST', '/login', [AuthController::class, 'login']);
    $router->addRoute('GET', '/logout', [AuthController::class, 'logout']);

    // Customers
    $router->addRoute('GET', '/customers', [CustomerController::class, 'index']);
    $router->addRoute('POST', '/customers', [CustomerController::class, 'store']);
    $router->addRoute('GET', '/customers/{id:\d+}', [CustomerController::class, 'show']);
    $router->addRoute('PUT', '/customers/{id:\d+}', [CustomerController::class, 'update']);
    $router->addRoute('PUT', '/customers/status/{id:\d+}', [CustomerController::class, 'updateStatus']);

    // Coaches
    $router->addRoute('GET', '/coaches', [CoachController::class, 'index']);
    $router->addRoute('POST', '/coaches', [CoachController::class, 'store']);
    $router->addRoute('GET', '/coaches/{id:\d+}', [CoachController::class, 'show']);
    $router->addRoute('PUT', '/coaches/{id:\d+}', [CoachController::class, 'update']);
    $router->addRoute('PUT', '/coaches/status/{id:\d+}', [CoachController::class, 'updateStatus']);
};