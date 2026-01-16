<?php
$host = "Localhost";
$user = "root";
$password = "";
$basededatos = "db_bibliotecaV";

$conexion = mysqli_connect($host, $user, $password, $basededatos);
if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}
?>