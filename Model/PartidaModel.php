<?php

class PartidaModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function cleanTable($idUser)
    {
        $this->database->update("DELETE FROM usuario_pregunta WHERE id_usuario = '$idUser'");
    }
    public function insertUserGamesByName($idUser, $puntaje)
    {
        return $this->database->update("INSERT INTO partida (id_usuario, puntaje) VALUES('$idUser', '$puntaje') ");
    }


}