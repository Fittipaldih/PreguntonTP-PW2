<?php

class UserController
{
    private $userModel;
    private $renderer;
    private $sessionManager;
    private $userService;

    public function __construct($model, $renderer, $sessionManager, $userService)
    {
        $this->userModel = $model;
        $this->renderer = $renderer;
        $this->sessionManager = $sessionManager;
        $this->userService = $userService;
    }

    public function home()
    {
        if (isset($_GET['name'])) {
            $userName = $_GET['name']; // Lo recibe de la view ranking Linea 18
        }
        $userLogged = $this->sessionManager->get("userName");
        $canEdit = (strtoupper($userName)) === (strtoupper($userLogged));
        $data['mapa'] = true;
        $data["userName"] = $userLogged;
        $data["canEdit"] = $canEdit;
        $data["userData"] = $this->userService->getDataUserByName($userName);
        $data["games"] = $this->userService->getUserGamesByName($userName);
        $data["player"] = $this->sessionManager->get('player');

        $this->userService->generateQRForUser();
        $this->renderer->render("user", $data);
    }

    public function editCount()
    {
        $userName = $this->sessionManager->get("userName");

        if (isset($_POST['nombre'])) {
            $nameComplete = $_POST['nombre'];
            $this->userModel->setNameComplete($userName, $nameComplete);
        }

        if (isset($_POST['fecha_nacimiento'])) {
            $birthDate = $_POST['fecha_nacimiento'];
            $this->userModel->setBirthDate($userName, $birthDate);
        }

        if (isset($_POST['pais'])) {
            $country = $_POST['pais'];
            $this->userModel->setCountry($userName, $country);
        }

        if (isset($_POST['sexo'])) {
            $sex = $_POST['sexo'];
            $this->userModel->setSex($userName, $sex);
        }

        if (isset($_POST['eliminar_foto']) && $_POST['eliminar_foto'] === 'on') {
            $this->userModel->setPhoto($userName, null);
        }

        if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] !== 4) {
            $photo = basename($_FILES['foto_perfil']['name']);
            $imagePath = "./public/imagenes/" . $photo;
            move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $imagePath);
            $this->userModel->setPhoto($userName, $photo);
        }

        header("Location: /user&name=" . $userName);
    }

    public function totalUser()
    {
        $rt = $this->userModel->getTotalUsers();
        echo("Total de usuarios= " .$rt);
    }

    public function totalGames()
    {
        $rt = $this->userModel->getTotalGames();
        echo("Total de partidas jugadas= " . $rt);
    }

    public function totalQuestions()
    {
        $rt = $this->userModel->getTotalQuestions();
        echo("Total de preguntas= " . $rt);
    }

    public function totalQuestionsCreate()
    {
        $rt = $this->userModel->getTotalQuestionsCreate();
        echo("Total de preguntas creadas= " . $rt);
    }
    public function questionCorrect() {
        $data = $this->userModel->getTotalPreguntasCorrectasPorUsuario();

        foreach ($data as $row) {
            $nivel = $row['nivel'];
            $nombreUsuario = $row['Nombre_usuario'];
            echo "Nivel: $nivel, Nombre de Usuario: $nombreUsuario<br>";
        }
    }

    public function getTotalUsersFromCountry() {
        $rt = $this->userModel->getTotalUsersFromCountry();
        foreach ($rt as $row) {
            $nombrePais = $row['Pais'];
            $cantidadUsuarios = $row['cantidadUsuarios'];
            echo "País: $nombrePais, Cantidad de usuarios: $cantidadUsuarios<br>";
        }
    }
}