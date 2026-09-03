<?php
class Estado
{
    private $conn;

    public function __construct($conexion){
        $this->conn = $conexion;
    }

    public function obtenerTodos(){
        $resultados = $this->conn->query("SELECT * FROM estados");
        $estados = [];
        while ($fila = $resultados->fetch_assoc()) {
            $estados[] = $fila;
        }
        return $estados;
    }
}
?>