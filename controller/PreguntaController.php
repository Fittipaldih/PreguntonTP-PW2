<?php

class PreguntaController
{
    private $preguntaModel;
    private $renderer;
    public function __construct($model, $renderer)
    {
        $this->preguntaModel = $model;
        $this->renderer = $renderer;
    }

    public function add()
    {
        if (isset($_POST['descripcion']) && isset($_POST['opcionA']) && isset($_POST['opcionB']) && isset($_POST['opcionC']) && isset($_POST['opcionD']) && isset($_POST['respuestaCorrecta'])) {
            $addQuestion = $_POST;
            $this->preguntaModel->update($addQuestion);
            header("Location: /lobby");
            exit();
        } else {
            // Los datos requeridos no están presentes en $_POST
            // Manejar el caso de error apropiadamente, redirigir o mostrar un mensaje de error, por ejemplo.
        }
    }


    public function edit()
    {
        $updateQuestion=$_POST;
        $this->preguntaModel->update($updateQuestion);
        header("Location: /lobby");
        exit();
    }

    public function delete()
    {
        $id = $_POST['id'];
        $this->preguntaModel->delete($id);
        header("Location: /lobby");
        exit();
    }
}