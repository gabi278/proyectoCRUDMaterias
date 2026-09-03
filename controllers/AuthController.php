<?php
require_once("../models/Usuario.php");

class AuthController
{
    private $modeloUsuario;
    //Lo que tengo que hacer es verificar que el usuario y contraseña ingresados sean correctos, y tambien verificar cual es el rol que tiene el usuario que ingresa.
    //Tambien manejar el caso en el que no exista usuario y/o la contraseña no es correcta.
    public function __construct($conexion)
    {
        $this->modeloUsuario = new Usuario($conexion);
    }

    public function mostrarLogin()
    {
        //Es una variable de sesion, en ella podemos guardar info de variables de sesion.
        //Para utilizarla tenemos que utilizar session_start().
        if (isset($_SESSION['usuario_rol']))
        {
            header("Location: index.php");
            exit();
        }
        require_once("../views/auth/login.php");
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $email = trim($_POST["email"]);
            $pwd = $_POST["password"];

            //Traemos datos del usuario dado el mail
            $usuario = $this->modeloUsuario->obtenerUsuarioPorEmail($email);
            if (!$usuario || !password_verify($pwd, $usuario['password']))
            {
                $_SESSION['login_error'] = 'Email o contraseña incorrectos.';
                header('Location: ?action=login');
                exit();
            }

            session_regenerate_id(true);
            $_SESSION['usuario_id'] = $usuario['user_id'];
            $_SESSION['usuario_rol'] = $usuario['rol'];
            $_SESSION['usuario_nombre'] = $usuario['firstname'];
            header('Location: ?action=index');
            exit();
        }
    }

    public function logout(){
        $_SESSION = []; //Vaciamos la variable sesion

        if (ini_get('session.use_cookies')){
            $params = session_get_cookie_params(); //obtiene la configuracion actual de la cookie.
            //Sobreescribimos la cookie, la vaciamos, ponemos una fecha de expiración. La elimina debido al time(), y para 
            //encontrarla utiliza los valores de params que indicamos ahi.
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();

        header('Location: ?action=login');
        exit;
    }
}



















?>