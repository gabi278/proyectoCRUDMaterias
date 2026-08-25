<?php
// Incluimos la conexión para poder consultar los estados
include 'conexion.php';

// Traemos todos los estados disponibles
$sql_estados = "SELECT * FROM estados";
$resultado_estados = mysqli_query($conn, $sql_estados);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Materia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2 class="mb-4">Agregar Nueva Materia</h2>

        <!-- El formulario enviará los datos a guardar.php mediante el método POST -->
        <form action="guardar.php" method="POST" style="max-width: 500px;">

            <!--Nombre-->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la Materia</label>
                <input type="text" class="form-control" name="nombre" id="nombre" required maxlength="100"
                    placeholder="Ingresa la materia.">
            </div>

            <!--Año de la materia segun el plan de estudios-->
            <div class="mb-3">
                <label for="anio" class="form-label">Año</label>
                <select name="anio" id="anio" class="form-select">
                    <option value="">Seleccione el año</option>
                    <option value="1">1° Año</option>
                    <option value="2">2° Año</option>
                    <option value="3">3° Año</option>
                    <option value="4">4° Año</option>
                    <option value="5">5° Año</option>
                    <option value="6">6° Año</option>
                    <option value="7">7° Año</option>
                </select>
            </div>

            <!--Estado-->
            <div class="mb-3">
                <label for="idEstado" class="form-label">Estado</label>
                <select class="form-select" name="idEstado" id="idEstado" required>
                    <option value="">Seleccione un estado</option>
                    <?php
                    // Recorremos los estados y creamos una opción por cada uno
                    while ($estado = mysqli_fetch_assoc($resultado_estados)) {
                        echo "<option value= '{$estado['idEstado']}'>{$estado['est_nombre']}</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Guardar Materia</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>

        </form>
    </div>

</body>

</html>