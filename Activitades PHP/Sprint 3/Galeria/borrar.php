<?php

$archivo = $_POST["archivo"];
$ruta = "uploads/" . $archivo;

if (file_exists($ruta)) {
    unlink($ruta);
}

header("Location: index.php");
exit;
?>