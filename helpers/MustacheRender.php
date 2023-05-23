<?php

class MustacheRender{
    private $mustache;

    public function __construct($partialsPathLoader){
        Mustache_Autoloader::register();
        $this->mustache = new Mustache_Engine(
            array(
            'partials_loader' => new Mustache_Loader_FilesystemLoader( $partialsPathLoader )
        ));
    }

    public function render($contentFile , $data = array() ){
        $contentAsString =  file_get_contents("view/". $contentFile . "_view.mustache");
        echo  $this->mustache->render($contentAsString, $data);
    }
}