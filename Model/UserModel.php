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

    public function getUserGamesByName($username)
    {   // tambien esta en el lobby -> refactorizar
        return $this->database->query("SELECT * FROM partida WHERE id_usuario =
                        (SELECT Id FROM usuario WHERE Nombre_usuario = '$username') ORDER BY id DESC LIMIT 50");
    }

    public function setNameComplete($username, $new)
    {
        $this->database->update("UPDATE usuario SET Nombre_completo='$new' WHERE LOWER(Nombre_usuario) = LOWER('$username')");
    }

    public function setBirthDate($username, $new)
    {
        $this->database->update("UPDATE usuario SET Fecha_nacimiento='$new' WHERE LOWER(Nombre_usuario) = LOWER('$username')");
    }

    public function setSex($username, $new)
    {
        $this->database->update("UPDATE usuario SET Genero='$new' WHERE LOWER(Nombre_usuario) = LOWER('$username')");
    }

    public function setCountry($username, $new)
    {
        $this->database->update("UPDATE usuario SET idPais='$new' WHERE LOWER(Nombre_usuario) = LOWER('$username')");
    }

    public function setPhoto($username, $new)
    {
        $this->database->update("UPDATE usuario SET Foto_perfil='$new' WHERE LOWER(Nombre_usuario) = LOWER('$username')");
    }

}