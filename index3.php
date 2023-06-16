<?php
include 'conexion.php';

$sql = "SELECT u.IdUsuario, u.UsuLogin, e.EmpNombre 
        FROM usuario u
        INNER JOIN empleado e ON u.UsuLogin = e.EmpIdentifiacion";
$resultado = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tabla Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to bottom, #ffffff, #e6e6e6);
            background-image: url('imagenes/fondo2.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }

        .container {
            margin-top: 50px;
            max-width: 600px;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 8px;
            border: 1px solid #ccc;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tr:hover {
            background-color: #eaeaea;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tabla Usuario</h1>

        <a href="create3.php" class="btn btn-primary">Agregar Usuario</a>
        <br><br>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Login</th>
                    <th>Empleado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>
                    <tr>
                        <td><?php echo $row['IdUsuario']; ?></td>
                        <td><?php echo $row['UsuLogin']; ?></td>
                        <td><?php echo $row['EmpNombre']; ?></td>
                        <td class="text-center">
                            <a href="update3.php?id=<?php echo $row['IdUsuario']; ?>" class="btn btn-primary">Editar</a>
                            <a href="delete3.php?id=<?php echo $row['IdUsuario']; ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
