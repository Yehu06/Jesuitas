  <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="jesuita.css"> <!-- Archivo CSS -->
</head>
<body>


<br><br><br>
<div>
    <?php
    session_start();

    // Recoge la información del formulario
    $nombre = $_POST["nombre"];
    $codigo = $_POST["codigo"];

    include 'configbd.php'; // Datos de conexión
    $conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);
    $conexion->set_charset("utf8");

    // Desactiva errores
    $controlador = new mysqli_driver();
    $controlador->report_mode = MYSQLI_REPORT_OFF;

    // Consulta SQL
    $sql = "SELECT nombre, codigo FROM jesuita WHERE codigo = '".$codigo."' AND nombre = '".$nombre."';";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $_SESSION["nombre"] = $nombre;
        $_SESSION["codigo"] = $codigo;
        echo '<h3 style="color:green;">Inicio de sesión correcto. ¡Bienvenido, '.$nombre.'!</h3>';
        echo '<h3><a href="elegirvisita.php">Continuar con la visita</a></h3>';
    } else {
        echo '<h3 style="color:red;">ERROR: El jesuita introducido no existe.</h3>';
        echo '<h3><a href="jesuitas.html">Volver a inicio</a></h3>';
    }

    $conexion->close();
    ?>
</div>

</body>
</html>
