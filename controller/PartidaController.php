<?php

class PartidaController
{
    private $partidaModel;
    private $renderer;
    private $sessionManager;
    private $questionData;

    public function __construct($model, $renderer, $sessionManager)
    {
        $this->partidaModel = $model;
        $this->renderer = $renderer;
        $this->sessionManager = $sessionManager;
    }

    public function home()
    {
        if (!$this->isSessionStarted()) {
            header("Location: /");
            exit();
        } else {
            $this->renderView();
        }
    }

    private function isSessionStarted()
    {
        return $this->sessionManager->get("isConnected");
    }

    private function renderView($userCorrects = 0)
    {
        $data['userLogged'] = $this->sessionManager->get("user");
        $data += $this->renderAnswerAndQuestion($userCorrects);
        $this->renderer->render("Partida", $data);
    }
    private function renderViewPerdiste()
    {
        header("location: /lobby");
        exit();
    }

    private function renderAnswerAndQuestion($userCorrects)
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
            $idPregunta=$this->sessionManager->get("idPregunta");
            $idUsuario=$this->sessionManager->get("idUsuario")[0]['id'];

            if ($this->partidaModel->checkAnswer($optionSelected, $optionCorrect)) {
                $userCorrects += 1;
                $this->partidaModel->registerCorrectAnswer($idPregunta, $idUsuario);
                $this->partidaModel->updateSkillLevel($idPregunta, $idUsuario);
                $this->renderView($userCorrects);
            } else {
                $this->partidaModel->updateSkillLevel($idPregunta, $idUsuario);
                $this->partidaModel->insertUserGamesByName($idUsuario, $userCorrects);
                $this->partidaModel->updateUserMaxScore($idUsuario);
                $this->renderViewPerdiste();
            }
            /*$this->partidaModel->updateSkillLevel($idPregunta, $idUsuario);
            $this->renderView($userCorrects);*/
        }
    }
}