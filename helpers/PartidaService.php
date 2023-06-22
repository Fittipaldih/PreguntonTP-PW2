<?php

class PartidaService
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function getDescriptionForCorrectAnswer($idQuestion)
    { // LO USA PARTIDA
        return $this->model->getDescriptionForCorrectAnswer($idQuestion);
    }

    public function getIdByName($userName)
    {
        return $this->model->getIdByName($userName);
    }

    private function getLevelUserById($idUser)
    {
        return $this->model->getLevelUserById($idUser);
    }

    public function cleanTable($idUser)
    {
        $this->model->cleanTable($idUser);
    }

    public function getQuestion()
    {// LO USA PARTIDA
        return $this->model->getQuestion();
    }

    public function checkAnswer($optionSelected, $idQuestion)
    {// LO USA PARTIDA
        return $this->model->checkAnswer($optionSelected, $idQuestion);
    }

    public function repportQuestion($id)
    {// LO USA PARTIDA
        $this->model->repportQuestion($id);
    }

    public function updateCorrectAnswer($idPregunta)
    { // LO USA PARTIDA
        $this->model->updateCorrectAnswer($idPregunta);
    }

    public function updateLevelQuestionById($idPregunta)
    {// LO USA PARTIDA
        $this->model->updateLevelQuestionById($idPregunta);
    }

}