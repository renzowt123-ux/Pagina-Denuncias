<?php

require_once "../app/controllers/DenunciaController.php";

$controller = new DenunciaController();

$action = $_GET['action'] ?? 'index';

if (method_exists($controller, $action)) {
    $controller->$action();
} else {
    echo "404 - Acción no encontrada";
}
