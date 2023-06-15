<?php

class RegistroController
{
    private $registroModel;
    private $renderer;

    public function __construct($model, $renderer)
    {
        $this->registroModel = $model;
        $this->renderer = $renderer;
    }

    public function home()
    {
        $data = [];
        $this->renderer->render("registro", $data);
    }
    public function newAccount()
    {
        $nameComplete = $_POST["nombre"];
        $birth = $_POST["fecha_nacimiento"];
        $sex = $_POST["sexo"];
        $country = $_POST["pais"];
        $lat = $_POST['lat'];
        $lng = $_POST['lng'];
        $mail = $_POST["correo"];
        $nameUser = $_POST["nombre_usuario"];
        $pass = $_POST["contrasenia"];
        $passValidate = $_POST["confirmar_contrasenia"];
        $photo = basename($_FILES['foto_perfil']['name']);
        $imagePath = "/public/imagenes/" . $photo;

        $data = [];

        if ($this->createAccount($pass, $passValidate, $nameComplete, $birth, $sex, $country, $lat, $lng, $mail, $nameUser, $photo, $data))
        {  move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $imagePath);
        }
    }

    private function createAccount($pass, $passValidate, $nameComplete, $birth, $sex, $country, $lat, $lng, $mail, $nameUser, $photo, $data)
    {
        $rt=false;
        if ($this->validatePassword($pass, $passValidate)) {
            if ($this->registroModel->saveUser($nameComplete, $birth, $sex, $country, $lat, $lng, $mail, $nameUser, $photo, $pass, $passValidate)) {
                $hash=$this->registroModel->getHash($mail);
                $this->registroModel->sendValidateEmail($mail, $hash, $nameComplete);
                $this->renderer->render("registroExitoso", $data);
                $rt=true;
            } else {
                $data["message"] = "el usuario ya está registrado. Prueba con otro nombre o un mail distinto.";
                $data['showMessage'] = true;
                $this->renderer->render("registro", $data);
            }
        } else {
            $data["message"] = "las contraseñas no coinciden. Intentá nuevamente. ";
            $data['showMessage'] = true;
            $this->renderer->render("registro", $data);
        }
        return $rt;
    }

    private function validatePassword($pass, $passValidate)
    {
        return $pass === $passValidate;
    }

}