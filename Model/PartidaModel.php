<?php

class PartidaModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }


    public function insertUserGamesByName($idUser, $puntaje)
    {
        return $this->database->update("INSERT INTO partida (id_usuario, puntaje) VALUES('$idUser', '$puntaje') ");
    }


}