<?php
// localhost/insertporcent2.php?dato4=30
if(isset($_GET["dato4"])) {
  
   $dato4 = $_GET["dato4"];
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

   // Obtener el último valor de Porcentajecama2
   $ultd3_query = "SELECT Porcentajecama1 FROM completado ORDER BY id DESC LIMIT 1";
   $result = $connection->query($ultd3_query);
   
   // Verificar si se encontró un resultado
   if ($result->num_rows > 0) {
       // Obtener el valor de Porcentajecama2
       $row = $result->fetch_assoc();
       $ultd3 = $row["Porcentajecama1"];
   } else {
       // Si no se encontró ningún resultado, asignar un valor predeterminado o manejar el caso según sea necesario
       $ultd3 = 0; // Por ejemplo, podrías establecerlo en 0
   }

   // Preparar la consulta SQL con los valores obtenidos
   $sql = "INSERT INTO completado (Porcentajecama1, Porcentajecama2) VALUES ('$ultd3', '$dato4')";

   if ($connection->query($sql) === TRUE) {
      echo "DATOS CORRECTAMENTE ALMACENADOS";
   } else {
      echo "Error: " . $sql . " => " . $connection->error;
   }

   $connection->close();
}
else {
   echo "SENSOR NO ESTA EN LA SOLICITUD";
}

echo "ACCESO A SERVIDOR EXITOSO";
?>