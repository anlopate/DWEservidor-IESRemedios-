<?php


    class classPDFCuenta extends FPDF{

        function Header() {
           
            $this->Cell(0, 5, iconv('UTF-8','ISO-8859-1','GESBANK 1.0'), 0, 1, 'L');
            $this->Cell(0, 5, iconv('UTF-8','ISO-8859-1','Ana Lopez Atero'), 0, 1, 'C');
            $this->Cell(0, 5, iconv('UTF-8','ISO-8859-1','2DAW 23/24'), 0, 1, 'R');
            $this->Cell(0, 0, '', 'T', 1, 'L'); // Borde inferior
        }
    
        function Footer() {
           // 15 mm sobre el final de la página.
            $this->SetY(-15);
            $this->Cell(0, 10, iconv('UTF-8','ISO-8859-1','Pagina ' . $this->PageNo()), 0, 0, 'C');
            $this->Cell(0, 0, '', 'T', 1, 'L'); // Borde superior
        }
    
        function titulo() {
           // título del informe
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(0, 10, iconv('UTF-8','ISO-8859-1','Informe: Listado de Cuenta'), 0, 1, 'L');
            $this->Cell(0, 10, iconv('UTF-8','ISO-8859-1','Fecha: ' . date('d-m-Y H:i:s')), 0, 1, 'L');
        }
    
        function encabezado() {
            // Encabezado del listado
            $this->SetFont('Arial', 'B', 10);
            $this->SetFillColor(150, 200, 255); // Color de fondo sombreado
            $this->Cell(60, 10, iconv('UTF-8','ISO-8859-1','Cliente'), 1, 0, 'C', true);
            $this->Cell(60, 10, iconv('UTF-8','ISO-8859-1','Num_cuenta'), 1, 0, 'C', true);
            $this->Cell(40, 10, iconv('UTF-8','ISO-8859-1','Fecha Alta'), 1, 0, 'C', true);
            $this->Cell(30, 10, iconv('UTF-8','ISO-8859-1','Saldo'), 1, 1, 'C', true);
            
        }
   

    }

?>