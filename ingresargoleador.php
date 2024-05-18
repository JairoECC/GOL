<?php  
    session_start(); // Inicia la sesión para acceder a las variables de sesión
    if (!isset($_POST['oculto'])) {
        exit();
    }

    include 'conexion.php';
    $nombre = $_POST['txtnombre'];
    $goles = $_POST['txtgoles'];

    if (empty($nombre) || empty($goles)){
        header('Location: paginaingresar.php');
    } else{
        // Obtener el usu_id del usuario que ha iniciado sesión
        $usu_id = $_SESSION['usu_id']; // Asumiendo que 'usu_id' se almacena en la sesión al iniciar sesión

        $sentencia = $bd->prepare("INSERT INTO jugador(nombre, goles, usu_id) VALUES (?, ?, ?);");
        $resultado = $sentencia->execute([$nombre, $goles, $usu_id]);

        if ($resultado === TRUE) {
            header('Location: paginaingresar.php');
        } else{
            echo "Error";
        }
    }
?>
