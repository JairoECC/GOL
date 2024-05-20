<?php  
session_start();
if (!isset($_SESSION['nombre'])) {
    header('Location: login.php');
} elseif (isset($_SESSION['nombre'])) {
    include 'conexion.php';
    $usu_id = $_SESSION['usu_id']; // Obtener el usu_id del usuario actual desde la sesión

    $sentencia = $bd->prepare("SELECT nombre, equipo, goles FROM jugador WHERE usu_id = ? ORDER BY goles DESC LIMIT 10");
    $sentencia->execute([$usu_id]);
    $jugador = $sentencia->fetchAll(PDO::FETCH_OBJ);
} else {
    echo "Error en el sistema";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<link rel="stylesheet" href="estilos/stylegoleador.css">
    <title>Goles</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link rel="icon" href="img/goal.ico" type="image/x-icon">
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
                color: white;
            }
            .asistencia{
                color: #b5b5b5;
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
        <a href="index.html">
            <img class="imglogo" src="https://i.ibb.co/xSzXzKf/logo-Gol-1.png" alt="logo-Gol-1" border="0">
        </a>
        
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars" style="color:white" ></i>
        </label>

		<ul>
			<li><a href="paginaingresar.php" class="goles">Goles</a></li>
	        <li><a href="estadisticas/asistencias.php" class="asistencia">Asistencias</a></li>
	        <li><a href="estadisticas/amarillas.php" class="amarilla">Amarillas</a></li>
	        <li><a href="estadisticas/rojas.php" class="roja">Rojas</a></li>
	        <li><a href="cerrarsesion.php" class="cerrarsesion">Cerrar Sesión</a></li>
		</ul>
	</nav>
	<div class="nombre-goles">
        <div class="divingreso">
            <h3>Ingresar</h3>
            <form method="POST" action="ingresargoleador.php" enctype="multipart/form-data">
                <table class="ingreso">
                    <tr class="ingreso-one">
                        <td>Nombre: </td>
                        <td id="name-input"><input type="text" class="form-control" name="txtnombre"></td>
                    </tr>
                    <tr class="ingreso-two">
                        <td>Goles: </td>
                        <td id="stat-input"><input type="number" class="form-control" name="txtgoles"></td>
                    </tr>
                    <tr class="ingreso-three">
                        <td>Equipo: </td>
                        <td id="team-input"><input type="text" class="form-control" name="txtequipo"></td>
                    </tr>
                    <tr class="ingreso-four">
                    <td>Perfil: </td>
                    <td id="photo-input">
                        <div class="profile-pic-wrapper">
                            <label for="foto_perfil" class="profile-pic">
                                <i id="icon-camera" class="fa fa-camera"></i>
                                <img src="img/user-predeterminado.png" alt="" id="profileDisplay">
                                <input type="file" class="form-control" name="foto_perfil" id="foto_perfil" onchange="displayImage(this)">
                            </label>
                        </div>
                    </td>
                    </tr>
                    <input type="hidden" name="oculto" value="1">
                    <tr>
                        <td><input class="buttonIngresar" type="submit" value="GUARDAR"></td>
                    </tr>
                </table>
            </form>
        </div>

		<div class="muestra">
        <table class="tabla-goleador">
        <h3 style="font-family: 'Roboto Mono', monospace;">Goleadores</h3>
        <tr>
            <th></th>
            <th>Jugador</th>
            <th></th>
            <th>Goles</th>
            <th></th>
            <th></th>
        </tr>
        <?php 
        $posicion = 1;
        foreach ($jugador as $dato) {
            if ($posicion <= 10) { // Limitar hasta la posición 10
        ?>
        <tr>
            <td><?php echo $posicion; ?></td>
            <td><?php echo $dato->nombre; ?></td>
            <td><?php echo $dato->equipo; ?></td>
            <td><?php echo $dato->goles; ?></td>
            <td><a class="btn btn-warning" id="edit" target="_blank" href="editAndDelete/editGol.php?nombre=<?php echo $dato->nombre; ?>"><i class="fas fa-edit"></i></a></td>
            <td><a class="btn btn-danger" id="delete" href="editAndDelete/delete.php?nombre=<?php echo $dato->nombre; ?>"><i class="fas fa-trash-alt"></i></a></td>
        </tr>
        <?php
            $posicion++;
        } else {
            break; // Romper el ciclo si se alcanza la posición 10
        }
        }?>
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
                <a href="viewAll/VAgol.php" target="_blank">Ver mas</a>
            </div>
        </div>
    </div>
<script src="script/click-out.js"></script>
<script src="script/displayImage.js"></script>
</body>
</html>