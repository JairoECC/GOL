<?php  
if (!isset($_GET['nombre'])) {
    exit();
}

$codigo = $_GET['nombre'];
include '../conexion.php';

// Obtener la foto del jugador antes de eliminarlo
$sentencia_foto = $bd->prepare("SELECT foto FROM jugador WHERE nombre = ?");
$sentencia_foto->execute([$codigo]);
$foto_jugador = $sentencia_foto->fetch(PDO::FETCH_ASSOC)['foto'];

// Debug: Imprimir la ruta de la foto
echo "Ruta de la foto: " . $foto_jugador . "<br>";

// Eliminar al jugador de la base de datos
$sentencia = $bd->prepare("DELETE FROM jugador WHERE nombre = ?");
$resultado = $sentencia->execute([$codigo]);

if ($resultado === TRUE) {
    // Eliminar la foto del jugador si existe
    if (!empty($foto_jugador) && file_exists($foto_jugador)) {
        $borrado = unlink($foto_jugador); // Agregamos una variable para comprobar si se eliminó correctamente
        if($borrado) {
            echo "La foto del jugador fue eliminada correctamente.<br>";
        } else {
            echo "Error al intentar eliminar la foto del jugador.<br>";
        }
    } else {
        echo "La foto del jugador no existe o la ruta es incorrecta.<br>";
    }
    header('Location: ../estadisticas/paginaingresar.php');
} else {
    echo "Error al eliminar el jugador de la base de datos.<br>";
}
?>
