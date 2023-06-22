<?php

class PartidaController
{
    private $partidaModel;
    private $renderer;
    private $questionData;
    private $sessionManager;
    private $userService;

    public function __construct($model, $renderer, $sessionManager, $userService)
    {
        $this->partidaModel = $model;
        $this->renderer = $renderer;
        $this->sessionManager = $sessionManager;
        $this->userService = $userService;
    }

    public function home()
    {
        $data = $this->prepareData();
        $this->renderer->render("partida", $data);
    }

    private function prepareData()
    {
        $userName = $this->sessionManager->get('userName');
        $photo = $this->userService->getPhoto($userName);
        $data['userName'] = $userName;
        $data['userPhoto'] = $photo;
        return $data;
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
            $idQuestion = $this->sessionManager->get('idPregunta');
            $idUser = $this->sessionManager->get('idUser');

            $response = $this->processAnswer($optionSelected, $idQuestion, $idUser, $userCorrects);
            if ($response) {
                $this->sessionManager->set('lost', true);

            }
            echo json_encode($response);
        }
    }

    public function processAnswer($optionSelected, $idQuestion, $idUser, &$userCorrects)
    {
        $response = [];
        if ($this->partidaModel->checkAnswer($optionSelected, $idQuestion)) {
            $this->partidaModel->updateCorrectAnswer($idQuestion);
            $this->userService->updateCorrectAnswer($idUser);
            $this->userService->updateLevelUserById($idUser);
            $this->partidaModel->updateLevelQuestionById($idQuestion);
            $response['success'] = true;

        } else {
            $correctAnswer = $this->partidaModel->getDescriptionForCorrectAnswer($idQuestion);
            $this->sessionManager->set('correctAnswer', $correctAnswer['correcta']);
            $this->sessionManager->set('question', $correctAnswer['descripcion']);

            $this->userService->updateLevelUserById($idUser);
            $this->partidaModel->updateLevelQuestionById($idQuestion);
            $this->partidaModel->insertUserGamesByName($idUser, $userCorrects);
            $this->userService->updateUserMaxScore($idUser);
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
        return $this->questionData;
    }
    public function getQuestionData()
    {
        $countCorrect = $_GET['countCorrect'];
        $this->sessionManager->set('countCorrect', $countCorrect);
        $question = $this->partidaModel->getQuestion();
        echo json_encode($question[0]);
    }
    public function repportQuestion()
    {
        if (isset($_POST['idQuestion'])){
            $questionId = $_POST['idQuestion'];
            $this->partidaModel->repportQuestion($questionId);
            $this->sessionManager->set('lost', false);
            $this->sessionManager->set('report', true);
            $this->renderViewLost();
        }
    }
}