<?php

class LobbyController {
    private $LobbyModel;
    private $renderer;

    public function __construct($LobbyModel, $renderer) {
        $this->LobbyModel = $LobbyModel;
        $this->renderer = $renderer;
    }

    public function home(){
        session_start();
        $data['nombre_usuario']=$_SESSION['usuario'];
        $this->renderer->render("lobby", $data);
    }

    public function validar(){
        $data=[];
        session_start();
        $usuario=$_SESSION["usuario"];
        $result = $this->LobbyModel->validarMail($usuario);

        if ( $result[0]["Hash"]==$_SESSION["hash"] ){
            $this->LobbyModel->cambiarRol($usuario);
            $this->renderer->render("/lobby", $data);
        } else{
            $this->renderer->render("/registro", $data);
        }
    }
}