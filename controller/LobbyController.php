<?php

class LobbyController {
    private $LobbyModel;
    private $renderer;

    public function __construct($LobbyModel, $renderer) {
        $this->LobbyModel = $LobbyModel;
        $this->renderer = $renderer;
    }

    public function home(){
        session_start();
        $data['nombre_usuario']=$_SESSION['usuario'];
        $this->renderer->render("lobby", $data);
    }


}