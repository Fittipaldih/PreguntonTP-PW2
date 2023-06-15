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
        return $this->database->query("SELECT u.*, p.nombre AS nombrep
              FROM usuario u
              JOIN pais p ON u.idPais = p.id
              WHERE u.Nombre_usuario = '$userName'");
    }

    public function getUserGamesByName($userName)
    {   // tambien esta en el lobby -> refactorizar
        return $this->database->query("SELECT * FROM partida WHERE id_usuario =
                        (SELECT Id FROM usuario WHERE Nombre_usuario = '$userName') ORDER BY id DESC LIMIT 10");
    }

    public function setNameComplete($userLogged, $new)
    {
        $this->database->update("UPDATE usuario SET Nombre_completo='$new' WHERE LOWER(Nombre_usuario) = LOWER('$userLogged')");
    }

    public function setBirthDate($userLogged, $new)
    {
        $this->database->update("UPDATE usuario SET Fecha_nacimiento='$new' WHERE LOWER(Nombre_usuario) = LOWER('$userLogged')");
    }

    public function setSex($userLogged, $new)
    {
        $this->database->update("UPDATE usuario SET Genero='$new' WHERE LOWER(Nombre_usuario) = LOWER('$userLogged')");
    }

    public function setCountry($userLogged, $new)
    {
        $this->database->update("UPDATE usuario SET idPais='$new' WHERE LOWER(Nombre_usuario) = LOWER('$userLogged')");
    }

    public function setPhoto($userLogged, $new)
    {
        $this->database->update("UPDATE usuario SET Foto_perfil='$new' WHERE LOWER(Nombre_usuario) = LOWER('$userLogged')");
    }

}