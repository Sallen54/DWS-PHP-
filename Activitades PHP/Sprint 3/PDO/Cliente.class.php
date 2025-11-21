<?php
class Cliente
{
    private $dni;
    private $nombre;
    private $direccion;
    private $localidad;
    private $provincia;
    private $telefono;
    private $email;

    public function __construct($dni, $nombre, $direccion, $localidad, $provincia, $telefono, $email)
    {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->localidad = $localidad;
        $this->provincia = $provincia;
        $this->telefono = $telefono;
        $this->email = $email;
    }

    // Getters
    public function getDni() { return $this->dni; }
    public function getNombre() { return $this->nombre; }
    public function getDireccion() { return $this->direccion; }
    public function getLocalidad() { return $this->localidad; }
    public function getProvincia() { return $this->provincia; }
    public function getTelefono() { return $this->telefono; }
    public function getEmail() { return $this->email; }

    // Setters
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setDireccion($direccion) { $this->direccion = $direccion; }
    public function setLocalidad($localidad) { $this->localidad = $localidad; }
    public function setProvincia($provincia) { $this->provincia = $provincia; }
    public function setTelefono($telefono) { $this->telefono = $telefono; }
    public function setEmail($email) { $this->email = $email; }

    public static function obtenerTodos()
    {
        $pdo = Conexion::conectarBD();
        if ($pdo === null) {
            return [];
        }

        try {
            $stmt = $pdo->query("SELECT * FROM clientes ORDER BY nombre");
            $clientes = [];
            
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $clientes[] = new Cliente(
                    $fila['dni'],
                    $fila['nombre'],
                    $fila['direccion'],
                    $fila['localidad'],
                    $fila['provincia'],
                    $fila['telefono'],
                    $fila['email']
                );
            }
            return $clientes;
        } catch (PDOException $e) {
            echo "Error al obtener clientes: " . $e->getMessage();
            return [];
        } finally {
            $pdo = null;
        }
    }

    public static function obtenerPorDni($dni)
    {
        $pdo = Conexion::conectarBD();
        if ($pdo === null) {
            return null;
        }

        try {
            $stmt = $pdo->prepare("SELECT * FROM clientes WHERE dni = ?");
            $stmt->execute([$dni]);
            $fila = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($fila) {
                return new Cliente(
                    $fila['dni'],
                    $fila['nombre'],
                    $fila['direccion'],
                    $fila['localidad'],
                    $fila['provincia'],
                    $fila['telefono'],
                    $fila['email']
                );
            }
            return null;
        } catch (PDOException $e) {
            echo "Error al obtener cliente: " . $e->getMessage();
            return null;
        } finally {
            $pdo = null;
        }
    }

    public function guardar()
    {
        $pdo = Conexion::conectarBD();
        if ($pdo === null) {
            return false;
        }

        try {
            $stmt = $pdo->prepare("INSERT INTO clientes (dni, nombre, direccion, localidad, provincia, telefono, email) VALUES (?, ?, ?, ?, ?, ?, ?)");
            return $stmt->execute([
                $this->dni,
                $this->nombre,
                $this->direccion,
                $this->localidad,
                $this->provincia,
                $this->telefono,
                $this->email
            ]);
        } catch (PDOException $e) {
            echo "Error al guardar cliente: " . $e->getMessage();
            return false;
        } finally {
            $pdo = null;
        }
    }

    public function actualizar()
    {
        $pdo = Conexion::conectarBD();
        if ($pdo === null) {
            return false;
        }

        try {
            $stmt = $pdo->prepare("UPDATE clientes SET nombre = ?, direccion = ?, localidad = ?, provincia = ?, telefono = ?, email = ? WHERE dni = ?");
            return $stmt->execute([
                $this->nombre,
                $this->direccion,
                $this->localidad,
                $this->provincia,
                $this->telefono,
                $this->email,
                $this->dni
            ]);
        } catch (PDOException $e) {
            echo "Error al actualizar cliente: " . $e->getMessage();
            return false;
        } finally {
            $pdo = null;
        }
    }

    public static function eliminar($dni)
    {
        $pdo = Conexion::conectarBD();
        if ($pdo === null) {
            return false;
        }

        try {
            $stmt = $pdo->prepare("DELETE FROM clientes WHERE dni = ?");
            return $stmt->execute([$dni]);
        } catch (PDOException $e) {
            echo "Error al eliminar cliente: " . $e->getMessage();
            return false;
        } finally {
            $pdo = null;
        }
    }

    public static function existeDni($dni)
    {
        $pdo = Conexion::conectarBD();
        if ($pdo === null) {
            return false;
        }

        try {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM clientes WHERE dni = ?");
            $stmt->execute([$dni]);
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            echo "Error al verificar DNI: " . $e->getMessage();
            return false;
        } finally {
            $pdo = null;
        }
    }

    // Validación de DNI
    public static function validarDni($dni)
    {
        $letras = "TRWAGMYFPDXBNJZSQVHLCKE";
        $dni = strtoupper($dni);
        
        if (preg_match('/^(\d{8})([' . $letras . '])$/', $dni, $matches)) {
            $numero = $matches[1];
            $letra = $matches[2];
            return $letra === $letras[$numero % 23];
        }
        return false;
    }
}
?>