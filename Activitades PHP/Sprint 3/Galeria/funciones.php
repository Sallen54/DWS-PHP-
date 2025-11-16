<?php

function obtenerImagenes($carpeta) {
    $archivos = scandir($carpeta);
    $imagenes = array();

    foreach ($archivos as $archivo) {
        if ($archivo != "." && $archivo != "..") {
            $ruta = $carpeta . "/" . $archivo;

            $ext = strtolower(pathinfo($ruta, PATHINFO_EXTENSION));
            if ($ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif") {
                $imagenes[$archivo] = filemtime($ruta);
            }
        }
    }

    arsort($imagenes);
    return $imagenes;
}

function esExtensionValida($nombre) {
    $ext = strtolower(pathinfo($nombre, PATHINFO_EXTENSION));
    return ($ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif");
}

?>
