<?php
class Conexion
{
    static function conectarBD()
    {
        $host = "localhost";
        $dbname = "clientes_php";
        $user = "root";
        $password = "1234";

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo "Error de conexion: " . $e->getMessage();
            return null;
        }
    }
}
?>