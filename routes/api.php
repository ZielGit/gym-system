<?php

use App\Controllers\Api\AuthController;
use App\Controllers\Api\CoachController;
use App\Controllers\Api\CustomerController;
use App\Controllers\Api\HomeController;
use App\Controllers\Api\PlanController;
use App\Controllers\Api\UserController;

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

    // Users
    $router->addRoute('GET', '/users', [UserController::class, 'index']);
    $router->addRoute('POST', '/users', [UserController::class, 'store']);
    $router->addRoute('GET', '/users/{id:\d+}', [UserController::class, 'show']);
    $router->addRoute('PUT', '/users/{id:\d+}', [UserController::class, 'update']);
    $router->addRoute('PUT', '/users/status/{id:\d+}', [UserController::class, 'updateStatus']);

    // Plans
    $router->addRoute('GET', '/plans', [PlanController::class, 'index']);
    $router->addRoute('POST', '/plans', [PlanController::class, 'store']);
    $router->addRoute('GET', '/plans/{id:\d+}', [PlanController::class, 'show']);
    $router->addRoute('PUT', '/plans/{id:\d+}', [PlanController::class, 'update']);
    $router->addRoute('PUT', '/plans/status/{id:\d+}', [PlanController::class, 'updateStatus']);
};