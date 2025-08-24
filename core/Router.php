<?php
// core/Router.php
namespace Core;

class Router {
    protected $routes = [];

    public function add($route, $callback) {
        $this->routes[$route] = $callback;
    }

    public function dispatch($url) {
        foreach ($this->routes as $route => $callback) {
            // Convertir la ruta en expresión regular
            $pattern = preg_replace('/\{([^}]+)\}/', '([^/]+)', $route);
            $pattern = '#^' . $pattern . '$#';
            
            if (preg_match($pattern, $url, $matches)) {
                // Eliminar el primer elemento (coincidencia completa)
                array_shift($matches);
                
                // Llamar al callback con los parámetros
                call_user_func_array($callback, $matches);
                return;
            }
        }
        
        // Ruta no encontrada
        http_response_code(404);
        echo "Página no encontrada";
    }
}