<?php

class HomeModel
{

    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function buscarUsuario($usuario, $clave){

        return $this->database->query("SELECT * FROM usuario WHERE Nombre_usuario = '$usuario' and contrasenia_hash = '$clave'");

    }
}