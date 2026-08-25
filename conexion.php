<?php
$conn = mysqli_connect("localhost", "root", "", "alumnos");
if(!$conn){
    die("Conexion fallida: " . my_sqli_connect_error());
}
//echo "Conexion exitosa";

?>