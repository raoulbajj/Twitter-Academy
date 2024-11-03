<?php

namespace src;

use Router\Router;
use Exceptions\RouteNotFoundException;

class App
{
    public function __construct(private Router $router, private array $request){}

    public function run()
    {
        try {
            echo $this->router->resolve($this->request['uri'], $this->request['method']);
        } catch (RouteNotFoundException $e) {
            echo $e->error();
        }
    }
}