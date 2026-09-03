<?php 
require_once("../models/Usuario.php");

class AuthController{
    private $modeloUsuario;
    //Lo que tengo que hacer es verificar que el usuario y contraseña ingresados sean correctos, y tambien verificar cual es el rol que tiene el usuario que ingresa.
    //Tambien manejar el caso en el que no exista usuario y/o la contraseña no es correcta.
    public function __construct($conexion){
        $this->modeloUsuario = new Usuario($conexion);
    }


}



















?>