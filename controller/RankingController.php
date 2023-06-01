<?php

class RankingController
{
    private $rankingModel;
    private $renderer;
    private $sessionManager;

    public function __construct($model, $renderer, $sessionManager)
    {
        $this->rankingModel = $model;
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

    public function renderView()
    {
        $data['userLogged'] = $this->sessionManager->get("user");
        $data['users'] = $this->rankingModel->getNameAndScoreByPositionOfUsers();
        $this->renderer->render("ranking", $data);
    }
}