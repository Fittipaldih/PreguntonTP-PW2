<?php

class LobbyController {
    private $LobbyModel;
    private $renderer;

    private $sessionManager;

    public function __construct($LobbyModel, $renderer, $sessionManager) {
        $this->LobbyModel = $LobbyModel;
        $this->renderer = $renderer;
        $this->sessionManager=$sessionManager;
    }

    public function home(){
        if($this->laSesionEstaIniciada()){
        $data['nombre_usuario']=$this->sessionManager->get("usuario");
        $genero = $this->LobbyModel->obtenerGeneroDesdeBD($nombreUsuario);
        $data['saludo'] = $this->getSaludo($genero);
        $this->renderer->render("lobby", $data);}
        else {
            header("Location: /");
            exit();
        }
    }
    private function laSesionEstaIniciada()
    {
        return $this->sessionManager->get("logueado");
}
    private function getSaludo($genero)
    {
        if ($genero === 'Femenino') {
            return 'Bienvenida';
        } elseif ($genero === 'Masculino') {
            return 'Bienvenido';
        } else {
            return 'Bienvenidx';
        }
    }

}