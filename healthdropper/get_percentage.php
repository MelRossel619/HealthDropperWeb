<?php

$servername = "localhost";
$username = "root";
$password = "";
$database_name = "centraldemonit";

// Crear conexión MySQL desde PHP al servidor MySQL
$connection = new mysqli($servername, $username, $password, $database_name);

// Verificar conexión
if ($connection->connect_error) {
    die("Conexión MySQL fallida: " . $connection->connect_error);
}

// Consulta SQL para obtener el último dato de la columna PORCENTAJE
$sqlporcent = "SELECT Porcentajecama1 FROM completado ORDER BY id DESC LIMIT 1";
$resultporcent = $connection->query($sqlporcent);

$porcentaje = 0;

if ($resultporcent->num_rows > 0) {
    $rowporcent = $resultporcent->fetch_assoc();
    $porcentaje = $rowporcent["Porcentajecama1"];
}

$connection->close();

echo json_encode(['Porcentajecama1' => $porcentaje]);
?>
