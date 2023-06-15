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
        $data = [];
        $this->renderer->render("home", $data);
    }

    public function login()
    {
        $userName = ucfirst(strtolower($_POST['user']));
        $pass = md5($_POST['pass']);
        $userFound = $this->homeModel->getUserByNameAndPass($userName, $pass);

        if (sizeof($userFound) == 1) {
            $this->setUserSession($userName, $pass, $userFound);
            $idRol = $this->sessionManager->get("idRol");

            switch ($idRol) {
                case 0:
                    $data["hash"] = $userFound[0]["Hash"];
                    $this->renderer->render('/registroExitoso', $data);
                    break;
                case 3:
                    header("Location: /lobby");
                    exit();
                    break;
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

    private function setUserSession($userName, $pass, $userFound)
    {
        $this->sessionManager->set("idUser", $userFound[0]["Id"]);
        $this->sessionManager->set("user", $userName);
        $this->sessionManager->set("pass", $pass);
        $this->sessionManager->set("isConnected", true);
        $this->sessionManager->set("idRol", $userFound[0]["Id_rol"]);
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