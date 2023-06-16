<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Obtener todos los empleados de la base de datos
$sql = "SELECT * FROM empleado";
$resultado = mysqli_query($conexion, $sql);

// Cerrar la conexión
mysqli_close($conexion);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro Empleado</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: url('imagenes/fondo2.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="create2.php" method="POST">
            <h1 class="text-center mb-4">Registro Empleado</h1>

            <button type="submit" class="btn btn-primary mb-3">Agregar Empleado</button>

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Identificación</th>
                        <th>Nombre</th>
                        <th>Fecha de Ingreso</th>
                        <th>Correo</th>
                        <th>Género</th>
                        <th>Cargo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>
                        <tr>
                            <td><?php echo $row['IdEmpleado']; ?></td>
                            <td><?php echo $row['EmpIdentifiacion']; ?></td>
                            <td><?php echo $row['EmpNombre']; ?></td>
                            <td><?php echo $row['EmpFechaIngreso']; ?></td>
                            <td><?php echo $row['EmpCorreo']; ?></td>
                            <td><?php echo $row['EmpGenero']; ?></td>
                            <td><?php echo $row['EmpCargo']; ?></td>
                            <td>
                                <a href="update2.php?id=<?php echo $row['IdEmpleado']; ?>" class="btn btn-primary">Editar</a>
                                <a href="delete2.php?id=<?php echo $row['IdEmpleado']; ?>" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </form>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
                    }