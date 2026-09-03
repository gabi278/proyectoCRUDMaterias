<?php

class Usuario{
    private $conn;

    public function __construct($conexion){
        $this->conn = $conexion;
    }

    //Obtenemos usuario por mail
    public function obtenerUsuarioPorEmail($email){
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ? ");
        $stmt->bind_param("s", $email,);
        $stmt->execute();
        $usuario = $stmt->get_result();
        return $usuario->fetch_assoc();
    }
}




?>