<?php
//require('login.php');
session_start();
$cargo=$_SESSION['cargo'];
$nombre=$_SESSION['nombre'];
$usuario=$_SESSION['usuario'];
if(!isset($cargo)){
    header("location: index.html");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet"> 
    <title>HealthDropper</title>
    <style>
        body {
            font-family: 'Oswald', sans-serif;
            margin: 20px;
        }
        .datos-container {
            max-width: 600px;
            margin: 0 auto;
        }
        .datos-item {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="d-flex justify-content-center">
        <div class="centro">
            <h1 class="text-center">Healthdropper</h1>
            <div class="text-center">
                <img src="imgs/HD-PNG.png" alt="">
            </div>
            <div class="datos-container">
                <h2>Parámetros</h2>
                
                <div class="datos-item" id="dosis-container">
                    <strong>Dosis Suministrada:</strong> <span id="dosis"></span> ml
                </div>

                <div class="datos-item" id="fecha-container">
                    <strong>Fecha:</strong> <span id="fecha"></span>
                </div>

                <div class="datos-item" id="penultima-hora-container">
                    <strong>Hora de Inicio:</strong> <span id="penultima-hora"></span>
                </div>

                <div class="datos-item" id="ultima-hora-container">
                    <strong>Hora de Finalizacion:</strong> <span id="ultima-hora"></span>
                </div>

                <button class="btn btn-primary" onclick="actualizarDatos()">Actualizar Datos</button>
            </div>
        </div>
    </div>

    <script>
        function actualizarDatos() {
            // Crear un objeto XMLHttpRequest
            let xhttp = new XMLHttpRequest();

            // Configurar la solicitud
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Manejar la respuesta del servidor
                    var datos = JSON.parse(this.responseText);

                    // Mostrar los datos en la página
                    document.getElementById('dosis').innerText = datos.DOSIS;
                    document.getElementById('fecha').innerText = datos.FechaFinalizacion;
                    document.getElementById('ultima-hora').innerText = datos.UltimaHoraInicio;
                    document.getElementById('penultima-hora').innerText = datos.PenultimaHoraInicio;
                }
            };

            // Especificar el tipo de solicitud y la URL del servidor
            xhttp.open("GET", "http://localhost/UltimoDato.php", true);
            xhttp.send();
        }
    </script>
</body>
</html>








