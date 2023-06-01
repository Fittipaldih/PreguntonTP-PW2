<?php

class UserModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getUserByName($userName)
    {
        return $this->database->query("SELECT * FROM usuario WHERE Nombre_usuario = '$userName'");
    }

    public function getUserGamesByName($userName)
    {   // tambien esta en el lobby -> refactorizar
        return $this->database->query("SELECT * FROM partida WHERE id_usuario =
                        (SELECT Id FROM usuario WHERE Nombre_usuario = '$userName')");
    }
}