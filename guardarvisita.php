<?php
session_start();

// Conecta con la base de datos
include 'configbd.php'; 
$conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); 
$conexion->set_charset("utf8");

// Desactiva errores
$controlador = new mysqli_driver();
$controlador->report_mode = MYSQLI_REPORT_OFF;

$nombreJesuita = $_SESSION["nombre"];
$nombreCiudad = $_POST["ciudad"];

// Consulta SQL
$idJesuita = "SELECT idJesuita FROM jesuita WHERE nombre = '".$nombreJesuita."';";
$residJesuita = $conexion->query($idJesuita);
$filaidJesuita = $residJesuita->fetch_array();

$ipLugar = "SELECT ip FROM lugar WHERE lugar = '".$nombreCiudad."';";
$resipLugar = $conexion->query($ipLugar);
$filaipLugar = $resipLugar->fetch_array();

$sql = "INSERT INTO visita (idJesuita, ip) VALUES ('".$filaidJesuita['idJesuita']."','".$filaipLugar['ip']."');";

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <title>Registro de Visitas</title>
    <link rel="stylesheet" href="jesuita.css"> 
</head>
<body>
<br><br>
<div>
    <?php
    // Ejecuta la consulta
    if ($conexion->query($sql) && $conexion->affected_rows > 0) {
        echo "<h2>La visita se ha registrado exitosamente</h2>";
    } else {
        echo '<h2>Parece que algo anda mal, <a href="./index.html">vuelve a intentarlo</a></h2>';
    }

    // Cierra la conexión
    $conexion->close();
    ?>
</div>
