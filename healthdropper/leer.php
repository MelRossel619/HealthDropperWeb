<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "centraldemonit";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT dosis, FROM interrupciones ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  echo "STOP"
} else {
  echo "NO SE ENCONTRARON RESULTADOS";
}

mysqli_close($conn);
?>