<?php

class PreguntaModel{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getQuestionById($idQuestion)
    {
        $this->database->query("SELECT * FROM pregunta WHERE id='$idQuestion'");
    }
}