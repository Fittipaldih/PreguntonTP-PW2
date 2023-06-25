<?php

class AdminController
{
    private $adminModel;
    private $renderer;

    public function __construct($model, $renderer)
    {
        $this->adminModel = $model;
        $this->renderer = $renderer;
    }
    public function totalUser()
    {   $data["totalPlayers"]= $this->adminModel->getTotalPlayers();
        $data["allPlayers"]=$this->adminModel->getAllPlayers();
        $data["players"]=true;
        $this->renderer->render("playersList", $data);
    }

    public function totalGames()
    {
        $data["totalGames"]= $this->adminModel->getTotalGames();
        $data["allGames"]=$this->adminModel->getAllGames();
        $data["games"]=true;
        $this->renderer->render("gamesList", $data);
    }

    public function totalQuestions()
    {
        $data["totalQuestions"]= $this->adminModel->getTotalQuestions();
        $data["allQuestions"]=$this->adminModel->getAllQuestions();
        $data["questions"]=true;
        $this->renderer->render("questionsList", $data);
    }

    public function totalQuestionsCreate()
    {
        $rt = $this->adminModel->getTotalQuestionsCreate();
        echo("Total de preguntas creadas= " . $rt);
    }
    public function questionCorrect() {
        $data = $this->adminModel->getTotalPreguntasCorrectasPorUsuario();

        foreach ($data as $row) {
            $nivel = $row['nivel'];
            $nombreUsuario = $row['Nombre_usuario'];
            echo "Nivel: $nivel, Nombre de Usuario: $nombreUsuario<br>";
        }
    }

    public function getTotalUsersFromCountry() {
        $rt = $this->adminModel->getTotalUsersFromCountry();
        foreach ($rt as $row) {
            $nombrePais = $row['Pais'];
            $cantidadUsuarios = $row['cantidadUsuarios'];
            echo "País: $nombrePais, Cantidad de usuarios: $cantidadUsuarios<br>";
        }
    }
}