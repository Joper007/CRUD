<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si se envió el formulario de creación
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $sueldo = $_POST['sueldo'];

    // Insertar el nuevo cargo en la base de datos
    $sql = "INSERT INTO cargo (CarNombre, CarSueldo) VALUES ('$nombre', '$sueldo')";
    mysqli_query($conexion, $sql);
}

// Cerrar la conexión
mysqli_close($conexion);

// Redireccionar al index.php después de cargar
header('Location: index1.php');
exit();