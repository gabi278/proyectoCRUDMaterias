<?php
include 'conexion.php';

// Tuve que hacer un join porque la columna idEstado de la tabla materias, es un int,
// y el nombre correspondiente al estado esta en la tabla estados.
$sql = "SELECT m.idMateria, m.mat_nombre AS mat_nombre, m.mat_anio, e.est_nombre AS est_nombre 
        FROM materias m
        INNER JOIN estados e ON m.idEstado = e.idEstado
        WHERE m.mat_activo = 1;";
$resultado = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width = device-width, initial-scale=1.0">
    <title>CRUD Materias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Listado de Materias</h1>


        <a href="formulario.php" class="btn btn-primary mb-3">Agregar Nueva Materia</a>
        <br><br>

        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Materia</th>
                    <th>Año</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Vamos sacando filas de los resultados que obtuvimos con la consulta anterior.
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo "<td>" . $fila['idMateria'] . "</td>";
                    echo "<td>" . $fila['mat_nombre'] . "</td>";
                    echo "<td>" . $fila['mat_anio'] . "</td>";
                    echo "<td>" . $fila['est_nombre'] . "</td>";
                    // Aquí pondremos los botones de Editar y Eliminar más adelante
                    echo "<td>";
                    echo "<a href='editar.php?id={$fila['idMateria']}' class='btn btn-warning btn-sm me-2'>Editar</a>    ";
                    echo "<a href='eliminar.php?id={$fila['idMateria']}' class='btn btn-danger btn-sm'>Eliminar</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

    </div>

</body>

</html>