<?php

namespace Config;

use Illuminate\Database\Capsule\Manager as Capsule;
// use Illuminate\Events\Dispatcher;
// use Illuminate\Container\Container;
use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

class Database
{
    public static function bootEloquent()
    {
        // Cargar las variables de entorno
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        // Crear el gestor de base de datos
        $capsule = new Capsule;

        // Configurar la conexión
        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => $_ENV['DB_HOST'],
            'database'  => $_ENV['DB_DATABASE'],
            'username'  => $_ENV['DB_USERNAME'],
            'password'  => $_ENV['DB_PASSWORD'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);

        // Establecer el event dispatcher (opcional)
        // $capsule->setEventDispatcher(new Dispatcher(new Container));

        // Hacer que esta conexión sea globalmente accesible
        $capsule->setAsGlobal();

        // Iniciar Eloquent ORM
        $capsule->bootEloquent();
    }
}
