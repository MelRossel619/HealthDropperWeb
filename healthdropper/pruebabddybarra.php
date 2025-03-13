<?php
//require('login.php');
session_start();
$cargo=$_SESSION['cargo'];
$nombre=$_SESSION['nombre'];
$usuario=$_SESSION['usuario'];
if(!isset($cargo)){
    header("location: index.html");
}
$servername = "localhost";
$username = "root";
$password = "";
$database_name = "centraldemonit";

// Crear conexión MySQL desde PHP al servidor MySQL
$connection = new mysqli($servername, $username, $password, $database_name);

// Verificar conexión
if ($connection->connect_error) {
    die("Conexión MySQL fallida: " . $connection->connect_error);
}

// Consulta SQL para obtener el último dato de la columna PORCENTAJE
$sqlporcent = "SELECT Porcentajecama1,Porcentajecama2 FROM completado ORDER BY id DESC LIMIT 1";
$resultporcent = $connection->query($sqlporcent);

$porcentaje1 = 0;
$porcentaje2 = 0;
if ($resultporcent->num_rows > 0) {
    $rowporcent = $resultporcent->fetch_assoc();
    $porcentaje1 = $rowporcent["Porcentajecama1"];
    $porcentaje2 = $rowporcent["Porcentajecama2"];
}
// Consulta SQL para obtener el último dato de "Dosis" y "Flujo" para cama 1 desde la tabla "datos"
$sqldata = "SELECT Dosis, Flujo FROM datos WHERE cama = 1 ORDER BY id DESC LIMIT 1";
$resultdata = $connection->query($sqldata);

$dosis = 0;
$flujo = 0;
if ($resultdata->num_rows > 0) {
    $rowdata = $resultdata->fetch_assoc();
    $dosis1 = $rowdata["Dosis"];
    $flujo1 = $rowdata["Flujo"];
}
// Consulta SQL para obtener el último dato de "Dosis" y "Flujo" para cama 2 desde la tabla "datos"
$sqldata = "SELECT Dosis, Flujo FROM datos WHERE cama = 2 ORDER BY id DESC LIMIT 1";
$resultdata2 = $connection->query($sqldata);

$dosis2 = 0;
$flujo2 = 0;
if ($resultdata2->num_rows > 0) {
    $rowdata2 = $resultdata2->fetch_assoc();
    $dosis2 = $rowdata2["Dosis"];
    $flujo2 = $rowdata2["Flujo"];
}

$connection->close();
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HD: Monitoreo</title>
    <link href="stilo.css" media="all" rel="stylesheet">
    <style>
        body, html {
           height: 100%;
           margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .titulo {
            font-size: 50px;
            margin-bottom: 35px;
            color: rgb(241, 239, 239);
        }

        .container {
            margin: 60px auto;
            width: 400px;
            text-align: center;
        }

    .container .progress {
      margin: 0 auto;
      width: 400px;
      position: relative;
    }

    .progress {
      padding: 4px;
      background: rgba(0, 0, 0, 0.25);
      border-radius: 6px;
      -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.25), 0 1px rgba(255, 255, 255, 0.08);
      box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.25), 0 1px rgba(255, 255, 255, 0.08);
    }

    .progress-bar1 {
      height: 16px;
      border-radius: 4px;
      background-image: -webkit-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
      background-image: -moz-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
      background-image: -o-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
      background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
      -webkit-transition: 0.4s linear;
      -moz-transition: 0.4s linear;
      -o-transition: 0.4s linear;
      transition: 0.4s linear;
      -webkit-transition-property: width, background-color;
      -moz-transition-property: width, background-color;
      -o-transition-property: width, background-color;
      transition-property: width, background-color;
      -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.25), inset 0 1px rgba(255, 255, 255, 0.1);
      box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.25), inset 0 1px rgba(255, 255, 255, 0.1);
    }
    .progress-bar2 {
      height: 16px;
      border-radius: 4px;
      background-image: -webkit-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
      background-image: -moz-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
      background-image: -o-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
      background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
      -webkit-transition: 0.4s linear;
      -moz-transition: 0.4s linear;
      -o-transition: 0.4s linear;
      transition: 0.4s linear;
      -webkit-transition-property: width, background-color;
      -moz-transition-property: width, background-color;
      -o-transition-property: width, background-color;
      transition-property: width, background-color;
      -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.25), inset 0 1px rgba(255, 255, 255, 0.1);
      box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.25), inset 0 1px rgba(255, 255, 255, 0.1);
    }
    .progress-bar3 {
      height: 16px;
      border-radius: 4px;
      background-image: -webkit-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
      background-image: -moz-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
      background-image: -o-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
      background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
      -webkit-transition: 0.4s linear;
      -moz-transition: 0.4s linear;
      -o-transition: 0.4s linear;
      transition: 0.4s linear;
      -webkit-transition-property: width, background-color;
      -moz-transition-property: width, background-color;
      -o-transition-property: width, background-color;
      transition-property: width, background-color;
      -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.25), inset 0 1px rgba(255, 255, 255, 0.1);
      box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.25), inset 0 1px rgba(255, 255, 255, 0.1);
    }
    .progress-bar4 {
      height: 16px;
      border-radius: 4px;
      background-image: -webkit-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
      background-image: -moz-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
      background-image: -o-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
      background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
      -webkit-transition: 0.4s linear;
      -moz-transition: 0.4s linear;
      -o-transition: 0.4s linear;
      transition: 0.4s linear;
      -webkit-transition-property: width, background-color;
      -moz-transition-property: width, background-color;
      -o-transition-property: width, background-color;
      transition-property: width, background-color;
      -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.25), inset 0 1px rgba(255, 255, 255, 0.1);
      box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.25), inset 0 1px rgba(255, 255, 255, 0.1);
    }
    .progress-bar5 {
      height: 16px;
      border-radius: 4px;
      background-image: -webkit-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
      background-image: -moz-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
      background-image: -o-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
      background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
      -webkit-transition: 0.4s linear;
      -moz-transition: 0.4s linear;
      -o-transition: 0.4s linear;
      transition: 0.4s linear;
      -webkit-transition-property: width, background-color;
      -moz-transition-property: width, background-color;
      -o-transition-property: width, background-color;
      transition-property: width, background-color;
      -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.25), inset 0 1px rgba(255, 255, 255, 0.1);
      box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.25), inset 0 1px rgba(255, 255, 255, 0.1);
    }
    .progress-bar6 {
      height: 16px;
      border-radius: 4px;
      background-image: -webkit-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
      background-image: -moz-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
      background-image: -o-linear-gradient(top, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
      background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
      -webkit-transition: 0.4s linear;
      -moz-transition: 0.4s linear;
      -o-transition: 0.4s linear;
      transition: 0.4s linear;
      -webkit-transition-property: width, background-color;
      -moz-transition-property: width, background-color;
      -o-transition-property: width, background-color;
      transition-property: width, background-color;
      -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.25), inset 0 1px rgba(255, 255, 255, 0.1);
      box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.25), inset 0 1px rgba(255, 255, 255, 0.1);
    }

    .label {
      font-size: 20px;
      position: absolute;
      top: -30px;
      left: 50%;
      transform: translateX(-50%);
      padding: 3px 18px;
      color: #aaa;
      text-shadow: 0 1px black;
      border-radius: 20px;
      cursor: pointer;
      background: rgba(0, 0, 0, 0.25);
      color: white;
    }
    .contenedor-columnas {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px;
        }

        .columna {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #d2d6d6;
            padding: 40px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            margin: 0 20px;
        }

        .detener {
            margin-top: 20px;
            padding: 5px 30px;
        }

        .imagen-central {
            max-width: 100%;
            height: auto;
            margin-top: 20px;
        }

        .barra-carga {
            position: relative;
            width: 100%;
            height: 20px;
            background-color: #f0f0f0;
            margin-bottom: 10px;
            margin-right: 10px;
            overflow: hidden;
        }

        .linea-limite {
            position: absolute;
            height: 100%;
            width: 2px;
            background-color: #000;
        }

        .linea-limite:nth-child(1) {
            left: 25%;
        }

        .linea-limite:nth-child(2) {
            left: 50%;
        }

        .linea-limite:nth-child(3) {
            left: 75%;
        }
        .mensaje-detencion {
            color: red;
            font-weight: bold;
            display: none;
        }
  </style>
  <script>
    function mostrarMensaje(cama) {
            var mensaje = document.getElementById('mensaje-detencion-' + cama);
            mensaje.style.display = 'block';
            fetch('interr1.php', {
            method: 'POST'
        })
        .then(response => response.text())
        .then(data => {
            console.log('PHP script executed successfully');
            alert('Se detuvo cama ' + cama);
        })
        
        .catch(error => console.error('Error:', error));
        }
        function verificarMensajes() {
            for (var i = 1; i <= 2; i++) {
                var mensajeGuardado = localStorage.getItem('mensaje-detencion-' + i);
                if (mensajeGuardado === 'visible') {
                    document.getElementById('mensaje-detencion-' + i).style.display = 'block';
                }
            }
        }


    function checkForUpdate() {
      fetch('get_percentage1.php')
        .then(response => response.json())
        .then(data => {
          if (data.Porcentaje != <?php echo $porcentaje1; ?>) {
            location.reload();
          }
        })
        .catch(error => console.error('Error:', error));
    }

    window.onload = function() {
            verificarMensajes();
            setInterval(checkForUpdate, 5000);  // Comprueba actualizaciones cada 5 segundos
        };
  </script>
<link type="text/css" rel="stylesheet" href="css/style.css"/>
</head>
<body>
    <h1 class="titulo">CENTRAL DE MONITORIZACION</h1>
    <div class="contenedor-columnas">
        <div class="columna">
            <!-- Cama 1 -->
            <div class="mensaje">
                <h1>Cama 1</h1>
                <div id="mensaje-detencion-1" class="mensaje-detencion">Se detuvo</div>
<div class="container">
  <div class="progress">
    <div class="progress-bar1" style="width: <?php echo $porcentaje1; ?>%; background-color: <?php echo getColor($porcentaje1); ?>;"></div>
    <label class="label"><?php echo $porcentaje1; ?>%</label>
  </div>
</div>

<p style="font-size: 16px; font-family: Arial, sans-serif; font-weight: bold">Dosis: <span style="font-family: inherit;"><?php echo $dosis1; ?> ml</span></p>
<p style="font-size: 16px; font-family: Arial, sans-serif; font-weight: bold">Flujo: <span style="font-family: inherit;"><?php echo $flujo1; ?> got/min</span></p>


<button class="pushable" type="button" onclick="mostrarMensaje(1)">
      <span class="shadow"></span>
      <span class="edge"></span>
      <span class="front">
        Detener
      </span>
      </button>
            </div>
            <!-- Cama 2 -->
            <div class="mensaje">
                <h1>Cama 2</h1>
                <div id="mensaje-detencion-2" class="mensaje-detencion">Se detuvo</div>
<div class="container">
  <div class="progress">
    <div class="progress-bar2" style="width: <?php echo $porcentaje2; ?>%; background-color: <?php echo getColor($porcentaje2); ?>;"></div>
    <label class="label"><?php echo $porcentaje2; ?>%</label>
  </div>
</div>

<p style="font-size: 16px; font-family: Arial, sans-serif; font-weight: bold">Dosis: <span style="font-family: inherit;"><?php echo $dosis2; ?> ml</span></p>
<p style="font-size: 16px; font-family: Arial, sans-serif; font-weight: bold">Flujo: <span style="font-family: inherit;"><?php echo $flujo2; ?> got/min</span></p>


<button class="pushable" type="button" onclick="mostrarMensaje(2)">
      <span class="shadow"></span>
      <span class="edge"></span>
      <span class="front">
        Detener
      </span>
      </button>
            </div>
<!-- Cama 3 -->
<div class="mensaje">
                <h1>Cama 3</h1>
<div class="container">
  <div class="progress">
    <div class="progress-bar3" style="width: <?php echo $porcentaje1; ?>%; background-color: <?php echo getColor($porcentaje1); ?>;"></div>
    <label class="label"><?php echo $porcentaje1; ?>%</label>
  </div>
</div>
<button class="pushable">
      <span class="shadow"></span>
      <span class="edge"></span>
      <span class="front">
        Detener
      </span>
      </button>
            </div>
      </div>
      <img src="imgs/HD-PNG.png" alt="Imagen Central" class="imagen-central">
      <div class="columna">
          <!-- Cama 4 -->
          <div class="mensaje">
                <h1>Cama 4</h1>
                <div class="container">
  <div class="progress">
    <div class="progress-bar4" style="width: <?php echo $porcentaje2; ?>%; background-color: <?php echo getColor($porcentaje2); ?>;"></div>
    <label class="label"><?php echo $porcentaje2; ?>%</label>
  </div>
</div>

<p style="font-size: 16px; font-family: Arial, sans-serif; font-weight: bold">Dosis: <span style="font-family: inherit;"><?php echo $dosis1; ?> ml</span></p>
<p style="font-size: 16px; font-family: Arial, sans-serif; font-weight: bold">Flujo: <span style="font-family: inherit;"><?php echo $flujo1; ?> got/min</span></p>


<button class="pushable" type="button" onclick="mostrarMensaje(1)">
      <span class="shadow"></span>
      <span class="edge"></span>
      <span class="front">
        Detener
      </span>
      </button>
            </div>
            <!-- Cama 5 -->
          <div class="mensaje">
                <h1>Cama 5</h1>
                <div class="container">
  <div class="progress">
    <div class="progress-bar5" style="width: <?php echo $porcentaje1; ?>%; background-color: <?php echo getColor($porcentaje1); ?>;"></div>
    <label class="label"><?php echo $porcentaje1; ?>%</label>
  </div>
</div>

<p style="font-size: 16px; font-family: Arial, sans-serif; font-weight: bold">Dosis: <span style="font-family: inherit;"><?php echo $dosis2; ?> ml</span></p>
<p style="font-size: 16px; font-family: Arial, sans-serif; font-weight: bold">Flujo: <span style="font-family: inherit;"><?php echo $flujo2; ?> got/min</span></p>


<button class="pushable">
      <span class="shadow"></span>
      <span class="edge"></span>
      <span class="front">
        Detener
      </span>
      </button>
            </div>
            <!-- Cama 6 -->
          <div class="mensaje">
                <h1>Cama 6</h1>
                <div class="container">
  <div class="progress">
    <div class="progress-bar6" style="width: <?php echo $porcentaje2; ?>%; background-color: <?php echo getColor($porcentaje2); ?>;"></div>
    <label class="label"><?php echo $porcentaje2; ?>%</label>
  </div>
</div>

<button class="pushable">
      <span class="shadow"></span>
      <span class="edge"></span>
      <span class="front">
        Detener
      </span>
      </button>
            </div>

<?php
function getColor($percentage) {
    if ($percentage >= 100) {
        return '#86e01e';
    } elseif ($percentage >= 75) {
        return '#f2d31b';
    } elseif ($percentage >= 50) {
        return '#f2b01e';
    } elseif ($percentage >= 25) {
        return '#f27011';
    } else {
        return '#f63a0f';
    }
}
?>
</body>
</html>
