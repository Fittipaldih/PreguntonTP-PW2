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
        if ($this->sessionManager->get('newQuestion')) {
            $data['showNewQuestionModal'] = true;
            $this->sessionManager->delete('newQuestion');
        }
        $data["questionsAccepted"] = $this->questionModel->getAcceptedQuestions();
        $data["edit"] = true;
        $this->renderer->render("question", $data);
    }

    public function reported(){
        $data["questionsReported"] = $this->questionModel->getRepportQuestions();
        $data["repport"] = true;
        $this->renderer->render("question", $data);
    }

    public function suggested(){
        $data["questionsSuggested"] = $this->questionModel->getSuggestedQuestions();
        $data["suggested"] = true;
        $this->renderer->render("question", $data);
    }

    public function delete(){
        $id=$_GET["id"];
        $idEstado=$this->questionModel->searchQuestionById($id);
        $this->questionModel->declineQuestion($id);
        switch ($idEstado[0]["id_estado"]){
            case 1:
                header("location: /question/suggested");
                exit();
            case 2:
                header("location: /question");
                exit();
            case 3:
                header("location: /question/reported");
                exit();
            default:
                header("location: /question");
                exit();
        }

    }

    public function accept(){
        $id=$_GET["id"];
        $idEstado=$this->questionModel->searchQuestionById($id);
        $this->questionModel->acceptQuestion($id);
        switch ($idEstado[0]["id_estado"]){
            case 1:
                header("location: /question/suggested");
                exit();
            case 2:
                header("location: /question");
                exit();
            case 3:
                header("location: /question/reported");
                exit();
            default:
                header("location: /question");
                exit();
        }
    }


    public function edit(){
        $idQuestion=$_GET["id"];
        $data['userName']= $this->sessionManager->get("userName");
        $data['edit'] = $this->sessionManager->get('edit');

        if ($idQuestion !== null){
            $data['question'] =  $this->questionModel->searchQuestionById($idQuestion);
        }
        $this->renderer->render("edit", $data);
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
        $idEstado=$this->questionModel->searchQuestionById($id);

        $this->questionModel->editQuestion($id, $descripcion, $idCategoria, $opcionA, $opcionB, $opcionC, $opcionD, $respCorrecta);

        // Restablece los parámetros a su estado original
        foreach ($requiredParams as $param) {
            unset($_POST[$param]);
        }

        switch ($idEstado[0]["id_estado"]){
            case 1:
                header("location: /question/suggested");
                exit();
            case 2:
                header("location: /question");
                exit();
            case 3:
                header("location: /question/reported");
                exit();
            default:
                header("location: /question");
                exit();
        }
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

        $idRol = $this->sessionManager->get("idRol");
        $this->questionModel->addQuestion($idRol, $idCategoria, $descripcion, $opcionA, $opcionB, $opcionC, $opcionD, $respuestaCorrecta);

        if ($idRol==3){
            $this->renderer->render("newQuestionSuccess");
        } else{
            $this->sessionManager->set('newQuestion', true);
            header("Location: /question");
            exit();
        }
    }
}