<?php
class Conexion {
    private $host;
    private $dbname;
    private $user;
    private $password;




    public function __construct($host, $dbname, $user, $password) {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->password = $password;
    }

    static function conectarBD($host, $dbname, $user, $password) {
        $host="localhost";
        $dbname= "";
        $user= "";
        $password="";
        
    }


}

?>