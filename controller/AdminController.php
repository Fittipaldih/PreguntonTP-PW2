<?php

class AdminController
{
    private $adminModel;
    private $renderer;
    private $sessionManager;

    public function __construct($model, $renderer, $session)
    {
        $this->adminModel = $model;
        $this->renderer = $renderer;
        $this->sessionManager = $session;
    }

    public function totalUser()
    {
        list($finit, $fend) = $this->getDatesFromPost();
        $datau = $this->getStatisticsForUsers($finit, $fend);
        $data = $datau;
        $data['userName'] = $this->sessionManager->get("userName");
        $tabla=$this->adminModel->getPrintPlayer($finit, $fend);
        if (isset($_GET["generarPDF"])) {
            $this->generarPDF($tabla);
        }
        $this->renderer->render("playersList", $data);
    }

    public function totalGames()
    {
        list($finit, $fend) = $this->getDatesFromPost();
        $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
        $registrosPorPagina = 12;
        $offset = ($paginaActual - 1) * $registrosPorPagina;
        $totalRegistros = $this->adminModel->getTotalGames($finit, $fend);
        $registros = $this->adminModel->getPartialGames($finit, $fend,$registrosPorPagina, $offset);
        $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

        $data=[
            'registros' => $registros,
            'totalPaginas' => $totalPaginas,
            'paginaActual' => $paginaActual
        ];
        $tabla=$this->adminModel->getAllGames($finit, $fend);

        // Generar los datos para los enlaces de paginación
        for ($i = 1; $i <= $totalPaginas; $i++) {
            $data['paginas'][] = [
                'numero' => $i,
                'esActual' => $i == $paginaActual,
            ];
        }


        $data['userName'] = $this->sessionManager->get("userName");
        $data["totalGames"] = $this->adminModel->getTotalGames($finit, $fend);
        if (isset($_GET["generarPDF"])) {
            $this->generarPDF($tabla);
        }
        return $this->renderer->render("test", $data);
    }

    public function totalQuestions()
    {
        list($finit, $fend) = $this->getDatesFromPost();

        $data['userName'] = $this->sessionManager->get("userName");
        $data["totalQuestions"] = $this->adminModel->getTotalQuestions($finit, $fend);
        $data["allQuestions"] = $this->adminModel->getAllQuestions($finit, $fend);
        $this->renderer->render("questionsList", $data);
    }

    private function getDatesFromPost()
    {
        $finit = isset($_POST['finit']) && !empty($_POST['finit']) ? $_POST['finit'] : null;
        $fend = isset($_POST['fend']) && !empty($_POST['fend']) ? $_POST['fend'] : null;
        return [$finit, $fend];
    }

    private function getStatisticsForUsers($finit, $fend)
    {
        $data = array(
            'usersByAge' => $this->adminModel->getTotalUsersByAge($finit, $fend),
            'usersByGenre' => $this->adminModel->getTotalUsersByGenre($finit, $fend),
            'usersFromCountry' => $this->adminModel->getTotalUsersFromCountry($finit, $fend),
            'usersNews' => $this->adminModel->getTotalUsersNews(),
            'allPlayers' => $this->adminModel->getAllPlayers($finit, $fend),
            'totalPlayers' => $this->adminModel->getTotalPlayers($finit, $fend)
        );
        if (empty($data['usersByAge']) && empty($data['usersByGenre']) && empty($data['usersFromCountry'])
            && empty($data['allPlayers']) && empty($data['totalPlayers'])) {
            $data['empty'] = true;
        }
        return $data;
    }

    public function generarPDF($data)
    {
        include "helpers/generate_pdf.php";
        // Aquí obtendrías los datos de la tabla que deseas mostrar en el PDF
        $pdf = new FPDF("L");
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Tabla en PDF', 0, 1, 'C');

        // Generar contenido de la tabla en el PDF
        $pdf->SetFont('Arial', '', 10);
        foreach ($data as $fila) {
            foreach ($fila as $valor) {
                $pdf->Cell(30, 10, $valor, 1, 0, 'C');
            }
            $pdf->Ln(); // Salto de línea después de cada fila
        }

        // Generar el archivo PDF
        $pdf->Output('tabla.pdf', 'D'); // Descargar el PDF con el nombre "tabla.pdf"
    }
}