<?php

class LobbyController
{
    private $lobbyModel;
    private $renderer;
    private $sessionManager;

    public function __construct($model, $renderer, $sessionManager)
    {
        $this->lobbyModel = $model;
        $this->renderer = $renderer;
        $this->sessionManager = $sessionManager;
    }

    public function home()
    {
        $data = $this->prepareData();
        $this->renderer->render("lobby", $data);
    }

    public function prepareData()
    {
        $userName = $this->sessionManager->get("user");

        $data = [
            "welcome" => $this->getWelcome($userName),
            "games" => $this->lobbyModel->getUserGamesByName($userName),
            "puntaje_max" => $this->lobbyModel->getUserMaxScore($userName)[0][0],
            "userLogged" => $userName,
            "showLostModal" => false,
        ];

        $lostModalData = $this->verifyLost();
        if ($lostModalData !== null) {
            $data['userCorrects'] = $lostModalData['userCorrects'];
            $data['showLostModal'] = true;
        }
        return $data;
    }

    private function getWelcome($genre)
    {
        if ($genre === 'Femenino') {
            return 'Bienvenida';
        } elseif ($genre === 'Masculino') {
            return 'Bienvenido';
        } else {
            return 'Bienvenidx';
        }
    }

    private function verifyLost()
    {
        $data = null;
        if ($this->sessionManager->get('lost')) {
            $data['userCorrects'] = $this->sessionManager->get('userCorrects');
            $this->sessionManager->delete('lost');
        }
        return $data;
    }
}