<?php

if(isset($_GET["dato1"])) {
  
   $dato1 = $_GET["dato1"]; // 
   $dato2 = $_GET["dato2"]; // 
   $servername = "localhost";
   $username = "root";
   $password = "";
   $database_name = "dashboard";
   
   

   // Create MySQL connection fom PHP to MySQL server
   $connection = new mysqli($servername, $username, $password, $database_name);
   // Check connection
   if ($connection->connect_error) {
      die("MySQL connection failed: " . $connection->connect_error);
   }

   $sql = "INSERT INTO sensor (dato1,dato2) VALUES ('$dato1','$dato2')";

   if ($connection->query($sql) === TRUE) {
      echo "DATOS CORRECTAMENTE ALMACENADOS";
   } else {
      echo "Error: " . $sql . " => " . $connection->error;
   }

   $connection->close();
} else {
   echo "SENSOR NO ESTA EN LA SOLICITUD";
}

echo "ACCESO A SERVIDOR EXITOSO";
?>
