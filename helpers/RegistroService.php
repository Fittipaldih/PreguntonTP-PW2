<?php

class RegistroService
{
    private $model;
    public function __construct($model){
        $this->model= $model;
    }
    public function receiveRegistrationForm($formData)
    {
        $data = [];
        $nameComplete = $formData["nombre"];
        $birth = $formData["fecha_nacimiento"];
        $sex = $formData["sexo"];
        $country = $formData["pais"];
        $lat = $formData["lat"];
        $lng = $formData["lng"];
        $mail = $formData["correo"];
        $nameUser = $formData["nombre_usuario"];
        $pass = $formData["contrasenia"];
        $passValidate = $formData["confirmar_contrasenia"];
        $photo = null;

        if ($formData['foto_perfil']['name']) {
            $photo = basename($formData['foto_perfil']['name']);
            $imagePath = "./public/imagenes/" . $photo;
            move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $imagePath);
        }
        if (!$this->validatePassword($pass, $passValidate)) {
            return "Las contraseñas no coinciden. Intentá nuevamente.";
        } else {
            if (!$this->createAccount($pass, $nameComplete, $birth, $sex, $country, $lat, $lng, $mail, $nameUser, $photo)) {
                return "El usuario ya está registrado. Prueba con otro nombre o un correo electrónico diferente.";
            } else {
                return true;
            }
        }
    }

    private function createAccount($pass, $nameComplete, $birth, $sex, $country, $lat, $lng, $mail, $nameUser, $photo): bool
    {
        {
            if ($this->model->saveUser($nameComplete, $birth, $sex, $country, $lat, $lng, $mail, $nameUser, $photo, $pass)) {
                $hash = $this->model->getHash($mail);
                $this->model->sendValidateEmail($mail, $hash, $nameComplete);
                return true;
            }
        }
        return false;
    }

    private function validatePassword($pass, $passValidate)
    {
        return $this->model->validatePassword($pass, $passValidate);
    }

}