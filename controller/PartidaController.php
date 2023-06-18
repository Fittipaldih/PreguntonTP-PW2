<?php

class PartidaController
{
    private $partidaModel;
    private $renderer;
    private $questionData;
    private $sessionManager;
    private $userService;

    public function __construct($model, $renderer, $sessionManager)
    {
        $this->partidaModel = $model;
        $this->renderer = $renderer;
        $this->sessionManager = $sessionManager;
        $this->userService= new UserService($this->partidaModel);
    }

    public function home($userCorrects = 0)
    {
        $userName=$this->sessionManager->get('userName');

        $this->sessionManager->set('userCorrects', $userCorrects);
        $data['userCorrects'] =  $this->sessionManager->get('userCorrects');

        $data['userName'] = $userName;

        $photo=$this->partidaModel->getUserPhoto($userName);
        if($photo!=null) {
            $data['userPhoto'] = $photo;
        }
        $this->renderer->render("partida", $data);
    }

    public function getSessionData()
    {
        $sessionData = $this->sessionManager->getAll();
        header('Content-Type: application/json');
        echo json_encode($sessionData);
    }

    public function checkAnswer()
    {
        if (isset($_POST['optionSelected'])) {
            $optionSelected = $_POST['optionSelected'];
            $userCorrects =  $this->sessionManager->get('userCorrects');
            $idQuestion =  $this->sessionManager->get('idPregunta');
            $idUser =  $this->sessionManager->get('idUser');

            $response = $this->processAnswer($optionSelected, $idQuestion, $idUser, $userCorrects);
            if ($response){
                $this->sessionManager->set('lost', true);

            }
            echo json_encode($response);
        }
    }

    public function processAnswer($optionSelected, $idQuestion, $idUser, &$userCorrects)
    {
        $response = [];
        if ( $this->partidaModel->checkAnswer($optionSelected, $idQuestion)) {
            $this->partidaModel->registerCorrectAnswer($idQuestion, $idUser);
            $this->partidaModel->updateSkillLevel($idQuestion, $idUser);
            $response['success'] = true;

        } else {
            $this->partidaModel->updateSkillLevel($idQuestion, $idUser);
            $this->partidaModel->insertUserGamesByName($idUser, $userCorrects);
            $this->partidaModel->updateUserMaxScore($idUser);
            $response['success'] = false;
        }
        return $response;
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
}