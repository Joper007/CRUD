<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Obtener todos los cargos disponibles
$sqlCargos = "SELECT * FROM cargo";
$resultadoCargos = mysqli_query($conexion, $sqlCargos);

// Verificar si se envió el formulario de creación
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identificacion = $_POST['identificacion'];
    $nombre = $_POST['nombre'];
    $fechaIngreso = $_POST['fecha_ingreso'];
    $correo = $_POST['correo'];
    $genero = $_POST['genero'];
    $cargo = $_POST['cargo'];

    // Insertar el nuevo empleado en la base de datos
    $sql = "INSERT INTO empleado (EmpIdentifiacion, EmpNombre, EmpFechaIngreso, EmpCorreo, EmpGenero, EmpCargo) VALUES ('$identificacion', '$nombre', '$fechaIngreso', '$correo', '$genero', $cargo)";
    mysqli_query($conexion, $sql);

    // Redireccionar al index.php después de cargar
    header('Location: index2.php');
    exit();
}

// Cerrar la conexión
mysqli_close($conexion);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Empleado</title>
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
                <h1>Agregar Empleado</h1>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="identificacion">Identificación:</label>
                        <input type="text" name="identificacion" id="identificacion" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="fecha_ingreso">Fecha de Ingreso:</label>
                        <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="correo">Correo:</label>
                        <input type="email" name="correo" id="correo" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="genero">Género:</label>
                        <select name="genero" id="genero" class="form-control" required>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cargo">Cargo:</label>
                        <select name="cargo" id="cargo" class="form-control" required>
                            <?php while ($rowCargo = mysqli_fetch_assoc($resultadoCargos)) { ?>
                                <option value="<?php echo $rowCargo['IdCargo']; ?>"><?php echo $rowCargo['CarNombre']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Agregar Empleado</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
