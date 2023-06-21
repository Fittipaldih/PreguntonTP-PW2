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
        $rt= $this->database->singleQuery("SELECT Hash FROM usuario WHERE Hash = '$hash' ");
        return $rt['Hash'];
    }

    public function setUserRolByHash($hash)
    {
        $this->database->update("UPDATE usuario SET Id_rol = 3 WHERE Hash = '$hash'");
    }
}