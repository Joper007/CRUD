<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si se recibió el ID del cargo a eliminar
if (isset($_GET['id'])) {
    $idCargo = $_GET['id'];

    // Eliminar el cargo de la base de datos
    $sql = "DELETE FROM cargo WHERE IdCargo = $idCargo";
    mysqli_query($conexion, $sql);
}

// Cerrar la conexión
mysqli_close($conexion);

// Redireccionar al index.php después de eliminar
header('Location: index1.php');
exit();