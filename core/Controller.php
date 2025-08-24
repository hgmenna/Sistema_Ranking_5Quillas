<?php
// core/Controller.php
namespace Core;

class Controller {
    public function model($model) {
        // Buscar en módulo público
        $modelPath = "../modules/public/models/" . $model . ".php";
        if (!file_exists($modelPath)) {
            // Buscar en módulo admin
            $modelPath = "../modules/admin/models/" . $model . ".php";
        }
        
        if (file_exists($modelPath)) {
            require_once $modelPath;
            
            // Determinar namespace
            $namespace = strpos($modelPath, 'admin') ? 
                "\\Modules\\Admin\\Models\\" : 
                "\\Modules\\Public\\Models\\";
                
            $modelClass = $namespace . $model;
            return new $modelClass();
        }
        
        return null;
    }

    public function view($view, $data = []) {
        // Buscar en módulo público
        $viewPath = "../modules/public/views/" . $view . ".php";
        if (!file_exists($viewPath)) {
            // Buscar en módulo admin
            $viewPath = "../modules/admin/views/" . $view . ".php";
        }
        
        if (file_exists($viewPath)) {
            extract($data);
            require_once $viewPath;
        } else {
            die("Vista no encontrada: " . $view);
        }
    }
}