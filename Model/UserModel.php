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

    public function setNameComplete($userLogged, $new)
    {
        return $this->database->update("UPDATE usuario SET Nombre_completo='$new' WHERE Nombre_usuario = '$userLogged'");
    }

    public function setPhoto($userLogged, $new)
    {
        return $this->database->update("UPDATE usuario SET Foto_perfil='$new' WHERE Nombre_usuario = '$userLogged'");
    }

    public function setSex($userLogged, $new)
    {
        return $this->database->update("UPDATE usuario SET Genero='$new' WHERE Nombre_usuario = '$userLogged'");
    }

    public function setBirthDate($userLogged, $new)
    {
        return $this->database->update("UPDATE usuario SET Fecha_nacimiento='$new' WHERE Nombre_usuario = '$userLogged'");
    }

    public function setUbication($userLogged, $new)
    {
        return $this->database->update("UPDATE usuario SET Ciudad='$new' WHERE Nombre_usuario = '$userLogged'");
    }

    public function setMail($userLogged, $new)
    {
        return $this->database->update("UPDATE usuario SET Mail='$new' WHERE Nombre_usuario = '$userLogged'");
    }

}