<?php

class PartidaController
{
    private $partidaModel;
    private $renderer;
    private $questionData;

    public function __construct($model, $renderer)
    {
        $this->partidaModel = $model;
        $this->renderer = $renderer;
    }

    public function home($userCorrects = 0)
    {
        $data['userLogged']=$_SESSION["user"];
        $data += $this->renderAnswerAndQuestion($userCorrects);
        $this->renderer->render("Partida", $data);
    }

    private function renderViewPerdiste()
    {
        header("location: /lobby");
        exit();
    }

    private function renderAnswerAndQuestion($userCorrects=0)
    {
        $question = $this->partidaModel->getQuestion();
        $_SESSION['startTime'] = time();
        $_SESSION['idPregunta'] = $question[0]['id'];
        $answer = $this->partidaModel->getAnswers($question[0]['id_respuesta']);
        $this->questionData = [
            'question' => $question[0]['descripcion'],
            'question_id' => $question[0]['id'],
            'opcionA' => $answer[0]['opcionA'],
            'opcionB' => $answer[0]['opcionB'],
            'opcionC' => $answer[0]['opcionC'],
            'opcionD' => $answer[0]['opcionD'],
            'answerCorrect' => $answer[0]['resp_correcta'],
            'userCorrects' => $userCorrects
        ];
        return $this->questionData;
        /* Al hacer [0] en lugar de pasar el array completo..
            Pasa directamente la descripción o lo que fuese como una cadena de texto
            Entonces evito errores al renderizador Mustache,
            Porque nuestro metodo query devuelve los resultados como un array siempre
         */
    }

    public function checkAnswer()
    {
        if (isset($_POST['optionSelected'])) {
            $optionSelected = $_POST['optionSelected'];
            $optionCorrect = $_POST['answerCorrect'];
            $userCorrects = $_POST['userCorrects'];
            $idPregunta = $_SESSION["idPregunta"];
            $idUsuario = $_SESSION['idUser'];

            if ($this->partidaModel->checkAnswer($optionSelected, $optionCorrect)) {
                $userCorrects += 1;
                $this->partidaModel->registerCorrectAnswer($idPregunta, $idUsuario);
                $this->partidaModel->updateSkillLevel($idPregunta, $idUsuario);
                $this->home($userCorrects);

            } else {
                $this->partidaModel->updateSkillLevel($idPregunta, $idUsuario);
                $this->partidaModel->insertUserGamesByName($idUsuario, $userCorrects);
                $this->partidaModel->updateUserMaxScore($idUsuario);
                $this->renderViewPerdiste();
            }
        }
    }
}