<?php

class HomeModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getUserByNameAndPass($user, $pass)
    {
        return $this->database->query("SELECT * FROM usuario WHERE Nombre_usuario = '$user' and contrasenia_hash = '$pass'");
    }
    public function getUserIdByNameAndPass($user, $pass)
    {
        return $this->database->query("SELECT id FROM usuario WHERE Nombre_usuario = '$user' and contrasenia_hash = '$pass'");
    }

    public function setUserRol($user)
    {
        $this->database->update("UPDATE usuario SET Id_rol = 3 WHERE Nombre_usuario = '$user'");
    }

}