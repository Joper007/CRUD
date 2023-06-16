<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $empleado = $_POST['empleado'];

    $sql = "INSERT INTO usuario (UsuLogin, UsuPassword) VALUES ('$login', '$password')";
    mysqli_query($conexion, $sql);

    // Relacionar usuario con empleado
    $sql = "UPDATE empleado SET EmpUsuario = '$login' WHERE EmpIdentifiacion = '$empleado'";
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
    <title>Agregar Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('imagenes/fondo2.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }

        .container {
            margin-top: 100px;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 30px;
            border-radius: 10px;
        }

        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <h1>Agregar Usuario</h1>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="login">Login:</label>
                        <input type="text" name="login" id="login" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="empleado">Empleado:</label>
                        <select name="empleado" id="empleado" class="form-control" required>
                            <option value="">Seleccionar</option>
                            <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>
                                <option value="<?php echo $row['EmpIdentifiacion']; ?>"><?php echo $row['EmpNombre']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Agregar Usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>