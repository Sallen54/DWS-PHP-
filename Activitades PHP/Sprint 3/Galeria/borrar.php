<?php
// Obtener el nombre del archivo enviado por POST
$archivo = $_POST["archivo"];
$ruta = "uploads/" . $archivo;

// Verificamos que el archivo exista y lo borramos
if (file_exists($ruta)) {
    unlink($ruta); // Elimina el archivo del servidor
}

header("Location: index.php");
exit;
?>
