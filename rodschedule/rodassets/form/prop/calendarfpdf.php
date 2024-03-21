<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('../fpdf.php');

class PDF extends FPDF
{
    private $month;
    private $year;

    function __construct($month, $year)
    {
        parent::__construct();
        $this->month = $month;
        $this->year = $year;
    }

    function Header()
    {   

        $this->SetFont('Helvetica','B',12);
        $this->cell(50,30, $this->Image('mmshi.png', 20, 10, 30), 0,0,'L');
        $this->Cell(180,10,'KIDAPAWAN MEDICAL SPECIALIST CENTER, INC.',0,0,'C');
        $this->Ln();
        $this->SetFont('Helvetica','B',8);
        $this->Cell(280,5,'BRGY. SUDAPIN, KIDAPAWAN CITY',0,0,'C');
        $this->Ln();
        $this->Cell(280,5,'TEL. NO.: (064)577-4553',0,0,'C');
        $this->Ln(10);
        $this->SetFont('Helvetica','B',12);
        $this->SetTextColor(255,103,0);
        $this->Cell(280,10,'LIST OF SCHEDULE IN MONTH OF FEBUARY 2023',0,0,'C');
       
    }

    function TBody()
    {   
        // Set the document properties and add a new page
        $cellWidth = 20;
        $cellHeight = 10;

        // Define the width and height of the page and the margin size
        $pageWidth = 210;
        $pageHeight = 297;
        $margin = 10;

        // Set the font size and family
        $this->SetFont('Helvetica', '', 10);

        // Loop through each day in the month and create a cell for it
        for ($i = 1; $i <= 31; $i++) {
            $date = strtotime($this->year . '-' . $this->month . '-' . $i);
            if (date('n', $date) !== $this->month) {
                // If the month doesn't match, it means we're on a day beyond the end of the month
                break;
            }

            $x = $margin + $cellWidth * ($i % 7);
            $y = $margin + $cellHeight * floor($i / 7);

            $this->Rect($x, $y, $cellWidth, $cellHeight, 'D');

            $this->Text($x + 2, $y + 5, $i);
        }
    }

    function Footer()
    {
         // Position at 1.5 cm from bottom
         $this->SetY(-15);
         $this->SetFont('Helvetica','',8);
         $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

// Instanciation of inherited class
$month = 2;
$year = 2023;
$pdf = new PDF($month, $year);
$pdf->SetTitle('ROD SCHEDULE');
$pdf->AliasNbPages();
$pdf->AddPage('L');
$pdf->TBody();
$pdf->Output('F', 'calendar_' . $month . '_' . $year . '.pdf');
?>
