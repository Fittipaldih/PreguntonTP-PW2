<?php

class HomeModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getUserByName($user)
    {
        return $this->database->query("SELECT * FROM usuario WHERE Nombre_usuario = '$user'");
    }

    public function getUserByNameAndPass($user, $pass)
    {
        return $this->database->query("SELECT * FROM usuario WHERE Nombre_usuario = '$user' and contrasenia_hash = '$pass'");
    }

    public function getUserHash($hash)
    {
        return $this->database->query("SELECT Hash, Nombre_usuario FROM usuario WHERE Hash = '$hash' ");
    }

    public function setUserRol($user)
    {
        $this->database->update("UPDATE usuario SET Id_rol = 3 WHERE Nombre_usuario = '$user'");
    }
}