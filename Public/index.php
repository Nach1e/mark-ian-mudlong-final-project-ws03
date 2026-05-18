<?php
    define('BASE_PATH', dirname(__DIR__));
    
    require BASE_PATH . '/vendor/autoload.php';
    require BASE_PATH . '/helpers.php';
    
    use Framework\Router;
    use Framework\Session;
    
    Session::start();
    
    $router = new Router();
    $routes = require BASE_PATH . '/routes.php';
    
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $method = $_SERVER['REQUEST_METHOD'];
    
    // Remove the base path /WS03-main/Public from the URI
    $basePath = '/WS03-main/Public';
    if (strpos($uri, $basePath) === 0) {
        $uri = substr($uri, strlen($basePath));
    }
    
    // If empty, set to root
    if (empty($uri) || $uri === '') {
        $uri = '/';
    }
    
    $router->route($uri, $method);
?>