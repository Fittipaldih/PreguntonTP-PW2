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
        $addQuestion=$_POST;
        $this->preguntaModel->update($addQuestion);
        header("Location: /lobby/editor");
        exit();
    }

    public function edit()
    {
        $updateQuestion=$_POST;
        $this->preguntaModel->update($updateQuestion);
        header("Location: /lobby/editor");
        exit();
    }

    public function delete($idQuestion)
    {
        $this->preguntaModel->delete($idQuestion);
        header("Location: /lobby/editor");
        exit();
    }






}