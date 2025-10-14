<?php
require_once 'funciones.php';
$clientes = obtenerClientes();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Clientes (PDO)</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <h1>Listado de Clientes</h1>
    <a href="clientenuevo.php">Nuevo Cliente</a><br><br>

    <table>
        <tr>
            <th>DNI</th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($clientes as $cli): ?>
            <tr>
                <td><?= htmlspecialchars($cli->getDni()) ?></td>
                <td><?= htmlspecialchars($cli->getNombre()) ?></td>
                <td><?= htmlspecialchars($cli->getDireccion()) ?></td>
                <td><?= htmlspecialchars($cli->getCorreo()) ?></td>
                <td>
                    <a href="editarcliente.php?dni=<?= urlencode($cli->getDni()) ?>">✏️ Editar</a> |
                    <a href="borrarcliente.php?dni=<?= urlencode($cli->getDni()) ?>">🗑️ Borrar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>

</html>