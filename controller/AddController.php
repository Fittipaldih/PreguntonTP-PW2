<?php

class AddController
{
    private $addModel;
    private $renderer;
    private $sessionManager;

    public function __construct($model, $renderer, $sessionManager)
    {
        $this->addModel = $model;
        $this->renderer = $renderer;
        $this->sessionManager = $sessionManager;
    }

    public function home()
    {
        $data['edit'] = $this->sessionManager->get('edit');
        $data['player'] = $this->sessionManager->get('player');
        $data['userName']= $this->sessionManager->get("userName");

        if ($this->sessionManager->get('idQuestionEdit') !== null){
            $id = $this->sessionManager->get('idQuestionEdit');
            $data['question'] =  $this->addModel->searchQuestionById($id);
        }
        $this->renderer->render("add", $data);
    }

    public function addQuestion()
    {
        $required = ['idCategoria', 'descripcion', 'opcionA', 'opcionB', 'opcionC', 'opcionD', 'respuestaCorrecta'];
        $errorMessage = "Error: Todos los campos son obligatorios";

        foreach ($required as $field) {
            if (!isset($_POST[$field])) {
                echo $errorMessage;
                return;
            }
        }
        $idCategoria = $_POST['idCategoria'];
        $descripcion = $_POST['descripcion'];
        $opcionA = $_POST['opcionA'];
        $opcionB = $_POST['opcionB'];
        $opcionC = $_POST['opcionC'];
        $opcionD = $_POST['opcionD'];
        $respuestaCorrecta = $_POST['respuestaCorrecta'];

        if ($this->sessionManager->get('idQuestionEdit') !== null){
            $id = $this->sessionManager->get('idQuestionEdit');
            $this->addModel->updateQuestionById($id, $idCategoria, $descripcion, $opcionA, $opcionB, $opcionC, $opcionD, $respuestaCorrecta);
        }
        else{
            $idRol = $this->sessionManager->get("idRol");
            $this->addModel->addQuestion($idRol, $idCategoria, $descripcion, $opcionA, $opcionB, $opcionC, $opcionD, $respuestaCorrecta);
        }
        unset($_POST['idCategoria']);
        unset($_POST['descripcion']);
        unset($_POST['opcionA']);
        unset($_POST['opcionB']);
        unset($_POST['opcionC']);
        unset($_POST['opcionD']);
        unset($_POST['respuestaCorrecta']);
        header("Location: /lobby");
        exit();
    }
}