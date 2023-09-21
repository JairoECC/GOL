<?php  
	if (!isset($_POST['oculto'])) {
		exit();
	}

	include '../conexion.php';
	$nombre = $_POST['txtnombre'];
	$roja = $_POST['txtroja'];

	$sentencia = $bd->prepare("INSERT INTO jugador4(nombre,tar_roj) VALUES (?,?);");
	$resultado = $sentencia->execute([$nombre,$roja]);

	if ($resultado === TRUE) {
		//echo "Insertado correctamente";
		header('Location: ../estadisticas/rojas.php');
	}else{
		echo "Error";
	}
?>