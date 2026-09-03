<?php
require_once("../controllers/MateriaController.php");
require_once("../config/conexion.php");

$controller = new MateriaController($conn);
$action = $_GET["action"] ?? "login";
switch ($action){
    case "login":
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $authController->login();
        }else{
            $authController->showLogin();
        }
        break;
    case "index":
        $controller->index();
        break;
    case "crear":
        $controller->crear();
        break;
    case "guardar":
        $controller->guardar();
        break;
    case "editar":
        $controller->editar();
        break;
    case "actualizar":
        $controller->actualizar();
        break;
    case "eliminar":
        $controller->eliminar();
        break;
}
?>