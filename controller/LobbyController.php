<?php

class LobbyController {
    private $LobbyModel;
    private $renderer;

    public function __construct($LobbyModel, $renderer) {
        $this->LobbyModel = $LobbyModel;
        $this->renderer = $renderer;
    }

    public function home(){
        $data=[];
        $this->renderer->render("lobby", $data);
    }

}