<?php

class PartidaController
{
    private $partidaModel;
    private $renderer;
    private $sessionManager;

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

    private function renderView()
    {
        /* Al hacer [0] en lugar de pasar el array completo..
           Pasa directamente la descripción o lo que fuese como una cadena de texto
           Entonces evito errores al renderizador Mustache,
           Porque nuestro metodo query devuelve los resultados como un array siempre
        */
        $data['userLogged'] = $this->sessionManager->get("user");

        $question = $this->partidaModel->getQuestion();
        $answerComplete= $this->partidaModel->getAnswers($question[0]['id_respuesta']);

        $data['question'] = $question[0]['descripcion'];
        $data['opcionA'] = $answerComplete[0]['opcionA'];
        $data['opcionB'] = $answerComplete[0]['opcionB'];
        $data['opcionC'] = $answerComplete[0]['opcionC'];
        $data['opcionD'] = $answerComplete[0]['opcionD'];
        $data['correct'] = $answerComplete[0]['resp_correcta'];
        $this->renderer->render("Partida", $data);
    }
}