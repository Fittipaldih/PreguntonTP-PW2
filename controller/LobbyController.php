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
        session_start();
        $data['nombre_usuario']=$_SESSION['usuario'];
        $this->renderer->render("lobby", $data);
    }


}