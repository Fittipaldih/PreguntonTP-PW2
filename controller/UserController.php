<?php

class UserController
{
    private $userModel;
    private $renderer;
    private $sessionManager;
    private $qrService;

    public function __construct($model, $renderer, $sessionManager)
    {
        $this->userModel = $model;
        $this->renderer = $renderer;
        $this->sessionManager = $sessionManager;
        $this->qrService = new UserService($this->userModel);
    }

    public function home()
    {
        if (isset($_GET['name'])){
        $userName = $_GET['name']; // esto lo recibe de la view ranking Linea 18
        }
        $userLogged = $this->sessionManager->get("userName");
        $canEdit = (strtoupper($userName)) === (strtoupper($userLogged));
        $data['mapa']=true;
        $data["userName"] = $userName;
        $data["canEdit"] = $canEdit;
        $data["userData"] = $this->getDataUserByName($userName);
        $data["games"] = $this->getUserGamesByName($userName);
        $data["player"] = $this->sessionManager->get('player');

        $this->qrService->generateQRForUser();
        $this->renderer->render("user", $data);
    }

    private function getUserGamesByName($userName)
    {
        return $this->userModel->getUserGamesByName($userName);
    }

    private function getDataUserByName($userName)
    {
        return $this->userModel->getUserByName($userName);
    }

    public function edit()
    {
        $userName = $this->sessionManager->get("userName");


        if (isset($_POST['nameComplete'])) {
            $nameComplete = $_POST['nameComplete'];
            $this->userModel->setNameComplete($userName, $nameComplete);
        }
        if (isset($_POST['birthDate'])) {
            $birthDate = $_POST['birthDate'];
            $this->userModel->setBirthDate($userName, $birthDate);
        }
        if (isset($_POST['country'])) {
            $country = $_POST['country'];
            $this->userModel->setCountry($userName, $country);
        }
        if (isset($_POST['sex'])) {
            $sex = $_POST['sex'];
            $this->userModel->setSex($userName, $sex);
        }
        if (isset($_FILES['photo'])) {
            $photo = basename($_FILES['photo']['name']);
            $imagePath = "./public/imagenes/" . $photo;
            move_uploaded_file($_FILES['photo']['tmp_name'], $imagePath);
            $this->userModel->setPhoto($userName, $photo);
        }
        header("Location: /user&name=" . $userName);
    }
}