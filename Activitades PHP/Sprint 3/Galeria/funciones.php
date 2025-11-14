<?php

function verificarArchivo()
{
    // 1. Verificar que se envió un archivo y que no hubo errores
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        // 2. Definir el directorio de destino
        

        // Asegúrate de que la carpeta "uploads" exista y tenga permisos de escritura
        
        
    } else {
        // Manejar errores (por ejemplo, el archivo está vacío o hay un error en la carga)
        //(echo "Error al subir el archivo. Código de error: " . $_FILES['imagen']['error'];
        return false;
    }

    return true;
}
?>