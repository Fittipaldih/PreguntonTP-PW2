<?php

class RankingController {
    private $RankingModel;
    private $renderer;
    private $sessionManager;

    public function __construct($Model, $renderer, $sessionManager) {
        $this->RankingModel = $Model;
        $this->renderer = $renderer;
        $this->sessionManager=$sessionManager;
    }

    public function home(){
        if ($this->laSesionEstaIniciada()){
            $data['users']=$this->RankingModel->obtenerDatosUsuarios();
            $this->renderer->render("ranking", $data);
        } else{ header("Location: /");
        exit();}
    }

    private function laSesionEstaIniciada()
    {
        return $this->sessionManager->get("logueado");
    }

}