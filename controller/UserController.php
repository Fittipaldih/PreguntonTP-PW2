<?php

class UserController
{
    private $userModel;
    private $renderer;
    private $sessionManager;

    public function __construct($model, $renderer, $sessionManager)
    {
        $this->userModel = $model;
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
        return $this->sessionManager->get("isConnected") && $this->sessionManager->get('user');
    }

    public function renderView()
    {
        if (isset($_GET['name'])){
        $userName = $_GET['name']; // esto lo recibe de la view ranking Linea 18
        $userLogged = $this->getNameUserBySession();
        $canEdit = ($userName === $userLogged) ? true : false;
        $data["canEdit"] = $canEdit;
        $data["user"] = $this->getUserByName($userName);
        $data["games"] = $this->getUserGamesByName($userName);
        $data['userLogged'] = $userLogged;

        $this->renderer->render("user", $data);
        }
        else {
            header("Location: /");
            exit();
        }
    }

    private function getNameUserBySession()
    {
        return $this->sessionManager->get('user');
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
        $userName = $_GET['name'];
        $userLogged = $this->getNameUserBySession();
        if ($userLogged === $userName) {
            $edit = $_GET['edit'];
            $new = $_GET['new'];
            switch ($edit) {
                case 'userName':
                    $this->userModel->setUserName($userLogged, $new);
                    break;
                case 'photo':
                    $this->userModel->setPhoto($userLogged, $new);
                    break;
                case 'nameComplete':
                    $this->userModel->setNameComplete($userLogged, $new);
                    break;
                case 'sex':
                    $this->userModel->setSex($userLogged, $new);
                    break;
                case 'birthDate':
                    $this->userModel->setBirthDate($userLogged, $new);
                    break;
                case 'ubi':
                    $this->userModel->setUbication($userLogged, $new);
                    break;
                case 'mail':
                    $this->userModel->setMail($userLogged, $new);
                    break;
                default :
                    header("Location: /lobby");
                    exit();
            }
        }
    }
}