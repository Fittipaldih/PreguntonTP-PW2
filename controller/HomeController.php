<?php

class HomeController
{
    private $HomeModel;
    private $renderer;

    public function __construct($HomeModel, $renderer){
        $this->HomeModel = $HomeModel;
        $this->renderer = $renderer;
    }

    public function home(){
        $data = [];
        $this->renderer->render("home", $data);
    }

    public function login(){
        $usuario = $_POST["usuario"];
        $clave = md5($_POST['clave']);
        $data = $this->HomeModel->buscarUsuario($usuario, $clave);

        if (sizeof($data) > 0) {
            $this->iniciarSesion();
            $this->renderer->render('validarMail');
        } else {
            $this->renderer->render('home');
        }
    }

    public function iniciarSesion()
    {

    }
}