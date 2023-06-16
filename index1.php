<!DOCTYPE html>
<html>
<head>
    <title>Registro Cargo</title>
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

        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registro Cargo</h1>

        <form action="create1.php" method="POST">
            <div class="form-group">
                <label>Nombre:</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Sueldo:</label>
                <input type="number" step="0.01" name="sueldo" class="form-control" required>
            </div>

            <div class="form-group">
                <input type="submit" value="Agregar Cargo" class="btn btn-primary">
            </div>
        </form>

        <h2>Lista de Cargos</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Sueldo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Incluir el archivo de conexión
                include 'conexion.php';

                // Obtener los cargos de la base de datos
                $sql = "SELECT * FROM cargo";
                $result = mysqli_query($conexion, $sql);

                // Verificar si se encontraron cargos
                if (mysqli_num_rows($result) > 0) {
                    // Recorrer los cargos y mostrarlos en la tabla
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$row['CarNombre']."</td>";
                        echo "<td>".$row['CarSueldo']."</td>";
                        echo "<td class='table-actions'>
                                <a href='update1.php?id=".$row['IdCargo']."' class='btn btn-primary'>Editar</a>
                                <a href='delete1.php?id=".$row['IdCargo']."' class='btn btn-danger'>Eliminar</a>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No se encontraron cargos.</td></tr>";
                }

                // Cerrar la conexión
                mysqli_close($conexion);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
