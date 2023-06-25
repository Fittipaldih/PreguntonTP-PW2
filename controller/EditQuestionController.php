<?php

class EditQuestionController
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
    public function home(){
        $idQuestion=$_POST["id"];
        $data['userName']= $this->sessionManager->get("userName");
        $data['edit'] = $this->sessionManager->get('edit');

        if ($idQuestion !== null){
            $data['question'] =  $this->questionModel->searchQuestionById($idQuestion);
        }
        $this->renderer->render("editQuestion", $data);
    }
    public function editQuestion()
    {
        $requiredParams = ['id', 'descripcion', 'id_categoria', 'opcionA', 'opcionB', 'opcionC', 'opcionD', 'resp_correcta'];

        foreach ($requiredParams as $param) {
            if (!isset($_POST[$param]) || empty($_POST[$param])) {
                echo "No se pudo editar, falta el parámetro: " . $param;
            }
        }
        $id = $_POST['id'];
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
                header("location: /question/suggestedView");
                exit();
            case 2:
                header("location: /question/acceptedView");
                exit();
            case 3:
                header("location: /question/reportedView");
                exit();
            default:
                header("location: /lobby");
                exit();
        }
    }
}