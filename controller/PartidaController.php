<?php

class PartidaController
{
    private $partidaModel;
    private $renderer;
    private $sessionManager;
    private $questionData;
    private $answerCorrects;

    public function __construct($model, $renderer, $sessionManager)
    {
        $this->partidaModel = $model;
        $this->renderer = $renderer;
        $this->sessionManager = $sessionManager;
        $this->answerCorrects = 0;
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

    private function renderView()
    {
        /* Al hacer [0] en lugar de pasar el array completo..
           Pasa directamente la descripción o lo que fuese como una cadena de texto
           Entonces evito errores al renderizador Mustache,
           Porque nuestro metodo query devuelve los resultados como un array siempre
        */
        $data['userLogged'] = $this->sessionManager->get("user");
        $data['answerCorrects'] = $this->answerCorrects;
        $data+= $this->renderAnswerAndQuestion();
        $this->renderer->render("Partida", $data);
    }

    private function renderAnswerAndQuestion()
    {
        $question = $this->partidaModel->getQuestion();
        $answer= $this->partidaModel->getAnswers($question[0]['id_respuesta']);
        $this->questionData = [
            'question' => $question[0]['descripcion'],
            'opcionA' => $answer[0]['opcionA'],
            'opcionB' => $answer[0]['opcionB'],
            'opcionC' => $answer[0]['opcionC'],
            'opcionD' => $answer[0]['opcionD'],
            'correct' => $answer[0]['resp_correcta']

        ];
        return $this->questionData;
    }
/*
    private function checkAnswer()
    {
        if (isset($_POST['option'])) {
            $optionSelected = $_POST['option'];
            if (isset($this->questionData['correct'])) {
            if( (string)$this->questionData['correct'] === (string)$optionSelected){
                $this->answerCorrects+=1;

            }else {
                var_dump($this->questionData['correct']);
                var_dump($optionSelected);
            }
            }
        }
    }*/
}