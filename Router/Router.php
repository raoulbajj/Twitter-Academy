<?php

namespace Router;

use Exceptions\RouteNotFoundException;

class Router
{
    private array $routes = [];
    
    public function register(string $path, callable|array $action, string $requestMethod): void
    {
        $this->routes[$requestMethod][$path] = $action;
    }
    public function get(string $path, callable|array $action): void
    {
        $this->register($path, $action, 'GET');
    }
    public function post(string $path, callable|array $action): void
    {
        $this->register($path, $action, 'POST');
    }

    public function resolve(string $uri, string $requestMethod){
        $path = explode('?', $uri)[0];
        $action = $this->routes[$requestMethod][$path] ?? null;

        if(is_callable($action)) {
            return $action();
        }
        if (is_array($action)) {
            [$className, $method] = $action;

            if (class_exists($className) && method_exists($className, $method)) {
                $class = new $className();
                return call_user_func_array([$class, $method], []);
            }
        }
        
        throw new RouteNotFoundException();
        
    }
}

