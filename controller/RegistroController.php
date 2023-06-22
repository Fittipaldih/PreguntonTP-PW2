<?php

class RegistroController
{
    private $registroModel;
    private $renderer;
    private $registroService;

    public function __construct($model, $renderer, $registroService)
    {
        $this->registroModel = $model;
        $this->renderer = $renderer;
        $this->registroService = $registroService;
    }

    public function home()
    {
        $data['mapa'] = true;
        $this->renderer->render("registro", $data);
    }

    public function newAccount()
    {
        if (isset($_POST["nombre"], $_POST["fecha_nacimiento"], $_POST["sexo"], $_POST["pais"], $_POST["lat"], $_POST["lng"], $_POST["correo"], $_POST["nombre_usuario"], $_POST["contrasenia"], $_POST["confirmar_contrasenia"])) {
            $formData = $_POST;

            if (isset($_FILES['foto_perfil']) && isset($_FILES['foto_perfil']['name'])) {
                $formData['foto_perfil']['name'] =  $_FILES['foto_perfil']['name'];
            }

            $result = $this->registroService->receiveRegistrationForm($formData);

            if ($result === true) {
                $this->renderRegistrationSuccess();
            } else {
                $this->renderRegistrationError($result);
            }
        } else {
            $data["message"] = "Por favor, completa todos los campos. Solo es opcional la imagen de perfil.";
            $data['showMessage'] = true;
            $this->renderer->render("registro", $data);
        }
    }

    private function renderRegistrationSuccess()
    {
        $data = [];
        $this->renderer->render("registroExitoso", $data);
    }

    private function renderRegistrationError($message)
    {
        $data["message"] = $message;
        $data['showMessage'] = true;
        $data['mapa'] = true;
        $this->renderer->render("registro", $data);
    }
}