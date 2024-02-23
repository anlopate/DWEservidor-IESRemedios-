<?php

    /* Creamos un objeto de la clase FPDF */

    // Carga el ficehro main de la librería FPDF
    require('fpdf/fpdf.php');

    // Instanciamos la en mayúsculas
    $pdf=new FPDF();

    /* Variables */

    $id = 1;
    $apellidos = 'Lopez Atero';
    $nombre = 'Ana'; 

    // Añadimos página
    $pdf->AddPage();

    // Seleccionamos tipo de letra. Arial B:negrita tamaño 16.
    $pdf->SetFont('Courier', 'B', 16);

   // Color de fondo con RGB
   $pdf->SetFillColor(240,120,10);

   // Documento
   $pdf->Cell(60, 10, iconv('UTF-8', 'ISO-8859-1','ID:'), 1, 0, 'R', true);
   $pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1',$id), 1, 1);
   $pdf->Cell(60, 10, iconv('UTF-8', 'ISO-8859-1','Nombre:'), 1, 0, 'R', true);
   $pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1',$nombre), 1, 1);
   $pdf->Cell(60, 10, iconv('UTF-8', 'ISO-8859-1','Apellidos:'), 1, 0, 'R', true);
   $pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1',$apellidos), 1);

   // D: descarga automática. Nombre del fichero.
$pdf->Output('D', 'informe.pdf', true);

?>