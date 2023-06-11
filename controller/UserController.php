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
        $canEdit = ($userName === $userLogged) ? true : false;
        $data["canEdit"] = $canEdit;
        $data["user"] = $this->getUserByName($userName);
        $data["games"] = $this->getUserGamesByName($userName);
        $data['userLogged'] = $userLogged;

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

    private function edit()
    {
        $edit = $_POST['edit'];
        $new = $_POST['new'];
        switch ($edit) {
            case 'photo':
                $this->userModel->setPhoto($this->getNameUserBySession(), $new);
                header("Location: /user");
                break;
            case 'nameComplete':
                $this->userModel->setNameComplete($this->getNameUserBySession(), $new);
                header("Location: /user");
                break;
            case 'genre':
                $this->userModel->setSex($this->getNameUserBySession(), $new);
                header("Location: /user");
                break;
            case 'birthDate':
                $this->userModel->setBirthDate($this->getNameUserBySession(), $new);
                header("Location: /user");
                break;
            case 'ubi':
                $this->userModel->setUbication($this->getNameUserBySession(), $new);
                header("Location: /user");
                break;
            case 'mail':
                $this->userModel->setMail($this->getNameUserBySession(), $new);
                header("Location: /user");
                break;
            default :
                header("Location: /lobby");
                exit();
        }
    }
}