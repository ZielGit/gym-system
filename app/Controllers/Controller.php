<?php

namespace App\Controllers;

class Controller
{
    public function view($route, $data = [])
    {
        // Convertir la notación de puntos en rutas de archivos
        $route = str_replace('.', '/', $route);

        // Obtener la ruta absoluta del archivo de vista
        $viewPath = realpath(__DIR__ . "/../../views/{$route}.php");
        if ($viewPath === false || !file_exists($viewPath)) {
            die('La vista no existe en la ruta: ' . $viewPath);
        }

        // Extraer los datos para que estén disponibles como variables en la vista
        if (!empty($data)) {
            extract($data);
        }

        // Incluir la vista directamente
        include $viewPath;
        exit;
    }
}
