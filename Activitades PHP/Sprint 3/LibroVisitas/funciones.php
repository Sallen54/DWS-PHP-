<?php
// Función para leer todas las visitas del archivo de texto
function leer_visitas($archivo)
{
    // Si el archivo no existe, retorna un array vacío
    if (!file_exists($archivo)) {
        return [];
    }
    // Lee el archivo línea por línea, ignorando saltos de línea y líneas vacías
    $lineas = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    return $lineas;
}

function mostrar_visitas($texto)
{
    $text = htmlspecialchars($texto);
    echo "<p>$text</p>";
}

function escribir_visita($archivo, $texto)
{
    // Obtener la fecha y hora actual
    $fecha = date("d/m/Y H:i:s");
    // Combinar el comentario con la fecha y hora
    $contenido = trim($texto) . " | " . $fecha . "\n";
    $f = fopen($archivo, "a");
    if ($f) {
        // Escribir el contenido en el archivo
        fwrite($f, $contenido);
        // Cerrar el archivo
        fclose($f);
    }
}
