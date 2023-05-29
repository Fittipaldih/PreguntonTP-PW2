<?php
class PartidaController{
    private $PartidaModel;
    private $renderer;

    private $sessionManager;

    public function __construct($PartidaModel, $renderer, $sessionManager) {
        $this->PartidaModel = $PartidaModel;
        $this->renderer = $renderer;
        $this->sessionManager=$sessionManager;
    }

    public function home(){
        if ($this->laSesionEstaIniciada()){
            $data=[];
            $this->renderer->render("Partida", $data);
        }
        else {
            header("Location: /");
            exit();
        }
    }

    private function laSesionEstaIniciada()
    {
        return $this->sessionManager->get("logueado");
    }


}