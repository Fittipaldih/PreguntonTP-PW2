<?php

class LobbyModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function obtenerGeneroDesdeBD($nombreUsuario)
    {
        $query = "SELECT Genero FROM usuario WHERE nombre_usuario = ?";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param("s", $nombreUsuario);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $fila = $resultado->fetch_assoc();

        $stmt->close();

        return $fila['Genero'];
    }
    public function getDatosPartida($usuario){
        return $this->database->query("SELECT * FROM partida WHERE id_usuario =
                        (SELECT Id FROM usuario WHERE Nombre_usuario = '$usuario')");
    }
}