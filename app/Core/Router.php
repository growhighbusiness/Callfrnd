<?php
namespace App\Core;

/**
 * Simple Router for CallFrend
 */
class Router {
    protected $routes = [];

    public function add($route, $params = []) {
        // Convert route to regex
        $route = preg_replace('/\//', '\\/', $route);
        $route = '/^' . $route . '$/i';
        $this->routes[$route] = $params;
    }

    public function dispatch($url) {
        $url = $this->removeQueryStringVariables($url);

        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                $controller = $params['controller'];
                $controller = $this->convertToStudlyCaps($controller);
                $controller = "App\Controllers\\$controller";

                if (class_exists($controller)) {
                    $controller_object = new $controller($params);
                    $action = $params['action'];
                    $action = $this->convertToCamelCase($action);

                    if (is_callable([$controller_object, $action])) {
                        $controller_object->$action();
                    } else {
                        echo "Method $action in controller $controller not found";
                    }
                } else {
                    echo "Controller class $controller not found";
                }
                return;
            }
        }

        echo "No route matched for URL: $url";
    }

    protected function convertToStudlyCaps($string) {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    protected function convertToCamelCase($string) {
        return lcfirst($this->convertToStudlyCaps($string));
    }

    protected function removeQueryStringVariables($url) {
        if ($url != '') {
            $parts = explode('&', $url, 2);
            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }
        return $url;
    }
}
