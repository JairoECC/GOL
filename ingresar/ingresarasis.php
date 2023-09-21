<?php  
	if (!isset($_POST['oculto'])) {
		exit();
	}

	include '../conexion.php';
	$nombre = $_POST['txtnombre'];
	$asistencia = $_POST['txtasistencia'];

	$sentencia = $bd->prepare("INSERT INTO jugador2(nombre,asistencia) VALUES (?,?);");
	$resultado = $sentencia->execute([$nombre,$asistencia]);

	if ($resultado === TRUE) {
		//echo "Insertado correctamente";
		header('Location: ../estadisticas/asistencias.php');
	}else{
		echo "Error";
	}
?>