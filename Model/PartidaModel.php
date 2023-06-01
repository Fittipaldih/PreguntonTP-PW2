<?php

class PartidaModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getQuestionAndAnswers()
    {
        $this->getQuestion();
        $this->getAnswers();
    }
    public function getQuestion()
    {
        $num = $this->getNumberRandom();
        return $this->database->query("SELECT descripcion, id_respuesta FROM pregunta WHERE id = '$num'");
    }

    public function getAnswers($idQuestion)
    {
        return $this->database->query("SELECT * FROM respuesta WHERE id = '$idQuestion'");
    }
    public function getNumberRandom()
    {
        return rand(1, 10);
    }
}