<?php

require_once __DIR__ . '/vendor/autoload.php';

$env = parse_ini_file('.env');
define('APP_URL', $env['APP_URL']);


function handleRoute($method, $uri)
{
    $base_path = parse_url(APP_URL, PHP_URL_PATH);
    if (strpos($uri, $base_path) === 0) {
        $uri = substr($uri, strlen($base_path));
    }

    $routes = require_once __DIR__ . '/routes.php';

    if (array_key_exists($uri, $routes)) {
        $controller_name = $routes[$uri];
        $controller = new $controller_name;
        if (method_exists($controller, $method)) {
            echo $controller->$method();
        } else {
            echo $controller->__invoke();
        }
    } else {
        http_response_code(404);
    }
}

handleRoute($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);