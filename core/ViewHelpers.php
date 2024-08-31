<?php

$sections = [];
$currentSection = null;

function startSection($name)
{
    global $currentSection;
    $currentSection = $name;
    ob_start();
}

function endSection()
{
    global $sections, $currentSection;
    $sections[$currentSection] = ob_get_clean();
    $currentSection = null;
}

function yieldContent($name)
{
    global $sections;
    echo $sections[$name] ?? '';
}

function includePartial($path)
{
    $path = str_replace('.', '/', $path);
    $viewPath = realpath(__DIR__ . "/../views/{$path}.php");

    // Verificar si la ruta es válida
    if ($viewPath && file_exists($viewPath)) {
        include $viewPath;
    } else {
        die("The partial view [{$path}] does not exist.");
    }
}
