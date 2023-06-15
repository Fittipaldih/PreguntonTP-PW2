<?php

class RegistroController
{
    private $registroModel;
    private $renderer;
    private $registroManager;

    public function __construct($model, $renderer)
    {
        $this->registroModel = $model;
        $this->renderer = $renderer;
        $this->registroManager = new RegistroManager();
    }

    public function home()
    {
        $data = [];
        $this->renderer->render("registro", $data);
    }

    public function newAccount()
    {
        // ISSET Solo se encarga de comprobar la existencia de las variables, empty que no esten vacias, si esta OK, envio los POST al objeto Manager.
        if (isset($_POST["nombre"], $_POST["fecha_nacimiento"], $_POST["sexo"], $_POST["pais"], $_POST["lat"], $_POST["lng"], $_POST["correo"], $_POST["nombre_usuario"], $_POST["contrasenia"], $_POST["confirmar_contrasenia"])) {
            $formData = $_POST;
            if (isset($_FILES['foto_perfil']) && isset($_FILES['foto_perfil']['name'])) {
                $formData['foto_perfil']['name'] =  $_FILES['foto_perfil']['name'];
            }
            $this->registroManager->receiveRegistrationForm($formData, $this->registroModel, $this->renderer);

        } else {
            $data["message"] = "por favor, completa todos los campos. Solo es opcional la imagen de perfil.";
            $data['showMessage'] = true;
            $this->renderer->render("registro", $data);
        }
    }
}