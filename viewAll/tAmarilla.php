<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    header('Location: login.php');
} elseif (isset($_SESSION['nombre'])) {
    include '../conexion.php';
    $usu_id = $_SESSION['usu_id']; //obtiene el id del usuario
    
    if (isset($_POST['nombre'])) {
        $nombre = $_POST['nombre'];
        $query = "SELECT foto, nombre, equipo, tar_ama FROM jugador3 WHERE usu_id = :usu_id AND nombre LIKE :nombre ORDER BY tar_ama DESC";
        $stmt = $bd->prepare($query);
        $stmt->execute(['usu_id' => $usu_id, ':nombre' => "%$nombre%"]);
        $jugador = $stmt->fetchAll(PDO::FETCH_OBJ);
    } else {
        $query = "SELECT foto, nombre, equipo, tar_ama FROM jugador3 WHERE usu_id = :usu_id ORDER BY tar_ama DESC";
        $stmt = $bd->prepare($query);
        $stmt->execute(['usu_id' => $usu_id]);
        $jugador = $stmt->fetchAll(PDO::FETCH_OBJ);
    }
} else {
    echo "Error en el sistema";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<link rel="stylesheet" href="../estilos/viewAll.css">
    <link rel="stylesheet" href="../estilos/modal.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="../img/yellow-card.ico" type="image/x-icon">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Total Amarillas</title>
</head>
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
#edit{
    color: #00a4e6;
    text-decoration: none;
}
#delete{
    color: red;
    text-decoration: none;
}

</style>
<body>
    
    <!-- Campo para ingresar el nombre para buscar -->
    <div class="buscador">
        <form method="POST" action="tAmarilla.php">
            <label class="input-container">
                <i class="fas fa-search"></i>
                <input id="txtBuscador" type="text" name="nombre" placeholder="Buscar" id="searchInput" oninput="performSearch(this.value)" autocomplete="off">
            </label>
            <button class="search-button" type="submit">Buscar</button>
        </form>
        <div class="user-menu-content">
            <button class="darkmode-button" id="darkModeToggle"><i id="darkModeIcon" class="fa-regular fa-sun"></i></button>
        </div>
    </div>

    <!-- Campo donde se nuestran los resultados y toda los jugadores -->
    <section class="View-all">
        <center>
        <div class="muestra" id="results">
        <h3>TARJETAS AMARILLAS</h3>
            <table class="tabla-goleador">
	    		<tr>
	    			<th></th>
                    <th>Jugador</th>
                    <th></th>
                    <th>Equipo</th>
                    <th>Tarjetas Amarillas</th>
                    <th></th>
                    <th></th>
	    		</tr>
	    		<?php 
                $posicion = 1;
                foreach ($jugador as $dato) {
                    if ($posicion <= 100) { // Limitar hasta la posición 100
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
                    <td id="td-goals"><?php echo $dato->tar_ama; ?></td>
                    <td id="td-edit">
                        <button class="btn btn-warning" id="edit" onclick="openModal('<?php echo $dato->nombre; ?>', '<?php echo $dato->tar_ama; ?>', '<?php echo $dato->equipo; ?>', '<?php echo $dato->foto; ?>')">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                    <td id="td-delete"><a class="btn btn-danger" id="delete" href="../editAndDelete/deleteAma.php?nombre=<?php echo $dato->nombre; ?>"><i class="fas fa-trash-alt"></i></a></td>
                </tr>
                <?php
                    $posicion++;
                } else {
                    break; // Romper el ciclo si se alcanza la posición 100
                }
                }
                ?>
	    	</table>
        </div> 
        </center>
    </section>
<!-- Contenedor Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close modal-close">&times;</span>
        <h3>Editar Jugador</h3>
        <center>
        <form id="editForm" method="POST" action="../editAndDelete/editProsAma.php" enctype="multipart/form-data">
            <input type="hidden" name="nombre_existente" id="editNombreExistente">
            <table>
                <tr class="edit-tr">
                    <td>Nombre: </td>
                    <td class="td-name-ama"><input type="text" class="form-control" name="txtnombre" id="editNombre"></td>
                </tr>
                <tr class="edit-tr">
                    <td>T. Amarillas: </td>
                    <td class="td-ama"><input type="number" class="form-control" name="txtamarillas" id="editGoles"></td>
                </tr>
                <tr class="edit-tr">
                    <td>Equipo: </td>
                    <td class="td-team-ama"><input type="text" class="form-control" name="txtequipo" id="editEquipo"></td>
                </tr>
                <tr class="edit-tr edit-tr-gol">
                    <td>Perfil: </td>
                    <td class="edit-photo-ama" id="edit-photo-input">
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
<script src="../script/darkmode.js"></script>
</body>
</html>