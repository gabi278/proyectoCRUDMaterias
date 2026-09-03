<?php
session_start();
require_once("../controllers/AuthController.php");
require_once("../controllers/MateriaController.php");
require_once("../config/conexion.php");


$materiaController = new MateriaController($conn);
$authController= new AuthController($conn);
$action = $_GET["action"] ?? "login";
switch ($action){
    case "login":
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $authController->login();
        }else{
            $authController->mostrarLogin();
        }
        break;
    case "index":
        $materiaController->index();
        break;
    case "crear":
        $materiaController->crear();
        break;
    case "guardar":
        $materiaController->guardar();
        break;
    case "editar":
        $materiaController->editar();
        break;
    case "actualizar":
        $materiaController->actualizar();
        break;
    case "eliminar":
        $materiaController->eliminar();
        break;
    case "logout":
        $authController->logout();
        break;
}
?>