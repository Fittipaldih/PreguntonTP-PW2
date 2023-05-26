<?php

class validarMailController
{
    private $validarMailController;
    private $renderer;

    public function __construct($Model, $renderer) {
        $this->validarMailController = $Model;
        $this->renderer = $renderer;
    }
    public function home(){

        $data=[];
        $this->renderer->render("lobby", $data);
    }
}