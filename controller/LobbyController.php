<?php

class LobbyController
{
    private $lobbyModel;
    private $renderer;
    private $sessionManager;
    private $userService;

    public function __construct($model, $renderer, $sessionManager, $userService)
    {
        $this->lobbyModel = $model;
        $this->renderer = $renderer;
        $this->sessionManager = $sessionManager;
        $this->userService=$userService;
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
        $reportModalData = $this->sessionManager->get('report');
        $lostModalData = $this->sessionManager->get('lost');

        $data['welcome'] = $this->getWelcome($genre);
        $data['games'] = $this->lobbyModel->getFiveUserGames($userName);
        $data['puntaje_max'] = $this->userService->getUserMaxScoreByName($userName);
        $data['userName'] = $userName;

        if ($lostModalData != null) {
            $data += $this->prepareLostModalData();

        } elseif ($reportModalData != null) {
            $data += $this->prepareReportModalData();
        }
        return $data;
    }

    private function prepareReportModalData()
    {
        $data['showReportModal'] = true;
        $this->sessionManager->delete('report');
        return $data;
    }

    private function prepareLostModalData()
    {
        $data['userCorrects'] = ($this->sessionManager->get('countCorrect')) + 1;
        $data['correctAnswer'] = $this->sessionManager->get('correctAnswer');
        $data['question'] = $this->sessionManager->get('question');
        $data['showLostModal'] = true;
        $this->sessionManager->delete('lost');
        return $data;
    }

    private function getWelcome($genre)
    {
        $rt = 'Bienvenidx';
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