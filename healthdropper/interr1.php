<?php
$servername = "localhost";
$username = "root";
$password = "";
$database_name = "centraldemonit";

// Create MySQL connection from PHP to MySQL server
$connection = new mysqli($servername, $username, $password, $database_name);

// Check connection
if ($connection->connect_error) {
    die("MySQL connection failed: " . $connection->connect_error);
}

$sqlDosis = "SELECT Dosis FROM datos ORDER BY id DESC LIMIT 1";
$resultDosis = $connection->query($sqlDosis);

$response = [];  
if ($resultDosis->num_rows > 0) {
    $rowDosis = $resultDosis->fetch_assoc();
    $dosisValue = $rowDosis["Dosis"];
    $response['DOSIS'] = $dosisValue;
    
    // Insert the Dosis value into the interrupciones table
    $sqlInterr = "INSERT INTO interrupciones (Dosis,Cama) VALUES ('$dosisValue','1')";
    if ($connection->query($sqlInterr) === TRUE) {
        $response['status'] = "Dosis almacenada correctamente en interrupciones.";
    } else {
        $response['status'] = "Error al almacenar la dosis en interrupciones: " . $connection->error;
    }
} else {
    $response['DOSIS'] = null;
    $response['status'] = "No hay datos en la tabla datos para DOSIS.";
}

$connection->close();
echo json_encode($response);
?>
