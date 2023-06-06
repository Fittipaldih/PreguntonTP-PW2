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
        if (!$this->isSessionStarted()) {
            header("Location: /");
            exit();
        } else {
            $this->renderView();
        }
    }

    private function isSessionStarted()
    {
        return $this->sessionManager->get("isConnected");
    }

    private function renderView()
    {
        $userName = $this->sessionManager->get("user");
        $genre = $this->lobbyModel->getUserSex($userName);
        $data["games"] = $this->lobbyModel->getUserGamesByName($userName);
        $data['welcome'] = $this->getWelcome($genre);
        $data['userLogged'] = $userName;
        $this->renderer->render("lobby", $data);
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
}