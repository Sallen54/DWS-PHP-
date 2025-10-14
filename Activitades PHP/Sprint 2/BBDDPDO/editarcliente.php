<?php
require_once 'funciones.php';
$dni = $_GET['dni'] ?? null;
$cliente = obtenerClientePorDni($dni);
$mensaje = "";

if (!$cliente) {
    die("Cliente no encontrado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['correo'];

    if (!empty($nombre) && !empty($correo)) {
        if (actualizarCliente($dni, $nombre, $direccion, $correo)) {
            header("Location: index.php");
            exit;
        } else {
            $mensaje = "Error al actualizar el cliente.";
        }
    } else {
        $mensaje = "Campos obligatorios vacíos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
</head>

<body>
    <h1>Editar Cliente</h1>
    <p style="color:red;"><?= $mensaje ?></p>
    <form method="POST">
        DNI: <input type="text" name="dni" value="<?= htmlspecialchars($cliente->getDni()) ?>" disabled><br>
        Nombre: <input type="text" name="nombre" value="<?= htmlspecialchars($cliente->getNombre()) ?>"><br>
        Dirección: <input type="text" name="direccion" value="<?= htmlspecialchars($cliente->getDireccion()) ?>"><br>
        Correo: <input type="email" name="correo" value="<?= htmlspecialchars($cliente->getCorreo()) ?>"><br><br>
        <button type="submit">Guardar Cambios</button>
    </form>
    <a href="index.php">⬅️ Volver</a>
</body>

</html>