<?php require __DIR__ . "/../layouts/header.php"; ?>
<div class="container mt-5">
        <h2 class="mb-4">Editar Materia</h2>

        <!-- actualizar va a ser el metodo que tengo que agregar en el controlador de Materia-->
        <form action="index.php?action=actualizar" method="POST" style="max-width: 500px;">

            <!-- Pasamos el id de la materia a actualizar para poder traer sus datos. -->
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
                    foreach($estados as $estado) {
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
<?php require __DIR__ . "/../layouts/footer.php"; ?>