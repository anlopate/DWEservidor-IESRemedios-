<?php

    /* Creamos un objeto de la clase FPDF */

    // Carga el ficehro main de la librería FPDF
    require('fpdf/fpdf.php');

    // Instanciamos la en mayúsculas
    // Formato apaisado. El formato por defecto es 'P','mm','A4'.
    $pdf=new FPDF('L', 'mm', 'A4');

    // Añadimos página
    $pdf->AddPage();

    // Seleccionamos tipo de letra. Arial B:negrita tamaño 16.
    $pdf->SetFont('Arial', 'B', 16);

    // Insertamos una celda
    // Márgenes por defecto 10mm
    //-> Si el texto sobrepasa las dimensiones de la celda, la información se trunca
    //-> 40mm ancho, 10mm alto, texto para esa celda

    // iconv para caracteres en españo. Más usado que lmb_convert_encoding 
    $pdf->Cell(40, 10, iconv ('ISO-8859-1', 'UTF-8', '¡Esta página es horizontal!'));

    // Añadimos otra página
    $pdf->AddPage();
    // Seleccionamos tipo de letra
    $pdf->SetFont('Courier', 'B', 16);
    // Insertamos celda
    $pdf->Cell(40, 10, iconv('ISO-8859-1', 'UTF-8','¡Esta página es vertical!'));
    $pdf->Output();







?>