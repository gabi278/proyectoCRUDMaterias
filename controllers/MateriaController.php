<?php
require_once('../models/Estado.php');
require_once('../models/Materia.php');

class MateriaController{
    private $modeloMateria;
    private $modeloEstado;

    public function __construct($conexion){
        $this->modeloEstado = new Estado($conexion);
        $this->modeloMateria = new Materia($conexion);
    }

    private function requireLogin(): void{
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ?action=login');
            exit;
        }
    }

    private function requireAdmin(): void{
        $this->requireLogin();

        if (($_SESSION['usuario_rol'] ?? '') !== 'admin') {
            http_response_code(403);
            exit('Acceso denegado. Solo un administrador puede realizar esta acción.');
        }
    }
    public function index(){
        $this->requireLogin();
        $materias = $this->modeloMateria->obtenerTodas();
        require_once('../views/materias/index.php');
    }

    public function crear(){
        $this->requireAdmin();
        $estados = $this->modeloEstado->obtenerTodos();
        require_once('../views/materias/crear.php');
    }

    public function actualizar(){
        $this->requireAdmin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idMateria =(int) $_POST['idMateria'];
            $nombre = trim($_POST['nombre']);
            $anio =(int) $_POST['anio'];
            $idEstado =(int) $_POST['idEstado'];
            if (empty($nombre)) {
                die("Error de seguridad: El nombre no puede estar vacío.");
            }
            if ($anio < 1 || $anio > 7) {
                die("Error de seguridad: El año debe estar entre 1 y 7.");
            }
            if ($idEstado <= 0) {
                die("Error de seguridad: Estado inválido.");
            }
            $this->modeloMateria->actualizar($idMateria, $nombre, $anio, $idEstado);
            header('Location: index.php?action=index');
        }
    }

    public function guardar(){
        $this->requireAdmin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre =trim($_POST['nombre']);
            $anio =(int) $_POST['anio'];
            $idEstado =(int) $_POST['idEstado'];

            if (empty($nombre)) {
                die('Error: el nombre de la materia no puede estar vacio.');
            }
            if ($anio < 1 || $anio > 7) {
                die('Error: El año debe estar comprendido entre 1 y 7.');
            }
            if ($idEstado <= 0) {
                die('Error: estado invalido.');
            }

            $this->modeloMateria->crear($nombre, $anio, $idEstado);
            header('Location: index.php?action=index');
        }

    }

    public function editar(){
        $this->requireAdmin();
        $id = $_GET['id'];
        $materia = $this->modeloMateria->obtenerPorId($id);
        $estados = $this->modeloEstado->obtenerTodos();
        require_once('../views/materias/editar.php');
    }

    public function eliminar(){
        $this->requireAdmin();
        if (isset($_GET['id'])) {
            $id = (int) $_GET['id'];
            $this->modeloMateria->eliminar($id);
        }
        header('Location: index.php?action=index');
    }
}



?>