<?php require __DIR__ . ("/../layouts/header.php") ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">

                <div class="card-header bg-dark text-white text-center py-3">
                    <h4 class="mb-0">Iniciar Sesión</h4>
                </div>

                <div class="card-body p-4">
                    <!-- Msj de error -->
                    <?php if (isset($_SESSION['login_error'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= htmlspecialchars($_SESSION['login_error']) ?>
                        </div>
                        <?php //Borramos el error para que no aparezca si recargamos la pagina.
                            unset($_SESSION['login_error']);
                        ?>
                    <?php endif; ?>

                    <form method="POST" action="index.php?action=login">

                    <!-- El atributo name es lo que llega por el post!!! -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control" name="email" required
                                placeholder="correo@ejemplo.com">
                        </div>

                        
                        <div class="mb-4">
                            <label for="password" class="form-label">Contraseña</label>
                            <input id="password" type="password" class="form-control" name="password" required
                                placeholder="********">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Ingresar</button>
                    </form>
                </div>

                
                <div class="card-footer bg-light p-3 text-center text-muted small">
                    <strong>Datos de prueba:</strong><br>
                    Usuario: juan@gmail.com / 123456<br>
                    Administrador: admin@gmail.com / 123456
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    //Funcion para que el msj de error desaparezca luego de 3 segundos
    document.addEventListener("DOMContentLoaded", function(){
        const alerta = document.querySelector('.alert');
        if(alerta){
            function borrarElemento(){
                //Eliminamos la etiqueta div del error en el html
                alerta.remove();
            }
            function desvanecerAlerta(){
                //Animacion que hace que el msj de error se desvanezca
                alerta.style.transition = "opacity 0.5s ease";
                alerta.style.opacity = "0";

                setTimeout(borrarElemento, 500);
            }
            setTimeout(desvanecerAlerta, 3000);
        }
    })
</script>
<?php require __DIR__ . ("/../layouts/footer.php") ?>