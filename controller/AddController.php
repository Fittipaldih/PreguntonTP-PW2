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
        $this->renderer->render("add", $data);
    }

    public function addQuestion()
    {
        $idRol = $this->sessionManager->get("idRol");
        if (
            isset($_POST['idCategoria']) &&
            isset($_POST['descripcion']) &&
            isset($_POST['opcionA']) &&
            isset($_POST['opcionB']) &&
            isset($_POST['opcionC']) &&
            isset($_POST['opcionD']) &&
            isset($_POST['respuestaCorrecta'])
        ) {
            $idCategoria = $_POST['idCategoria'];
            $descripcion = $_POST['descripcion'];
            $opcionA = $_POST['opcionA'];
            $opcionB = $_POST['opcionB'];
            $opcionC = $_POST['opcionC'];
            $opcionD = $_POST['opcionD'];
            $respuestaCorrecta = $_POST['respuestaCorrecta'];
            $this->addModel->addQuestion($idRol, $idCategoria, $descripcion, $opcionA, $opcionB, $opcionC, $opcionD, $respuestaCorrecta);
            echo "Exitoso";
            header("Location: /lobby");
            exit();
        } else {
            echo "Error: Todos los campos son obligatorios";
        }
    }
}