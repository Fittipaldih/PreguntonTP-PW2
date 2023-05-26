<?php

class UserController {
    private $UserModel;
    private $renderer;

    public function __construct($UserModel, $renderer) {
        $this->UserModel = $UserModel;
        $this->renderer = $renderer;
    }

    public function home() {
        $data["usuario"] = $this->UserModel->getUsuarioPorId();
        $this->renderer->render("user", $data);
    }

}