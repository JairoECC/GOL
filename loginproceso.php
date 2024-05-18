<?php 
    session_start();
    include_once 'conexion.php';
    $email = $_POST['txtEmail'];
    $contrasena = $_POST['txtPass'];
    $sentencia = $bd->prepare('select * from usuario where 
                                email_usu = ? and password_usu = ?;');
    $sentencia->execute([$email, $contrasena]);
    $datos = $sentencia->fetch(PDO::FETCH_OBJ);

    if ($datos === FALSE) {
        header('Location: login.php');
    } elseif($sentencia->rowCount() == 1){
        $_SESSION['nombre'] = $datos->nombre_usu;
        $_SESSION['usu_id'] = $datos->usu_id; // Guardar el usu_id en la sesión
        header('Location: paginaingresar.php');
    }
?>
