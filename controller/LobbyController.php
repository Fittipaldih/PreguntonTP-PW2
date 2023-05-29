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

    public function home()
    {
        $nombreUsuario = $this->sessionManager->get("usuario");
        $data['nombre_usuario'] = $nombreUsuario;
        $genero = $this->LobbyModel->obtenerGeneroDesdeBD($nombreUsuario);
        $data['saludo'] = $this->getSaludo($genero);
        $this->renderer->render("lobby", $data);
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