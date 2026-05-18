<?php

namespace Framework;

use App\Controllers\ErrorController;

class Router
{
    private $routes = [];

    /**
     * Register a route inside the framework routing table
     * * @param string $method
     * @param string $uri
     * @param string $action
     * @return void
     */
    public function registerRoute($method, $uri, $action)
    {
        list($controller, $controllerMethod) = explode('@', $action);
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'action' => $action,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod
        ];
    }

    /**
     * Register a GET route
     * * @param string $uri
     * @param string $controller
     * @return void
     */
    public function get($uri, $controller)
    {
        $this->registerRoute('GET', $uri, $controller);
    }

    /**
     * Register a POST route
     * * @param string $uri
     * @param string $controller
     * @return void
     */
    public function post($uri, $controller)
    {
        $this->registerRoute('POST', $uri, $controller);
    }

    /**
     * Register a PUT route
     * * @param string $uri
     * @param string $controller
     * @return void
     */
    public function put($uri, $controller)
    {
        $this->registerRoute('PUT', $uri, $controller);
    }

    /**
     * Register a DELETE route
     * * @param string $uri
     * @param string $controller
     * @return void
     */
    public function delete($uri, $controller)
    {
        $this->registerRoute('DELETE', $uri, $controller);
    }

    /**
     * Match an incoming request URI against registered routes and execute logic
     * * @param string $uri
     * @return void
     */
    public function route($uri)
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {

            $uriSegments = explode('/', trim($uri, '/'));
            $routerSegments = explode('/', trim($route['uri'], '/'));
            $match = true;

            if (count($uriSegments) == count($routerSegments) && strtoupper($route['method']) === $requestMethod) {
                $params = [];
                $match = true;
                
                for ($i = 0; $i < count($uriSegments); $i++) {

                    if ($routerSegments[$i] !== $uriSegments[$i] && !preg_match('/{(.*?)}/', $routerSegments[$i])) {
                        $match = false;
                        break;
                    }
                    

                    if (preg_match('/{(.*?)}/', $routerSegments[$i], $matches)) {
                        $params[$matches[1]] = $uriSegments[$i];
                    }
                }
                
                if ($match) {

                    $controller = 'App\\Controllers\\' . $route['controller'];
                    $controllerMethod = $route['controllerMethod'];

                    // Instantiate controller class dynamically and execute method
                    $controllerInstance = new $controller();
                    $controllerInstance->$controllerMethod($params);
                    return;
                }
            }
        }
        

        ErrorController::notFound();
    }
}