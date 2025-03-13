<?php
// Configuración de conexión a la base de datos
$servername = "localhost"; // Cambiar según la configuración
$username = "root";        // Usuario de la base de datos
$password = "";            // Contraseña de la base de datos
$dbname = "centraldemonit"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener los pacientes
$sql = "SELECT nombre, apellido FROM pacientes";
$result = $conn->query($sql);

// Crear arreglo para almacenar los pacientes
$pacientes = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pacientes[] = $row;
    }
}

// Devolver los datos como JSON
header('Content-Type: application/json');
echo json_encode($pacientes);

// Cerrar conexión
$conn->close();
?>
