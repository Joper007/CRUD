<?php
// Establecer la conexión a la base de datos.
$conexion = mysqli_connect("localhost", "root", "123", "company");

// Verificar la conexión.
if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}
?>
