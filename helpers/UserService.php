<?php

class UserService
{
    private $model;

    public function __construct($model)
    {
        $this->model=$model;
    }
    public function getPhoto($username){
        $rt= $this->model->getUserPhoto($username);
        if ( $rt != null){
            return $rt;
        }
        return null;
    }
    public function getUserLevelByName($userName)
    {
        return $this->model->getUserLevelByName($userName);
    }

    public function getUserMaxScoreByName($userName){
        // LO USA EL LOBBY
        return $this->model->getUserMaxScoreByName($userName);
    }
    public function updateLevelUserById($idUsuario)
    {
        $this->model->updateLevelUserById($idUsuario);
    }
    public function updateCorrectAnswerUser($idUsuario)
    {
        $this->model->updateCorrectAnswer($idUsuario);
    }
    public function getUserGamesByName($username)
    {
        return $this->model->getUserGamesByName($username);
    }
    public function getDataUserByName($userName)
    {
        return $this->model->getUserByName($userName);
    }
    public function generateQRForUser()
    {
        $dir = 'public/qr/';

        if (!file_exists($dir)) {
            mkdir($dir);
        }
        $userName = $_GET['name'];
        $filename = $dir . $userName . '.png';

        if (!file_exists($filename)) {
            $size = 9;
            $level = 'M';
            $frameSize = 1;
            $content = "localhost/user&name=" . $userName;
            QRcode::png($content, $filename, $level, $size, $frameSize);
        }
    }

}