<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Terapia</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4faff;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            background-image: url('imgs/background.png');
        }
        .barra-superior {
            background-color: #007bff;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 30px;
            width: 100%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .barra-superior .izquierda {
            display: flex;
            align-items: center;
        }
        .barra-superior .izquierda img {
            width: 100px;
            height: 100px;
            margin-right: 10px;
        }
        .btn-retroceder {
            background-color: white;
            border: none;
            padding: 15px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        .btn-retroceder:hover {
            background-color: #d9f0ff;
            transform: scale(1.1);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        .titulo {
            flex-grow: 1;
            text-align: center;
            font-size: 40px;
            text-transform: uppercase;
            font-weight: bold;
        }
        .datos-derecha {
            text-align: left;
            font-size: 18px;
            padding-right: 50px;
        }
    </style>
</head>
<body>
    <?php
        session_start();
        if (!isset($_SESSION['nombre'])) {
            header("Location: LogHD.html");
            exit();
        }
        $nombreUsuario = $_SESSION['nombre'];
    ?>
    <div class="barra-superior">
        <div class="izquierda">
            <img src="imgs/LOGOENTHD.png" alt="Logo">
            <button class="btn-retroceder" onclick="window.history.back();">&#8592;</button>
        </div>
        <div class="titulo">Inicio de Terapia</div>
        <div class="datos-derecha">Usuario: <?php echo htmlspecialchars($nombreUsuario); ?> | Estado: Activo</div>
    </div>
</body>
</html>
