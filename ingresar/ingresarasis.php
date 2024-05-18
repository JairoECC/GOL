<?php  
    session_start();
	if (!isset($_POST['oculto'])) {
		exit();
	}

	include '../conexion.php';
	$nombre = $_POST['txtnombre'];
	$asistencia = $_POST['txtasistencia'];

	if (empty($nombre) || empty($asistencia)){
		header('Location: ../estadisticas/asistencias.php');
	}else{
		//obtiene el id del usuario
		$usu_id = $_SESSION['usu_id'];

		$sentencia = $bd->prepare("INSERT INTO jugador2(nombre, asistencia, usu_id) VALUES (?, ?, ?);");
		$resultado = $sentencia->execute([$nombre, $asistencia, $usu_id]);

		if ($resultado === TRUE) {
			header('Location: ../estadisticas/asistencias.php');
		}else{
			echo "Error";
		}
	}

	// $sentencia = $bd->prepare("INSERT INTO jugador2 (nombre,asistencia) VALUES (?,?);");
	// $resultado = $sentencia->execute([$nombre,$asistencia]);

	// if ($resultado === TRUE) {
	// 	//echo "Insertado correctamente";
	// 	header('Location: ../estadisticas/asistencias.php');
	// }else{
	// 	echo "Error";
	// }
?>