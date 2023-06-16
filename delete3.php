<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $idUsuario = $_GET['id'];

    $sql = "DELETE FROM usuario WHERE IdUsuario = $idUsuario";
    mysqli_query($conexion, $sql);
}

header('Location: index3.php');
exit();
?>
