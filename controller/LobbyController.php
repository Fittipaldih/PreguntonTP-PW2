<?php

class LobbyController {
    private $LobbyModel;
    private $renderer;

    private $sessionManager;

    public function __construct($LobbyModel, $renderer, $sessionManager) {
        $this->LobbyModel = $LobbyModel;
        $this->renderer = $renderer;
        $this->sessionManager=$sessionManager;
    }

    public function home(){
        if($this->laSesionEstaIniciada()){
        $data['nombre_usuario']=$this->sessionManager->get("usuario");
        $this->renderer->render("lobby", $data);}
        else {
            header("Location: /");
            exit();
        }
    }
    private function laSesionEstaIniciada()
    {
        return $this->sessionManager->get("logueado");
    }


}