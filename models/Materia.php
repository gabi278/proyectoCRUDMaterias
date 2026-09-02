<?php

class Materias{
    private $conn;

    public function __construct($conexion){
        $this->conn = $conexion;
    }
    //Traemos todas las materias para mostrarlas
    public function obtenerTodas(){
        $sql = "SELECT m.idMateria, m.mat_nombre AS mat_nombre, m.mat_anio, e.est_nombre AS est_nombre 
        FROM materias m
        INNER JOIN estados e ON m.idEstado = e.idEstado
        WHERE m.mat_activo = 1;";

        $resultado = this->conn->query($sql);
        $materias = [];
        while($fila = $resultado->fetch_assoc()){
            $materias[] = $fila; //Agregamos materia en el array, cada elemento es una fila.
        }
        return $materias; 
    }

    //Para cuando editemos una materia, traemos sus datos.
    public function obtenerPorId($id){
        $stmt = $this->conn->prepare("SELECT * FROM materias WHERE idMateria = ?");
        $stmt->bindParam("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }
    //Actualizamos la materia
    public function actualizar($id, $nombre, $anio){
        $stmt = $this->conn->prepare("UPDATE materias SET mat_nombre = ?, mat_anio = ? WHERE idMateria = ?");
        $stmt->bindParam("sii", $id, $nombre, $anio);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }
    //Creamos una materia
    public function crear($nombre, $anio, $idEstado){
        $stmt = $this->conn->prepare("INSERT INTO materias (mat_nombre, mat_anio, idEstado) VALUES (?,?,?)");
        $stmt->bindParam("sii", $nombre, $anio, $idEstado);
        return $stmt->execute();
    }
    //Eliminamos una materia
    public function eliminar($id){
        $stmt = $this->conn->prepare("UPDATE materias SET mat_activo = 0 WHERE idMateria = ?");
        $stmt->bindParam("i", $id);
        return $stmt->execute();
    }













}








?>