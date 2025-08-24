<?php
// core/App.php
namespace Core;

class App {
    protected $controller = 'PublicController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();
        
        // Determinar controlador
        if (isset($url[0]) && !empty($url[0])) {
            $controllerName = ucfirst($url[0]) . 'Controller';
            $controllerPath = '../modules/public/controllers/' . $controllerName . '.php';
            
            if (file_exists($controllerPath)) {
                $this->controller = $controllerName;
                unset($url[0]);
            } else {
                // Verificar en módulo admin
                $adminControllerPath = '../modules/admin/controllers/' . $controllerName . '.php';
                if (file_exists($adminControllerPath)) {
                    $this->controller = $controllerName;
                    unset($url[0]);
                }
            }
        }

        // Cargar controlador
        $controllerFile = '../modules/public/controllers/' . $this->controller . '.php';
        if (!file_exists($controllerFile)) {
            $controllerFile = '../modules/admin/controllers/' . $this->controller . '.php';
        }
        
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controllerClass = '\\Modules\\' . (strpos($controllerFile, 'admin') ? 'Admin' : 'Public') . '\\Controllers\\' . $this->controller;
            $this->controller = new $controllerClass;
        } else {
            // Controlador por defecto
            require_once '../modules/public/controllers/PublicController.php';
            $this->controller = new \Modules\Public\Controllers\PublicController();
        }

        // Determinar método
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        // Parámetros
        $this->params = $url ? array_values($url) : [];

        // Llamar al método con parámetros
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}