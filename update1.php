<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si se recibió el ID del cargo a modificar
if (isset($_GET['id'])) {
    $idCargo = $_GET['id'];

    // Obtener los datos del cargo actual
    $sql = "SELECT * FROM cargo WHERE IdCargo = $idCargo";
    $result = mysqli_query($conexion, $sql);

    // Verificar si se encontró el cargo
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $nombre = $row['CarNombre'];
        $sueldo = $row['CarSueldo'];
    } else {
        // Redireccionar si no se encuentra el cargo
        header('Location: index1.php');
        exit();
    }
} else {
    // Redireccionar si no se recibió el ID del cargo
    header('Location: index1.php');
    exit();
}

// Verificar si se envió el formulario de actualización
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $sueldo = $_POST['sueldo'];

    // Actualizar los datos del cargo en la base de datos
    $sql = "UPDATE cargo SET CarNombre = '$nombre', CarSueldo = '$sueldo' WHERE IdCargo = $idCargo";
    mysqli_query($conexion, $sql);

    // Redireccionar a la página principal después de la actualización
    header('Location: index1.php');
    exit();
}

// Cerrar la conexión
mysqli_close($conexion);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Actualizar Cargo</title>
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
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form label {
            display: block;
            margin-bottom: 5px;
        }

        form input[type="text"],
        form input[type="number"] {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Actualizar Cargo</h1>

    <div class="container">
        <form action="" method="POST">
            <label>Nombre:</label>
            <input type="text" name="nombre" value="<?php echo $nombre; ?>" required><br>

            <label>Sueldo:</label>
            <input type="number" step="0.01" name="sueldo" value="<?php echo $sueldo; ?>" required><br>

            <input type="submit" value="Actualizar Cargo">
        </form>
    </div>
</body>
</html>
