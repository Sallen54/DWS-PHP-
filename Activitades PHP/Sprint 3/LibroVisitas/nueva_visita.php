<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Nueva visita</title>
</head>

<body>

    <h1>Escribir un nuevo comentario</h1>

    <form action="insertar_visitas.php" method="post">
        <p>
            <label for="comentario">Comentario:</label><br>
            <textarea name="comentario" id="comentario" rows="5" cols="40" required></textarea>
        </p>
        <p>
            <input type="submit" value="Enviar">
        </p>
    </form>

    <p><a href="libro_visitas.php">Volver al libro de visitas</a></p>
    <p><a href="index.php">Volver al inicio</a></p>

</body>

</html>