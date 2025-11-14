<?php
include_once("funciones.php");

$visitas = leer_visitas("visitas.txt");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Libro de Visitas</title>
</head>

<body>

    <h1>Libro de Visitas</h1>
    <p><a href="nueva_visita.php">Añadir nuevo comentario</a></p>
    <hr>

    <?php
    if (!empty($visitas)) {
        foreach ($visitas as $visita) {
            mostrar_visitas($visita);
            echo "<hr>";
        }
    } else {
        echo "<p>No hay comentarios todavia.</p>";
    }
    ?>

    <p><a href="index.php">Volver al inicio</a></p>
</body>

</html>