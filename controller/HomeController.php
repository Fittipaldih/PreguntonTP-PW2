<?php

class HomeController {
    private $HomeModel;
    private $renderer;

    public function __construct($HomeModel, $renderer) {
        $this->HomeModel = $HomeModel;
        $this->renderer = $renderer;
    }

}