<?php

class LobbyController
{
    private $lobbyModel;
    private $renderer;

    public function __construct($model, $renderer)
    {
        $this->lobbyModel = $model;
        $this->renderer = $renderer;
    }

    public function home()
    {
        $userName=$_SESSION["user"];
        $genre = $this->lobbyModel->getUserSex($userName);
        $data["games"] = $this->lobbyModel->getUserGamesByName($userName);
        $data['welcome'] = $this->getWelcome($genre);
        $data['userLogged'] = $userName;
        $score = $this->lobbyModel->getUserMaxScore($userName);
        $scores = $score[0][0];
        $data['puntaje_max'] = $scores;
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