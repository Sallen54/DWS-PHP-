<?php
function conectarBD() {
    $host = "localhost";
    $dbname = "clientes_php";
    $usuario = "root";
    $password = "1234"; 

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Error al conectar con la base de datos: " . $e->getMessage());
    }
}

function desconectarBD(&$pdo) {
    $pdo = null;
}
?>
