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
        $_SESSION['lost'] = true;
        header("location: /lobby");
        exit();
    }

    private function renderAnswerAndQuestion($userCorrects)
    {
        $question = $this->partidaModel->getQuestion();
        $_SESSION['startTime'] = time();
        $_SESSION['idPregunta'] = $question[0]['id'];
        $_SESSION['userCorrects'] = $userCorrects;
        $idQuestion= $_SESSION['idPregunta'];
        $answer = $this->partidaModel->getOptions($idQuestion);
        $this->questionData = [
            'question' => $question[0]['descripcion'],
            'question_id' => $question[0]['id'],
            'opcionA' => $answer[0]['opcionA'],
            'opcionB' => $answer[0]['opcionB'],
            'opcionC' => $answer[0]['opcionC'],
            'opcionD' => $answer[0]['opcionD'],
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
            $userCorrects = $_SESSION['userCorrects'];
            $idQuestion = $_SESSION['idPregunta'];
            $idUser = $_SESSION['idUser'];

            if ($this->partidaModel->checkAnswer($optionSelected, $idQuestion)) {
                $userCorrects += 1;
                $this->partidaModel->registerCorrectAnswer($idQuestion, $idUser);
                $this->partidaModel->updateSkillLevel($idQuestion, $idUser);
                $this->home($userCorrects);

            } else {
                $this->partidaModel->updateSkillLevel($idQuestion, $idUser);
                $this->partidaModel->insertUserGamesByName($idUser, $userCorrects);
                $this->partidaModel->updateUserMaxScore($idUser);
                $this->renderViewPerdiste();
            }
        }
    }
}