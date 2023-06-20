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
        $data["questions"] = $this->suggestedModel->getSuggestedQuestions();
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
}