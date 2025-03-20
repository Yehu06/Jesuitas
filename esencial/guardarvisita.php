  <?php

//Recoge la información del formulario
$nombre= $_POST["nombre"];
$codigo= $_POST["codigo"];

//Conecta con la base de datos ($conexión)
include 'configbd.php'; //include del archivo con los datos de conexión
$conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); //Conecta con la base de datos
$conexion->set_charset("utf8"); //Usa juego caracteres UTF8

//Desactiva errores
$controlador = new mysqli_driver();
$controlador->report_mode = MYSQLI_REPORT_OFF;

//Cadena de caracteres de la consulta sql
$sql = "SELECT nombre, codigo FROM jesuita WHERE codigo = '$codigo' AND nombre = '$nombre';";

//Prepara la consulta
echo $sql;
$resultado=$conexion->query($sql); //Ejecuta la consulta sql

//Validar
if ($resultado->num_rows > 0) {
echo ""; // El jesuita existe
echo '<h3><a href="elegirvisita.php"> Inicio de sesion correcto. Continua con la visita</a></h3>';
} else {
echo "ERROR: El jesuita introducido no existe.";
echo '<h3><a href="jesuitas.html">Volver a inicio</a></h3>';
exit(); // Asegura que el script no continúe ejecutándose
}
$conexion->close();
?>