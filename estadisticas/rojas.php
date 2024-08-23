<?php  
session_start();
if (!isset($_SESSION['nombre'])) {
    header('Location: ../login.php');
    exit();
} elseif (isset($_SESSION['nombre'])) {
    include '../conexion.php';
    $usu_id = $_SESSION['usu_id'];

    $sentencia = $bd->prepare("SELECT foto, nombre, equipo, tar_roj FROM jugador4 WHERE usu_id = ? ORDER BY tar_roj DESC LIMIT 10");
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
	<link rel="stylesheet" href="../estilos/stylegoleador.css">
    <link rel="stylesheet" href="../estilos/modal.css">
    <title>Tarjetas Rojas</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link rel="icon" href="../img/red-card.ico" type="image/x-icon">
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
            width: 95%;
			height: 70%;
            border-radius: 10px;
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.2);
            margin: 20px auto; /* Cambia este valor para ajustar el margen */
		}
        .muestra {
            padding: 10px;
            width: 95%;
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
		<a href="../index.php">
            <img class="imglogo" src="../img/logo-Gol-1.png" alt="logo-Gol-1" border="0">
        </a>
		<input type="checkbox" id="check">
		<label for="check" class="checkbtn">
			<i class="fas fa-bars" style="color:white" ></i>
		</label>
		<ul>
            <span class="closer ul-closer">&times;</span>
			<li><a href="paginaingresar.php" class="goles">Goles</a></li>
	        <li><a href="asistencias.php" class="asistencia">Asistencias</a></li>
	        <li><a href="amarillas.php" class="amarilla">Amarillas</a></li>
	        <li><a href="rojas.php" class="roja">Rojas</a></li>
	        <li class="user-menu">
                <span class="user-name"><?php echo $_SESSION['nombre']; ?></span>
                <i class="fas fa-chevron-down"></i>
                <div class="user-menu-content">
                    <a href="../cerrarsesion.php">Cerrar Sesión</a>
                    <button id="darkModeToggle"><i id="darkModeIcon" class="fa-regular fa-sun"></i></button>
                </div>
            </li>
		</ul>
	</nav>
	<div class="nombre-goles">
		<div class="divingreso">
			<h3 class="h3-divingreso">Ingresar</h3>
			<form method="POST" action="../ingresar/ingresarroj.php" enctype="multipart/form-data">
				<table class="ingreso">
					<tr class="ingreso-one">
						<td>Nombre: </td>
						<td id="input-name-roj"><input type="text" class="form-control" name="txtnombre"></td>
				    </tr>
					<tr class="ingreso-two">
					    <td>T. Rojas: </td>
					    <td id="input-roja"><input type="number" class="form-control" name="txtroja"></td>
					</tr>
					<tr class="ingreso-three">
						<td>Equipo: </td>
						<td id="input-team-roj"><input type="text" class="form-control" name="txtequipo"></td>
					</tr>
					<tr class="ingreso-four">
						<td>Perfil: </td>
						<td id="input-photo-roj">
							<div class="profile-pic-wrapper">
							    <label for="foto_perfil" class="profile-pic">
                                    <i id="icon-camera" class="fa fa-camera"></i>
                                    <img src="../img/user-predeterminado.png" alt="" id="profileDisplay">
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
				<h3 style="font-family: 'Roboto Mono', monospace;">Tarjetas Rojas</h3>
				<tr>
                    <th></th>
                    <th>Jugador</th>
					<th></th>
					<th>Equipo</th>
                    <th>T. Rojas</th>
					<th></th>
					<th></th>
			    </tr>
				<?php 
				$posicion =1;
				foreach ($jugador as $dato) {
					if ($posicion <= 10){
					?>
					<tr>
						<td id="td-position"><?php echo $posicion; ?></td>
						<td id="td-photo">
                            <?php if (!empty($dato->foto)): ?>
                                <img id="player-perfil" style="border-radius: 50%" src="<?php echo $dato->foto; ?>" alt="" width="45" height="45">
                            <?php else: ?>
                                <img id="player-perfil" style="border-radius: 50%" src="../img/user-predeterminado.png" alt="" width="45" height="45">
                            <?php endif; ?>
                        </td>
						<td id="td-name"><?php echo $dato->nombre; ?></td>
						<td id="td-team"><?php echo $dato->equipo; ?></td>
						<td id="td-stad"><?php echo $dato->tar_roj; ?></td>
						<td id="td-edit">
                            <button class="btn btn-warning" id="edit" onclick="openModal('<?php echo $dato->nombre; ?>', '<?php echo $dato->tar_roj; ?>', '<?php echo $dato->equipo; ?>', '<?php echo $dato->foto; ?>')">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                        <td id="td-delete"><a class="btn btn-danger" id="delete" href="../editAndDelete/deleteRoj.php?nombre=<?php echo $dato->nombre; ?>"><i class="fas fa-trash-alt"></i></a></td>
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
                <button><i class="fa-solid fa-plus"></i><a href="../viewAll/tRoja.php" target="_blank">Ver tabla completa</a></button>
            </div>
		</div>
	</div>
<!-- Contenedor Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close modal-close">&times;</span>
        <h3>Editar Jugador</h3>
        <center>
        <form id="editForm" method="POST" action="../editAndDelete/editProsRoj.php" enctype="multipart/form-data">
            <input type="hidden" name="nombre_existente" id="editNombreExistente">
            <table>
                <tr class="edit-tr">
                    <td>Nombre: </td>
                    <td class="td-name-roj"><input type="text" class="form-control" name="txtnombre" id="editNombre"></td>
                </tr>
                <tr class="edit-tr">
                    <td>T. Rojas: </td>
                    <td class="td-roja"><input type="number" class="form-control" name="txtroja" id="editGoles"></td>
                </tr>
                <tr class="edit-tr">
                    <td>Equipo: </td>
                    <td class="td-team-roj"><input type="text" class="form-control" name="txtequipo" id="editEquipo"></td>
                </tr>
                <tr class="edit-tr edit-tr-gol">
                    <td>Perfil: </td>
                    <td class="edit-photo-roj" id="edit-photo-input">
                        <div class="edit-profile-pic-wrapper">
                            <label for="editFotoPerfil" class="edit-profile-pic">
                                <i id="edit-icon-camera" class="fa fa-camera"></i>
                                <img src="" alt="" id="editProfileDisplay">
                                <input type="file" class="form-control" name="foto_perfil" id="editFotoPerfil" onchange="displayEditImage(this)">
                            </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="td-edit-buttons">
                        <button id="editBtnCancelar" type="button" class="modal-close">CANCELAR</button>
                        <button id="editBtnGuardar" type="submit">GUARDAR</button>
                    </td>
                </tr>
            </table>
        </form>
        </center>
    </div>
</div>
<script src="../script/modal.js"></script>
<script src="../script/click-out.js"></script>
<script src="../script/displayImage.js"></script>
<script src="../script/darkmode.js"></script>
</body>
</html>
