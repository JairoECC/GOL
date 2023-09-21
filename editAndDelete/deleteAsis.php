<?php  
	if (!isset($_GET['nombre'])) {
		exit();
	}

	$codigo = $_GET['nombre'];
	include '../conexion.php';
	$sentencia = $bd->prepare("DELETE FROM jugador2 WHERE nombre = ?;");
	$resultado = $sentencia->execute([$codigo]);

	if ($resultado === TRUE) {
		header('Location: ../estadisticas/asistencias.php');
	}else{
		echo "Error";
	}

?>