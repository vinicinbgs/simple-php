<?php

namespace Packages\Http;

use Packages\Http\Response;

class Router
{
    public $traceId;
    private $routes;
    private static $instance;

    public function __construct()
    {
        $this->routes = [];
    }

    public function run()
    {
        $route = $this->getRoute();
        $method = $this->getMethod();

        if (!isset($this->routes[$method][$route]) || is_null($this->routes[$method][$route])) {
            return $this->pageNotFound();
        }

        return $this->executeController($route, $method);
    }

    public function get($path, $controller)
    {
        $this->map('GET', $path, $controller);
    }

    public function post($path, $controller)
    {
        $this->map('POST', $path, $controller);
    }

    public function put($path, $controller)
    {
        $this->map('PUT', $path, $controller);
    }

    public function patch($path, $controller)
    {
        $this->map('PATCH', $path, $controller);
    }

    public function delete($path, $controller)
    {
        $this->map('DELETE', $path, $controller);
    }

    private function map($method, $path, $controller)
    {
        $this->routes[$method] = [
            $path => $controller
        ];
    }

    private function pageNotFound()
    {
        return Response::send([
            'type' => 'error',
            'status' => '404'
        ], 404);
    }

    private function executeController(string $route, string $method)
    {
        list($controller, $method) = explode('@', $this->routes[$method][$route]);

        $request = new Request();
        $request->traceId = $this->traceId;

        return (new $controller($request))->$method();
    }

    /**
     * Remove query string from route
     */
    private function getRoute()
    {
        return preg_replace('/\?.*/', '', $_SERVER['REQUEST_URI']);
    }

    private function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function generateTraceId()
    {
        $timestamp = (string) ((new \DateTime())->getTimestamp() * mt_rand(1, 3));
        $this->traceId = hash('sha256', $timestamp, false);
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}
