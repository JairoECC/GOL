<?php 
	//print_r($_POST);
	if (!isset($_POST['oculto'])) {
		header('Location: paginaingresar.php');
	}

	include '../conexion.php';
	$nombre = $_POST['txtnombre'];  // Nuevo nombre
	$amarilla = $_POST['txtamarillas'];    // Nuevos tarjetas amarillas

	$nombreExistente = $_POST['nombre_existente'];  // Nombre existente para la condición WHERE

	$sentencia = $bd->prepare("UPDATE jugador3 SET nombre = ?, tar_ama = ? WHERE nombre = ?;");
	$resultado = $sentencia->execute([$nombre, $amarilla, $nombreExistente]);

	if ($resultado === TRUE) {
		header('Location: ../estadisticas/amarillas.php');
	} else {
		echo "Error";
	}
?>