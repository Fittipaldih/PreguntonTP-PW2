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
        if ($this->sessionManager->get('edit') !== null){
            $data["questions"]=$this->lobbyModel->getAllQuestions();
            $this->renderer->render("lobbyEditor", $data);
        }
        if ($this->sessionManager->get('player') !== null){
            $this->renderer->render("lobbyPlayer", $data);
        }
        if ($this->sessionManager->get('edit') !== null){
            $this->renderer->render("lobbyAdmi", $data);
        }

    }

    private function prepareData()
    {
        $userName = $this->sessionManager->get("userName");
        $genre = $this->lobbyModel->getUserGenre($userName);
        $lostModalData = $this->verifyLost();

        if ($lostModalData !== null) {
            $data['userCorrects'] = $lostModalData['userCorrects'];
            $data['showLostModal'] = true;
            $this->sessionManager->set('showLostModal', true);
        }
        else{
            $this->sessionManager->delete('showLostModal');
        }

        $data = [
            "welcome" => $this->getWelcome($genre),
            "games" => $this->lobbyModel->getFiveUserGames($userName),
            "puntaje_max" => $this->lobbyModel->getUserMaxScore($userName)[0][0],
            "userName" => $userName,
            "showLostModal" => isset($_SESSION['showLostModal']) && $_SESSION['showLostModal'] === 'true',
        ];

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