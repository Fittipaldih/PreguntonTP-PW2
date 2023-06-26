<?php
class PartidaModel
{
    private $database;
    public function __construct($database)
    {
        $this->database = $database;
    }
    public function getCorrectAnswer($idQuestion)
    {
        return $this->database->singleQuery("SELECT resp_correcta FROM pregunta WHERE id = '$idQuestion'");
    }
    public function getDescriptionForCorrectAnswer($idQuestion)
    {
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
    public function getLevelUserById($idUser)
    {
        $userLevel = $this->database->query("SELECT nivel FROM usuario WHERE id=$idUser");
        $level = $userLevel[0]['nivel'];
        if ($level > 70) {
            return "dificil";
        } elseif ($level < 30) {
            return "facil";
        }
    }
    public function updateCorrectAnswerQuestion($idPregunta)
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
    public function updateUserMaxScore($idUser, $score)
    {
        $scoreBD=$this->getUserMaxScoreById($idUser);
        $scoreBD2=$scoreBD[0][0];
        if ($scoreBD2<$score) {
            $this->database->update("UPDATE usuario SET Puntaje_max = '$score' WHERE Id = $idUser");
        }
    }
    public function getUserMaxScoreById($idUser)
    {
        return $this->database->query("SELECT MAX(Puntaje_max) FROM usuario WHERE Id=$idUser");
    }
    public function checkAnswer($optionSelected, $idQuestion, $endTime)
    {
        $correct = $this->getCorrectAnswer($idQuestion);
        $optionCorrect = $correct["resp_correcta"];
        if (time() <= $endTime) {
            return $optionSelected === $optionCorrect;
        } else {
            return false;
        }
    }
    public function getQuestion($id)
    {
        $question = null;
        $difficulty = $this->getLevelUserById($id);
        while ($question == null || empty($question)) {
            $question = $this->getQuestionByDifficulty($id, $difficulty);
            if (!$question)
                $question = $this->getQuestionAleatoryNotShow($id);
            if ($question == null || empty($question)) {
                $this->cleanQuestionShows($id);
            }
        }
        $this->registerQuestionShow($question[0]['id'], $id);

        return $question;
    }
    public function getQuestionByDifficulty($idUser, $difficulty)
    {
        switch ($difficulty) {
            case 'dificil':
                return $this->getDifficultQuestion($idUser);
            case 'facil':
                return $this->getEasyQuestion($idUser);
            default:
                return $this->getMediumQuestion($idUser);
        }
    }
    private function getDifficultQuestion($idUser)
    {
        $query = "
        SELECT p.*, c.descripcion AS catDescripcion
        FROM pregunta p
        JOIN categoria c ON c.id = p.id_categoria
        WHERE p.porc_correc < 30 AND NOT EXISTS (
            SELECT 1 FROM usuario_pregunta up
            WHERE up.id_usuario = '$idUser' AND p.id = up.id_pregunta
        )
        ORDER BY RAND() LIMIT 1";

        return $this->database->query($query);
    }
    private function getEasyQuestion($idUser)
    {
        $query = "
        SELECT p.*, c.descripcion AS catDescripcion
        FROM pregunta p
        JOIN categoria c ON c.id = p.id_categoria
        WHERE p.porc_correc > 70 AND NOT EXISTS (
            SELECT 1 FROM usuario_pregunta up
            WHERE up.id_usuario = '$idUser' AND p.id = up.id_pregunta
        )
        ORDER BY RAND() LIMIT 1";

        return $this->database->query($query);
    }
    private function getMediumQuestion($idUser)
    {
        $query = "
        SELECT p.*, c.descripcion AS catDescripcion
        FROM pregunta p
        JOIN categoria c ON c.id = p.id_categoria
        WHERE p.porc_correc >= 30 AND p.porc_correc <= 70 AND NOT EXISTS (
            SELECT 1 FROM usuario_pregunta up
            WHERE up.id_usuario = '$idUser' AND p.id = up.id_pregunta
        )
        ORDER BY RAND() LIMIT 1";

        return $this->database->query($query);
    }
    public function getQuestionAleatoryNotShow($idUser)
    {
        return $this->database->query("SELECT p.*, c.descripcion AS catDescripcion FROM pregunta p JOIN categoria c ON c.id = p.id_categoria WHERE p.id_estado = 2 AND NOT EXISTS
        (SELECT 1 FROM usuario_pregunta up WHERE up.id_usuario = '$idUser' AND p.id = up.id_pregunta) 
        ORDER BY RAND() LIMIT 1");
    }
    public function registerQuestionShow($idPregunta, $idUsuario)
    {
        $this->registerUserQuestion($idUsuario, $idPregunta);
        $this->increaseQuestionShowCount($idPregunta);
        $this->increaseUserAnsweredCount($idUsuario);
    }
    private function registerUserQuestion($idUsuario, $idPregunta)
    {
        $query = "INSERT INTO usuario_pregunta (id_usuario, id_pregunta) VALUES ('$idUsuario', '$idPregunta')";
        $this->database->update($query);
    }
    private function increaseQuestionShowCount($idPregunta)
    {
        $query = "UPDATE pregunta
              SET veces_mostrada = veces_mostrada + 1
              WHERE id = $idPregunta";
        $this->database->update($query);
    }
    private function increaseUserAnsweredCount($idUsuario)
    {
        $query = "UPDATE usuario
              SET cant_respondidas = cant_respondidas + 1
              WHERE id = $idUsuario";
        $this->database->update($query);
    }
    public function cleanQuestionShows($idUser)
    {
        $this->database->update("DELETE FROM usuario_pregunta WHERE id_usuario = '$idUser'");
    }
    public function insertUserGamesByName($idUser, $puntaje)
    {
        return $this->database->update("INSERT INTO partida (id_usuario, puntaje) VALUES('$idUser', '$puntaje') ");
    }
    public function repportQuestion($id)
    {
        $this->database->update("UPDATE pregunta SET id_estado = 3 WHERE id = '$id' ");
    }
}