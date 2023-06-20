<?php

class SuggestedModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getSuggestedQuestions(){
        return $this->database->query("SELECT * FROM pregunta WHERE id_estado = 1");
    }

    public function acceptQuestion($id){
        $this->database->update("UPDATE pregunta SET id_estado = 2 WHERE id = '$id'");
    }

    public function declineQuestion($id){
        $this->database->update("UPDATE pregunta SET id_estado = 4 WHERE id = '$id'");
    }
}