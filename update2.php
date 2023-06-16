<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Obtener el ID del empleado a editar
if (isset($_GET['id'])) {
    $idEmpleado = $_GET['id'];

    // Obtener los datos del empleado de la base de datos
    $sql = "SELECT * FROM empleado WHERE IdEmpleado = $idEmpleado";
    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) === 1) {
        $row = mysqli_fetch_assoc($resultado);
        $identificacion = $row['EmpIdentifiacion'];
        $nombre = $row['EmpNombre'];
        $fechaIngreso = $row['EmpFechaIngreso'];
        $correo = $row['EmpCorreo'];
        $genero = $row['EmpGenero'];
        $cargo = $row['EmpCargo'];
    } else {
        // No se encontró el empleado, redireccionar al index.php
        header('Location: index2.php');
        exit();
    }
} else {
    // No se proporcionó un ID de empleado, redireccionar al index.php
    header('Location: index2.php');
    exit();
}

// Obtener todos los cargos disponibles
$sqlCargos = "SELECT * FROM cargo";
$resultadoCargos = mysqli_query($conexion, $sqlCargos);

// Verificar si se envió el formulario de actualización
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identificacion = $_POST['identificacion'];
    $nombre = $_POST['nombre'];
    $fechaIngreso = $_POST['fecha_ingreso'];
    $correo = $_POST['correo'];
    $genero = $_POST['genero'];
    $cargo = $_POST['cargo'];

    // Actualizar los datos del empleado en la base de datos
    $sql = "UPDATE empleado SET EmpIdentifiacion = '$identificacion', EmpNombre = '$nombre', EmpFechaIngreso = '$fechaIngreso', EmpCorreo = '$correo', EmpGenero = '$genero', EmpCargo = $cargo WHERE IdEmpleado = $idEmpleado";
    mysqli_query($conexion, $sql);

    // Redireccionar al index.php después de actualizar
    header('Location: index2.php');
    exit();
}

// Cerrar la conexión
mysqli_close($conexion);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Empleado</title>
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
        form input[type="date"],
        form input[type="email"] {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

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
    <h1>Editar Empleado</h1>

    <div class="container">
        <form action="" method="POST">
            <label>Identificación:</label>
            <input type="text" name="identificacion" value="<?php echo $identificacion; ?>" required><br>

            <label>Nombre:</label>
            <input type="text" name="nombre" value="<?php echo $nombre; ?>" required><br>

            <label>Fecha de Ingreso:</label>
            <input type="date" name="fecha_ingreso" value="<?php echo $fechaIngreso; ?>" required><br>

            <label>Correo:</label>
            <input type="email" name="correo" value="<?php echo $correo; ?>" required><br>

            <label>Género:</label>
            <select name="genero" required>
                <option value="Masculino"<?php if ($genero === 'Masculino') { echo ' selected'; } ?>>Masculino</option>
                <option value="Femenino"<?php if ($genero === 'Femenino') { echo ' selected'; } ?>>Femenino</option>
            </select><br>

            <label>Cargo:</label>
            <select name="cargo" required>
                <?php while ($rowCargo = mysqli_fetch_assoc($resultadoCargos)) { ?>
                    <option value="<?php echo $rowCargo['IdCargo']; ?>"<?php if ($cargo === $rowCargo['IdCargo']) { echo ' selected'; } ?>><?php echo $rowCargo['CarNombre']; ?></option>
                <?php } ?>
            </select><br>

            <input type="submit" value="Actualizar Empleado">
        </form>
    </div>
</body>
</html>
