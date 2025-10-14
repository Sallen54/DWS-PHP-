<?php
include("usuarios.php");

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];
$archivo = "accesos.txt";

// Comprobación de credenciales
if (isset($usuarios[$usuario]) && $usuarios[$usuario] === $clave) {
    // Usuario válido
    $mensaje = "El usuario $usuario ha accedido al sistema.\n";
    file_put_contents($archivo, $mensaje, FILE_APPEND);
    header("Location: ok.php");
    exit;
} else {
    // Usuario no válido
    $mensaje = "Intento fallido de acceso del usuario $usuario.\n";
    file_put_contents($archivo, $mensaje, FILE_APPEND);
    header("Location: error.html");
    exit;
}
?>