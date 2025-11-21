<?php
require_once 'Conexion.class.php';
require_once 'Cliente.class.php';

if (!isset($_GET['dni'])) {
    header('Location: index.php');
    exit;
}

$dni = $_GET['dni'];
$cliente = Cliente::obtenerPorDni($dni);

if ($cliente === null) {
    header('Location: index.php');
    exit;
}

if (isset($_GET['confirmar']) && $_GET['confirmar'] === 'si') {
    if (Cliente::eliminar($dni)) {
        header('Location: index.php?mensaje=Cliente eliminado correctamente');
    } else {
        header('Location: index.php?mensaje=Error al eliminar el cliente');
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Cliente</title>
</head>
<body>
    <h1>Eliminar Cliente</h1>
    
    <p>¿Está seguro de que desea eliminar este cliente?</p>
    <p>DNI: <?php echo htmlspecialchars($cliente->getDni()); ?></p>
    <p>Nombre: <?php echo htmlspecialchars($cliente->getNombre()); ?></p>
    
    <div>
        <a href="borrarcliente.php?dni=<?php echo urlencode($dni); ?>&confirmar=si">Sí, eliminar</a>
        <a href="index.php">Cancelar</a>
    </div>
</body>
</html>