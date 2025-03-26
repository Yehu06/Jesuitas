<?php
session_start();

//Conecta con la base de datos ($conexión)
    include 'configbd.php'; //include del archivo con los datos de conexión
	$conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); //Conecta con la base de datos
    $conexion->set_charset("utf8"); //Usa juego caracteres UTF8
	
	//Desactiva errores
	$controlador = new mysqli_driver();
    $controlador->report_mode = MYSQLI_REPORT_OFF;
	
	//obtener nombre jseuita
	$nombre_jesuita=$_SESSION["nombre"];
	$codigo=$_SESSION["codigo"];
	
	//comprobar inicio de sesion
	
	$sql = "SELECT idJesuita FROM jesuita WHERE codigo = ".$codigo." AND nombre = '".$nombre_jesuita."';";

	//echo $sql;	//Para probar
	$resultado=$conexion->query($sql);	//Ejecuta la consulta sql
	
	
	//Obtener ip
	$sql="SELECT lugar FROM lugar";    
	//echo $sql;	//Para probar
	$resultado=$conexion->query($sql);	//Ejecuta la consulta sql
	

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
	<link rel="stylesheet" href="jesuita.css">
    <title>Visita</title>
</head>
<body>
    <h1>Hola, <?php echo $nombre_jesuita?> </h1>
    <h2>Bienvenido a la página de visita. Completa el formulario a continuación:</h2>

   <br>

		<br><br>
		<form method="post" action="guardarvisita.php">
		<br><br>
        <label for="ciudad">Selecciona tu ciudad:</label>
        <select id="ciudad" class="visita" name="ciudad">
		<?php
			
           /* while($fila=$resultado->fetch_array()){
		echo "<p>".$fila["nombre"]."------".$fila["firma"]."</p>";
		   }*/
			 while($fila=$resultado->fetch_array())
			 {
				 echo '<option class="visita" value="'.$fila["lugar"].'">'.$fila["lugar"].'</option>';
			 }
       ?>
        </select>
        <br><br>

    
        <button type="submit">Enviar</button>
    </form>
	
</body>
</html>