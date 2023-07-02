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
        $tabla=$this->getStatisticsForPrint($finit, $fend);
        $this->adminModel->getPrintPlayer($finit, $fend);
        $this->renderer->render("playersList", $data);
    }

    public function totalGames()
    {
        list($finit, $fend) = $this->getDatesFromPost();
        $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
        $registrosPorPagina = 22;
        $offset = ($paginaActual - 1) * $registrosPorPagina;
        $totalRegistros = $this->adminModel->getTotalGames($finit, $fend);
        $registros = $this->adminModel->getPartialGames($finit, $fend,$registrosPorPagina, $offset);
        $totalPaginas = ceil($totalRegistros / $registrosPorPagina);
        $data=[
            'allGames' => $registros,
            'totalPaginas' => $totalPaginas,
            'paginaActual' => $paginaActual
        ];

        for ($i = 1; $i <= $totalPaginas; $i++) {
            $data['paginas'][] = [
                'numero' => $i,
                'esActual' => $i == $paginaActual,
            ];
        }
        $data["totalGames"] = $totalRegistros;
        return $this->renderer->render("gamesList", $data);
    }

    public function totalQuestions()
    {
        list($finit, $fend) = $this->getDatesFromPost();
        $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
        $registrosPorPagina = 22;
        $offset = ($paginaActual - 1) * $registrosPorPagina;
        $totalRegistros = $this->adminModel->getTotalQuestions($finit, $fend);
        $registros = $this->adminModel->getPartialQuestions($finit, $fend,$registrosPorPagina, $offset);
        $totalPaginas = ceil($totalRegistros / $registrosPorPagina);
        $data=[
            'allQuestions' => $registros,
            'totalPaginas' => $totalPaginas,
            'paginaActual' => $paginaActual
        ];

        for ($i = 1; $i <= $totalPaginas; $i++) {
            $data['paginas'][] = [
                'numero' => $i,
                'esActual' => $i == $paginaActual,
            ];
        }
        $data["totalQuestions"] = $totalRegistros;

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

    private function getStatisticsForPrint($finit, $fend)
    {
        $data = array(
            'usersByAge' => $this->adminModel->getTotalUsersByAge($finit, $fend),
            'usersByGenre' => $this->adminModel->getTotalUsersByGenre($finit, $fend),
            'usersFromCountry' => $this->adminModel->getTotalUsersFromCountry($finit, $fend),
            'usersNews' => $this->adminModel->getTotalUsersNews(),
            'allPlayers' => $this->adminModel->getAllPlayers($finit, $fend),
            'totalPlayers' => $this->adminModel->getTotalPlayers($finit, $fend)
        );
        return $data;
    }

    public function totalGamesPdf(){
        require('helpers/totalGames.php');
        $pdf = new PDF("P");
        $pdf->AddPage();
        $pdf->AliasNbPages(); //muestra la pagina / y total de paginas
        $tabla=$this->adminModel->getPrintAllGames();
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetDrawColor(163, 163, 163); //colorBorde
        // Generar contenido de la tabla en el PDF
        foreach ($tabla as $fila) {
            $pdf->Ln(); // Salto de línea después de cada fila
            $pdf->Cell(30, 10, ($fila["id"]), 1, 0, 'C', 0);
                $pdf->Cell(45, 10, ($fila["id_usuario"]), 1, 0, 'C', 0);
                $pdf->Cell(45, 10, ($fila["puntaje"]), 1, 0, 'C', 0);
                $pdf->Cell(70, 10, ($fila["fecha"]), 1, 0, 'C', 0);
            if ($pdf->GetY() > 250) {
                $pdf->AddPage();
            }
        }

        $pdf->Output('TotalGames.pdf', 'D'); // Descargar el PDF con el nombre "tabla.pdf"
    }

    public function totalQuestionsPdf(){
        require('helpers/totalQuestions.php');
        $pdf = new PDF("L");
        $pdf->AddPage();
        $pdf->AliasNbPages(); //muestra la pagina / y total de paginas
        $tabla=$this->adminModel->getPrintAllQuestions();
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetDrawColor(163, 163, 163); //colorBorde
        // Generar contenido de la tabla en el PDF
        foreach ($tabla as $fila) {
            $pdf->SetX( 10+100);
            $pdf->Cell(18, 20, utf8_decode($fila["opcionA"]), 1, 0, 'C', 0);
            $pdf->Cell(18, 20, utf8_decode($fila["opcionB"]), 1, 0, 'C', 0);
            $pdf->Cell(18, 20, utf8_decode($fila["opcionC"]), 1, 0, 'C', 0);
            $pdf->Cell(18, 20, utf8_decode($fila["opcionD"]), 1, 0, 'C', 0);
            $pdf->Cell(18, 20, utf8_decode($fila["resp_correcta"]), 1, 0, 'C', 0);
            $pdf->Cell(20, 20, utf8_decode($fila["fecha_creacion"]), 1, 0, 'C', 0);
            $pdf->Cell(20, 20, utf8_decode($fila["veces_mostrada"]), 1, 0, 'C', 0);
            $pdf->Cell(22, 20, utf8_decode($fila["veces_correcta"]), 1, 0, 'C', 0);
            $pdf->Cell(22, 20, utf8_decode($fila["porc_correc"]), 1, 0, 'C', 0);
            $pdf->SetX( 10);
            $descripcion = utf8_decode($fila["descripcion"]);
            $pdf->MultiCell(100,20,$descripcion, 1,'C', 0);
        }
        $pdf->Output('TotalQuestions.pdf', 'D');
    }

}