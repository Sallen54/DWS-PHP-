<?php
require_once 'Conexion.class.php';
require_once 'Cliente.class.php';

$errores = [];
$datos = [
    'dni' => '',
    'nombre' => '',
    'direccion' => '',
    'localidad' => '',
    'provincia' => '',
    'telefono' => '',
    'email' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = array_map('trim', $_POST);

    if (empty($datos['dni'])) {
        $errores[] = 'El DNI es obligatorio';
    } elseif (Cliente::existeDni($datos['dni'])) {
        $errores[] = 'El DNI ya existe';
    }

    if (empty($datos['nombre'])) {
        $errores[] = 'El nombre es obligatorio';
    }

    if (empty($datos['email'])) {
        $errores[] = 'El email es obligatorio';
    }

    if (empty($errores)) {
        $cliente = new Cliente(
            $datos['dni'],
            $datos['nombre'],
            $datos['direccion'],
            $datos['localidad'],
            $datos['provincia'],
            $datos['telefono'],
            $datos['email']
        );

        if ($cliente->guardar()) {
            header('Location: index.php?mensaje=Cliente creado correctamente');
            exit;
        } else {
            $errores[] = 'Error al guardar el cliente';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Nuevo Cliente</title>
</head>

<body>
    <h1>Nuevo Cliente</h1>

    <?php foreach ($errores as $error): ?>
        <p><?php echo htmlspecialchars($error); ?></p>
    <?php endforeach; ?>

    <form method="post" action="">
        <div>
            <label>DNI: </label>
            <input type="text" name="dni" value="<?php echo htmlspecialchars($datos['dni']); ?>">
        </div>

        <div>
            <label>Nombre: </label>
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($datos['nombre']); ?>">
        </div>

        <div>
            <label>Dirección: </label>
            <input type="text" name="direccion" value="<?php echo htmlspecialchars($datos['direccion']); ?>">
        </div>

        <div>
            <label>Localidad: </label>
            <input type="text" name="localidad" value="<?php echo htmlspecialchars($datos['localidad']); ?>">
        </div>

        <div>
            <label>Provincia: </label>
            <input type="text" name="provincia" value="<?php echo htmlspecialchars($datos['provincia']); ?>">
        </div>

        <div>
            <label>Teléfono: </label>
            <input type="text" name="telefono" value="<?php echo htmlspecialchars($datos['telefono']); ?>">
        </div>

        <div>
            <label>Email: </label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($datos['email']); ?>">
        </div>

        <div>
            <button type="submit">Guardar</button>
            <a href="index.php">Cancelar</a>
        </div>
    </form>
</body>

</html>