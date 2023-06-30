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
        $userCorrects = 0;
        $data = $this->prepareData();
        $this->renderer->render("partida", $data);
        $this->sessionManager->set('userCorrects', $userCorrects);
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
    public function getQuestionData()
    {   // cargarAjax() AJAX
        $countCorrect = $_GET['countCorrect'];
        $idUser = $this->sessionManager->get('idUser');
        $this->sessionManager->set('countCorrect', $countCorrect);
        $question = $this->partidaModel->getQuestion($idUser);
        $this->sessionManager->set('startTime', time());
        $this->sessionManager->set('idPregunta', $question[0]['id']);
        echo json_encode($question[0]);
    }
    public function checkAnswer()
    { //  selected(value) AJAX
        if (isset($_POST['optionSelected'])) {
            $optionSelected = $_POST['optionSelected'];
            $idQuestion = $this->sessionManager->get('idPregunta');
            $idUser = $this->sessionManager->get('idUser');
            $userCorrects = $this->sessionManager->get('userCorrects');
            $this->sessionManager->set('userCorrects', (++$userCorrects));
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
        $endTime =  ($this->sessionManager->get('startTime')) + 11;
        if ($this->partidaModel->checkAnswer($optionSelected, $idQuestion, $endTime)) {
            $this->partidaModel->updateCorrectAnswerQuestion($idQuestion);
            $this->userService->updateCorrectAnswerUser($idUser);
            $response['success'] = true;
        } else {
            $this->partidaModel->insertUserGamesByName($idUser, --$userCorrects);
            $score= $this->sessionManager->get('userCorrects');
            $this->partidaModel->updateUserMaxScore($idUser, --$score);

            $correctAnswer = $this->partidaModel->getDescriptionForCorrectAnswer($idQuestion);
            $this->sessionManager->set('correctAnswer', $correctAnswer['correcta']);
            $this->sessionManager->set('question', $correctAnswer['descripcion']);
            $response['success'] = false;
        }
        $this->userService->updateLevelUserById($idUser);
        $this->partidaModel->updateLevelQuestionById($idQuestion);
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