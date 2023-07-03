<?php

require('third-party/fpdf/fpdf.php');

class PDF extends fpdf
{

    // Cabecera de página
    function Header()
    {
        $this->Image('third-party/fpdf/logo2.png', 110, 5, 80); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
        $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
        $this->Cell(45); // Movernos a la derecha
        $this->SetTextColor(0, 0, 0); //color
        $this->Ln(15); // Salto de línea

        /* TITULO DE LA TABLA */
        //color
        $this->SetTextColor(228, 100, 0);
        $this->Cell(50); // mover a la derecha
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(190, 10, utf8_decode("REPORTE DE PREGUNTAS "), 0, 1, 'C', 0);
        $this->Ln(4);

        /* CAMPOS DE LA TABLA */
        //color
        $this->SetFillColor(228, 100, 0); //colorFondo
        $this->SetTextColor(255, 255, 255); //colorTexto
        $this->SetDrawColor(163, 163, 163); //colorBorde
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(100, 10, utf8_decode('Pregunta'), 1, 0, 'C', 1);
        $this->Cell(18,10, utf8_decode('Opción A'), 1, 0, 'C', 1);
        $this->Cell(18, 10, utf8_decode('Opción B'), 1, 0, 'C', 1);
        $this->Cell(18, 10, utf8_decode('Opción C'), 1, 0, 'C', 1);
        $this->Cell(18, 10, utf8_decode('Opción D'), 1, 0, 'C', 1);
        $this->Cell(18,10, utf8_decode('Correcta'), 1, 0, 'C', 1);
        $this->Cell(20, 10, utf8_decode('Fecha'), 1, 0, 'C', 1);
        $this->Cell(20, 10, utf8_decode('Mostrada'), 1, 0, 'C', 1);
        $this->Cell(22, 10, utf8_decode('Acertada(cant)'), 1, 0, 'C', 1);
        $this->Cell(22, 10, utf8_decode('Acertada(%)'), 1, 0, 'C', 1);
        $this->Ln();
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15); // Posición: a 1,5 cm del final
        $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

        $this->SetY(-15); // Posición: a 1,5 cm del final
        $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
        $hoy = date('d/m/Y');
        $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
    }
}