<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = htmlspecialchars($_POST["nombre"]);
    $email = htmlspecialchars($_POST["email"]);
    $telefono = htmlspecialchars($_POST["telefono"]);
    $fecha_nacimiento = htmlspecialchars($_POST["fecha_nacimiento"]);

    // Mostrar los datos (solo como ejemplo)
    echo "<h2>Datos recibidos:</h2>";
    echo "Nombre: " . $nombre . "<br>";
    echo "Correo: " . $email . "<br>";
    echo "Teléfono: " . $telefono . "<br>";
    echo "Fecha de nacimiento: " . $fecha_nacimiento . "<br>";
} else {
    echo "No se ha enviado ningún formulario.";
}
?>