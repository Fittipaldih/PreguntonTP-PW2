<?php

class addQuestionController{

    private $questionModel;
    private $renderer;
    private $sessionManager;

    public function __construct($model, $renderer, $sessionManager)
    {
        $this->questionModel = $model;
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
            $data['question'] =  $this->questionModel->searchQuestionById($id);
        }
        $this->renderer->render("addQuestion", $data);
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

        $idRol = $this->sessionManager->get("idRol");
        $this->questionModel->addQuestion($idRol, $idCategoria, $descripcion, $opcionA, $opcionB, $opcionC, $opcionD, $respuestaCorrecta);

        if ($idRol==3){
            $this->renderer->render("newQuestionSuccess");
        } else{
            $this->sessionManager->set('newQuestion', true);
            header("Location: /question");
            exit();
        }
    }
}