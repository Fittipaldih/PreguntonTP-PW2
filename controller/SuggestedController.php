<?php

class SuggestedController
{
    private $suggestedModel;
    private $renderer;
    private $sessionManager;

    public function __construct($model, $renderer, $sessionManager)
    {
        $this->suggestedModel = $model;
        $this->renderer = $renderer;
        $this->sessionManager = $sessionManager;
    }

    public function home()
    {
        $data['userName'] = $this->sessionManager->get("userName");
       if ( isset($_GET['s'])){
           $data["questionsS"] = $this->suggestedModel->getSuggestedQuestions();
           $data["suggested"] = true;
       }
       if ( isset($_GET['r'])){
           $data["questionsR"] = $this->suggestedModel->getRepportQuestions();
           $data["repport"] = true;
       }
        if ( isset($_GET['e'])){
            $data["questionsE"] = $this->suggestedModel->getAcceptedQuestions();
            $data["edit"] = true;
        }
        $this->renderer->render("suggested", $data);
    }

    public function accept()
    {
        if (isset($_POST['idQuestion'])) {
            $id = $_POST['idQuestion'];
            $this->suggestedModel->acceptQuestion($id);
            unset($_POST['idQuestion']);
            $this->home();
        } else {
            echo("No se pudo aceptar, reporte el problema con el programador");
        }
    }

    public function decline()
    {
        if (isset($_POST['idQuestion'])) {
            $id = $_POST['idQuestion'];
            $this->suggestedModel->declineQuestion($id);
            unset($_POST['idQuestion']);
            $this->home();
        } else {
            echo("No se pudo eliminar, reporte el problema con el programador");
        }
    }

    public function editQuestion()
    {
        $requiredParams = ['idQuestion', 'descripcion', 'id_categoria', 'opcionA', 'opcionB', 'opcionC', 'opcionD', 'resp_correcta'];

        foreach ($requiredParams as $param) {
            if (!isset($_POST[$param]) || empty($_POST[$param])) {
                echo "No se pudo editar, falta el parámetro: " . $param;
            }
        }
        $id = $_POST['idQuestion'];
        $descripcion = $_POST['descripcion'];
        $idCategoria = $_POST['id_categoria'];
        $opcionA = $_POST['opcionA'];
        $opcionB = $_POST['opcionB'];
        $opcionC = $_POST['opcionC'];
        $opcionD = $_POST['opcionD'];
        $respCorrecta = $_POST['resp_correcta'];

        $this->suggestedModel->editQuestion($id, $descripcion, $idCategoria, $opcionA, $opcionB, $opcionC, $opcionD, $respCorrecta);

        // Restablece los parámetros a su estado original
        foreach ($requiredParams as $param) {
            unset($_POST[$param]);
        }
        $this->home();
    }
}