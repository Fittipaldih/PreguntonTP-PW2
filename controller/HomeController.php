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

    public function home()
    {
        $data['mapa']=true;
        $this->renderer->render("home", $data);
    }

    public function login()
    {
        $userNameForm = ucfirst(strtolower($_POST['user']));
        $pass = md5($_POST['pass']);

        $userConnected = $this->homeModel->getUserByNameAndPass($userNameForm, $pass);

        if (sizeof($userConnected) == 1) {
            $this->setUserSession($userConnected);
            $idRol = $this->sessionManager->get("idRol");

            switch ($idRol) {
                case 0: // novalidado
                    $data["hash"] = $userConnected[0]["Hash"];
                    $this->renderer->render('/registroExitoso', $data);
                    break;
                case 1: // administrador
                    $this->sessionManager->set('admin', true);
                    header("Location: /lobby");
                    exit();
                case 2: // editor
                    $this->sessionManager->set('edit', true);
                    header("Location: /lobby");
                    exit();
                case 3: // jugador
                    $this->sessionManager->set('player', true);
                    header("Location: /lobby");
                    exit();
                default:
                    header("Location: /");
                    exit();
                    break;
            }
        } else {
            header("location:/");
            exit();
        }
    }

    private function setUserSession($user)
    {
        $this->sessionManager->set("userName", $user[0]['Nombre_usuario']);
        $this->sessionManager->set("idUser", $user[0]["Id"]);
        $this->sessionManager->set("idRol", $user[0]["Id_rol"]);
    }

    public function validateEmail()
    {
        $hash = $_GET["hash"];
        $verifedHashArray = $this->homeModel->getUserHash($hash);
        $hashobtained = $verifedHashArray[0]["Hash"];

        if ($hash == $hashobtained) {
            $this->homeModel->setUserRol($verifedHashArray[0]["Nombre_usuario"]);
            $this->sessionManager->set("validEmail", true);
            header("Location: /");

        } else {
            header("Location: /registro");
        }
        exit();
    }
    /*
   private function validateHash($hash, $userFound)
    {
        return $userFound[0]["Hash"] == $hash;
    }*/

    public function logout()
    {
        $this->sessionManager->destroy();
        header("Location: /home");
        exit();
    }
}