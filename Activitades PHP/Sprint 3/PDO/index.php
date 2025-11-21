<?php
require_once 'Conexion.class.php';
require_once 'Cliente.class.php';

$clientes = Cliente::obtenerTodos();
$mensaje = isset($_GET['mensaje']) ? $_GET['mensaje'] : '';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Clientes</title>
</head>

<body>
    <h1>Gestión de Clientes</h1>

    <?php if ($mensaje): ?>
        <p><?php echo htmlspecialchars($mensaje); ?></p>
    <?php endif; ?>

    <a href="clientenuevo.php">Nuevo Cliente</a>

    <table border="1">
        <thead>
            <tr>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Localidad</th>
                <th>Provincia</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($clientes)): ?>
                <tr>
                    <td colspan="8">No hay clientes registrados</td>
                </tr>
            <?php else: ?>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($cliente->getDni()); ?></td>
                        <td><?php echo htmlspecialchars($cliente->getNombre()); ?></td>
                        <td><?php echo htmlspecialchars($cliente->getDireccion()); ?></td>
                        <td><?php echo htmlspecialchars($cliente->getLocalidad()); ?></td>
                        <td><?php echo htmlspecialchars($cliente->getProvincia()); ?></td>
                        <td><?php echo htmlspecialchars($cliente->getTelefono()); ?></td>
                        <td><?php echo htmlspecialchars($cliente->getEmail()); ?></td>
                        <td>
                            <a href="editarcliente.php?dni=<?php echo urlencode($cliente->getDni()); ?>">Editar</a>
                            <a href="borrarcliente.php?dni=<?php echo urlencode($cliente->getDni()); ?>">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>