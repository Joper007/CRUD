<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $idUsuario = $_GET['id'];

    $sql = "SELECT u.IdUsuario, u.UsuLogin, e.EmpNombre 
            FROM usuario u
            INNER JOIN empleado e ON u.UsuLogin = e.EmpIdentifiacion
            WHERE u.IdUsuario = $idUsuario";
    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) === 1) {
        $row = mysqli_fetch_assoc($resultado);
        $login = $row['UsuLogin'];
        $empleado = $row['EmpNombre'];
    } else {
        header('Location: index3.php');
        exit();
    }
} else {
    header('Location: index3.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $empleado = $_POST['empleado'];

    $sql = "UPDATE usuario SET UsuLogin = '$login' WHERE IdUsuario = $idUsuario";
    mysqli_query($conexion, $sql);

    // Actualizar relación entre usuario y empleado
    $sql = "UPDATE empleado SET EmpUsuario = '$login' WHERE EmpNombre = '$empleado'";
    mysqli_query($conexion, $sql);

    header('Location: index3.php');
    exit();
}

$sql = "SELECT EmpIdentifiacion, EmpNombre FROM empleado";
$resultado = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        form {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form label {
            display: block;
            margin-bottom: 5px;
        }

        form input[type="text"],
        form select {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Editar Usuario</h1>

    <div class="container">
        <form action="" method="POST">
            <label>Login:</label>
            <input type="text" name="login" value="<?php echo $login; ?>" required><br>

            <label>Empleado:</label>
            <select name="empleado" required>
                <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>
                    <option value="<?php echo $row['EmpNombre']; ?>" <?php echo $row['EmpNombre'] === $empleado ? 'selected' : ''; ?>><?php echo $row['EmpNombre']; ?></option>
                <?php } ?>
            </select><br>

            <input type="submit" value="Actualizar Usuario">
        </form>
    </div>
</body>
</html>
