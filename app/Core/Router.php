<?php

namespace RezaFikkri\PHPLoginManagement\Core;

class Router
{
    private static array $routes = [];

    /**
     * Method for add route to routes
     *
     * @param string $method HTTP method, ex. POST, GET
     * @param string $path path in url, ex. /login
     * @param string $controller controller name for load
     * @param string $function method name in controller for load
     *
     * @return void
     */
    public static function add(
        string $method,
        string $path,
        string $controller,
        string $function,
        array $middleware = []
    ): void {
        static::$routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'function' => $function,
            'middleware' => $middleware
        ];
    }

    /**
     * Method for run Router class
     */
    public static function run(): void
    {
        $path = '/';
        if (isset($_SERVER['PATH_INFO'])) $path = $_SERVER['PATH_INFO'];
        $method = $_SERVER['REQUEST_METHOD'];

        foreach (static::$routes as $route) {
            $pattern = '#^' . $route['path'] . '$#';
            if (preg_match($pattern, $path, $matches) && $method == $route['method']) {
                // call middleware
                foreach ($route['middleware'] as $middleware) {
                    $instance = new $middleware;
                    $instance->before();
                }

                // call controller
                $controller = new $route['controller']();
                $method = $route['function'];

                array_shift($matches);
                call_user_func_array([$controller, $method], $matches);

                return;
            }
        }

        http_response_code(404);
        echo "CONTROLLER NOT FOUND";
    }
}
