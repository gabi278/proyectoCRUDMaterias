<?php require __DIR__ . "/../layouts/header.php"; ?>

    <div class="container mt-5">
        <h2 class="mb-4">Agregar Nueva Materia</h2>

        <!--  -->
        <form action="index.php?action=guardar" method="POST" style="max-width: 500px;">

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
                    // Tengo que crear un nuevo modelo Estado ?
                    foreach($estados as $estado) {
                        echo "<option value= '{$estado['idEstado']}'>{$estado['est_nombre']}</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Guardar Materia</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>

        </form>
    </div>





<?php require __DIR__ . "/../layouts/footer.php"; ?>