<?php

if (!empty($_POST['archivo'])) {
    $archivo = "uploads/" . $_POST['archivo'];

    if (file_exists($archivo)) {
        unlink($archivo);
    }
}

// Volver al index
header("Location: index.php");
exit;

?>