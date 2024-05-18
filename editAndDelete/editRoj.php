<?php  
	session_start();
	if (!isset($_GET['nombre'])) {
		header('Location: rojas.php');
	}

	if (!isset($_SESSION['nombre'])) {
		header('Location: login.php');
	}elseif(isset($_SESSION['nombre'])){
		include '../conexion.php';
		$nombre = $_GET['nombre'];

		$sentencia = $bd->prepare("SELECT * FROM jugador4 WHERE nombre = ?;");
		$sentencia->execute([$nombre]);
		$persona = $sentencia->fetch(PDO::FETCH_OBJ);
		//print_r($persona);
	}else{
		echo "Error en el sistema";
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Editar</title>
	<meta charset="utf-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="icon" href="../img/edit.ico" type="image/x-icon">
	<style>
		#btnGuardar{
			background-color: green;
			border-color: green;
			color: white;
			margin-left: 20px;
			width: 90px;
			height: 5%;
			font-size: 13px;
		}
		#btnCancelar{
			background-color: red;
			border-color: red;
			color: white;
			margin-top: 10px;
			margin-left: 40px;
			width: 90px;
			height: 5%;
			font-size: 13px;	
		}
	</style>
</head>
<body>
	<center>
		<h3>Editar Jugador</h3>
		<form method="POST" action="editProsRoj.php">
			<table>
				<tr>
					<td>Nombre: </td>
					<td><input type="text" class="form-control" name="txtnombre" value="<?php echo $persona->nombre; ?>"></td>
				</tr>
				<tr>
					<td>Tarjetas Rojas: </td>
					<td><input type="text" class="form-control" name="txtroja" value="<?php echo $persona->tar_roj; ?>"></td>
				</tr>
				<tr>
					<input type="hidden" name="oculto">
				    <input type="hidden" name="nombre_existente" value="<?php echo $persona->nombre; ?>">
					<td colspan="2">
					    <button id="btnCancelar" type="button" onclick="window.location.href='../estadisticas/rojas.php'">CANCELAR</button>
						<button id="btnGuardar" type="submit">GUARDAR</button>
					</td>
				</tr>
			</table>
		</form>
	</center>
</body>
</html>