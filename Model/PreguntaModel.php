<?php

class PreguntaModel{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getQuestionById($idQuestion)
    {
       return $this->database->query("SELECT * FROM pregunta WHERE id='$idQuestion'");
    }

    public function delete($idQuestion)
    {
        $this->database->update("DELETE FROM pregunta WHERE id = '$idQuestion'");
    }
}