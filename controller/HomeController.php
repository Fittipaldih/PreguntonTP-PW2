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
        if (!$this->isSessionStarted()) {
            $data = [];
            $this->renderer->render("home", $data);
        } else {
            $this->renderView();
        }
    }

    private function isSessionStarted()
    {
        return $this->sessionManager->get("isConnected");
    }

    private function renderView()
    {
        header("Location: /lobby");
        exit();
    }

    public function login()
    {
        $userName = $_POST['user'];
        $pass = md5($_POST['pass']);
        $userFound = $this->homeModel->getUserByNameAndPass($userName, $pass);

        if (sizeof($userFound) > 0) {
            $this->setUserSession($userName, $pass);
            $this->verifyRol($userFound);
        } else {
            $this->renderer->render('/home');
        }
    }

    private function setUserSession($userName, $pass)
    {
        $this->sessionManager->set("user", $userName);
        $this->sessionManager->set("pass", $pass);
        $this->sessionManager->set("isConnected", true);
    }

    private function verifyRol($user)
    {
        // $rol = $this->homeModel->getUserRol($user);
        $rol = $user[0]["Id_rol"];
        switch ($rol) {
            case 0: // No_validado
                $this->sessionManager->set("validEmail", false);
                $data["nombre_usuario"] = $user[0]["Nombre_usuario"];
                $data["hash"] = $user[0]["Hash"];
                $this->renderer->render('validarMail', $data);
                break;
            case 1: // Administrador
                break;
            case 2: // Editor
                break;
            case 3: // Jugador
                header("Location: /lobby");
                exit();
            default:
                header("Location: /");
                exit();
        }
    }

    public function logout()
    {
        $this->sessionManager->destroy();
        header("Location: /home");
        exit();
    }

    public function validateEmail()
    {
        $hash = $_GET["hash"];
        $userName = $this->sessionManager->get("user");
        $pass = $this->sessionManager->get("pass");
        $userFound = $this->homeModel->getUserByNameAndPass($userName, $pass);

        if ($this->validateHash($hash, $userFound)) {
            $this->homeModel->setUserRol($userName);
            $this->sessionManager->set("validEmail", true);
            header("Location: /");
            exit();
        } else {
            header("Location: /registro");
            exit();
        }
    }

    private function validateHash($hash, $userFound)
    {
        return $userFound[0]["Hash"] == $hash;
    }
}