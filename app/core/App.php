<?php

class App
{
    private $routes = [];

    public function __construct()
    {
        $this->handleRequest();
    }

    private function handleRequest()
    {
        $requestUri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $basePath   = 'airtelxstream/public';

        if (str_starts_with($requestUri, $basePath)) {
            $requestUri = trim(substr($requestUri, strlen($basePath)), '/');
        }

        $url = isset($_GET['url']) ? trim($_GET['url'], '/') : '';

        if ($requestUri === 'admin') {
            require ROOT_PATH . "app/routes/admin.php";
            $this->routes = $routes;
            $this->dispatch('');
            return;
        }

        if (str_starts_with($requestUri, 'admin/')) {
            require ROOT_PATH . "app/routes/admin.php";
            $url = trim(substr($requestUri, strlen('admin')), '/');
        }
        
        else {
            require ROOT_PATH . "app/routes/frontend.php";
        }

        $this->routes = $routes;

        if (!array_key_exists($url, $this->routes)) {
            $this->show404($url);
            return;
        }

        $this->dispatch($url);
    }



    private function dispatch($routeKey)
    {
        $route = $this->routes[$routeKey];
        list($controllerPath, $method) = explode("@", $route);

        $filePath = ROOT_PATH . "app/Controllers/" . $controllerPath . ".php";

        if (!file_exists($filePath)) {
            die("Controller file not found: {$filePath}");
        }

        require_once $filePath;

        $className = basename($controllerPath);

        if (!class_exists($className)) {
            die("Controller class '{$className}' not found.");
        }

        $controller = new $className();

        if (!method_exists($controller, $method)) {
            die("Method '{$method}' not found in '{$className}'.");
        }

        $controller->$method();
    }

    private function show404($url)
    {
        http_response_code(404);
        echo "<h1>404 - Route not found: {$url}</h1>";
    }
}
