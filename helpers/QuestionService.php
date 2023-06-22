<?php
class QuestionService
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function getCorrectAnswer($idQuestion)
    {
        return $this->model->getCorrectAnswer($idQuestion);
    }

    public function getDescriptionForCorrectAnswer($idQuestion)
    {
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

    public function registerQuestion($idPregunta, $idUsuario)
    {
        $this->model->registerQuestion($idPregunta, $idUsuario);
    }

    public function getQuestion()
    {
        return $this->model->getQuestion();
    }

    public function checkAnswer($optionSelected, $idQuestion)
    {
        return $this->model->checkAnswer($optionSelected, $idQuestion);
    }

    public function repportQuestion($id)
    {
        $this->model->repportQuestion($id);
    }

    public function updateCorrectAnswer($idPregunta)
    {
        $this->model->updateCorrectAnswer($idPregunta);
    }

    public function updateLevelQuestionById($idPregunta)
    {
        $this->model->updateLevelQuestionById($idPregunta);
    }

}