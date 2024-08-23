<?php
session_start();
if (!isset($_POST['oculto'])) {
    exit();
}

include '../conexion.php';
$nombre = $_POST['txtnombre'];
$tar_ama = $_POST['txtamarillas'];
$equipo = $_POST['txtequipo'];

if (empty($nombre) || empty($tar_ama) || empty($equipo)) {
    header('Location: ../estadisticas/amarillas.php');
    exit();
}

// Obtener el usu_id del usuario que ha iniciado sesión
$usu_id = $_SESSION['usu_id'];

// Manejar la subida de la imagen si se seleccionó una
if ($_FILES["foto_perfil"]["size"] > 0) {
    $target_dir = "../img/uploads/";
    
    // Generar un nombre único para el archivo
    $timestamp = time(); // Obtener el timestamp actual
    $target_file = $target_dir . $timestamp . '_' . basename($_FILES["foto_perfil"]["name"]);

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verificar si el archivo es una imagen real o falsa
    $check = getimagesize($_FILES["foto_perfil"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "El archivo no es una imagen.";
        $uploadOk = 0;
    }

    // Verificar si el archivo ya existe
    if (file_exists($target_file)) {
        echo "Lo siento, el archivo ya existe.";
        $uploadOk = 0;
    }

    // Verificar el tamaño del archivo
    if ($_FILES["foto_perfil"]["size"] > 10000000) {
        echo "Lo siento, tu archivo es demasiado grande.";
        $uploadOk = 0;
    }

    // Permitir ciertos formatos de archivo
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.";
        $uploadOk = 0;
    }

    // Verificar si $uploadOk es 0 por un error
    if ($uploadOk == 0) {
        echo "Lo siento, tu archivo no fue subido.";
    // Si todo está bien, intenta subir el archivo
    } else {
        if (move_uploaded_file($_FILES["foto_perfil"]["tmp_name"], $target_file)) {
            // Insertar los datos en la base de datos
            $sentencia = $bd->prepare("INSERT INTO jugador3 (nombre, equipo, tar_ama, usu_id, foto) VALUES (?, ?, ?, ?, ?);");
            $resultado = $sentencia->execute([$nombre, $equipo, $tar_ama, $usu_id, $target_file]);

            if ($resultado === TRUE) {
                header('Location: ../estadisticas/amarillas.php');
            } else {
                echo "Error al insertar los datos.";
            }
        } else {
            echo "Lo siento, hubo un error al subir tu archivo.";
        }
    }
} else {
    // Insertar los datos en la base de datos sin foto
    $sentencia = $bd->prepare("INSERT INTO jugador3 (nombre, equipo, tar_ama, usu_id) VALUES (?, ?, ?, ?);");
    $resultado = $sentencia->execute([$nombre, $equipo, $tar_ama, $usu_id]);

    if ($resultado === TRUE) {
        header('Location: ../estadisticas/amarillas.php');
    } else {
        echo "Error al insertar los datos.";
    }
}
?>
