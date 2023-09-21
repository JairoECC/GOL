<?php 
	//print_r($_POST);
	if (!isset($_POST['oculto'])) {
		header('Location: paginaingresar.php');
	}

	include '../conexion.php';
	$nombre = $_POST['txtnombre'];  // Nuevo nombre
	$goles = $_POST['txtgoles'];    // Nuevos goles

	$nombreExistente = $_POST['nombre_existente'];  // Nombre existente para la condición WHERE

	$sentencia = $bd->prepare("UPDATE jugador SET nombre = ?, goles = ? WHERE nombre = ?;");
	$resultado = $sentencia->execute([$nombre, $goles, $nombreExistente]);

	if ($resultado === TRUE) {
		header('Location: ../paginaingresar.php');
	} else {
		echo "Error";
	}
?>
