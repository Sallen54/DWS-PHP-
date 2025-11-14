<?php
include_once("funciones.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comentario = trim($_POST["comentario"]);

    if (!empty($comentario)) {
        escribir_visita("visitas.txt", $comentario);
    }
}

header("Location: libro_visitas.php");
exit;
?>