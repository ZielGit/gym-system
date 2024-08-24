<?php

require 'vendor/autoload.php';

use Config\Database;
use Config\FastRoute;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Inicializar Eloquent
Database::bootEloquent();

$router = new FastRoute;

// Definir encabezados condicionales
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Verificar si la ruta pertenece a una API
if (strpos($requestUri, '/api') === 0) {
    // Rutas de la API
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
}

// Cargar las rutas API y web
$apiRoutes = require __DIR__ . '/routes/api.php';
$webRoutes = require __DIR__ . '/routes/web.php';

// Agrupar las rutas API con el prefijo /api
$router->group('/api', $apiRoutes);

// Cargar las rutas web
$webRoutes($router);

// Ejecutar el enrutador
$router->run();