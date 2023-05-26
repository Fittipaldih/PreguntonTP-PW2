<?php

class LobbyModel {

    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function validarMail($usuario){
        $result = $this->database->query("SELECT Hash FROM usuario WHERE Nombre_usuario = '$usuario'");
        return $result;
    }

    public function cambiarRol($usuario){
       $this->database->update("UPDATE usuario SET Id_rol = 3 WHERE Nombre_usuario = '$usuario'");
    }
}