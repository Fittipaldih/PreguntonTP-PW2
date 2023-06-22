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
    public function getUserPhoto($userName)
    {
        $rt=$this->database->query("SELECT Foto_perfil FROM usuario WHERE nombre_usuario = '$userName'");
        return $rt['Foto_perfil'];
    }
    public function setNameComplete($username, $new)
    {
        $this->database->update("UPDATE usuario SET Nombre_completo = '$new' WHERE LOWER(Nombre_usuario) = LOWER('$username')");
    }
    public function setBirthDate($username, $new)
    {
        $this->database->update("UPDATE usuario SET Fecha_nacimiento = '$new' WHERE LOWER(Nombre_usuario) = LOWER('$username')");
    }
    public function setSex($username, $new)
    {
        $this->database->update("UPDATE usuario SET Genero = '$new' WHERE LOWER(Nombre_usuario) = LOWER('$username')");
    }
    public function setCountry($username, $new)
    {
        $this->database->update("UPDATE usuario SET idPais = '$new' WHERE LOWER(Nombre_usuario) = LOWER('$username')");
    }
    public function setPhoto($username, $new)
    {
        $this->database->update("UPDATE usuario SET Foto_perfil = '$new' WHERE LOWER(Nombre_usuario) = LOWER('$username')");
    }
}