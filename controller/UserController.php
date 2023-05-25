<?php

class UserController {
    private $UserModel;
    private $renderer;

    public function __construct($UserModel, $renderer) {
        $this->UserModel = $UserModel;
        $this->renderer = $renderer;
    }
    public function home() {
        $data=[];
        $this->renderer->render("home", $data);
    }
    public function list() {
        $data["usuario"] = $this->UserModel->getUsuarioPorId();
        $this->renderer->render("user", $data);
    }

}