<?php

//Inicia o buffer de saída para capturar qualquer conteúdo
ob_start();
require_once('C:\xampp\htdocs\ProjetoPDF_BeatrizJosé/fpdf/fpdf.php');

class NOVOPDF extends FPDF {
    function Header(){
        $this->Image('logo.png',5,1,50);
        $this->Ln(30);
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(80);
        $this->Cell(30, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', 'Título'), 1, 0, 'C');
        $this->Ln(20);
    }

    function Footer(){
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo().'/{nb}' ,0, 0, 'C');
    }
}

$pdf = new NOVOPDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Times', '', 12);

for($i = 1; $i <= 80; $i++) {
    $pdf->Cell(0, 10, 'Teste de Linha ' . $i, 0, 1);
}

$pdf->Output('Relatorio_ID.pdf', 'I'); 

echo "Beatriz Coimbra José";
?>