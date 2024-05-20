<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    header('Location: login.php');
} elseif (isset($_SESSION['nombre'])) {
    include '../conexion.php';
    $usu_id = $_SESSION['usu_id']; //obtiene el id del usuario
    
    if (isset($_POST['nombre'])) {
        $nombre = $_POST['nombre'];
        $query = "SELECT nombre, tar_ama FROM jugador3 WHERE usu_id = :usu_id AND nombre LIKE :nombre ORDER BY tar_ama DESC";
        $stmt = $bd->prepare($query);
        $stmt->execute(['usu_id' => $usu_id, ':nombre' => "%$nombre%"]);
        $jugador = $stmt->fetchAll(PDO::FETCH_OBJ);
    } else {
        $query = "SELECT nombre, tar_ama FROM jugador3 WHERE usu_id = :usu_id ORDER BY tar_ama DESC";
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

button{
    display: none;
}
#edit{
    color: green;
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
            <button type="submit">Buscar</button>
        </form>
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
                    <th>Tarjetas Amarillas</th>
                    <th></th>
                    <th></th>
	    		</tr>
	    		<?php 
	    		$posicion =1;
	    		foreach ($jugador as $dato) {
	    			if ($posicion <=100){
	    			?>
	    			<tr>
	    				<td><?php echo $posicion; ?></td>
	    				<td><?php echo $dato->nombre; ?></td>
	    				<td><?php echo $dato->tar_ama; ?></td>
	    				<td><a class="btn btn-warning" id="edit" target="_blank" href="../editAndDelete/editAma.php?nombre=<?php echo $dato->nombre; ?>">Editar</a></td>
                        <td><a class="btn btn-danger" id="delete" href="../editAndDelete/deleteAma.php?nombre=<?php echo $dato->nombre; ?>">Eliminar</a></td>
	    			</tr>
	    			<?php
	    			$posicion ++;
	    			} else{
	    				break;
	    			}
	    		}
	    	?>
	    	</table>
        </div> 
        </center>
    </section>
</body>
</html>