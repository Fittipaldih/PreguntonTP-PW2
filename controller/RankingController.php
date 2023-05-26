<?php

class RankingController {
    private $RankingModel;
    private $renderer;

    public function __construct($Model, $renderer) {
        $this->RankingModel = $Model;
        $this->renderer = $renderer;
    }

    public function home(){
        $data['users']=$this->RankingModel->obtenerDatosUsuarios();
        $this->renderer->render("ranking", $data);
    }

}