<?php
$conn = mysqli_connect("localhost", "root", "", "alumnos");
$conn = new mysqli("localhost", "root", "", "alumnos");
if($conn->connect_error){
    die("Conexion fallida: " . $conn->connect_error);
}
//echo "Conexion exitosa";

?>