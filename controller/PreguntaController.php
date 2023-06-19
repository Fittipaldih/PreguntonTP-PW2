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

    public function editar()
    {
        $updateQuestion=$_POST;
        $this->preguntaModel->update($updateQuestion);
        header("Location: /lobby/editor");
        exit();
    }






}