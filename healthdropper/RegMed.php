<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Medicamentos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('imgs/background.png');
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f4f4f4;
        }

        form {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        form input, form button {
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form button {
            background-color: #4caf50;
            color: white;
            border: none;
        }

        .delete-btn {
            color: white;
            background-color: #f44336;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .update-btn {
            color: white;
            background-color: #2196F3;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Registro de Medicamentos</h1>
    
    <form method="POST" action="">
        <input type="text" name="Nombre" placeholder="Nombre del medicamento" required>
        <input type="number" name="FactorGoteo" placeholder="Factor de Goteo" required>
        <input type="text" name="Observaciones" placeholder="Observaciones" required>
        <button type="submit" name="create">Agregar Medicamento</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Factor de Goteo</th>
                <th>Observaciones</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Conexión a la base de datos
            $conn = new mysqli('localhost', 'root', '', 'centraldemonit');

            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Crear
            if (isset($_POST['create'])) {
                $Nombre = $conn->real_escape_string($_POST['Nombre']);
                $FactorGoteo = $conn->real_escape_string($_POST['FactorGoteo']);
                $Observaciones = $conn->real_escape_string($_POST['Observaciones']);
                $sql = "INSERT INTO meds (Nombre, FactorGoteo, Observaciones) VALUES ('$Nombre', '$FactorGoteo', '$Observaciones')";
                $conn->query($sql);
            }

            // Leer
            $sql = "SELECT * FROM meds";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['ID']}</td>
                            <td>{$row['Nombre']}</td>
                            <td>{$row['FactorGoteo']}</td>
                            <td>{$row['Observaciones']}</td>
                            <td>
                                <form method='POST' action='' style='display:inline;'>
                                    <input type='hidden' name='ID' value='{$row['ID']}'>
                                    <button type='submit' name='delete' class='delete-btn'>Eliminar</button>
                                </form>
                                <form method='POST' action='' style='display:inline;'>
                                    <input type='hidden' name='ID' value='{$row['ID']}'>
                                    <input type='text' name='new_Nombre' placeholder='Nuevo nombre' required>
                                    <input type='number' name='new_FactorGoteo' placeholder='Nuevo factor' required>
                                    <input type='text' name='new_Observaciones' placeholder='Nuevas observaciones' required>
                                    <button type='submit' name='update' class='update-btn'>Actualizar</button>
                                </form>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No hay medicamentos registrados</td></tr>";
            }

            // Eliminar
            if (isset($_POST['delete'])) {
                $ID = $conn->real_escape_string($_POST['ID']);
                $sql = "DELETE FROM meds WHERE ID='$ID'";
                $conn->query($sql);
            }

            // Actualizar
            if (isset($_POST['update'])) {
                $ID = $conn->real_escape_string($_POST['ID']);
                $new_Nombre = $conn->real_escape_string($_POST['new_Nombre']);
                $new_FactorGoteo = $conn->real_escape_string($_POST['new_FactorGoteo']);
                $new_Observaciones = $conn->real_escape_string($_POST['new_Observaciones']);
                $sql = "UPDATE meds SET Nombre='$new_Nombre', FactorGoteo='$new_FactorGoteo', Observaciones='$new_Observaciones' WHERE ID='$ID'";
                $conn->query($sql);
            }

            // Recargar la página para reflejar cambios
            if (isset($_POST['create']) || isset($_POST['delete']) || isset($_POST['update'])) {
                echo "<script>window.location.href=window.location.href;</script>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
