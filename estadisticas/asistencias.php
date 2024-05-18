<?php  
	session_start();
	if (!isset($_SESSION['nombre'])) {
		header('Location: ../login.php');
	}elseif(isset($_SESSION['nombre'])){
		include '../conexion.php';
		$usu_id = $_SESSION['usu_id']; //obtiene el id del usuario

		$sentencia = $bd->prepare("SELECT nombre, asistencia FROM jugador2 WHERE usu_id = ? ORDER BY asistencia DESC LIMIT 10");
		$sentencia->execute([$usu_id]);
		$jugador = $sentencia->fetchAll(PDO::FETCH_OBJ);
		//print_r($alumnos);
	}else{
		echo "Error en el sistema";
	}	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<link rel="stylesheet" href="../estilos/stylegoleador.css">
    <title>Asistencias</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="icon" href="../img/asist.ico" type="image/x-icon">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: white;
        }

        .nombre-goles {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 2%;
        }

        .divingreso{
			padding: 10px;
            width: 80%;
			height: 70%;
            border-radius: 10px;
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.2);
            margin: 20px auto; /* Cambia este valor para ajustar el margen */
		}
        .muestra {
            padding: 10px;
            width: 80%;
			height: 100%;
            border-radius: 10px;
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.2);
            margin: 20px auto; /* Cambia este valor para ajustar el margen */
        }

        @media (min-width: 1000px) {
            .nombre-goles {
                flex-direction: row;
                justify-content: space-between;
            }

            .divingreso,
            .muestra {
                width: 40%;
                margin: 30px; /* Cambia este valor para ajustar el margen en la vista de computadora */
            }
        }
    </style>
</head>
<body>
	<nav class="navegador">
		<style>
            .goles{
                color: #b5b5b5;
            }
            .asistencia{
                color: white;
            }
            .amarilla{
                color: #b5b5b5;
            }
            .roja{
                color: #b5b5b5;
            }
            .cerrarsesion{
                color: #b5b5b5;
            }
        </style>
		<h1>ESTADISTICAS</h1>
		<input type="checkbox" id="check">
		<label for="check" class="checkbtn">
			<i class="fas fa-bars" style="color:white" ></i>
		</label>
		<ul>
			<li><a href="../paginaingresar.php" class="goles">Goles</a></li>
	        <li><a href="asistencias.php" class="asistencia">Asistencias</a></li>
	        <li><a href="amarillas.php" class="amarilla">Amarillas</a></li>
	        <li><a href="rojas.php" class="roja">Rojas</a></li>
	        <li><a href="../cerrarsesion.php" class="cerrarsesion">Cerrar Sesión</a></li>
		</ul>
	</nav>
	<div class="nombre-goles">
		<div class="divingreso">
			<h3>Ingresar</h3>
			<form method="POST" action="../ingresar/ingresarasis.php">
				<table class="ingreso">
					<tr>
						<td>Nombre: </td>
						<td><input type="text" class="form-control" name="txtnombre"></td>
				    </tr>
					<tr>
					    <td>Asistencias: </td>
					    <td><input type="number" class="form-control" name="txtasistencia"></td>
					</tr>
					<input type="hidden" name="oculto" value="1">
					<tr>
					    <td><input class="buttonIngresar" type="submit" value="GUARDAR"></td>
				    </tr>
			    </table>
		    </form>
		</div>
		<div class="muestra">
			<h3></h3>
			<table class="tabla-goleador">
				<h3>Asistencias</h3>
				<tr>
                    <th>#</th>
                    <th>Jugador</th>
                    <th>Asistencias</th>
			    </tr>
				<?php 
				$posicion =1;
				foreach ($jugador as $dato) {
					if ($posicion <= 10){
					?>
					<tr>
						<td><?php echo $posicion; ?></td>
						<td><?php echo $dato->nombre; ?></td>
						<td><?php echo $dato->asistencia; ?></td>
						<td><a class="btn btn-warning" id="edit" target="_blank" href="../editAndDelete/editAsis.php?nombre=<?php echo $dato->nombre; ?>">Editar</a></td>
                        <td><a class="btn btn-danger" id="delete" href="../editAndDelete/deleteAsis.php?nombre=<?php echo $dato->nombre; ?>">Eliminar</a></td>
					</tr>
					<?php
					$posicion++;
					} else {
						break;
					}
				}
			?>
			</table>
			<div class="view-all">
                <style>
                .view-all{
                    margin-left: 90%;
                    margin-top: 5px;
                }
			    .view-all a{
				    color: green;
			    }
                .view-all a:hover{
                    text-decoration: underline;
                }
		        </style>
                <a href="../viewAll/VAasistencia.php" target="_blank">Ver mas</a>
            </div>
		</div>
	</div>
<script src="../script/click-out.js"></script>
</body>
</html>