<?php
    session_start();  
	if (!isset($_POST['oculto'])) {
		exit();
	}

	include '../conexion.php';
	$nombre = $_POST['txtnombre'];
	$amarilla = $_POST['txtamarillas'];

	if (empty($nombre) || empty($amarilla)){
		header('Location: ../estadisticas/amarillas.php');
	}else{
		//obtener el id del usario
		$usu_id = $_SESSION['usu_id'];

		$sentencia = $bd->prepare("INSERT INTO jugador3(nombre,tar_ama, usu_id) VALUES (?, ?, ?);");
	    $resultado = $sentencia->execute([$nombre, $amarilla, $usu_id]);

	    if ($resultado === TRUE) {
			//echo "Insertado correctamente";
		    header('Location: ../estadisticas/amarillas.php');
	    }else{
	   	    echo "Error";
	    }
	}

?>