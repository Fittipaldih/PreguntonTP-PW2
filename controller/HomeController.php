<?php

class HomeController {
    private $HomeModel;
    private $renderer;

    public function __construct($HomeModel, $renderer) {
        $this->HomeModel = $HomeModel;
        $this->renderer = $renderer;
    }

    public function home(){
        $data=[];
        $this->renderer->render("home", $data);
    }
}