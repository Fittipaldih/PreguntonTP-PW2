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
        $result = $this->database->query("SELECT Foto_perfil FROM usuario WHERE nombre_usuario = '$userName'");
        if ($result === null || empty($result)) {
            return null;
        }
        return $result[0]['Foto_perfil'];
    }
    public function getUserLevelByName($userName)
    {
        return $this->database->query("SELECT nivel FROM usuario WHERE Nombre_usuario = '$userName'");
    }
    public function getUserGamesByName($username)
    {
        return $this->database->query("SELECT * FROM partida WHERE id_usuario =
                        (SELECT Id FROM usuario WHERE Nombre_usuario = '$username') ORDER BY id DESC LIMIT 50");
    }
    public function getUserMaxScore($idUser)
    {
        return $this->database->query("SELECT MAX(puntaje) FROM partida WHERE id_usuario=$idUser");
    }
    public function getUserMaxScoreByName($username)
    {
        $rt= $this->database->singleQuery("SELECT puntaje_max FROM usuario WHERE Nombre_usuario = '$username'");
        return $rt["puntaje_max"];
    }

    public function updateLevelUserById($idUsuario)
    {
        $this->database->update("UPDATE usuario
                                 SET nivel = (cant_acertadas / cant_respondidas) * 100
                                 WHERE id = $idUsuario;");
    }
    public function updateCorrectAnswer($idUsuario)
    {
        $this->database->update("UPDATE usuario
                                 SET cant_acertadas = cant_acertadas + 1
                                 WHERE id = $idUsuario;");
    }
    public function updateUserMaxScore($idUser, $puntos)
    {
        return $this->database->update("UPDATE usuario SET puntaje_max = '$puntos' WHERE id = $idUser");
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