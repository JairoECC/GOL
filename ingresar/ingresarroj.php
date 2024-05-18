<?php 
    session_start(); 
	if (!isset($_POST['oculto'])) {
		exit();
	}

	include '../conexion.php';
	$nombre = $_POST['txtnombre'];
	$roja = $_POST['txtroja'];
	
	if(empty($nombre) || empty($roja)){
		header('Location: ../estadisticas/rojas.php');
	}else{
		//obtiene le id del usario
		$usu_id = $_SESSION['usu_id'];

	    $sentencia = $bd->prepare("INSERT INTO jugador4(nombre, tar_roj, usu_id) VALUES (?, ?, ?);");
	    $resultado = $sentencia->execute([$nombre, $roja, $usu_id]);

	    if ($resultado === TRUE) {
	    	//echo "Insertado correctamente";
	    	header('Location: ../estadisticas/rojas.php');
	    }else{
	    	echo "Error";
	    }
	}
?>