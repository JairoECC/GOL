<?php 
	//print_r($_POST);
	if (!isset($_POST['oculto'])) {
		header('Location: paginaingresar.php');
	}

	include '../conexion.php';
	$nombre = $_POST['txtnombre'];  // Nuevo nombre
	$asistencia = $_POST['txtasistencia'];    // Nuevos asistencia

	$nombreExistente = $_POST['nombre_existente'];  // Nombre existente para la condición WHERE

	$sentencia = $bd->prepare("UPDATE jugador2 SET nombre = ?, asistencia = ? WHERE nombre = ?;");
	$resultado = $sentencia->execute([$nombre, $asistencia, $nombreExistente]);

	if ($resultado === TRUE) {
		header('Location: ../estadisticas/asistencias.php');
	} else {
		echo "Error";
	}
?>