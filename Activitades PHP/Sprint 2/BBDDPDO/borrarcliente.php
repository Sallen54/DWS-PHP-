<?php
require_once 'funciones.php';
$dni = $_GET['dni'] ?? null;
$cliente = obtenerClientePorDni($dni);

if (!$cliente)
    die("Cliente no encontrado.");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['confirmar'])) {
        if (borrarCliente($dni)) {
            header("Location: index.php");
            exit;
        } else {
            echo "Error al borrar el cliente.";
        }
    } else {
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Borrar Cliente</title>
</head>

<body>
    <h1>Eliminar Cliente</h1>
    <p>¿Seguro que deseas eliminar al cliente <strong><?= htmlspecialchars($cliente->getNombre()) ?></strong>?</p>

    <form method="POST">
        <button type="submit" name="confirmar">Sí, eliminar</button>
        <button type="submit" name="cancelar">Cancelar</button>
    </form>
</body>

</html>