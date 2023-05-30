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
        if (!$this->laSesionEstaIniciada()){
            $data = [];
            $this->renderer->render("home", $data);
        } else {
            header("Location: /lobby");
            exit();
        }
    }

    private function laSesionEstaIniciada()
    {
        return $this->sessionManager->get("logueado");
    }

    public function login()
    {
        $usuario = $_POST['usuario'];
        $clave = md5($_POST['clave']);
        $usuarioEncontrado = $this->HomeModel->buscarUsuario($usuario, $clave);
        if (sizeof($usuarioEncontrado) > 0){
            $rol=$usuarioEncontrado[0]["Id_rol"];
            $this->sessionManager->set("logueado", true);
            $this->sessionManager->set("usuario", $usuario);
            $this->sessionManager->set("clave", $clave);
            $this->sessionManager->set("validado", false);
            switch ($rol){
                case 0:
                    $data["nombre_usuario"]=$this->sessionManager->get("usuario");
                    $data["hash"]=$usuarioEncontrado[0]["Hash"];
                    $this->renderer->render('validarMail', $data);
                    break;
                case 3:
                    header("Location: /lobby");
                    exit();
            }
        } else $this->renderer->render('/home');
    }

    public function logout()
    {
        $this->sessionManager->destroy();
        header("Location: /home");
        exit();
    }

    public function validar()
    {
        $hash=$_GET["id"];
        $usuario = $this->sessionManager->get("usuario");
        $clave= $this->sessionManager->get("clave");
        $usuarioEncontrado = $this->HomeModel->buscarUsuario($usuario, $clave);
        if ( $usuarioEncontrado[0]["Hash"]==$hash){
            $this->HomeModel->cambiarRol($usuario);
            $this->sessionManager->set("validado", true);
            header("Location: /");
            exit();
        }
        else{
            header("Location: /registro");
            exit();
        }
    }
}