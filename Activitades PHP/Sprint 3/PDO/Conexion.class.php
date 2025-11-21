<?php
class Conexion
{
    private $host;
    private $dbname;
    private $user;
    private $password;

    public function __construct($host, $dbname, $user, $password)
    {
        $this->host     = $host;
        $this->dbname   = $dbname;
        $this->user     = $user;
        $this->password = $password;
    }

    static function conectarBD()
    {
        $host     = "10.2.218.1";
        $dbname   = "Alejandro";
        $user     = "tendaFake";
        $password = "Lliurex_01";
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