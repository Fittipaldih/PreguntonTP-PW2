<?php

class UserController
{
    private $userModel;
    private $renderer;

    public function __construct($model, $renderer)
    {
        $this->userModel = $model;
        $this->renderer = $renderer;
    }

    public function home()
    {
        $userName = $_GET['name']; // esto lo recibe de la view ranking Linea 18
        $userLogged = $this->getNameUserBySession();
        $canEdit = (strtoupper($userName)) == (strtoupper($userLogged));
        $data["canEdit"] = $canEdit;
        $data["user"] = $this->getUserByName($userName);
        $data["games"] = $this->getUserGamesByName($userName);
        $data['userLogged'] = $userLogged;
        $this->generateQR();
        $this->renderer->render("user", $data);
    }

    private function getNameUserBySession()
    {
        return $_SESSION["user"];
    }

    private function getUserGamesByName($name)
    {
        return $this->userModel->getUserGamesByName($name);
    }

    private function getUserByName($name)
    {
        return $this->userModel->getUserByName($name);
    }

    public function edit()
    {
        $userName = $this->getNameUserBySession();
        $variables = ['nameComplete', 'birthDate', 'sex', 'city', 'country'];

        $nameComplete = $_POST['nameComplete'] ?? null;
        $birthDate = $_POST['birthDate'] ?? null;
        $sex = $_POST['sex'] ?? null;
        $country = $_POST['country'] ?? null;

        if ($nameComplete !== null) {
            $this->userModel->setNameComplete($userName, $nameComplete);
        }

        if ($birthDate !== null) {
            $this->userModel->setBirthDate($userName, $birthDate);
        }

        if ($sex !== null) {
            $this->userModel->setSex($userName, $sex);
        }

        if ($country !== null) {
            $this->userModel->setCountry($userName, $country);
        }

        if (isset($_FILES['photo'])) {
            $photo = basename($_FILES['photo']['name']);
            $imagePath = "./public/imagenes/" . $photo;
            move_uploaded_file($_FILES['photo']['tmp_name'], $imagePath);
            $this->userModel->setPhoto($userName, $photo);
        }
        header("Location: /user&name=" . $userName);
    }

    private function generateQR()
    {
        $dir = 'public/qr/';

        if (!file_exists($dir)) {
            mkdir($dir);
        }
        $nameUser = $_GET['name'];
        $filename = $dir . $nameUser . '.png';

        if (!file_exists($filename)) {
            $size = 9;
            $level = 'M';
            $frameSize = 1;
            $content = "localhost/user&name=" . $nameUser;
            QRcode::png($content, $filename, $level, $size, $frameSize);
        }
    }
}