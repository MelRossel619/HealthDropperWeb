<?php

$servername = "localhost";
$username = "root";
$password = "";
$database_name = "centraldemonit"; //localhost/ultimodato2.php
// Create MySQL connection from PHP to MySQL server
$connection = new mysqli($servername, $username, $password, $database_name);

// Check connection
if ($connection->connect_error) {
    die("MySQL connection failed: " . $connection->connect_error);
}

// Consulta SQL para obtener el último dato de la columna PORCENTAJECAMA1
$sqlporcent = "SELECT Porcentajecama1 FROM completado ORDER BY id DESC LIMIT 1";
$resultporcent = $connection->query($sqlporcent);

$response = "";

if ($resultporcent->num_rows > 0) {
    $rowporcent = $resultporcent->fetch_assoc();
    $response .= "PORCENTAJE COMPLETADO: " . $rowporcent["Porcentajecama1"] . "<br>";
} else {
    $response .= "No hay datos en la tabla completado para Porcentaje<br>";
}
// Consulta SQL para obtener el último dato de la columna PORCENTAJECAMA2
$sqlporcent2 = "SELECT Porcentajecama2 FROM completado ORDER BY id DESC LIMIT 1";
$resultporcent2 = $connection->query($sqlporcent2);

$response2 = "";

if ($resultporcent2->num_rows > 0) {
    $rowporcent2 = $resultporcent2->fetch_assoc();
    $response2 .= "PORCENTAJE COMPLETADO: " . $rowporcent2["Porcentajecama2"] . "<br>";
} else {
    $response2 .= "No hay datos en la tabla completado para Porcentaje<br>";
}
// Consulta SQL para obtener el último dato de la columna HORA
$sqlHora = "SELECT Hora FROM completado ORDER BY id DESC LIMIT 1";
$resultHora = $connection->query($sqlHora);

$response = "";

if ($resultHora->num_rows > 0) {
    $rowHora = $resultHora->fetch_assoc();
    $response .= "HORA: " . $rowHora["Hora"] . "<br>";
} else {
    $response .= "No hay datos en la tabla completado para Hora<br>";
}

$connection->close();

echo json_encode([
    'Porcentajecama1' => $rowporcent["Porcentajecama1"],
    'Porcentajecama2' => $rowporcent2["Porcentajecama2"],
    'Hora' => $rowHora["Hora"],
]);
?>