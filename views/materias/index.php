<?php require __DIR__ . "/../layouts/header.php"; ?>
<div class="container mt-5">
    <h1 class="text-center mb-4">Listado de Materias</h1>


    <a href="index.php?action=crear" class="btn btn-primary mb-3">Agregar Nueva Materia</a>
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
            foreach ($materias as $materia) {
                echo "<tr>";
                echo "<td>" . $materia['idMateria'] . "</td>";
                echo "<td>" . $materia['mat_nombre'] . "</td>";
                echo "<td>" . $materia['mat_anio'] . "</td>";
                echo "<td>" . $materia['est_nombre'] . "</td>";
                // botones para eliminar y editar.
                echo "<td>";
                echo "<a href='index.php?action=editar&id={$materia['idMateria']}' class='btn btn-warning btn-sm me-2'>Editar</a>    ";
                echo "<a href='index.php?action=eliminar&id={$materia['idMateria']}' class='btn btn-danger btn-sm'>Eliminar</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</div>
<?php require __DIR__ . "/../layouts/footer.php"; ?>