<?php
    require_once ('fpdf/fpdf.php');
     require('class/classPDFCliente.php');

    class classPDFCliente extends FPDF{

        function Header() {
           
            $this->Cell(0, 5, iconv('UTF-8','ISO-8859-1', 'Gesbank 1.0'), 0, 1, 'L');
            $this->Cell(0, 5, iconv('UTF-8','ISO-8859-1','Ana Lopez Atero'), 0, 1, 'C');
            $this->Cell(0, 5, iconv('UTF-8','ISO-8859-1','2DAW 23/24'), 0, 1, 'R');
            $this->Cell(0, 0, '', 'T', 1, 'L'); // Borde inferior
        }
    
        function Footer() {
           // 15 mm sobre el final de la página.
            $this->SetY(-15);
            $this->Cell(0, 10, iconv('UTF-8','ISO-8859-1','Pagina' . $this->PageNo()), 0, 0, 'C');
            $this->Cell(0, 0, '', 'T', 1, 'L'); // Borde superior
        }
    
        function titulo() {
           // título del informe
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(0, 10, iconv('UTF-8','ISO-8859-1','Informe: Listado de Clientes'), 0, 1, 'L');
            $this->Cell(0, 10, iconv('UTF-8','ISO-8859-1','Fecha: ' . date('d-m-Y H:i:s')), 0, 1, 'L');
        }
    
        function encabezado() {
            // Encabezado del listado
            $this->SetFont('Arial', 'B', 10);
            $this->SetFillColor(150, 200, 255); // Color de fondo sombreado
            $this->Cell(15, 10, iconv('UTF-8','ISO-8859-1','ID'), 1, 0, 'C', true);
            $this->Cell(70, 10, iconv('UTF-8','ISO-8859-1','Cliente'), 1, 0, 'C', true);
            $this->Cell(30, 10, iconv('UTF-8','ISO-8859-1','Telefono'), 1, 0, 'C', true);
            // $this->Cell(30, 10, 'Ciudad', 1, 0, 'C', true);
            $this->Cell(30, 10, iconv('UTF-8','ISO-8859-1','DNI'), 1, 0, 'C', true);
            $this->Cell(50, 10, iconv('UTF-8','ISO-8859-1','Email'), 1, 1, 'C', true);
        }
   

    }

?>