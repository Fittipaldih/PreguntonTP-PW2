<?php

class RegistroController {
    private $RegistroModel;
    private $renderer;
    private $sessionManager;

    public function __construct($RegistroModel, $renderer, $sessionManager) {
        $this->RegistroModel = $RegistroModel;
        $this->renderer = $renderer;
        $this->sessionManager=$sessionManager;
    }

    public function home(){
        if (!$this->laSesionEstaIniciada()){
            $data=[];
            $this->renderer->render("registro", $data);
        } else {header("Location: /lobby");
        exit();
        }

    }

    public function registrarse() {
        $nombre= $_POST["nombre"];
        $fecha_nacimiento= $_POST["fecha_nacimiento"];
        $sexo= $_POST["sexo"];
        $pais= $_POST["pais"];
        $ciudad= $_POST["ciudad"];
        $correo= $_POST["correo"];
        $nombre_usuario= $_POST["nombre_usuario"];
        $foto_perfil= basename($_FILES['foto_perfil']['name']);
        $contrasenia= $_POST["contrasenia"];
        $confirmar_contrasenia= $_POST["confirmar_contrasenia"];
        $data=[];

        if ($this->validatePassword($contrasenia, $confirmar_contrasenia)) {
            if ($this->RegistroModel->guardarUsuario($nombre, $fecha_nacimiento, $sexo, $pais, $ciudad, $correo, $nombre_usuario, $foto_perfil, $contrasenia, $confirmar_contrasenia)) {
                $this->renderer->render("registroExitoso", $data);
            } else {
                $data["mensaje"]="el usuario ya existe";
                $this->renderer->render("registro", $data);
            }
        } else {
            $data["mensaje"]="las contraseñas no coinciden";
            $this->renderer->render("registro", $data);
        }
    }

    private function validatePassword($contrasenia, $confirmar_contrasenia)
    {
        return $contrasenia === $confirmar_contrasenia;
    }

    private function laSesionEstaIniciada()
    {
        return $this->sessionManager->get("logueado");
    }
}