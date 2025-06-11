<?php

//Inicia o buffer de saída para capturar qualquer conteúdo
ob_start();
require_once('C:\xampp\htdocs\ProjetoPDF_BeatrizJosé/fpdf/fpdf.php');

//Cria uma nova instancia da classe FPDF
$pdf = new FPDF('P', 'pt', 'A4');
//portrait
//unidade de medida
//tamanho do papel

//Adiciona uma nova página ao documento PDF
$pdf->AddPage();

//Função auxiliar para converter textos paea ISO-8859-1 (evita problemas com acentos)
function textPDF($txt)
{
    return iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $txt);
}

//Define a fonte: Arial, Negrito (B), tamanho 18
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(0, 5, textPDF('Relatório de Dados'), 0, 1, 'C');
$pdf->Cell(0,5,"", 'B', 1, 'C'); //1->Quebra de linha, C->ALinhamento
$pdf->Ln(20);   
//Pula vinte linhas

$dados = [
    ['Item A', 'Descrição 1',  'Categoria X', 10.50],
    ['Item B', 'Descrição 2',  'Categoria Y', 25.75],
    ['Item C', 'Descrição 3',  'Categoria X', 5.99],
    ['Item D', 'Descrição 4',  'Categoria Z', 100.00],
    ['Item E', 'Descrição 5',  'Categoria Y', 12.30],
    ['Item F', 'Descrição 6',  'Categoria X', 8.20],
    ['Item G', 'Descrição 7',  'Categoria Z', 55.00],
];

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(100,20, textPDF('Produto'), 1, 0, 'L');
$pdf->Cell(100,20, textPDF('Detalhes'), 1, 0, 'L');
$pdf->Cell(100,20, textPDF('Categoria'), 1, 0, 'L');
$pdf->Cell(100,20, textPDF('Valor'), 1, 0, 'R');

$pdf->SetFont('Arial', '', 12);
foreach ($dados as $linha) {
   // $pdf->Ln();
    $pdf->Cell(100, 20, textPDF($linha[0]), 1, 0, 'L');
    $pdf->Cell(100, 20, textPDF($linha[1]), 1, 0, 'L');
    $pdf->Cell(100, 20, textPDF($linha[2]), 1, 0, 'L');
    $pdf->Cell(100, 20, number_format($linha[3], 2, ',', '.'), 1, 1, 'R');
}

$pdf->Output('relatorio_produtos.pdf', 'I'); //I->Exibe o PDF no navegador

echo "Beatriz Coimbra José";
?>