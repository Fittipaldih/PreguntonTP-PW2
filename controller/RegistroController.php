<?php

class RegistroController
{
    private $registroModel;
    private $renderer;
    private $sessionManager;

    public function __construct($model, $renderer, $sessionManager)
    {
        $this->registroModel = $model;
        $this->renderer = $renderer;
        $this->sessionManager = $sessionManager;
    }

    public function home()
    {
        if (!$this->isSessionStarted()) {
            $data = [];
            $this->renderer->render("registro", $data);
        } else {
            $this->renderView();
        }
    }

    private function isSessionStarted()
    {
        return $this->sessionManager->get("isConnected");
    }

    private function renderView()
    {
        header("Location: /lobby");
        exit();
    }
    public function newAccount()
    {
        $nameComplete = $_POST["nombre"];
        $birth = $_POST["fecha_nacimiento"];
        $sex = $_POST["sexo"];
        $country = $_POST["pais"];
        $city = $_POST["ciudad"];
        $mail = $_POST["correo"];
        $nameUser = $_POST["nombre_usuario"];
        $photo = basename($_FILES['foto_perfil']['name']);
        $pass = $_POST["contrasenia"];
        $passValidate = $_POST["confirmar_contrasenia"];
        $data = [];

        $imagePath="./public/imagenes/" . $photo;
        move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $imagePath);

        $this->createAccount($pass, $passValidate, $nameComplete, $birth, $sex, $country, $city, $mail, $nameUser, $photo, $data);
    }

    private function createAccount($pass, $passValidate, $nameComplete, $birth, $sex, $country, $city, $mail, $nameUser, $photo, $data)
    {
        if ($this->validatePassword($pass, $passValidate)) {
            if ($this->registroModel->saveUser($nameComplete, $birth, $sex, $country, $city, $mail, $nameUser, $photo, $pass, $passValidate)) {
                $this->renderer->render("registroExitoso", $data);
            } else {
                $data["message"] = "El usuario ya existe";
                $this->renderer->render("registro", $data);
            }
        } else {
            $data["message"] = "Las contraseñas no coinciden";
            $this->renderer->render("registro", $data);
        }
    }

    private function validatePassword($pass, $passValidate)
    {
        return $pass === $passValidate;
    }
}