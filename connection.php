<?php

class Connection {

    private $servidor = "localhost";
    private $usuario = "root";
    private $contrasena = "";
    private $conexion;

    public function __construct() {

        try {

            $this->conexion = new PDO("mysql:host=$this->servidor;dbname=album", $this->usuario. $this->contrasena);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        }
        catch(PDOException $e) {

            return "Falla de conexion" . $e;

        }
    }
    //  Insertar datos
    public function ejecutar($sql) {
        $this->conexion->exec($sql);
        return $this->conexion->lastInsertId();
    }
    //  Consultar datos
    public function consultar($sql) {
        $sentencia = $this->conexion->prepare($sql);
        $sentencia->execute();
        return $sentencia->fetchAll();
    }
}

?>