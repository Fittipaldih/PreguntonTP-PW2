<?php

class QuestionController
{
    private $questionModel;
    private $renderer;
    private $sessionManager;

    public function __construct($model, $renderer, $sessionManager)
    {
        $this->questionModel = $model;
        $this->renderer = $renderer;
        $this->sessionManager = $sessionManager;
    }

    public function home()
    {
        $data['userName'] = $this->sessionManager->get("userName");
       /*$data['userName'] = $this->sessionManager->get("userName");
       if ( isset($_GET['s'])){
           $data["questionsS"] = $this->questionModel->getSuggestedQuestions();
           $data["suggested"] = true;
       }
       if ( isset($_GET['r'])){
           $data["questionsR"] = $this->questionModel->getRepportQuestions();
           $data["repport"] = true;
       }
        if ( isset($_GET['e'])){
            $data["questionsE"] = $this->questionModel->getAcceptedQuestions();
            $data["edit"] = true;
        }
        $this->renderer->render("question", $data);*/
        $data["questionsAccepted"] = $this->questionModel->getAcceptedQuestions();
        $data["edit"] = true;
        $this->renderer->render("question", $data);
    }

    public function reported(){
        $data['userName'] = $this->sessionManager->get("userName");
        $data["questionsReported"] = $this->questionModel->getRepportQuestions();
        $data["repport"] = true;
        $this->renderer->render("question", $data);
    }

    public function suggested(){
        $data['userName'] = $this->sessionManager->get("userName");
        $data["questionsSuggested"] = $this->questionModel->getSuggestedQuestions();
        $data["suggested"] = true;
        $this->renderer->render("question", $data);
    }

    public function delete(){
        $id=$_GET["id"];
        $this->questionModel->declineQuestion($id);
        header("location: /question");
        exit();
    }

    public function accept(){
        $id=$_GET["id"];
        $this->questionModel->acceptQuestion($id);
        header("location: /question");
        exit();
    }


    public function edit(){
        $idQuestion=$_GET["id"];
        $data['userName']= $this->sessionManager->get("userName");
        $data['edit'] = $this->sessionManager->get('edit');

        if ($idQuestion !== null){
            $data['question'] =  $this->questionModel->searchQuestionById($idQuestion);
        }
        $this->renderer->render("add", $data);
    }
    /*public function actions()
    {
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
            $id = $_POST['idQuestion'];

            switch ($action) {
                case 'accept':
                    $this->questionModel->acceptQuestion($id);
                    header("location: /question");
                    exit();
                case 'decline':
                    $this->questionModel->declineQuestion($id);
                    header("location: /question");
                    exit();
                case 'edit':
                    $this->sessionManager->set('idQuestionEdit', $id);
                    header("location: /question/add");
                    exit();
                default:
                    header("location: /question");
                    exit();
            }
            unset($_POST['idQuestion']);
            unset($_POST['action']);
        } else {
            echo("No se pudo realizar la acción, reporte el problema con el programador");
        }
    }
*/
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

        $this->questionModel->editQuestion($id, $descripcion, $idCategoria, $opcionA, $opcionB, $opcionC, $opcionD, $respCorrecta);

        // Restablece los parámetros a su estado original
        foreach ($requiredParams as $param) {
            unset($_POST[$param]);
        }
        $this->home();
    }

    public function add()
    {
        $data['edit'] = $this->sessionManager->get('edit');
        $data['player'] = $this->sessionManager->get('player');
        $data['userName']= $this->sessionManager->get("userName");

        if ($this->sessionManager->get('idQuestionEdit') !== null){
            $id = $this->sessionManager->get('idQuestionEdit');
            $data['question'] =  $this->questionModel->searchQuestionById($id);
        }
        $this->renderer->render("add", $data);
    }

    public function addQuestion()
    {
        $required = ['idCategoria', 'descripcion', 'opcionA', 'opcionB', 'opcionC', 'opcionD', 'respuestaCorrecta'];
        $errorMessage = "Error: Todos los campos son obligatorios";

        foreach ($required as $field) {
            if (!isset($_POST[$field])) {
                echo $errorMessage;
                return;
            }
        }
        $idCategoria = $_POST['idCategoria'];
        $descripcion = $_POST['descripcion'];
        $opcionA = $_POST['opcionA'];
        $opcionB = $_POST['opcionB'];
        $opcionC = $_POST['opcionC'];
        $opcionD = $_POST['opcionD'];
        $respuestaCorrecta = $_POST['respuestaCorrecta'];

        if ($this->sessionManager->get('idQuestionEdit') !== null){
            $id = $this->sessionManager->get('idQuestionEdit');
            $this->questionModel->updateQuestionById($id, $idCategoria, $descripcion, $opcionA, $opcionB, $opcionC, $opcionD, $respuestaCorrecta);
        }
        else{
            $idRol = $this->sessionManager->get("idRol");
            $this->questionModel->addQuestion($idRol, $idCategoria, $descripcion, $opcionA, $opcionB, $opcionC, $opcionD, $respuestaCorrecta);
        }
        unset($_POST['idCategoria']);
        unset($_POST['descripcion']);
        unset($_POST['opcionA']);
        unset($_POST['opcionB']);
        unset($_POST['opcionC']);
        unset($_POST['opcionD']);
        unset($_POST['respuestaCorrecta']);
        header("Location: /lobby");
        exit();
    }
}