<?php

class UserModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getUsuarioPorNombre($nombreUsuario)
    {
        return $this->database->query("SELECT * FROM usuario WHERE Nombre_usuario = '$nombreUsuario'");

    }
    // esto esta repetido en Lobby tambien
    public function getDatosPartida($usuario){
        return $this->database->query("SELECT * FROM partida WHERE id_usuario =
                        (SELECT Id FROM usuario WHERE Nombre_usuario = '$usuario')");
    }
}