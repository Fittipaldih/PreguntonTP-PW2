<?php

use Dompdf\Dompdf;

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
        if (isset ($_POST['finit']) && isset($_POST['fend'])
            && !empty($_POST['finit']) && !empty($_POST['fend'])) {
            $finit = $_POST['finit'];
            $fend = $_POST['fend'];
            $datau = $this->getStatistics($finit, $fend);
        } else {
            $datau = $this->getStatistics(null, null);
        }

        $data = $datau;
        $data['userName'] = $this->sessionManager->get("userName");
        $this->renderer->render("playersList", $data);
    }

    public function totalGames()
    {
        $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
        $registrosPorPagina = 10;
        $offset = ($paginaActual - 1) * $registrosPorPagina;
        $registros = $this->adminModel->getAllGames($registrosPorPagina, $offset);
        $totalRegistros = $this->adminModel->getTotalGames();

        $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

        $data=[
            'registros' => $registros,
            'totalPaginas' => $totalPaginas,
            'paginaActual' => $paginaActual
        ];

        // Generar los datos para los enlaces de paginación
        for ($i = 1; $i <= $totalPaginas; $i++) {
            $data['paginas'][] = [
                'numero' => $i,
                'esActual' => $i == $paginaActual,
            ];
        }

        $data['userName'] = $this->sessionManager->get("userName");
        $data["totalGames"] = $this->adminModel->getTotalGames();
      // $data["allGames"] = $this->adminModel->getAllGames();
        $this->renderer->render("test", $data);
    }

    public function totalQuestions()
    {
        $data['userName'] = $this->sessionManager->get("userName");
        $data["totalQuestions"] = $this->adminModel->getTotalQuestions();
        $data["allQuestions"] = $this->adminModel->getAllQuestions();
        $this->renderer->render("questionsList", $data);
    }

    private function getStatistics($finit, $fend)
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

    /*
     * <?php
if ($num_total_rows > 0) {
    $page = false;

    //examino la pagina a mostrar y el inicio del registro a mostrar
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    }

    if (!$page) {
        $start = 0;
        $page = 1;
    } else {
        $start = ($page - 1) * NUM_ITEMS_BY_PAGE;
    }
    //calculo el total de paginas
    $total_pages = ceil($num_total_rows / NUM_ITEMS_BY_PAGE);

    //pongo el numero de registros total, el tamano de pagina y la pagina que se muestra
    echo '<h3>Numero de articulos: '.$num_total_rows.'</h3>';
    echo '<h3>En cada pagina se muestra '.NUM_ITEMS_BY_PAGE.' articulos ordenados por fecha en formato descendente.</h3>';
    echo '<h3>Mostrando la pagina '.$page.' de ' .$total_pages.' paginas.</h3>';

    $result = $connexion->query(
        'SELECT * FROM product p
        LEFT JOIN product_lang pl ON (pl.id_product = p.id_product AND pl.id_lang = 1)
        LEFT JOIN `image` i ON (i.id_product = p.id_product AND cover = 1)
        WHERE active = 1
        ORDER BY date_upd DESC LIMIT '.$start.', '.NUM_ITEMS_BY_PAGE
    );
    if ($result->num_rows > 0) {
        echo '<ul class="row items">';
        while ($row = $result->fetch_assoc()) {
            echo '<li class="col-lg-4">';
            echo '<div class="item">';
            echo '<h3>'.$row['name'].'</h3>';
            ...
            echo '</div>';
            echo '</li>';
        }
        echo '</ul>';
    }

    echo '<nav>';
    echo '<ul class="pagination">';

    if ($total_pages > 1) {
        if ($page != 1) {
            echo '<li class="page-item"><a class="page-link" href="index.php?page='.($page-1).'"><span aria-hidden="true">&laquo;</span></a></li>';
        }

        for ($i=1;$i<=$total_pages;$i++) {
            if ($page == $i) {
                echo '<li class="page-item active"><a class="page-link" href="#">'.$page.'</a></li>';
            } else {
                echo '<li class="page-item"><a class="page-link" href="index.php?page='.$i.'">'.$i.'</a></li>';
            }
        }

        if ($page != $total_pages) {
            echo '<li class="page-item"><a class="page-link" href="index.php?page='.($page+1).'"><span aria-hidden="true">&raquo;</span></a></li>';
        }
    }
    echo '</ul>';
    echo '</nav>';
}
?>*/

    public function generatePdf(): void
    {
        $html = '<html>
                <body>
                    <h1>Hello, World!</h1>
                    <p>This is a PDF generated from HTML.</p>
                </body>
            </html>';

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $dompdf->stream("report.pdf", ['Attachment' => 0]);
    }

}