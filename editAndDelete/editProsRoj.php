<?php 
session_start();
if (!isset($_POST['nombre_existente'])) {
    header('Location: ../estadisticas/paginaingresar.php');
    exit();
}

include '../conexion.php';
$nombre = $_POST['txtnombre'];
$roja = $_POST['txtroja'];
$equipo = $_POST['txtequipo'];

$nombreExistente = $_POST['nombre_existente'];

if (empty($nombre) || empty($roja) || empty($equipo)) {
    header('Location: ../estadisticas/rojas.php');
    exit();
}

// Manejar la subida de la imagen si se seleccionó una
if ($_FILES["foto_perfil"]["size"] > 0) {
    $target_dir = "../img/uploads/";
    
    // Generar un nombre único para el archivo
    $timestamp = time();
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
    } else {
        if (move_uploaded_file($_FILES["foto_perfil"]["tmp_name"], $target_file)) {
            // Actualizar los datos en la base de datos con foto
            $sentencia = $bd->prepare("UPDATE jugador4 SET nombre = ?, equipo = ?, tar_roj = ?, foto = ? WHERE nombre = ?;");
            $resultado = $sentencia->execute([$nombre, $equipo, $roja, $target_file, $nombreExistente]);

            if ($resultado === TRUE) {
                header('Location: ../estadisticas/rojas.php');
            } else {
                echo "Error al actualizar los datos.";
            }
        } else {
            echo "Lo siento, hubo un error al subir tu archivo.";
        }
    }
} else {
    // Actualizar los datos en la base de datos sin foto
    $sentencia = $bd->prepare("UPDATE jugador4 SET nombre = ?, equipo = ?, tar_roj = ? WHERE nombre = ?;");
    $resultado = $sentencia->execute([$nombre, $equipo, $roja, $nombreExistente]);

    if ($resultado === TRUE) {
        header('Location: ../estadisticas/rojas.php');
    } else {
        echo "Error al actualizar los datos.";
    }
}
?>
