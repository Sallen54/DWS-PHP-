<?php
include("funciones.php");
$directorio_destino = "uploads/";
if (!is_dir($directorio_destino)) {
    mkdir($directorio_destino, 0755, true);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria</title>
</head>

<body>


    <form action="subirarchivo.php" name="subida-imagenes" type="POST" enctype="multipart/formdata">
        <input type="file" name="imagen1" />
        <input type="submit" name="subir-imagen" value="Enviar imagen" />
    </form>


</body>

</html>
<?php
if (verificarArchivo()) {



}
// 3. Construir la ruta completa del archivo en el destino
// basename() ayuda a evitar ataques de directorios
$ruta_destino = $directorio_destino . basename($_FILES['imagen']['name']);

// 4. Mover el archivo desde la ubicación temporal a la ruta de destino
if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino)) {
    echo "El archivo " . htmlspecialchars(basename($_FILES['imagen']['name'])) . " ha sido subido exitosamente.";
} else {
    echo "Hubo un error al subir el archivo.";
}

?>