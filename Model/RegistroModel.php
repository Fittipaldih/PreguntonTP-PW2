<?php
class RegistroModel{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function saveUser($nameComplete, $birth, $sex, $country, $city, $mail, $nameUser, $photo, $pass, $passValidate)
    {
        $ret = false;
        $passHash = md5($pass);
        $validateHash = md5($nameUser);

        if ($this->validateUser($mail, $nameUser)) {
            $query = "INSERT INTO usuario (Nombre_completo, Fecha_nacimiento, Genero, Pais, Ciudad, Mail, Nombre_usuario, Foto_perfil, Hash, contrasenia_hash) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->database->prepare($query);
            $stmt->bind_param("ssssssssss", $nameComplete, $birth, $sex, $country, $city, $mail, $nameUser, $photo, $validateHash, $passHash);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                $ret = true;
            }
        }
        return $ret;
    }

    private function validateUser($mail, $nameUser)
    {
        $query = "SELECT COUNT(*) AS count FROM usuario WHERE mail = ? OR nombre_usuario = ?";
        $stmt = $this->database->prepare($query);
        $stmt->bind_param("ss", $mail, $nameUser);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row['count'] > 0) {
            return false;
            // El mail o el nombre ya existen en la base de datos
        } else {
            return true;
        }
    }
}