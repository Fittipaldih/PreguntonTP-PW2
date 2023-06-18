<?php

class RankingModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getNameAndScoreByPositionOfUsers()
    {
        return $this->database->query('SELECT Nombre_usuario, Puntaje_max,
    (SELECT COUNT(*) + 1 FROM usuario AS u2 WHERE u2.Puntaje_max > u1.Puntaje_max) AS Posicion 
    FROM usuario AS u1 
    WHERE u1.id_rol = 3
    ORDER BY Puntaje_max DESC;');

    }
}