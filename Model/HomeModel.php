<?php

class HomeModel
{

    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function login(){

    }

    public function buscarUsuario($usuario, $clave){
        $result = $this->database->query("SELECT * FROM usuario WHERE Nombre_usuario = '$usuario' and contrasenia_hash = '$clave'");
        return $result;
    }

    public function getRolUsuario($usuario){
        $result = $this->database->query("SELECT Id_rol FROM usuario WHERE Nombre_usuario = '$usuario'");
        return $result;
    }
}