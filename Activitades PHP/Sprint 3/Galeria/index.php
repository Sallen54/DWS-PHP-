<?php
include "funciones.php";

$mensaje = "";

if (!empty($_FILES["imagen"]["name"])) {

    $nombre = $_FILES["imagen"]["name"];
    $tmp = $_FILES["imagen"]["tmp_name"];

    if (esImagen($nombre)) {

        $destino = "uploads/" . $nombre;

        if (move_uploaded_file($tmp, $destino)) {
            $mensaje = "Imagen subida.";
        } else {
            $mensaje = "Error al subir.";
        }

    } else {
        $mensaje = "Archivo no permitido.";
    }
}

$lista = listarImagenes("uploads");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Galería Simple</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>

    <h1>Galería Simple</h1>

    <?php if ($mensaje != ""): ?>
        <p class="mensaje"><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <h2>Subir imagen</h2>

    <form method="POST" action="" enctype="multipart/form-data" class="subida">
        <input type="file" name="imagen" required>
        <button type="submit">Subir</button>
    </form>

    <hr>

    <h2>Imágenes</h2>

    <div class="galeria">

        <?php
        foreach ($lista as $img) {

            if ($img != "." && $img != ".." && esImagen($img)) {

                echo "<div class='item'>";
                echo "<img src='uploads/$img'>";
                echo "<p>$img</p>";

                echo "<form action='borrar.php' method='POST'>
                <input type='hidden' name='archivo' value='$img'>
                <button class='borrar'>Borrar</button>
              </form>";

                echo "</div>";
            }
        }
        ?>

    </div>

</body>

</html>