<?php

use App\Controllers\Api\AuthController;
use App\Controllers\Api\HomeController;

return function ($router) {
    $router->addRoute('GET', '/home', [HomeController::class, 'index']);

    // Auth
    $router->addRoute('GET', '/login', [AuthController::class, 'login']);
    $router->addRoute('GET', '/logout', [AuthController::class, 'logout']);
};