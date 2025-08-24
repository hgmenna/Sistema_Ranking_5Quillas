<?php
// core/View.php
namespace Core;

class View {
    public static function render($view, $data = []) {
        extract($data);
        
        // Buscar en módulo público
        $viewPath = "../modules/public/views/" . $view . ".php";
        if (!file_exists($viewPath)) {
            // Buscar en módulo admin
            $viewPath = "../modules/admin/views/" . $view . ".php";
        }
        
        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            die("Vista no encontrada: " . $view);
        }
    }
}