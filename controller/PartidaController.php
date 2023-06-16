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
        $_SESSION['userCorrects'] = $userCorrects;
        $data['userLogged']=$_SESSION["userName"];
        $this->renderer->render("Partida", $data);

    }

    private function renderViewLost()
    {

        header("location: /lobby");
        exit();
    }

    private function renderAnswerAndQuestion($userCorrects)
    {
        //$_SESSION['userCorrects'] = $userCorrects;

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
                $_SESSION['userCorrects'] += 1;
                $this->partidaModel->registerCorrectAnswer($idQuestion, $idUser);
                $this->partidaModel->updateSkillLevel($idQuestion, $idUser);
                $response['success'] = true;


            } else {
                $_SESSION['lost'] = true;
                $this->partidaModel->updateSkillLevel($idQuestion, $idUser);
                $this->partidaModel->insertUserGamesByName($idUser, $userCorrects);
                $this->partidaModel->updateUserMaxScore($idUser);
                $response['success'] = false;

            }

            echo json_encode($response);
        }

    }
}