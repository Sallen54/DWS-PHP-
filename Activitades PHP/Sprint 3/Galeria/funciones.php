<?php
// Comprueba si un archivo es una imagen válida (JPG, PNG, GIF)
function esImagen($nombre) {
    $ext = strtolower(pathinfo($nombre, PATHINFO_EXTENSION));
    return ($ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif");
}

// Devuelve un listado de todos los archivos en la carpeta dada
function listarImagenes($carpeta) {
    return scandir($carpeta); // scandir devuelve todos los archivos y carpetas
}
?>
