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
        $data['nombre_usuario']=$this->sessionManager->get("usuario");
        $this->renderer->render("lobby", $data);
    }


}