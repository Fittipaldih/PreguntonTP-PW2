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
    public function getRepportQuestions(){
        return $this->database->query("SELECT * FROM pregunta WHERE id_estado = 3");
    }
    public function getAcceptedQuestions(){
        return $this->database->query("SELECT * FROM pregunta WHERE id_estado = 2");
    }
    public function acceptQuestion($id){
        $this->database->update("UPDATE pregunta SET id_estado = 2 WHERE id = '$id'");
    }
    public function declineQuestion($id){
        $this->database->update("UPDATE pregunta SET id_estado = 4 WHERE id = '$id'");
    }
    public function editQuestion($id, $descripcion, $id_categoria, $opcionA, $opcionB, $opcionC, $opcionD, $resp_correcta){
        $this->database->update("UPDATE pregunta SET descripcion = '$descripcion', id_categoria = '$id_categoria', 
                    opcionA = '$opcionA', opcionB = '$opcionB', opcionC = '$opcionC', opcionD = '$opcionD', resp_correcta='$resp_correcta' WHERE id = '$id'");
    }

}