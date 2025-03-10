<?php

spl_autoload_register(function ($class_name) {
    $base_dir = __DIR__ . '/app/';

    // Reemplaza las barras invertidas (namespace) por barras normales
    $class_name = str_replace('\\', '/', $class_name);
    
    // Construye la ruta del archivo de la clase
    $file = $base_dir . $class_name . '.php';

    // Si el archivo existe, inclúyelo
    if (file_exists($file)) {
        require_once $file;
    }
});