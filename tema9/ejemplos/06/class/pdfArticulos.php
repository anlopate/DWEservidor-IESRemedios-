<?php

class PdfArticulos extends FPDF {

    public function Header(){

        // logo 
        $this->image('marvin.png', 10,5,20);
        $this->setFont('Arial', 'B', 10);
        // Subraya la cabecera
        $this->Cell(0,16,'Marvin','B',1,'R');
        // Margen con respecto a la cabecera.
        $this->ln(5);

    }

    public function Footer (){
        $this->setY(-10);
        $this->SetFont('Arial','B',10);
        // {nb} muestra el numero de pag con ese formato.
        $this->Cell(0,10, ' Page ' . $this->PageNo() . '/{nb}', 'T', 0, 'C');
    }

    public function Titulo (){
        $this->SetFillColor(240);
        $this->Cell(0,10, iconv('UTF-8', 'ISO-8859-1', 'Listado Artículos'), 0,0, 'C', true);
        $this->ln(20);

    }

    public function Cabecera(){
        $this->SetFont('Courier','',10);
        $this->SetFillColor(240);
        // La suma de todas las anchuras debe ser 190 para que ocupe todo el espacio.
        $this->Cell(10, 7, iconv('UTF-8', 'ISO-8859-1', 'id'),'B',0,'R', true);
        $this->Cell(50, 7, iconv('UTF-8', 'ISO-8859-1', 'Descripción'),'B',0,'L', true);
        $this->Cell(30, 7, iconv('UTF-8', 'ISO-8859-1', 'Fabricante'),'B',0,'L', true);
        $this->Cell(30, 7, iconv('UTF-8', 'ISO-8859-1', 'Categoría'),'B',0,'L', true);
        $this->Cell(40, 7, iconv('UTF-8', 'ISO-8859-1', 'Etiquetas'),'B',0,'L', true);
        $this->Cell(30, 7, iconv('UTF-8', 'ISO-8859-1', 'Precio'),'B',1,'R', true);
    }

   

}

?>