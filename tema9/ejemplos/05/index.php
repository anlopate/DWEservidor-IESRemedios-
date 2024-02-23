<?php
    /* */


    #Cargamos clase fpdpf
    require('fpdf/fpdf.php');

    // require('class/pdfArticulos.php');

    $pdf = new FPDF();

    $pdf->SetFont('Times','',10);
    $pdf->AddPage();
    $pdf->Image('marvin.png', 10, 10, 100); 
    $pdf->Output();

?>