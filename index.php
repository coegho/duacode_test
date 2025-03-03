<?php

require_once __DIR__ . '/env.php';
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/db.php';

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
            $output = $controller->$method();
        } elseif (method_exists($controller, '__invoke')) {
            $output = $controller->__invoke();
        } else {
            http_response_code(404);
            return;
        }
        if (is_string($output)) {
            echo $output;
            return;
        }
        if (is_array($output)) {
            list($view, $params) = $output;
            displayView($view, $params);
        }
    }
    http_response_code(404);
    return;
}

function displayView(string $_view_name, ?array $_params): void
{
    $_path = __DIR__ . DIRECTORY_SEPARATOR . 'App' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . str_replace('.', DIRECTORY_SEPARATOR, $_view_name) . '.php';
    if (file_exists($_path)) {
        extract($_params);
        require $_path;
    } else {
        throw new \Exception("View $_view_name not found");
    }
}

try {
    handleRoute($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
} catch (\Exception $e) {
    echo $e->getMessage();
    exit;
}