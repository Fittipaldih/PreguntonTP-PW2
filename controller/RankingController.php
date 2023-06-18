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
        $data['userName']= $this->sessionManager->get("userName");
        $data['users'] = $this->rankingModel->getNameAndScoreByPositionOfUsers();
        $this->renderer->render("ranking", $data);
    }
}