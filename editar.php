<?php
include 'conexion.php';

//Codigo para cuando el usuario quiera editar una materia.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // 1. Recibimos y limpiamos los datos
    $idMateria = (int) $_POST['idMateria'];
    $nombre = trim($_POST['nombre']);
    $anio = (int) $_POST['anio'];
    $idEstado = (int) $_POST['idEstado'];

    // 2. VALIDACIONES DE SEGURIDAD (¡Lo que notaste que faltaba!)
    if (empty($nombre)) {
        die("Error de seguridad: El nombre no puede estar vacío.");
    }
    if ($anio < 1 || $anio > 5) {
        die("Error de seguridad: El año debe estar entre 1 y 5.");
    }
    if ($idEstado <= 0) {
        die("Error de seguridad: Estado inválido.");
    }

    //Preparamos la actualizacion
    $sql_update = "UPDATE Materias SET mat_nombre = ?, mat_anio = ?, idEstado = ? WHERE idMateria = ?";
    $stmt_update = mysqli_prepare($conn, $sql_update);

    mysqli_stmt_bind_param($stmt_update, "siii", $nombre, $anio, $idEstado, $idMateria);

    if (mysqli_stmt_execute($stmt_update)) {
        mysqli_stmt_close($stmt_update);
        header("Location: index.php");
        exit();
    } else {
        echo "Error al actualizar: " . mysqli_error($conexion);
        mysqli_stmt_close($stmt_update);
    }
}


//Codigo para traer los datos de la materia que el usuario quiere editar
if (!isset($_GET['id'])) {
    die('ID incorrecto.');
}
$idMateria = (int) $_GET['id'];

//Traemos la materia relacionada al ID que vino por parametro.
$sql_materia = "SELECT * FROM materias WHERE idMateria = ? AND mat_activo = 1";
$stmt = mysqli_prepare($conn, $sql_materia);
mysqli_stmt_bind_param($stmt, "i", $idMateria);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
$materia = mysqli_fetch_assoc($resultado);

if (!$materia) {
    die("La materia no existe o se elimino.");
}

$sql_estados = "SELECT * FROM estados";
$resultado_estados = mysqli_query($conn, $sql_estados);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar materia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Editar Materia</h2>

        <!-- Con action="" indicamos que los datos vienen a este archivo -->
        <form action="" method="POST" style="max-width: 500px;">

            <!-- Campo oculto vital para que la Parte 1 sepa qué materia actualizar -->
            <input type="hidden" name="idMateria" value="<?php echo $materia['idMateria']; ?>">

            <div class="mb-3">
                <label class="form-label">Nombre de la Materia</label>
                <input type="text" class="form-control" name="nombre" required
                    value="<?php echo htmlspecialchars($materia['mat_nombre']); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Año de la carrera</label>
                <select class="form-select" name="anio" required>
                    <option value="1" <?php if ($materia['mat_anio'] == 1)
                        echo 'selected'; ?>>1º Año</option>
                    <option value="2" <?php if ($materia['mat_anio'] == 2)
                        echo 'selected'; ?>>2º Año</option>
                    <option value="3" <?php if ($materia['mat_anio'] == 3)
                        echo 'selected'; ?>>3º Año</option>
                    <option value="4" <?php if ($materia['mat_anio'] == 4)
                        echo 'selected'; ?>>4º Año</option>
                    <option value="5" <?php if ($materia['mat_anio'] == 5)
                        echo 'selected'; ?>>5º Año</option>
                    <option value="6" <?php if ($materia['mat_anio'] == 6)
                        echo 'selected'; ?>>6º Año</option>
                    <option value="7" <?php if ($materia['mat_anio'] == 7)
                        echo 'selected'; ?>>7º Año</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Estado</label>
                <select class="form-select" name="idEstado" required>
                    <?php
                    while ($estado = mysqli_fetch_assoc($resultado_estados)) {
                        $seleccionado = ($estado['idEstado'] == $materia['idEstado']) ? "selected" : "";
                        echo "<option value='{$estado['idEstado']}' $seleccionado>{$estado['est_nombre']}</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-warning">Guardar Cambios</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>

        </form>
    </div>
</body>

</html>