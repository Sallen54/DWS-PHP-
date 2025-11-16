<?php
include "funciones.php";

$mensaje = "";

// --- Manejo de SUBIDA ---
if (!empty($_FILES['imagen']['name'])) {

    if (esExtensionValida($_FILES['imagen']['name'])) {

        if ($_FILES['imagen']['size'] <= 2 * 1024 * 1024) { // 2MB
            $destino = "uploads/" . basename($_FILES['imagen']['name']);

            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $destino)) {
                $mensaje = "Imagen subida correctamente.";
            } else {
                $mensaje = "Error al subir la imagen.";
            }
        } else {
            $mensaje = "La imagen es demasiado grande (máx 2MB).";
        }

    } else {
        $mensaje = "El archivo no es una imagen válida.";
    }
}

$imagenes = obtenerImagenes("uploads");
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

    <h2>Subir nueva imagen</h2>

    <form action="index.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="imagen" required>
        <button type="submit">Subir</button>
    </form>

    <hr>

    <h2>Imágenes en la galería</h2>

    <div class="galeria">
        <?php foreach ($imagenes as $archivo => $fecha): ?>
            <div class="item">
                <img src="uploads/<?php echo $archivo; ?>" width="150">
                <p><?php echo $archivo; ?></p>

                <form action="borrar.php" method="POST">
                    <input type="hidden" name="archivo" value="<?php echo $archivo; ?>">
                    <button type="submit">Borrar</button>
                </form>
            </div>
        <?php endforeach; ?>

        <?php if (empty($imagenes)): ?>
            <p>No hay imágenes todavía.</p>
        <?php endif; ?>
    </div>

</body>

</html>