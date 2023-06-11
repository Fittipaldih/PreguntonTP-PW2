<?php

class HomeController
{
    private $homeModel;
    private $renderer;

    public function __construct($model, $renderer, $sessionManager)
    {
        $this->homeModel = $model;
        $this->renderer = $renderer;
    }

    public function home()
    {
        $data = [];
        $this->renderer->render("home", $data);
    }

    public function login()
    {
        $userName = $_POST['user'];
        $pass = md5($_POST['pass']);
        $userFound = $this->homeModel->getUserByNameAndPass($userName, $pass);

        if (sizeof($userFound) > 0) {
            $this->setUserSession($userName, $pass, $userFound);
            if ($_SESSION["idRol"]==0) {
                $data["hash"]=$userFound[0]["Hash"];
                $this->renderer->render('/validarMail', $data);
            } else {
                header("Location: /lobby");
                exit();
            }
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: /home");
        exit();
    }

    private function setUserSession($userName, $pass, $userFound)
    {
        $_SESSION["idUser"]=$userFound[0]["Id"];
        $_SESSION["user"]= $userName;
        $_SESSION["pass"]=$pass;
        $_SESSION["isConnected"]=true;
        $_SESSION["idRol"]=$userFound[0]["Id_rol"];
    }

    public function validateEmail()
    {
        $hash = $_GET["hash"];
        $userName=$_SESSION["user"];
        $pass=$_SESSION["pass"];
        $userFound = $this->homeModel->getUserByNameAndPass($userName, $pass);

        if ($this->validateHash($hash, $userFound)) {
            $this->homeModel->setUserRol($userName);
            $_SESSION["validEmail"]=true;
            header("Location: /");
        } else {
            header("Location: /registro");
        }
        exit();
    }

    private function validateHash($hash, $userFound)
    {
        return $userFound[0]["Hash"] == $hash;
    }
}