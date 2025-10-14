<?php
require_once 'conexion.php';
require_once 'cliente.php';

function obtenerClientes() {
    $pdo = conectarBD();
    $sql = "SELECT * FROM clientes";
    $stmt = $pdo->query($sql);
    $clientes = [];

    while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $clientes[] = new Cliente($fila['dni'], $fila['nombre'], $fila['direccion'], $fila['correo']);
    }

    desconectarBD($pdo);
    return $clientes;
}

function insertarCliente($dni, $nombre, $direccion, $correo) {
    $pdo = conectarBD();
    $sql = "INSERT INTO clientes (dni, nombre, direccion, correo) VALUES (:dni, :nombre, :direccion, :correo)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            ':dni' => $dni,
            ':nombre' => $nombre,
            ':direccion' => $direccion,
            ':correo' => $correo
        ]);
        return true;
    } catch (PDOException $e) {
        return false;
    } finally {
        desconectarBD($pdo);
    }
}

function obtenerClientePorDni($dni) {
    $pdo = conectarBD();
    $sql = "SELECT * FROM clientes WHERE dni = :dni";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':dni' => $dni]);
    $fila = $stmt->fetch(PDO::FETCH_ASSOC);
    desconectarBD($pdo);

    if ($fila) {
        return new Cliente($fila['dni'], $fila['nombre'], $fila['direccion'], $fila['correo']);
    }
    return null;
}

function actualizarCliente($dni, $nombre, $direccion, $correo) {
    $pdo = conectarBD();
    $sql = "UPDATE clientes SET nombre=:nombre, direccion=:direccion, correo=:correo WHERE dni=:dni";
    $stmt = $pdo->prepare($sql);

    $ok = $stmt->execute([
        ':dni' => $dni,
        ':nombre' => $nombre,
        ':direccion' => $direccion,
        ':correo' => $correo
    ]);
    desconectarBD($pdo);
    return $ok;
}

function borrarCliente($dni) {
    $pdo = conectarBD();
    $sql = "DELETE FROM clientes WHERE dni = :dni";
    $stmt = $pdo->prepare($sql);
    $ok = $stmt->execute([':dni' => $dni]);
    desconectarBD($pdo);
    return $ok;
}
?>
