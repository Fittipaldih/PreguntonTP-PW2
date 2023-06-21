<?php

class QuestionModel
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

    public function getStatusById($id){
        $this->database->query("SELECT id_estado FROM pregunta WHERE id='$id'");
    }
    public function declineQuestion($id){
        $this->database->update("UPDATE pregunta SET id_estado = 4 WHERE id = '$id'");
    }
    public function editQuestion($id, $descripcion, $id_categoria, $opcionA, $opcionB, $opcionC, $opcionD, $resp_correcta){
        $this->database->update("UPDATE pregunta SET descripcion = '$descripcion', id_categoria = '$id_categoria', 
                    opcionA = '$opcionA', opcionB = '$opcionB', opcionC = '$opcionC', opcionD = '$opcionD', resp_correcta='$resp_correcta' WHERE id = '$id'");
    }

    public function addQuestion($idRol, $idCategoria, $descripcion, $opcionA, $opcionB, $opcionC, $opcionD, $resp_correcta)
    {
        $idEstado = 0;
        if ( $idRol == 3){
            $idEstado = 1;
        }
        if ($idRol ==2){
            $idEstado = 2;
        }
        $query = "INSERT INTO pregunta (id_estado, id_categoria, descripcion, opcionA, opcionB, opcionC, opcionD, resp_correcta)
              VALUES ($idEstado, $idCategoria, '$descripcion', '$opcionA', '$opcionB', '$opcionC', '$opcionD', '$resp_correcta')";

        $this->database->update($query);

        if ($this->database->singleQuery("SELECT * FROM pregunta WHERE id_categoria = $idCategoria AND descripcion = '$descripcion'") === null) {
            echo "Error: No se pudo insertar la pregunta en la base de datos.";
        }
    }

    public function searchQuestionById($id){
        return $this->database->query("SELECT * FROM pregunta WHERE id = '$id'");
    }

    public function updateQuestionById($id, $idCategoria, $descripcion, $opcionA, $opcionB, $opcionC, $opcionD, $respuestaCorrecta){
        $this->database->update("UPDATE pregunta SET id_categoria = '$idCategoria', descripcion = '$descripcion', opcionA='$opcionA', opcionB='$opcionB',
                                    opcionC='$opcionC', opcionD='$opcionD', resp_correcta = '$respuestaCorrecta' WHERE id = '$id'");
    }

}