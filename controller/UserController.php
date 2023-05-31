<?php

class UserController {
    private $UserModel;
    private $renderer;
    private $sessionManager;

    public function __construct($UserModel, $renderer, $sessionManager) {
        $this->UserModel = $UserModel;
        $this->renderer = $renderer;
        $this->sessionManager=$sessionManager;
    }

    public function home() {
        if ($this->laSesionEstaIniciada()){
            $nombreUsuario=$_GET['nombre'];
            if($nombreUsuario==$this->sessionManager->get('usuario')){
                $usuario=$this->sessionManager->get('usuario');
                $data["usuario"] = $this->UserModel->getUsuarioPorNombre($usuario);
                $data["partida"] = $this->UserModel->getDatosPartida($nombreUsuario);
                $this->renderer->render("user", $data);
            }
            else{
                $data["usuario"] = $this->UserModel->getUsuarioPorNombre($nombreUsuario);
                $this->renderer->render("user", $data);
            }

        }
        else {
            header("location: /");
            exit();
        }

    }

    private function laSesionEstaIniciada()
    {
        return $this->sessionManager->get("logueado");
    }

}