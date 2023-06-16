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
        $userName = $this->sessionManager->get("userName");
        $genre = $this->lobbyModel->getUserGenre($userName);
        $lostModalData = $this->verifyLost();

        $data = [
            "welcome" => $this->getWelcome($genre),
            "games" => $this->lobbyModel->getFiveUserGames($userName),
            "puntaje_max" => $this->lobbyModel->getUserMaxScore($userName)[0][0],
            "userName" => $userName,
            "showLostModal" => false,
        ];

        if ($lostModalData !== null) {
            $data['userCorrects'] = $lostModalData['userCorrects'];
            $data['showLostModal'] = true;
        }
        return $data;
    }

    private function getWelcome($genre)
    {
        $rt ='Bienvenidx';
        if ($genre === 'Femenino') {
            $rt = 'Bienvenida';
        } elseif ($genre === 'Masculino') {
            $rt = 'Bienvenido';
        }
        return $rt;
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