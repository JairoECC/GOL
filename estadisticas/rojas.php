<?php  
	session_start();
	if (!isset($_SESSION['nombre'])) {
		header('Location: ../login.php');
	}elseif(isset($_SESSION['nombre'])){
		include '../conexion.php';
		$sentencia = $bd->query("SELECT nombre, tar_roj FROM jugador4 ORDER BY tar_roj DESC LIMIT 10");
		$jugador = $sentencia->fetchAll(PDO::FETCH_OBJ);
		//print_r($alumnos);
	}else{
		echo "Error en el sistema";
	}	
?>

<!DOCTYPE html>
<html lang="en">
<head
    <meta charset="UTF-8">
	<link rel="stylesheet" href="../estilos/stylegoleador.css">
    <title>Estadisticas</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
	<header>
		<div class="header-content">
			<div class="logo">
				<h1>ESTADISTICAS</h1>
			</div>
			<div>
				<nav class="navegador">
		        	<ul>
					<style>
                        .goles{
                            color: #b5b5b5;
                        }
                        .asistencia{
                            color: #b5b5b5;
                        }
                        .amarilla{
                            color: #b5b5b5;
                        }
                        .roja{
                            color: white;
                        }
                        .cerrarsesion{
                            color: #b5b5b5;
                        }
                    </style>
		        		<li><a href="../paginaingresar.php"class="goles">Goles</a></li>
		                <li><a href="asistencias.php"class="asistencia">Asistencias</a></li>
		                <li><a href="amarillas.php"class="amarilla">Amarillas</a></li>
		                <li><a href="rojas.php"class="roja">Rojas</a></li>
		                <li><a href="../cerrarsesion.php"class="cerrarsesion">Cerrar Sesión</a></li>
		        	</ul>
		        </nav>
			</div>
		</div>
		<div id="icon-menu">
			<i class="fas fa-bars"></i>
		</div>
	</header>
	<div class="nombre-goles">
		<div class="divingreso">
			<h3>Ingresar</h3>
			<form method="POST" action="../ingresar/ingresarroj.php">
				<table class="ingreso">
					<tr>
						<td>Nombre: </td>
						<td><input type="text" class="form-control" name="txtnombre"></td>
				    </tr>
					<tr>
					    <td>Tarjetas Rojas: </td>
					    <td><input type="number" class="form-control" name="txtroja"></td>
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
				<h3>Tarjetas Rojas</h3>
				<tr>
					<th>#</th>
					<th>Jugador</th>
					<th>Tarjetas Rojas</th>
                </tr>
				<?php
				$posicion = 1;
				$totalJugadores = count($jugador); // Contar el número total de jugadores
				foreach ($jugador as $dato) {
					if ($posicion <= 10) {
                ?>
				<tr>
					<td><?php echo $posicion; ?></td>
					<td><?php echo $dato->nombre; ?></td>
					<td><?php echo $dato->tar_roj; ?></td>
					<td><a class="btn btn-warning" id="edit" href="../editAndDelete/editRoj.php?nombre=<?php echo $dato->nombre; ?>">Editar</a></td>
					<td><a class="btn btn-danger" id="delete" href="/editAndDelete/deleteRoj.php?nombre=<?php echo $dato->nombre; ?>">Eliminar</a></td>
				</tr>
            <?php
			$posicion++;
		} else {
			break;
        }
    }
    ?>
</table>
<?php if ($totalJugadores > 10): ?>
    <!-- Aquí colocas el botón "Ver Más" -->
    <button id="verMasBtn" class="btn btn-primary">Ver Más</button>
<?php endif; ?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const verMasBtn = document.getElementById("verMasBtn");
        const filasOcultas = document.querySelectorAll(".tabla-goleador tr:nth-child(n+11)");

        verMasBtn.addEventListener("click", function () {
            filasOcultas.forEach(function (fila) {
                fila.style.display = "table-row";
            });
            verMasBtn.style.display = "none"; // Oculta el botón "Ver Más" después de hacer clic
        });
    });
</script>

		</div>
	</div>
</body>
</html>