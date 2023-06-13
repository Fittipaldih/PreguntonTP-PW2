<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


class RegistroModel{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }
    public function sendValidateEmail($email, $hash, $nameComplete){
        $mail = new PHPMailer;
        try{
            $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'mail.cinalent.com.ar';
        $mail->SMTPAuth = true;
        $mail->Username = 'pregunton@cinalent.com.ar';
        $mail->Password = 'q9aHxdjV[rj#';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;


        $mail->setFrom('pregunton@cinalent.com.ar', 'Pregunton');
        $mail->addAddress($email, $nameComplete);
        $mail->Subject = '¡Valida tu cuenta para empezar a jugar!';


        $mail->isHTML(true);
        $mail->Body = '<h1> Tu URL para el activar tu correo </h1>
                         Haz click <a href="' . $_SERVER['SERVER_NAME'] . '/Home/validateEmail?hash=' . $hash . '">en este link</a> para validar tu email';
        $mail->AltBody = 'Si no puedes ver este mensaje, por favor, habilita el soporte para HTML en tu cliente de correo.';
        $mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }


    }
    public function saveUser($nameComplete, $birth, $sex, $country, $lat, $lng, $mail, $nameUser, $photo, $pass, $passValidate)
    {
        $ret = false;
        $passHash = md5($pass);
        $token = openssl_random_pseudo_bytes(16);
        $validateHash = md5($token);

        if ($this->validateUser($mail, $nameUser)) {
            $query = "INSERT INTO usuario (Nombre_completo, Fecha_nacimiento, Genero, idPais, lat, lng, Mail, Nombre_usuario, Foto_perfil, Hash, contrasenia_hash) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->database->prepare($query);
            $stmt->bind_param("sssiddsssss", $nameComplete, $birth, $sex, $country, $lat, $lng, $mail, $nameUser, $photo, $validateHash, $passHash);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                $ret = true;
            }
        }
        return $ret;
    }

    public function validateUser($mail, $nameUser)
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

    public function getHash($email){
        $resultado= $this->database->singleQuery("SELECT Hash FROM usuario WHERE mail = '$email'");

        return $resultado['Hash'];
    }

}