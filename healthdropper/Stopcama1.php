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

// Function to get the last interruption ID
function getLastInterruptionId($connection) {
    $sql = "SELECT id FROM interrupciones ORDER BY id DESC LIMIT 1";
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['id'];
    } else {
        return null;
    }
}

// Initial last interruption ID
$lastInterruptionId = getLastInterruptionId($connection);

while (true) {
    sleep(1); // Wait for 1 second before checking again

    $currentInterruptionId = getLastInterruptionId($connection);

    if ($currentInterruptionId !== $lastInterruptionId) {
        echo "STOP";
        break;
    }
}

$connection->close();
?>
