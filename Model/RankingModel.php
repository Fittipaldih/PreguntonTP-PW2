<?php

class RankingModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function obtenerDatosUsuarios(){
        return $this->database->query('SELECT * FROM usuario');
    }
}