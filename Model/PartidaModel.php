<?php

class PartidaModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getIdByName($userName)
    {   // tambien esta en el lobby, y user -> refactorizar
        return $this->database->query("SELECT Id FROM usuario WHERE Nombre_usuario = '$userName'");
    }

    public function getAnswers($idQuestion)
    {
        return $this->database->query("SELECT * FROM respuesta WHERE id = '$idQuestion'");
    }

    public function getQuestion()
    {
        $result = $this->getIdByName($_SESSION['user']);
        $idUser = $result[0][0];
        $question = null;

        while ($question == null || empty($question)) {
            $question = $this->queryQuestion($idUser);
            if ($question == null || empty($question)) {
                $this->cleanTable($idUser);
            }
        }
        $this->registerQuestion($question[0]['id']);
        return $question;
    }

    public function queryQuestion($idUser)
    {
        return $this->database->query
        ("SELECT * FROM pregunta WHERE NOT EXISTS
        (SELECT 1 FROM usuario_pregunta WHERE id_usuario = '$idUser' AND pregunta.id = usuario_pregunta.id_pregunta) 
        ORDER BY RAND() LIMIT 1");
    }

    public function cleanTable($idUser)
    {
        $this->database->update("DELETE FROM usuario_pregunta WHERE id_usuario = '$idUser'");
    }

    public function registerQuestion($idPregunta)
    {
        $result = $this->getIdByName($_SESSION['user']);
        $idUser = $result[0][0];
        $this->database->update("INSERT INTO usuario_pregunta (id_usuario, id_pregunta) VALUES ('$idUser', '$idPregunta')");
    }

    public function checkAnswer($optionSelected, $optionCorrect)
    {
        $endTime = $_SESSION["startTime"] + 10;
        if (time() <= $endTime) {
            return $optionSelected === $optionCorrect;
        } else {
            return false;
        }
    }
}