<?php

class QuestionService
{
    private $model;
    public function __construct($model){
        $this->model=$model;
    }
    public function getCorrectAnswer($idQuestion)
    {
        return $this->database->singleQuery("SELECT resp_correcta FROM pregunta WHERE id = '$idQuestion'");
    }
    public function getDescriptionForCorrectAnswer($idQuestion)
    { // PARA EL MODAL DEL LOBBY
        $query = "SELECT resp_correcta, opcionA, opcionB, opcionC, opcionD, descripcion,
        CASE
            WHEN resp_correcta = 'A' THEN opcionA
            WHEN resp_correcta = 'B' THEN opcionB
            WHEN resp_correcta = 'C' THEN opcionC
            WHEN resp_correcta = 'D' THEN opcionD
            ELSE NULL
        END AS correcta
    FROM pregunta
    WHERE id = " . $idQuestion;

        $result = $this->database->query($query);
        $correctAnswer = $result[0]['correcta'];
        $description = $result[0]['descripcion'];
        return [
            'correcta' => $correctAnswer,
            'descripcion' => $description
        ];
    }
    public function getIdByName($userName)
    {
        return $this->database->query("SELECT Id FROM usuario WHERE Nombre_usuario = '$userName'");
    }
    private function getLevelUserById($idUser)
    {
        $userLevel = $this->database->query
        ("SELECT nivel FROM usuario WHERE id=$idUser");
        $level = $userLevel[0]['nivel'];
        if ($level > 70) {
            return "dificil";
        } elseif ($level < 30) {
            return "facil";
        }
    }
    public function cleanTable($idUser)
    {
        $this->database->update("DELETE FROM usuario_pregunta WHERE id_usuario = '$idUser'");
    }
    public function registerQuestion($idPregunta, $idUsuario)
    {
        $result = $this->getIdByName($_SESSION['userName']);
        $idUser = $result[0][0];
        $this->database->update("INSERT INTO usuario_pregunta (id_usuario, id_pregunta) VALUES ('$idUser', '$idPregunta')");
        //suma una vez mostrada
        $this->database->update("UPDATE pregunta
                                 SET veces_mostrada = veces_mostrada + 1
                                 WHERE id = $idPregunta;");
        $this->database->update("UPDATE usuario
                                 SET cant_respondidas = cant_respondidas + 1
                                 WHERE id = $idUsuario;");
    }
    public function getQuestion()
    {
        $result = $this->getIdByName($_SESSION['userName']);
        $idUser = $result[0][0];
        $question = null;
        $difficulty = $this->getLevelUserById($idUser);
        while ($question == null || empty($question)) {
            $question = $this->queryQuestionByDiff($idUser, $difficulty);
            if (!$question)
                $question = $this->queryQuestion($idUser);
            //con esto, si no encuentra preguntas de tu nivel, te devuelve una random
            if ($question == null || empty($question)) {
                $this->cleanTable($idUser);
            }
        }
        $this->registerQuestion($question[0]['id'], $idUser);

        $_SESSION['startTime'] = time();
        $_SESSION['idPregunta'] = $question[0]['id'];
        return $question;
    }
    public function queryQuestionByDiff($idUser, $difficulty)
    {
        return match ($difficulty) {
            'dificil' => $this->database->query("
            SELECT p.*, c.descripcion AS catDescripcion
            FROM pregunta p
            JOIN categoria c ON c.id = p.id_categoria
            WHERE p.porc_correc < 30 AND NOT EXISTS (
                SELECT 1 FROM usuario_pregunta up
                WHERE up.id_usuario = '$idUser' AND p.id = up.id_pregunta
            )
            ORDER BY RAND() LIMIT 1"),

            'facil' => $this->database->query("
            SELECT p.*, c.descripcion AS catDescripcion
            FROM pregunta p
            JOIN categoria c ON c.id = p.id_categoria
            WHERE p.porc_correc > 70 AND NOT EXISTS (
                SELECT 1 FROM usuario_pregunta up
                WHERE up.id_usuario = '$idUser' AND p.id = up.id_pregunta
            )
            ORDER BY RAND() LIMIT 1"),

            default => $this->database->query("
            SELECT p.*, c.descripcion AS catDescripcion
            FROM pregunta p
            JOIN categoria c ON c.id = p.id_categoria
            WHERE p.porc_correc >= 30 AND p.porc_correc <= 70 AND NOT EXISTS (
                SELECT 1 FROM usuario_pregunta up
                WHERE up.id_usuario = '$idUser' AND p.id = up.id_pregunta
            )
            ORDER BY RAND() LIMIT 1"),
        };
    }
    public function queryQuestion($idUser)
    {
        return $this->database->query
        ("SELECT p.*, c.descripcion AS catDescripcion FROM pregunta p JOIN categoria c ON c.id = p.id_categoria WHERE p.id_estado = 2 AND NOT EXISTS
        (SELECT 1 FROM usuario_pregunta up WHERE up.id_usuario = '$idUser' AND p.id = up.id_pregunta) 
        ORDER BY RAND() LIMIT 1");
    }
    public function checkAnswer($optionSelected, $idQuestion)
    {
        $correct = $this->getCorrectAnswer($idQuestion);
        $optionCorrect = $correct["resp_correcta"];
        $endTime = $_SESSION["startTime"] + 12;
        if (time() <= $endTime) {
            return $optionSelected === $optionCorrect;
        } else {
            return false;
        }
    }
    public function repportQuestion($id)
    {
        $this->database->update("UPDATE pregunta SET id_estado = 3 WHERE id = '$id' ");
    }
    public function updateCorrectAnswer($idPregunta)
    {
        $this->database->update("UPDATE pregunta
                                 SET veces_correcta = veces_correcta + 1
                                 WHERE id = $idPregunta;");
    }
    public function updateLevelQuestionById($idPregunta)
    {
        $this->database->update("UPDATE pregunta
                                 SET porc_correc = (veces_correcta / veces_mostrada) * 100
                                 WHERE id = $idPregunta;");
    }
}