<?php

class RegistroController {
    private $RegistroModel;
    private $renderer;

    public function __construct($RegistroModel, $renderer) {
        $this->RegistroModel = $RegistroModel;
        $this->renderer = $renderer;
    }

    public function home(){
        $data=[];
        $this->renderer->render("registro", $data);
    }
    private function renderHome()
    {
        $data = [];
        $this->renderer->render("home", $data);
    }

    public function registrarse() {
        $nombre= $_POST["nombre"];
        $anio_nacimiento= $_POST["anio_nacimiento"];
        $sexo= $_POST["sexo"];
        $pais= $_POST["pais"];
        $ciudad= $_POST["ciudad"];
        $correo= $_POST["correo"];
        $nombre_usuario= $_POST["nombre_usuario"];
        $foto_perfil= basename($_FILES['foto_perfil']['name']);
        $contrasenia= $_POST["contrasenia"];
        $confirmar_contrasenia= $_POST["confirmar_contrasenia"];

        if ($this->validatePassword($contrasenia, $confirmar_contrasenia)) {
            if ($this->RegistroModel->guardarUsuario($nombre, $anio_nacimiento, $sexo, $pais, $ciudad, $correo, $nombre_usuario, $foto_perfil, $contrasenia, $confirmar_contrasenia)) {
                $this->renderHome();
            } else {
                $this->home();
            }
        } else {
            $this->home();
        }
    }

    private function validatePassword($contrasenia, $confirmar_contrasenia)
    {
        return $contrasenia === $confirmar_contrasenia;
    }
}