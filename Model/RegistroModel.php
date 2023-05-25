<?php

class RegistroModel
{

    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }


    public function validarUsuario($correo, $nombre_usuario){
        $query= "SELECT COUNT(*) as count FROM usuario WHERE mail = ? OR nombre_usuario = ?";
        $stmt = $this->database->prepare($query);
        $stmt->bind_param("ss", $correo, $nombre_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row['count'] > 0) {
            return false;
            // El correo electrónico o el nombre de usuario ya existen en la base de datos
        } else {
            return true;
            // El correo electrónico y el nombre de usuario no existen en la base de datos
        }
    }
    public function guardarUsuario($nombre, $anio_nacimiento, $sexo, $pais, $ciudad, $correo, $nombre_usuario, $foto_perfil, $contrasenia, $confirmar_contrasenia){
        $contraseniahasheada = password_hash($contrasenia, PASSWORD_DEFAULT);
        $hashParaValidar = password_hash($nombre_usuario, PASSWORD_DEFAULT);

        if ($this->validarUsuario($correo, $nombre_usuario)){
            $query = "INSERT INTO usuario (Nombre_completo, Anio_nacimiento, Genero, Pais, Ciudad, Mail, Nombre_usuario, Foto_perfil, Hash, contrasenia_hash) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->database->prepare($query);
            $stmt->bind_param("ssssssssss", $nombre, $anio_nacimiento, $sexo, $pais, $ciudad, $correo, $nombre_usuario, $foto_perfil, $hashParaValidar, $contraseniahasheada );
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                return true;
            }else
                return false;
        }
    }
















}