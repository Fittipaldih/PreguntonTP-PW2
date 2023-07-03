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
        $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
        $registrosPorPagina = 22;
        $offset = ($paginaActual - 1) * $registrosPorPagina;
        $totalRegistros = $data["totalPlayers"];
        $registros = $this->adminModel->getPartialPlayers($finit, $fend,$registrosPorPagina, $offset);
        $totalPaginas = ceil($totalRegistros / $registrosPorPagina);
        $data=[
            'allPlayers' => $registros,
            'totalPaginas' => $totalPaginas,
            'paginaActual' => $paginaActual,
            'totalPlayers' => $totalRegistros
        ];

        for ($i = 1; $i <= $totalPaginas; $i++) {
            $data['paginas'][] = [
                'numero' => $i,
                'esActual' => $i == $paginaActual,
            ];
        }
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

    public function playersGraph()
    {
        list($finit, $fend) = $this->getDatesFromPost();
        $data = $this->getStatisticsForUsers($finit, $fend);

        // Obtén los datos de género de los usuarios
        $dataGenero = $data['usersByGenre'];
        $dataCountry=$data['usersFromCountry'];
        $dataAge=$data['usersByAge'];
        $data["imagePathGenre"]= $this->graficoUserByGenre($dataGenero);
        $data["imagePathCountry"]=$this->graficoUserByCountry($dataCountry);
        $data["imagePathAge"]=$this->graficoUserByAge($dataAge);
        $tabla=$this->adminModel->getPrintTotalUsersByGenre();
        $this->renderer->render("graph", $data);
    }
    private function graficoUserByAge($dataAge)
    {
        require_once('third-party/jpgraph/src/jpgraph.php');
        require_once('third-party/jpgraph/src/jpgraph_pie.php');

        $graph = new PieGraph(350, 250);

        $graph->title->Set("Usuarios por Edad");
        $graph->SetBox(true);

        $values = array_column($dataAge, 'cantidad_usuarios');
        $labels = array_column($dataAge, 'grupo_edad');

        $p1 = new PiePlot($values);
        $p1->SetLegends($labels);
        $p1->ShowBorder();
        $p1->SetColor('black');
        $p1->SetSliceColors(array('#1E90FF', '#2E8B57', '#ADFF2F', '#DC143C', '#BA55D3'));

        $graph->Add($p1);

        $uniqueName = 'age_' . date('YmdHis') . '.png';
        $imagePath = 'public/imagenes/' . $uniqueName;

        $graph->Stroke($imagePath);
        if (!file_exists($imagePath)) {
            $graph->Stroke($imagePath);
        }

        return $imagePath;
    }
    private function graficoUserByCountry($dataCountry)
    {
        require_once('third-party/jpgraph/src/jpgraph.php');
        require_once('third-party/jpgraph/src/jpgraph_pie.php');

        $graph = new PieGraph(350, 250);

        $graph->title->Set("Usuarios por País");
        $graph->SetBox(true);

        $values = array_column($dataCountry, 'cantidadUsuarios');
        $labels = array_column($dataCountry, 'Pais');

        $p1 = new PiePlot($values);
        $p1->SetLegends($labels);
        $p1->ShowBorder();
        $p1->SetColor('black');
        $p1->SetSliceColors(array('#1E90FF', '#2E8B57', '#ADFF2F', '#DC143C', '#BA55D3'));

        $graph->Add($p1);

        $uniqueName = 'country_' . date('YmdHis') . '.png';
        $imagePath = 'public/imagenes/' . $uniqueName;

        $graph->Stroke($imagePath);
        if (!file_exists($imagePath)) {
            $graph->Stroke($imagePath);
        }

        return $imagePath;
    }
    private function graficoUserByGenre($dataGenero)
    {
        require_once('third-party/jpgraph/src/jpgraph.php');
        require_once('third-party/jpgraph/src/jpgraph_pie.php');

        $graph = new PieGraph(350, 250);

        $graph->title->Set("Usuarios por género");
        $graph->SetBox(true);

        $values = array_column($dataGenero, 'cantidad_usuarios');
        $labels = array_column($dataGenero, 'Genero');

        $p1 = new PiePlot($values);
        $p1->SetLegends($labels);
        $p1->ShowBorder();
        $p1->SetColor('black');
        $p1->SetSliceColors(array('#1E90FF', '#2E8B57', '#ADFF2F', '#DC143C', '#BA55D3'));

        $graph->Add($p1);

        $uniqueName = 'genre_' . date('YmdHis') . '.png';
        $imagePath = 'public/imagenes/' . $uniqueName;

        $graph->Stroke($imagePath);
        if (!file_exists($imagePath)) {
            $graph->Stroke($imagePath);
        }

        return $imagePath;
    }
    private function getDatesFromPost()
    {
        $finit = isset($_POST['finit']) && !empty($_POST['finit']) ? $_POST['finit'] : null;
        $fend = isset($_POST['fend']) && !empty($_POST['fend']) ? $_POST['fend'] : null;
        return [$finit, $fend];
    }
    private function getStatisticsForGraph()
    {
        $data = array(
            'usersByAge' => $this->adminModel->getTotalByAge(),
        );
        if (empty($data['usersByAge'])){
            $data['empty'] = true;
        }
        return $data;
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

    public function totalPlayersPdf(){
        require('helpers/TotalPlayers.php');
        $pdf = new PDF("L");
        $pdf->AddPage();
        $pdf->AliasNbPages(); //muestra la pagina / y total de paginas
        $tabla=$this->adminModel->getPrintAllPlayers();
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetDrawColor(163, 163, 163); //colorBorde
        // Generar contenido de la tabla en el PDF
        foreach ($tabla as $fila) {
            $pdf->Cell(20, 20, utf8_decode($fila["Id"]), 1, 0, 'C', 0);
            $pdf->Cell(50, 20, utf8_decode($fila["Nombre_usuario"]), 1, 0, 'C', 0);
            $pdf->Cell(70, 20, utf8_decode($fila["Mail"]), 1, 0, 'C', 0);
            $pdf->Cell(30, 20, utf8_decode($fila["Genero"]), 1, 0, 'C', 0);
            $pdf->Cell(35, 20, utf8_decode($fila["Fecha_nacimiento"]), 1, 0, 'C', 0);
            $pdf->Cell(35, 20, utf8_decode($fila["Fecha_registro"]), 1, 0, 'C', 0);
            $pdf->Cell(35, 20, utf8_decode($fila["cant_acertadas"]), 1, 0, 'C', 0);
            $pdf->Ln();
        }
        $pdf->Output('TotalPlayers.pdf', 'D');
    }

    public function playersGraphPdf(){
        require('helpers/graph.php');
        $pdf = new PDF("P");
        $pdf->AddPage();
        $pdf->AliasNbPages(); //muestra la pagina / y total de paginas
        $tabla=$this->adminModel->getPrintTotalUsersByGenre();

        $pdf->SetTextColor(228, 100, 0);
        $pdf->Cell(-24); // mover a la derecha
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Cell(100, 10, utf8_decode("Usuarios por género "), 0, 1, 'C', 0);
        $pdf->Ln(4);

        $pdf->SetFillColor(228, 100, 0); //colorFondo
        $pdf->SetTextColor(255, 255, 255); //colorTexto
        $pdf->SetDrawColor(163, 163, 163); //colorBorde
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(70, 10, utf8_decode('Género'), 1, 0, 'C', 1);
        $pdf->Cell(70,10, utf8_decode('Cantidad de Usuarios'), 1, 0, 'C', 1);
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetDrawColor(163, 163, 163); //colorBorde
        // Generar contenido de la tabla en el PDF
        foreach ($tabla as $fila) {
            $pdf->Cell(70, 20, utf8_decode($fila["Genero"]), 1, 0, 'C', 0);
            $pdf->Cell(70, 20, utf8_decode($fila["cantidad_usuarios"]), 1, 0, 'C', 0);
            $pdf->Ln();
        }
        $pdf->Output('GraphUsers.pdf', 'D');
    }
}