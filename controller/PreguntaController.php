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
        var_dump($_POST);
        //$updateQuestion=$_POST;
        //$this->preguntaModel->update($updateQuestion);
        $this->renderer->render("/editado");
       /* header("Location: /lobby/editor");
        exit();*/
    }






}