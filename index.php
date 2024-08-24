<?php

require 'vendor/autoload.php';

use Config\Database;
use Config\FastRoute;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

header("Access-Control-Allow-Origin: *");

// Inicializar Eloquent
Database::bootEloquent();

$router = new FastRoute;

// Cargar las rutas API y web
$apiRoutes = require __DIR__ . '/routes/api.php';
$webRoutes = require __DIR__ . '/routes/web.php';

// Agrupar las rutas API con el prefijo /api
$router->group('/api', $apiRoutes);

// Cargar las rutas web
$webRoutes($router);

// Ejecutar el enrutador
$router->run();