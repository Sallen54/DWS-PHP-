<?php
include "funciones.php";

$mensaje = ""; // Mensaje para mostrar resultados de la subida

if (!empty($_FILES["imagen"]["name"])) {

    $nombre = $_FILES["imagen"]["name"];
    $tmp = $_FILES["imagen"]["tmp_name"];
    // Verificamos que sea imagen válida
    if (esImagen($nombre)) { 

        $destino = "uploads/" . $nombre;
        // Movemos el archivo al servidor
        if (move_uploaded_file($tmp, $destino)) { 
            $mensaje = "Imagen subida correctamente.";
        } else {
            $mensaje = "Error al subir la imagen.";
        }

    } else {
        $mensaje = "Solo se permiten imágenes JPG, PNG o GIF.";
    }
}

$lista = listarImagenes("uploads"); // Obtenemos todos los archivos de la carpeta uploads
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

<!-- Mostrar mensaje si hay -->
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
// Recorrer todos los archivos de la carpeta uploads
foreach ($lista as $img) {

    // Ignoramos "." y ".." y verificamos que sea imagen
    if ($img != "." && $img != ".." && esImagen($img)) {

        echo "<div class='item'>";
        echo "<img src='uploads/$img'>"; // Miniatura
        echo "<p>$img</p>"; // Nombre del archivo

        // Formulario para borrar la imagen
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
