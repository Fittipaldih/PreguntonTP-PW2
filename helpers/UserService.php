<?php

class UserService
{
    private $database;
    private $model;

    public function __construct($model)
    {
        $this->model=$model;
    }

    public function getPhoto($username){
        return $this->model->getUserPhoto($username);
    }
    public function getUserLevelByName($userName)
    {
        return $this->model->getUserLevelByName($userName);
    }

    public function updateLevelUserById($idUsuario)
    {
        $this->model->updateLevelUserById($idUsuario);
    }

    public function updateCorrectAnswer($idUsuario)
    {
        $this->model->updateCorrectAnswer($idUsuario);
    }

    public function updateUserMaxScore($idUser)
    {
        $puntajeMax = $this->model->getUserMaxScore($idUser);
        $puntos = $puntajeMax[0][0];
        return $this->model->updateUserMaxScore($idUser, $puntos);
    }

    public function getUserGamesByName($username)
    {
        return $this->model->getUserGamesByName($username);
    }

    public function getUserMaxScore($idUser)
    {
        return $this->model->getUserMaxScore($idUser);
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