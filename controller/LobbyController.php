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
        $userName = $_SESSION["user"];
        $genre = $this->lobbyModel->getUserSex($userName);
        $data["games"] = $this->lobbyModel->getUserGamesByName($userName);
        $data['welcome'] = $this->getWelcome($genre);
        $data['userLogged'] = $userName;
<<<<<<< Updated upstream
        $puntaje = $this->lobbyModel->getUserMaxScore($userName);
        $puntos = $puntaje[0][0];
        $data['puntaje_max'] = $puntos;
=======
        $score = $this->lobbyModel->getUserMaxScore($userName);
        $scores = $score[0][0];
        $data['puntaje_max'] = $scores;

        $lostModalData = $this->verifyLost();
        if ($lostModalData !== null) {
            $data['userCorrects'] = $lostModalData['userCorrects'];
            $data['showLostModal'] = true;
        } else {
            $data['showLostModal'] = false;
        }

>>>>>>> Stashed changes
        $this->renderer->render("lobby", $data);
    }

    private function verifyLost()
    {
        $data = null;
        if (isset($_SESSION['lost']) && $_SESSION['lost']) {
            $data['userCorrects'] = $_SESSION['userCorrects'];
            unset($_SESSION['lost']);
        }
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
}