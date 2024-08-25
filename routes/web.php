<?php

use App\Controllers\HomeController;

return function ($router) {
    $router->addRoute('GET', '/', [HomeController::class, 'index']);
    $router->addRoute('GET', '/login', [HomeController::class, 'login']);
};