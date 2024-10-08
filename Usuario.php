<?php

class Usuario {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerUsuarios() {
        $sql = "SELECT * FROM usuarios"; // Asegúrate de que la tabla 'usuarios' existe
        $result = $this->conn->query($sql);
        
        if ($result === false) {
            die("Error en la consulta: " . $this->conn->error); // Muestra el error de la consulta
        }
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Métodos adicionales para crear, actualizar y eliminar usuarios...
}
