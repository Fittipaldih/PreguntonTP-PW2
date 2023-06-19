<?php

class PreguntaModel{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getQuestionById($idQuestion)
    {
        $this->database->singleQuery("SELECT * FROM pregunta WHERE id='$idQuestion'");
    }

    public function add($question) {
        $descripcion = $question['descripcion'];
        $opcionA = $question['opcionA'];
        $opcionB = $question['opcionB'];
        $opcionC = $question['opcionC'];
        $opcionD = $question['opcionD'];
        $respuestaCorrecta = $question['respuestaCorrecta'];
        $query = "INSERT INTO pregunta (descripcion, opcionA, opcionB, opcionC, opcionD, resp_correcta) VALUES ('$descripcion', '$opcionA', '$opcionB', '$opcionC', '$opcionD', '$respuestaCorrecta')";
        $this->database->query($query);

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

    public function delete($idQuestion)
    {
        $result = $this->getQuestionById($idQuestion);

        if ($result !== false) {
            $query = "DELETE FROM pregunta WHERE id = ?";
            $this->database->prepare($query)->execute([$idQuestion]);
        }
    }

}