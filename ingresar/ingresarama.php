<?php  
	if (!isset($_POST['oculto'])) {
		exit();
	}

	include '../conexion.php';
	$nombre = $_POST['txtnombre'];
	$amarilla = $_POST['txtamarillas'];

	$sentencia = $bd->prepare("INSERT INTO jugador3(nombre,tar_ama) VALUES (?,?);");
	$resultado = $sentencia->execute([$nombre,$amarilla]);

	if ($resultado === TRUE) {
		//echo "Insertado correctamente";
		header('Location: ../estadisticas/amarillas.php');
	}else{
		echo "Error";
	}
?>