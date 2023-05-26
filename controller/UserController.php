<?php

class UserController {
    private $UserModel;
    private $renderer;

    public function __construct($UserModel, $renderer) {
        $this->UserModel = $UserModel;
        $this->renderer = $renderer;
    }

    public function home() {
        session_start();
        $usuario=$_SESSION['usuario'];
        $data["usuario"] = $this->UserModel->getUsuarioPorNombre($usuario);
        $this->renderer->render("user", $data);
    }

}