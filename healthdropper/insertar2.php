<?php

if(isset($_GET["dato1"])) {
  
   $dato1 = $_GET["dato1"]; // localhost/insertar2.php?dato1=619&dato2=60&dato3=1
   $dato2 = $_GET["dato2"];
   $dato3 = $_GET["dato3"]; //
   $servername = "localhost";
   $username = "root";
   $password = "";
   $database_name = "centraldemonit";
   
   

   // Create MySQL connection fom PHP to MySQL server
   $connection = new mysqli($servername, $username, $password, $database_name);
   // Check connection
   if ($connection->connect_error) {
      die("MySQL connection failed: " . $connection->connect_error);
   }

   $sql = "INSERT INTO datos (Dosis,Flujo,Cama) VALUES ('$dato1','$dato2','$dato3')";

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
