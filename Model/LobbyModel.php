<?php

class LobbyModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getUserSex($userName)
    {
        $query = "SELECT Genero FROM usuario WHERE nombre_usuario = ?";

        $stmt = $this->database->prepare($query);
        $stmt->bind_param("s", $userName);
        $stmt->execute();

        $rt = $stmt->get_result();
        $fila = $rt->fetch_assoc();

        $stmt->close();

        return $fila['Genero'];
    }

    public function getUserGamesByName($user)
    { // tambien esta en el userModel -> refactorizar
        return $this->database->query("SELECT * FROM partida WHERE id_usuario =
                        (SELECT Id FROM usuario WHERE Nombre_usuario = '$user') ORDER BY id DESC LIMIT 50");
    }
    public function getUserMaxScore($userName){
        return $this->database->query("SELECT puntaje_max FROM usuario WHERE Nombre_usuario = '$userName'");
    }
}