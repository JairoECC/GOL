<?php  
	session_start();
	if (!isset($_SESSION['nombre'])) {
		header('Location: login.php');
	}elseif(isset($_SESSION['nombre'])){
		include '../conexion.php';
		$sentencia = $bd->query("SELECT nombre, goles FROM jugador ORDER BY goles DESC");
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
	<link rel="stylesheet" href="../estilos/viewAll.css">
    <title>Estadisticas</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="estilos/navStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Document</title>
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
</style>
<body>
    <div class="buscador">
        <form method="POST" action="buscar.php">
            <label class="input-container">
                <i class="fas fa-search"></i>    
                <input id="ingreText" type="text" name="nombre" placeholder="Ingrese nombre">
            </label>                
        </form>
    </div>
    <div class="muestra">
		<table class="tabla-goleador">
            <h3>Goleadores</h3>
            <tr>
                <th>#</th>
                <th>Jugador</th>
                <th>Goles</th>
            </tr>
            <?php 
            $posicion = 1;
            foreach ($jugador as $dato) {
                if ($posicion <= 10) { // Limitar hasta la posición 8
            ?>
            <tr>
                <td><?php echo $posicion; ?></td>
                <td><?php echo $dato->nombre; ?></td>
                <td><?php echo $dato->goles; ?></td>
                <td><a class="btn btn-warning" id="edit" href="editAndDelete/editGol.php?nombre=<?php echo $dato->nombre; ?>">Editar</a></td>
                <td><a class="btn btn-danger" id="delete" href="editAndDelete/delete.php?nombre=<?php echo $dato->nombre; ?>">Eliminar</a></td>
            </tr>
            <?php
                $posicion++;
            } else {
                break; // Romper el ciclo si se alcanza la posición 8
            }
            }
            ?>
        </table>
    </div>     
</body>
</html>