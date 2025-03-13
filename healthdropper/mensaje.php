<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensaje</title>
</head>
<body>
    <?php
    $cama = isset($_POST['cama']) ? $_POST['cama'] : 'desconocida';
    echo "<h1>Se detuvo la cama $cama</h1>";
    ?>
</body>
</html>
