<?php
$contrasena = '';
$email = 'root';
$nombrebd = 'goleadores';

try {
    $bd = new PDO(
        'mysql:host=localhost;dbname='.$nombrebd,
        $email,
        $contrasena,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
    );
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
