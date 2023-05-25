<?php

class UserModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getUsuarioPorId() {
        session
        return $this->database->query('SELECT * FROM usuario WHERE Id = 2');
        /* $sql = "SELECT * FROM usuario WHERE id = ?";
        $stmt = $this->database-
        if ($stmt === false) {
            die("Error en la consulta: " . $this->database->error);
        }
        $parametro = 2;
        $stmt->bind_param("i", $parametro);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado; */
    }
}