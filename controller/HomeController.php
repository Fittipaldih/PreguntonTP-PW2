<?php

class HomeController
{
    private $HomeModel;
    private $renderer;

    public function __construct($HomeModel, $renderer)
    {
        $this->HomeModel = $HomeModel;
        $this->renderer = $renderer;
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
        $data = $this->HomeModel->buscarUsuario($usuario, $clave);

        if (sizeof($data) > 0 && $data[0]["Id_rol"]==0) {
            session_start();
            $_SESSION['hash'] = $data[0]["Hash"];
            $_SESSION['logueado'] = true;
            $_SESSION['usuario'] = $usuario;
            $data['nombre_usuario'] = $_SESSION['usuario'];

            $this->renderer->render('validarMail', $data);

        } else if (sizeof($data) > 0 && $data[0]["Id_rol"]!=0) {
            $this->renderer->render('lobby');
        } else{
            $this->renderer->render('home');
        }
    }

    public function logout(){
        session_start();
        session_destroy();
        $data = [];
        $this->renderer->render('home');
    }
}