<?php
   #Cargamos clase fpdpf
   require('fpdf/fpdf.php');
   require('class/pdfArticulos.php');
   require('datos/articulos.php');

   # Creo objeto odf articulo
   $pdf = new PdfArticulos();
   // Muestra formato pagina 1 de 10, etc
   $pdf->AliasNbPages();
   $pdf->AddPage();
   $pdf->SetFont('Courier','',10);
   
   # Muestro el título documento.
    $pdf->Titulo();

   # Muestro cabecera del listado.
  $pdf->Cabecera();

  # Muestro los detalles de los artículos.
  foreach($articulos as $articulo){
    $pdf-> Cell(10, 7, iconv('UTF-8', 'ISO-8859-1', $articulo['id']),0,0,'R');
    $pdf-> Cell(50, 7, iconv('UTF-8', 'ISO-8859-1', $articulo['Descripción']),0,0,'L');
    $pdf-> Cell(30, 7, iconv('UTF-8', 'ISO-8859-1', $articulo['Fabricante']),0,0,'L');
    $pdf-> Cell(30, 7, iconv('UTF-8', 'ISO-8859-1', $articulo['Categoría']),0,0,'R');
    $pdf-> Cell(40, 7, iconv('UTF-8', 'ISO-8859-1', implode(', ', $articulo['Etiquetas'])),0,0,'L');
    $pdf-> Cell(30, 7, iconv('UTF-8', 'ISO-8859-1', $articulo['Precio']),0,1,'R');
  }

   $pdf->Output();
?>

