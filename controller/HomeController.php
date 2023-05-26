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
            session_start();
            $_SESSION["logueado"]=true;
            $_SESSION["usuario"]=$usuario;
            $data["nombre_usuario"]=$_SESSION["usuario"];
            $this->renderer->render('validarMail', $data);
        } else {
            $this->renderer->render('home');
        }
    }

}