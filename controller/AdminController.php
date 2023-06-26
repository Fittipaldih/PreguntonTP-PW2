<?php

use Dompdf\Dompdf;

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
            $datau = $this->getStatisticsForUsers($finit, $fend);
        } else {
            $datau = $this->getStatisticsForUsers(null, null);
        }

        $data = $datau;
        $data['userName'] = $this->sessionManager->get("userName");
        $this->renderer->render("playersList", $data);
    }

    public function totalGames()
    {
        if (isset ($_POST['finit']) && isset($_POST['fend'])
            && !empty($_POST['finit']) && !empty($_POST['fend'])) {
            $finit = $_POST['finit'];
            $fend = $_POST['fend'];
        } else {
          $finit = null;
            $fend = null;
        }
        $data['userName'] = $this->sessionManager->get("userName");
        $data["totalGames"] = $this->adminModel->getTotalGames($finit, $fend);
        $data["allGames"] = $this->adminModel->getAllGames($finit, $fend);
        $this->renderer->render("gamesList", $data);
    }

    public function totalQuestions()
    {
        if (isset ($_POST['finit']) && isset($_POST['fend'])
            && !empty($_POST['finit']) && !empty($_POST['fend'])) {
            $finit = $_POST['finit'];
            $fend = $_POST['fend'];
        } else {
            $finit = null;
            $fend = null;
        }
        $data['userName'] = $this->sessionManager->get("userName");
        $data["totalQuestions"] = $this->adminModel->getTotalQuestions($finit, $fend);
        $data["allQuestions"] = $this->adminModel->getAllQuestions($finit, $fend);
        $this->renderer->render("questionsList", $data);
    }

    private function getStatisticsForUsers($finit, $fend)
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

    public function generatePdf(): void
    {
        $html=$this->totalUser();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("report.pdf", ['Attachment' => 0]);
    }
}