<?php
// Conexión a la base de datos
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'centraldemonit';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT ID, Nombre FROM meds";
$result = $conn->query($sql);

$medicamentos = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $medicamentos[] = $row;
    }
}

$conn->close();

// Devolver en formato JSON
header('Content-Type: application/json');
echo json_encode($medicamentos);
?>
