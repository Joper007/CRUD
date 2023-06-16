<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Obtener el ID del empleado a eliminar
if (isset($_GET['id'])) {
    $idEmpleado = $_GET['id'];

    // Eliminar el empleado de la base de datos
    $sql = "DELETE FROM empleado WHERE IdEmpleado = $idEmpleado";
    mysqli_query($conexion, $sql);
}

// Redireccionar al index.php después de eliminar
header('Location: index2.php');
exit();
?>