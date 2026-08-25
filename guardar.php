<?php
include 'conexion.php';
//Ahora tenemos que hacer las validaciones del formulario.php
//Luego de validar los datos vamos a insertar la nueva materia en la BD
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Recuperamos los datos.
    $nombre = trim($_POST['nombre']);
    $anio = (int) $_POST['anio'];
    $idEstado = (int) $_POST['idEstado'];

    //Validaciones
    if (empty($nombre)) {
        die('Error: el nombre de la materia no puede estar vacio.');
    }
    if ($anio < 1 || $anio > 7) {
        die('Error: El año debe estar comprendido entre 1 y 7.');
    }
    if ($idEstado <= 0) {
        die('Error: estado invalido.');
    }

    //Insertamos la nueva materia
    $sql = "INSERT INTO materias (mat_nombre, mat_anio, idEstado) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    //Vinculamos los parametros a la declaracion preprada
    //El sii significa que agregamos un: string, int, int.
    mysqli_stmt_bind_param($stmt, "sii", $nombre, $anio, $idEstado);
    if (mysqli_stmt_execute($stmt)) {
        echo "Nueva materia agregada exitosamente.";
        mysqli_stmt_close($stmt);
        header("Location: index.php"); //Redireccionamos al index
        exit(); //Termina la ejecución del script.
    } else {
        echo "Error al agregar materia.";
        mysqli_stmt_close($stmt);
    }

} else {
    echo "Hay que entrar haciendo click en el boton Agregar nueva materia.";
}
?>