<?php

function esImagen($nombre)
{
    $ext = strtolower(pathinfo($nombre, PATHINFO_EXTENSION));
    return ($ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif");
}

function listarImagenes($carpeta)
{
    return scandir($carpeta);
}

?>