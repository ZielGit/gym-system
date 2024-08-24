<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/Database.php';

use Config\Database;

Database::bootEloquent();

// Lista de archivos de migración
$migrations = [
    // Agregar otras migraciones aquí
];

foreach ($migrations as $migration) {
    require __DIR__ . "/$migration";
}
