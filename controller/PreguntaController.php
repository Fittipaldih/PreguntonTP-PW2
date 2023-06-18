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
        $data["mensaje"]="editado";
        $this->renderer->render("/lobbyEditor", $data);
    }






}