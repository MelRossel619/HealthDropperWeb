<?php
// localhost/insertporcent.php?dato3=15
if(isset($_GET["dato3"])) {
  
   $dato3 = $_GET["dato3"];
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
   $ultd4_query = "SELECT Porcentajecama2 FROM completado ORDER BY id DESC LIMIT 1";
   $result = $connection->query($ultd4_query);
   
   // Verificar si se encontró un resultado
   if ($result->num_rows > 0) {
       // Obtener el valor de Porcentajecama2
       $row = $result->fetch_assoc();
       $ultd4 = $row["Porcentajecama2"];
   } else {
       // Si no se encontró ningún resultado, asignar un valor predeterminado o manejar el caso según sea necesario
       $ultd4 = 0; // Por ejemplo, podrías establecerlo en 0
   }

   // Preparar la consulta SQL con los valores obtenidos
   $sql = "INSERT INTO completado (Porcentajecama1, Porcentajecama2) VALUES ('$dato3', '$ultd4')";

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