<?php  
	if (!isset($_GET['nombre'])) {
		exit();
	}

	$codigo = $_GET['nombre'];
	include '../conexion.php';
	$sentencia = $bd->prepare("DELETE FROM jugador WHERE nombre = ?;");
	$resultado = $sentencia->execute([$codigo]);

	if ($resultado === TRUE) {
		header('Location: ../paginaingresar.php');
	}else{
		echo "Error";
	}

?>