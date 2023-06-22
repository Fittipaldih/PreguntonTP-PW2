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

    public function acceptedView()
    {
        $userName = $this->sessionManager->get("userName");
        $data = [
            'userName' => $userName,
            'showNewQuestionModal' => $this->sessionManager->get('newQuestion') ?? false,
            'questionsAccepted' => $this->questionModel->getAcceptedQuestions(),
            'edit' => true
        ];

        $this->sessionManager->delete('newQuestion');
        $this->renderer->render("question", $data);
    }

    public function reportedView()
    {
        $userName = $this->sessionManager->get("userName");
        $data = [
            'userName' => $userName,
            'questionsReported' => $this->questionModel->getRepportQuestions(),
            'repport' => true
        ];

        $this->renderer->render("question", $data);
    }

    public function suggestedView()
    {
        $userName = $this->sessionManager->get("userName");
        $data = [
            'userName' => $userName,
            'questionsSuggested' => $this->questionModel->getSuggestedQuestions(),
            'suggested' => true
        ];

        $this->renderer->render("question", $data);
    }

    private function redirectToQuestionPage($idEstado)
    {
        switch ($idEstado) {
            case 1:
                $location = "/question/suggested";
                break;
            case 2:
                $location = "/question";
                break;
            case 3:
                $location = "/question/reported";
                break;
            default:
                $location = "/question";
                break;
        }
        header("Location: " . $location);
        exit();
    }

    public function delete()
    {
        $id = $_GET["id"];
        $idEstado = $this->questionModel->searchQuestionById($id);
        $this->questionModel->declineQuestion($id);
        $this->redirectToQuestionPage($idEstado[0]["id_estado"]);
    }

    public function accept()
    {
        $id = $_GET["id"];
        $idEstado = $this->questionModel->searchQuestionById($id);
        $this->questionModel->setAcceptQuestion($id);
        $this->redirectToQuestionPage($idEstado[0]["id_estado"]);
    }
}
