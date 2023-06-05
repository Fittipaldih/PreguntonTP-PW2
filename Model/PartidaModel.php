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
    public function getUserLevelByName($userName)
    {   // tambien esta en el lobby, y user -> refactorizar
        return $this->database->query("SELECT nivel FROM usuario WHERE Nombre_usuario = '$userName'");
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
        $difficulty= $this->getUserSkilLevel($idUser);
        while ($question == null || empty($question)) {
            $question = $this->queryQuestionByDiff($idUser, $difficulty);
                if(!$question)
                    $question= $this->queryQuestion($idUser);
                    //con esto, si no encuentra preguntas de tu nivel, te devuelve una random
            if ($question == null || empty($question)) {
                $this->cleanTable($idUser);
            }
        }
        $this->registerQuestion($question[0]['id'], $idUser);
        return $question;
    }
    private function getUserSkilLevel($idUser)
    {
        $userLevel=$this->database->query
        ("SELECT nivel FROM usuario WHERE id=$idUser");
        $level=$userLevel[0]['nivel'];
        if($level>70){
            return "dificil";
        }
        elseif($level<30){
            return "facil";
        }
    }

    public function queryQuestionByDiff($idUser, $difficulty)
    {
        return match ($difficulty) {
            'dificil' =>  $this->database->query
                             ("SELECT * FROM pregunta WHERE porc_correc < 30 AND NOT EXISTS
                                (SELECT 1 FROM usuario_pregunta WHERE id_usuario = '$idUser' AND pregunta.id = usuario_pregunta.id_pregunta) 
                                  ORDER BY RAND() LIMIT 1"),
            'facil' => $this->database->query
            ("SELECT * FROM pregunta WHERE porc_correc > 70 AND  NOT EXISTS
                 (SELECT 1 FROM usuario_pregunta WHERE id_usuario = '$idUser' AND pregunta.id = usuario_pregunta.id_pregunta) 
                   ORDER BY RAND() LIMIT 1"),
            default => $this->database->query
            ("SELECT * FROM pregunta WHERE porc_correc >= 30 AND porc_correc <= 70  AND NOT EXISTS
                 (SELECT 1 FROM usuario_pregunta WHERE id_usuario = '$idUser' AND pregunta.id = usuario_pregunta.id_pregunta) 
                   ORDER BY RAND() LIMIT 1"),
        };
       /* return $this->database->query
        ("SELECT * FROM pregunta WHERE NOT EXISTS
        (SELECT 1 FROM usuario_pregunta WHERE id_usuario = '$idUser' AND pregunta.id = usuario_pregunta.id_pregunta) 
        ORDER BY RAND() LIMIT 1"); */
    }
    public function queryQuestion($idUser){
        return $this->database->query
        ("SELECT * FROM pregunta WHERE NOT EXISTS
        (SELECT 1 FROM usuario_pregunta WHERE id_usuario = '$idUser' AND pregunta.id = usuario_pregunta.id_pregunta) 
        ORDER BY RAND() LIMIT 1");
    }



    public function cleanTable($idUser)
    {
        $this->database->update("DELETE FROM usuario_pregunta WHERE id_usuario = '$idUser'");
    }

    public function registerQuestion($idPregunta, $idUsuario)
    {
        $result = $this->getIdByName($_SESSION['user']);
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
    public function registerCorrectAnswer($idPregunta, $idUsuario)
    {
        $this->database->update("UPDATE pregunta
                                 SET veces_correcta = veces_correcta + 1
                                 WHERE id = $idPregunta;");
        $this->database->update("UPDATE usuario
                                 SET cant_acertadas = cant_acertadas + 1
                                 WHERE id = $idUsuario;");
    }

    public function updateSkillLevel($idPregunta, $idUsuario)
    {
        $this->database->update("UPDATE pregunta
                                 SET porc_correc = (veces_correcta / veces_mostrada) * 100
                                 WHERE id = $idPregunta;");
        $this->database->update("UPDATE usuario
                                 SET nivel = (cant_acertadas / cant_respondidas) * 100
                                 WHERE id = $idUsuario;");
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

    public function insertUserGamesByName($idUser, $puntaje)
    {
        return $this->database->update("INSERT INTO partida (id_usuario, puntaje) VALUES('$idUser', '$puntaje') ");
    }

    public function updateUserMaxScore($idUser)
    {
        $puntajeMax= $this->selectUserMaxScore($idUser);
        $puntos=$puntajeMax[0][0];
        return $this->database->update("UPDATE usuario SET puntaje_max = '$puntos' WHERE id = $idUser");
    }
    public function selectUserMaxScore($idUser){
        return $this->database->query("SELECT MAX(puntaje) FROM partida WHERE id_usuario=$idUser; ");
    }


}