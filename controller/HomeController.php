<?php

class HomeController
{
    private $homeModel;
    private $renderer;
    private $sessionManager;

    public function __construct($model, $renderer, $sessionManager)
    {
        $this->homeModel = $model;
        $this->renderer = $renderer;
        $this->sessionManager = $sessionManager;
    }

    public function home(): void
    {
        $data=[];
        $this->renderer->render("home", $data);
    }

    public function login(): void
    {
        if ($this->sessionManager->get('idUser') == null) {
            $userNameForm = ucfirst(strtolower($_POST['user']));
            $pass = md5($_POST['pass']);

            $userConnected = $this->homeModel->getUserByNameAndPass($userNameForm, $pass);

            if (sizeof($userConnected) == 1) {
                $this->setUserSession($userConnected);
                $idRol = $this->sessionManager->get("idRol");
                $this->userRolManager($idRol);
            } else {
                $this->redirectHome();
            }
        } else {
            $this->redirectLobby();
        }
    }

    private function setUserSession($user): void
    {
        $this->sessionManager->set("userName", $user[0]['Nombre_usuario']);
        $this->sessionManager->set("idUser", $user[0]["Id"]);
        $this->sessionManager->set("idRol", $user[0]["Id_rol"]);
    }

    private function userRolManager($idRol): void
    {
        switch ($idRol) {
            case 0: // novalidado
                $this->caseNoValidate();
                break;
            case 1: // administrador
                $this->sessionManager->set('admin', true);
                $this->redirectLobby();
                break;
            case 2: // editor
                $this->sessionManager->set('edit', true);
                $this->redirectLobby();
                break;
            case 3: // jugador
                $this->sessionManager->set('player', true);
                $this->redirectLobby();
                break;
            default:
                $this->redirectHome();
                break;
        }
    }

    private function caseNoValidate(): void
    {
        $userName = $this->sessionManager->get("userName");
        $userConnected = $this->homeModel->getUserByName($userName);

        if ($userConnected !== null) {
            $data = [];
            $this->sessionManager->destroy();
            $this->renderer->render('/registroExitoso', $data);
        } else {
            $this->redirectHome();
        }
    }

    private function redirectHome()
    {
        header("Location: /");
        exit();
    }

    private function redirectLobby()
    {
        header("Location: /lobby");
        exit();
    }

    public function validateEmail()
    {
        $hash = $_GET["hash"];
        $verifedHashArray = $this->homeModel->getUserHash($hash);
        $hashobtained = $verifedHashArray[0]["Hash"];

        if ($hash == $hashobtained) {
            $this->homeModel->setUserRol($verifedHashArray[0]["Nombre_usuario"]);
            header("Location: /");
        } else {
            header("Location: /registro");
        }
        exit();
    }

    public function logout()
    {
        $this->sessionManager->destroy();
        header("Location: /home");
        exit();
    }
}