<?php

if(isset($_GET["boton1"])) {
  
   $dato1 = $_GET["boton1"]; // http://localhost/insertar.php?boton1=0&TIEMPO1=38&&TIEMPO2=38&&TIEMPO3=38&&TIEMPO4=38  Para meter datos a la base de datos
   $dato2 = $_GET["TIEMPO1"]; // 
   $dato3 = $_GET["TIEMPO2"]; 
   $dato4 = $_GET["TIEMPO3"];
   $dato5 = $_GET["TIEMPO4"];
   $servername = "localhost";
   $username = "root";
   $password = "";
   $database_name = "secuencios_lde";
   

   // Create MySQL connection fom PHP to MySQL server
   $connection = new mysqli($servername, $username, $password, $database_name);
   // Check connection
   if ($connection->connect_error) {
      die("MySQL connection failed: " . $connection->connect_error);
   }

   //$sql = "INSERT INTO esp32 (boton1,boton2) VALUES ('$dato1','$dato2')";

   $sql = "INSERT INTO reaccion (APAGLED1,APAGLED2,APAGLED3,APAGLED4) VALUES ('$dato2','$dato3','$dato4','$dato5')";

   if ($connection->query($sql) === TRUE) {
      echo "DATOS CORRECTAMENTE ALMACENADOS";
   } else {
      echo "Error: " . $sql . " => " . $connection->error;
   }

   $connection->close();
} else {
   echo "NO ESTA EN LA SOLICITUD";
}

echo "DATO CORRECTAMENTE ENVIADO";
?>
