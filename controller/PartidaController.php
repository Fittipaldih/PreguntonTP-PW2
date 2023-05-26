<?php
class PartidaController{
    private $PartidaModel;
    private $renderer;

    public function __construct($PartidaModel, $renderer) {
        $this->PartidaModel = $PartidaModel;
        $this->renderer = $renderer;
    }

    public function home(){
        $data=[];
        $this->renderer->render("Partida", $data);
    }
}