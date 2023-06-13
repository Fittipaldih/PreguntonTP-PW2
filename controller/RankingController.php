<?php

class RankingController
{
    private $rankingModel;
    private $renderer;

    public function __construct($model, $renderer)
    {
        $this->rankingModel = $model;
        $this->renderer = $renderer;
    }

    public function home()
    {
        $data['userLogged']=$_SESSION["user"];
        $data['users'] = $this->rankingModel->getNameAndScoreByPositionOfUsers();
        $this->renderer->render("ranking", $data);
    }

}