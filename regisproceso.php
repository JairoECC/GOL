<?php
if (!isset($_POST['oculto'])) {
    exit();
}

include 'conexion.php';

$nombre_usu=$_POST['txtNombre'];
$email = $_POST['txtEmail'];
$contrasena = $_POST['txtPass'];

// Verifica si algún campo está vacío
if (empty($nombre_usu) || empty($email) || empty($contrasena)) {
    header('Location: registro.php');
} else {
    $sentencia = $bd->prepare("INSERT INTO usuario(nombre_usu,email_usu,password_usu) VALUES (?,?,?);");
    $resultado = $sentencia->execute([$nombre_usu, $email,$contrasena]);

    if ($resultado === TRUE) {
        header('Location: login.php');
    } else {
        echo "Error al insertar usuario";
    }
}
?>