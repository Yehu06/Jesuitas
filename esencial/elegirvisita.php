<?php

//Conecta con la base de datos ($conexión)
    include 'configbd.php'; //include del archivo con los datos de conexión
	$conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); //Conecta con la base de datos
    $conexion->set_charset("utf8"); //Usa juego caracteres UTF8
	
	//Desactiva errores
	$controlador = new mysqli_driver();
    $controlador->report_mode = MYSQLI_REPORT_OFF;
	
	//obtener nombre jseuita
	$nombre_jesuita=$_POST["nombre"];
	
	//comprobar inicio de sesion
	
	$sql = "SELECT idJesuita FROM jesuita WHERE nombre = ".$_POST["nombre"]." AND codigo = '".$_POST["codigo"]."';";

	echo $sql;	//Para probar
	$resultado=$conexion->query($sql);	//Ejecuta la consulta sql
	
	
	//Obtener ip
	$sql="SELECT lugar FROM lugar";    
	echo $sql;	//Para probar
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
    <p>Bienvenido a la página de visita. Completa el formulario a continuación:</p>

   <
        <input type="hidden" name="ip" value="...">
		<br><br>
		<form method="post">
        <label for="ciudad">Selecciona tu ciudad:</label>
        <select id="ciudad" class="visita" name="ciudades">
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