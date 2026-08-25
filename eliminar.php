<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $idMateria = (int) $_GET['id'];
    //Hacemos un borrado logico, tenemos que cambiar el atributo mat_activo.
    $sql = "UPDATE Materias SET mat_activo = 0 WHERE idMateria = ?";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "i", $idMateria);

    // Ejecutamos la consulta para realizar el borrado logico.
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        header("Location: index.php");
        exit();
    } else {
        echo "Error al intentar eliminar la materia: " . mysqli_error($conexion);
        mysqli_stmt_close($stmt);
    }

} else {
    // Si alguien intenta entrar a eliminar.php sin mandar un ID
    echo "Acceso denegado. No se especificó ninguna materia.";
}
?>