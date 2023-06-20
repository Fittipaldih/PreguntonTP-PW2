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

    public function edit()
    {
        $updateQuestion=$_POST;
        $this->preguntaModel->update($updateQuestion);
        header("Location: /lobby");
        exit();
    }




}