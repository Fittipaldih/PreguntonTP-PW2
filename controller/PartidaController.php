<?php

class PartidaController
{
    private $partidaModel;
    private $renderer;
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
    private function renderViewLost()
    {
        header("location: /lobby");
        exit();
    }
    public function getSessionData()
    { // AJAX
        $sessionData = $this->sessionManager->getAll();
        header('Content-Type: application/json');
        echo json_encode($sessionData);
    }
    public function getQuestionData()
    {// AJAX
        $countCorrect = $_GET['countCorrect'];
        $idUser = $this->sessionManager->get('idUser');
        $this->sessionManager->set('countCorrect', $countCorrect);
        $question = $this->partidaModel->getQuestion($idUser);
        $this->sessionManager->set('startTime', time());
        $this->sessionManager->set('idPregunta', $question[0]['id']);
        echo json_encode($question[0]);
    }
    public function checkAnswer()
    { // AJAX
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
        $endTime =  ($this->sessionManager->get('startTime')) + 12;
        if ($this->partidaModel->checkAnswer($optionSelected, $idQuestion, $endTime)) {
            $this->partidaModel->updateCorrectAnswerQuestion($idQuestion);
            $this->userService->updateCorrectAnswerUser($idUser);
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
            $score= $this->sessionManager->get('countCorrect');
            $this->partidaModel->updateUserMaxScore($idUser, $score);
            $response['success'] = false;
        }
        return $response;
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