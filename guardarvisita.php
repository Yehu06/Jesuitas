<?php

//Conecta con la base de datos ($conexión)
    include 'configbd.php'; //include del archivo con los datos de conexión
	$conexion = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD); //Conecta con la base de datos
    $conexion->set_charset("utf8"); //Usa juego caracteres UTF8
	
	//Desactiva errores
	$controlador = new mysqli_driver();
    $controlador->report_mode = MYSQLI_REPORT_OFF;
	
// Obtener datos del formulario
$nombre_jesuita=$_SESSION["nombre"];
$ip = $_POST['lugar'];

// Obtener el idJesuita a partir del nombre del Jesuita
$sqlJesuita = "SELECT idJesuita FROM jesuita WHERE nombreAlumno = '$nombre_jesuita'";
$resultJesuita = $conexion->query($sqlJesuita);



if ($resultJesuita->num_rows > 0) {
    $rowJesuita = $resultJesuita->fetch_assoc(); 
    $idJesuita = $rowJesuita['idJesuita']; //extrae el valor de la columna idJesuita y lo guarda en $idJesuita


    // Insertar la visita en la base de datos
    $sqlVisita = "INSERT INTO visita (idJesuita, ip, fechaHora) VALUES ('$idJesuita', '$ip', NOW())";
    
    if ($conexion->query($sqlVisita) === TRUE) {
        echo "Visita guardada con éxito.";
    } else {
        echo "Error al guardar la visita: " . $conexion->error;
    }
} else {
    echo "No se encontró un Jesuita con ese nombre.";
}

// Cerrar la conexión
$conexion->close();
?>
