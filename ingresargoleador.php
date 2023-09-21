<?php  
	if (!isset($_POST['oculto'])) {
		exit();
	}

	include 'conexion.php';
	$nombre = $_POST['txtnombre'];
	$goles = $_POST['txtgoles'];

if (empty($nombre)|| empty($goles)){
	header('Location: paginaingresar.php');
} else{
	$sentencia = $bd->prepare("INSERT INTO jugador(nombre,goles) VALUES (?,?);");
	$resultado = $sentencia->execute([$nombre,$goles]);

	if ($resultado === TRUE) {
		//echo "Insertado correctamente";
		header('Location: paginaingresar.php');
	}else{
		echo "Error";
	}
}
?>