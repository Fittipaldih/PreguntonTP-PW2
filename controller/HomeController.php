<?php

class HomeController
{
    private $HomeModel;
    private $renderer;
    private $sessionManager;
    public function __construct($HomeModel, $renderer, $sessionManager)
    {
        $this->HomeModel = $HomeModel;
        $this->renderer = $renderer;
        $this->sessionManager=$sessionManager;
    }

    public function home()
    {
        $data = [];
        $this->renderer->render("home", $data);
    }

    public function login()
    {
        $usuario = $_POST['usuario'];
        $clave = md5($_POST['clave']);
        $usuarioEncontrada = $this->HomeModel->buscarUsuario($usuario, $clave);
        $rol=$usuarioEncontrada[0]["Id_rol"];
        if (sizeof($usuarioEncontrada) > 0){
            $this->sessionManager->set("logueado", true);
            $this->sessionManager->set("usuario", $usuario);
            switch ($rol){
                case 0:
                    $this->sessionManager->set("hash",$usuarioEncontrada[0]["Hash"]);
                    $data["nombre_usuario"]=$this->sessionManager->get("usuario");
                    $this->renderer->render('validarMail', $data);
                    break;
                case 3:
                    header("Location: /lobby");
                    exit();
            }
        } else $this->renderer->render('/home');
    }

    public function logout(){
        session_start();
        session_destroy();
        $data = [];
        $this->renderer->render('/home');
    }
}