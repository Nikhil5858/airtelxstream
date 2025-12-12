<?php

class App
{
    private $routes = [];

    public function __construct($mode = "frontend")
    {
        // Load correct routes file
        if ($mode === "admin") {
            require ROOT_PATH . "app/routes/admin.php";
        } else {
            require ROOT_PATH . "app/routes/frontend.php";
        }

        // $routes comes from the required file
        $this->routes = $routes;

        $this->handleRequest();
    }

    // Handle URL parsing
    private function handleRequest()
    {
        $url = isset($_GET['url']) ? trim($_GET['url'], '/') : '';

        // Default route
        if ($url === '') {
            $this->dispatch("");
            return;
        }

        if (!array_key_exists($url, $this->routes)) {
            $this->show404($url);
            return;
        }

        $this->dispatch($url);
    }

    // Run the mapped controller
    private function dispatch($routeKey)
    {
        $route = $this->routes[$routeKey];

        // Format: "Frontend/HomeController@index"
        list($controllerPath, $method) = explode("@", $route);

        // Correct controller file location
        $filePath = ROOT_PATH . "app/Controllers/" . $controllerPath . ".php";

        if (!file_exists($filePath)) {
            die("Controller file not found: {$filePath}");
        }

        require_once $filePath;

        // Extract class name from path
        $parts     = explode("/", $controllerPath);
        $className = end($parts);

        if (!class_exists($className)) {
            die("Controller class '{$className}' not found.");
        }

        $controller = new $className();

        if (!method_exists($controller, $method)) {
            die("Method '{$method}' not found in '{$className}'.");
        }

        // Call the controller method
        $controller->$method();
    }

    private function show404($url)
    {
        http_response_code(404);
        echo "<h1>404 - Route not found: {$url}</h1>";
    }
}
