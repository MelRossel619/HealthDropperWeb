<?php

$servername = "localhost";
$username = "root";
$password = "";
$database_name = "healthdropper";

// Create MySQL connection from PHP to MySQL server
$connection = new mysqli($servername, $username, $password, $database_name);

// Check connection
if ($connection->connect_error) {
    die("MySQL connection failed: " . $connection->connect_error);
}

// Consulta SQL para obtener el último dato de la columna DOSIS
$sqlDosis = "SELECT DOSIS FROM fechasesp ORDER BY id DESC LIMIT 1";

$resultDosis = $connection->query($sqlDosis);

$response = "";

if ($resultDosis->num_rows > 0) {
    $rowDosis = $resultDosis->fetch_assoc();
    $response .= "DOSIS SUMINISTRADA: " . $rowDosis["DOSIS"] . "<br>";
} else {
    $response .= "No hay datos en la tabla fechasesp para DOSIS<br>";
}

// Consulta SQL para obtener el último dato de la columna FechaFinalizacion
$sqlFechaFinalizacion = "SELECT FechaFinalizacion FROM fechasesp ORDER BY id DESC LIMIT 1";

$resultFechaFinalizacion = $connection->query($sqlFechaFinalizacion);

if ($resultFechaFinalizacion->num_rows > 0) {
    $rowFechaFinalizacion = $resultFechaFinalizacion->fetch_assoc();
    $response .= "Fecha: " . $rowFechaFinalizacion["FechaFinalizacion"] . "<br>";
} else {
    $response .= "No hay datos en la tabla fechasesp para FechaFinalizacion<br>";
}

// Consulta SQL para obtener el penúltimo dato de la columna HoraInicializacion
$sqlPenultimoHoraInicializacion = "SELECT HoraInicializacion FROM fechasesp ORDER BY id DESC LIMIT 1 OFFSET 1";

$resultPenultimoHoraInicializacion = $connection->query($sqlPenultimoHoraInicializacion);

if ($resultPenultimoHoraInicializacion->num_rows > 0) {
    $rowPenultimoHoraInicializacion = $resultPenultimoHoraInicializacion->fetch_assoc();
    $response .= "Hora de inicio: " . $rowPenultimoHoraInicializacion["HoraInicializacion"] . "<br>";
} else {
    $response .= "No hay datos en la tabla fechasesp para la penúltima HoraInicializacion<br>";
}

// Consulta SQL para obtener el último dato de la columna HoraInicializacion
$sqlUltimoHoraInicializacion = "SELECT HoraInicializacion FROM fechasesp ORDER BY id DESC LIMIT 1";

$resultUltimoHoraInicializacion = $connection->query($sqlUltimoHoraInicializacion);

if ($resultUltimoHoraInicializacion->num_rows > 0) {
    $rowUltimoHoraInicializacion = $resultUltimoHoraInicializacion->fetch_assoc();
    $response .= "Hora de finalizacion: " . $rowUltimoHoraInicializacion["HoraInicializacion"] . "<br>";
} else {
    $response .= "No hay datos en la tabla fechasesp para la última HoraInicializacion<br>";
}


$connection->close();

echo json_encode([
    'DOSIS' => $rowDosis["DOSIS"],
    'FechaFinalizacion' => $rowFechaFinalizacion["FechaFinalizacion"],
    'UltimaHoraInicio' => $rowUltimoHoraInicializacion["HoraInicializacion"],
    'PenultimaHoraInicio' => $rowPenultimoHoraInicializacion["HoraInicializacion"]
]);
?>
    