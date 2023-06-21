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

        if ($this->sessionManager->get('edit') !== null) {
            $this->renderEditorLobby($data);
        }

        if ($this->sessionManager->get('player') !== null) {
            $this->renderPlayerLobby($data);
        }

        if ($this->sessionManager->get('admin') !== null) {
            $this->renderAdminLobby($data);
        }
    }

    private function prepareData()
    {
        $userName = $this->sessionManager->get("userName");
        $genre = $this->lobbyModel->getUserGenre($userName);
        $lostModalData = $this->verifyLost();

        $data['welcome'] = $this->getWelcome($genre);
        $data['games'] = $this->lobbyModel->getFiveUserGames($userName);
        $data['puntaje_max'] = $this->lobbyModel->getUserMaxScore($userName)[0][0];
        $data['userName'] = $userName;

        if ($lostModalData !== null) {
            $data['userCorrects'] = $lostModalData;
            $data['correctAnswer'] = $this->sessionManager->get('correctAnswer');
            $data['showLostModal'] = true;
        } else {
            $this->sessionManager->delete('showLostModal');
        }
        return $data;
    }

    private function verifyLost()
    {
        if ($this->sessionManager->get('lost')) {
            $countCorrect = ($this->sessionManager->get('countCorrect')) +1;
            $this->sessionManager->delete('lost');
            $this->sessionManager->delete('countCorrect');
            return $countCorrect;
        }
        return null;
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

    private function renderEditorLobby($data)
    {
        $this->renderer->render("lobbyEditor", $data);
    }

    private function renderPlayerLobby($data)
    {
        $this->renderer->render("lobbyPlayer", $data);
    }

    private function renderAdminLobby($data)
    {
        $this->renderer->render("lobbyAdmi", $data);
    }
}