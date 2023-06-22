<?php

class LobbyModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getUserGenre($userName)
    {
        $rt= $this->database->singleQuery("SELECT genero FROM usuario WHERE Nombre_usuario = '$userName'");
        return $rt["genero"];
    }

    public function getFiveUserGames($userName)
    {
        return $this->database->query("SELECT * FROM partida WHERE id_usuario =(SELECT Id FROM usuario WHERE Nombre_usuario = '$userName') ORDER BY id DESC LIMIT 5");
    }

}