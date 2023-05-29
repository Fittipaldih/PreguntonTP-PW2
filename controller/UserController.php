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
            $usuario=$this->sessionManager->get('usuario');
            $data["usuario"] = $this->UserModel->getUsuarioPorNombre($usuario);
            $this->renderer->render("user", $data);
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