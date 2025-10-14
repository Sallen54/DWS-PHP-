<?php
class Cliente
{
    private $dni;
    private $nombre;
    private $direccion;
    private $correo;

    public function __construct($dni, $nombre, $direccion, $correo)
    {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->correo = $correo;
    }

    public function getDni()
    {
        return $this->dni;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getDireccion()
    {
        return $this->direccion;
    }
    public function getCorreo()
    {
        return $this->correo;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }
}
?>