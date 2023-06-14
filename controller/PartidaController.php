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

    private function renderViewLost()
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
    }


    public function renderQuestionData()
    {
        $question= $this->partidaModel->getQuestion();

        echo json_encode($question[0]);


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
                $response['success'] = true;

            } else {
                $this->partidaModel->updateSkillLevel($idQuestion, $idUser);
                $this->partidaModel->insertUserGamesByName($idUser, $userCorrects);
                $this->partidaModel->updateUserMaxScore($idUser);
                $response['success'] = false;
            }
            header('Content-Type: application/json');
            echo json_encode($response);
        }

    }
}