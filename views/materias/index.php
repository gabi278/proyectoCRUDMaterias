<?php require __DIR__ . "/../layouts/header.php"; ?>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-center mb-4">Listado de Materias</h1>
        <div>
            <span class="me-3">Bienvenido <strong><?= htmlspecialchars($_SESSION['usuario_nombre'])?></strong></span>
            <a href="index.php?action=logout" class="btn btn-outline-danger btn-sm">Cerrar sesión</a>
        </div>
    </div>


    <?php if(isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] === 'admin'): ?>
    <a href="index.php?action=crear" class="btn btn-primary mb-3">Agregar Nueva Materia</a>
    <br><br>
    <?php endif; ?>
    <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Materia</th>
                <th>Año</th>
                <th>Estado</th>
                <?php if(isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] === 'admin'): ?>
                <th>Acciones</th>
                <?php endif; ?>
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
                if(isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] === 'admin'){
                    echo "<td>";
                    echo "<a href='index.php?action=editar&id={$materia['idMateria']}' class='btn btn-warning btn-sm me-2'>Editar</a>    ";
                    echo "<a href='index.php?action=eliminar&id={$materia['idMateria']}' class='btn btn-danger btn-sm'>Eliminar</a>";
                    echo "</td>";
    
                }
                echo "</tr>";
           }
            ?>
        </tbody>
    </table>

</div>
<?php require __DIR__ . "/../layouts/footer.php"; ?>