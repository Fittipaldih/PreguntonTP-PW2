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

    public function update($question) {
        $id = $question['id'];
        $descripcion = $question['descripcion'];
        $opcionA = $question['opcionA'];
        $opcionB = $question['opcionB'];
        $opcionC = $question['opcionC'];
        $opcionD = $question['opcionD'];
        $respuestaCorrecta = $question['respuestaCorrecta'];

        $query = "UPDATE pregunta SET descripcion='$descripcion', opcionA='$opcionA', opcionB='$opcionB', opcionC='$opcionC', opcionD='$opcionD', resp_correcta='$respuestaCorrecta' WHERE id='$id'";
        $this->database->update($query);
    }
}