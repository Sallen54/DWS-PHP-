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

$errores = [];
$datos = [
    'dni' => $cliente->getDni(),
    'nombre' => $cliente->getNombre(),
    'direccion' => $cliente->getDireccion(),
    'localidad' => $cliente->getLocalidad(),
    'provincia' => $cliente->getProvincia(),
    'telefono' => $cliente->getTelefono(),
    'email' => $cliente->getEmail()
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = array_map('trim', $_POST);

    if (empty($datos['nombre'])) {
        $errores[] = 'El nombre es obligatorio';
    }
    
    if (empty($datos['email'])) {
        $errores[] = 'El email es obligatorio';
    }

    if (empty($errores)) {
        $cliente = new Cliente(
            $dni,
            $datos['nombre'],
            $datos['direccion'],
            $datos['localidad'],
            $datos['provincia'],
            $datos['telefono'],
            $datos['email']
        );
        
        if ($cliente->actualizar()) {
            header('Location: index.php?mensaje=Cliente actualizado correctamente');
            exit;
        } else {
            $errores[] = 'Error al actualizar el cliente';
        }
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
    
    <?php foreach ($errores as $error): ?>
        <p><?php echo htmlspecialchars($error); ?></p>
    <?php endforeach; ?>

    <form method="post" action="">
        <div>
            <label>DNI: </label>
            <input type="text" value="<?php echo htmlspecialchars($datos['dni']); ?>" disabled>
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
            <button type="submit">Actualizar</button>
            <a href="index.php">Cancelar</a>
        </div>
    </form>
</body>
</html>