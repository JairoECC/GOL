<?php 
	//print_r($_POST);
	if (!isset($_POST['oculto'])) {
		header('Location: paginaingresar.php');
	}

	include '../conexion.php';
	$nombre = $_POST['txtnombre'];  // Nuevo nombre
	$roja = $_POST['txtroja'];    // Nuevos tarjetas rojas

	$nombreExistente = $_POST['nombre_existente'];  // Nombre existente para la condición WHERE

	$sentencia = $bd->prepare("UPDATE jugador4 SET nombre = ?, tar_roj = ? WHERE nombre = ?;");
	$resultado = $sentencia->execute([$nombre, $roja, $nombreExistente]);

	if ($resultado === TRUE) {
		header('Location: ../estadisticas/rojas.php');
	} else {
		echo "Error";
	}
?>