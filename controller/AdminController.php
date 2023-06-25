<?php

class AdminController
{
    private $adminModel;
    private $renderer;
    private $sessionManager;

    public function __construct($model, $renderer, $session)
    {
        $this->adminModel = $model;
        $this->renderer = $renderer;
        $this->sessionManager = $session;
    }

    public function totalUser()
    {
        if (isset ($_POST['finit']) && isset($_POST['fend'])
        && !empty($_POST['finit']) && !empty($_POST['fend'])) {
            $finit = $_POST['finit'];
            $fend = $_POST['fend'];
            $datau = $this->getStatistics($finit, $fend);
        }
        else{
            $datau = $this->getStatistics(null, null);
        }

        $data = $datau;
        $data['userName'] = $this->sessionManager->get("userName");
        $this->renderer->render("playersList", $data);
    }

    public function totalGames()
    {
        $data['userName'] = $this->sessionManager->get("userName");
        $data["totalGames"] = $this->adminModel->getTotalGames();
        $data["allGames"] = $this->adminModel->getAllGames();
        $this->renderer->render("gamesList", $data);
    }

    public function totalQuestions()
    {
        $data['userName'] = $this->sessionManager->get("userName");
        $data["totalQuestions"] = $this->adminModel->getTotalQuestions();
        $data["allQuestions"] = $this->adminModel->getAllQuestions();
        $this->renderer->render("questionsList", $data);
    }

    private function getStatistics($finit, $fend)
    {
        $data = array(
            'usersByAge' => $this->adminModel->getTotalUsersByAge($finit, $fend),
            'usersByGenre' => $this->adminModel->getTotalUsersByGenre($finit, $fend),
            'usersFromCountry' => $this->adminModel->getTotalUsersFromCountry($finit, $fend),
            'usersNews' => $this->adminModel->getTotalUsersNews(),
            'allPlayers' => $this->adminModel->getAllPlayers($finit, $fend),
            'totalPlayers' => $this->adminModel->getTotalPlayers($finit, $fend)
        );
        if (empty($data['usersByAge']) && empty($data['usersByGenre']) && empty($data['usersFromCountry'])
            && empty($data['allPlayers']) && empty($data['totalPlayers'])) {
            $data['empty'] = true;
        }
        return $data;
    }
}