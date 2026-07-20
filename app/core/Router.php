<?php
namespace App\Core;

class Router
{
    private $routes = [];

    public function add($method, $route, $handler)
    {
        $route = preg_replace('/\{([a-zA-Z]+)\}/', '([^/]+)', $route);
        $this->routes[] = [
            'method' => $method,
            'pattern' => '#^' . $route . '$#',
            'handler' => $handler,
        ];
    }

    public function get($route, $handler)
    {
        $this->add('GET', $route, $handler);
    }

    public function post($route, $handler)
    {
        $this->add('POST', $route, $handler);
    }

    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $base = dirname($_SERVER['SCRIPT_NAME']);
        if ($base !== '/') {
            $uri = substr($uri, strlen($base));
        }
        $uri = '/' . trim($uri, '/');

        foreach ($this->routes as $route) {
            if ($method !== $route['method']) continue;

            if (preg_match($route['pattern'], $uri, $matches)) {
                array_shift($matches);
                $handler = $route['handler'];
                $controller = new $handler[0]();
                call_user_func_array([$controller, $handler[1]], $matches);
                return;
            }
        }

        http_response_code(404);
        if (function_exists('error_log')) {
            error_log("[Router] 404: {$method} {$uri}");
        }
        echo '<h1>404 — Página no encontrada</h1>';
    }
}
