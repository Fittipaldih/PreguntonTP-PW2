<?php

class AdminController
{
    private $adminModel;
    private $renderer;
    private $sessionManager;

    public function __construct($model, $renderer, $session)
    {
        $this->adminModel = $model;
        $this->renderer = $renderer;
        $this->sessionManager = $session;
    }
    public function totalUser()
    {    $data['userName']= $this->sessionManager->get("userName");
        $data["totalPlayers"]= $this->adminModel->getTotalPlayers();
        $data["allPlayers"]=$this->adminModel->getAllPlayers();
        $data["players"]=true;
        $data += $this->getStatistics();
        $this->renderer->render("playersList", $data);
    }

    public function totalGames()
    {
        $data['userName']= $this->sessionManager->get("userName");
        $data["totalGames"]= $this->adminModel->getTotalGames();
        $data["allGames"]=$this->adminModel->getAllGames();
        $data["games"]=true;
        $this->renderer->render("gamesList", $data);
    }

    public function totalQuestions()
    {
        $data['userName']= $this->sessionManager->get("userName");
        $data["totalQuestions"]= $this->adminModel->getTotalQuestions();
        $data["allQuestions"]=$this->adminModel->getAllQuestions();
        $data["questions"]=true;
        $this->renderer->render("questionsList", $data);
    }

    private function getStatistics()
    {
        $data = array(
            'usersByAge' => $this->adminModel->getTotalUsersByAge(),
            'usersByGenre' => $this->adminModel->getTotalUsersByGenre(),
            'usersFromCountry' => $this->adminModel->getTotalUsersFromCountry(),
            'usersNews' => $this->adminModel->getTotalUsersNews()
        );
        return $data;
    }

    private function getTotalUsersByAge()
    {
        $data = $this->adminModel->getTotalUsersByAge();
        $result = array();
        foreach ($data as $row) {
            $edad = $row['grupo_edad'];
            $total = $row['cantidad_usuarios'];
            $result[] = array('edad' => $edad, 'total' => $total);
        }
        return $result;
    }

    private function getTotalUsersByGenre()
    {
        $data = $this->adminModel->getTotalUsersByGenre();
        $result = array();
        foreach ($data as $row) {
            $genero = $row['Genero'];
            $total = $row['cantidad_usuarios'];
            $result[] = array('Genero' => $genero, 'total' => $total);
        }
        return $result;
    }

    private function getTotalUsersFromCountry()
    {
        $data = $this->adminModel->getTotalUsersFromCountry();
        $result = array();
        foreach ($data as $row) {
            $nombrePais = $row['Pais'];
            $cantidadUsuarios = $row['cantidadUsuarios'];
            $result[] = array('Pais' => $nombrePais, 'total' => $cantidadUsuarios);
        }
        return $result;
    }

    private function getTotalUsersNews()
    {
        return $this->adminModel->getTotalUsersNews();
    }
}