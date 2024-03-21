<?php 
// Set error reporting to show all errors
error_reporting(E_ALL);

// Display errors on the screen
ini_set('display_errors', 'off');

require('fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{   
    $m = $_GET['month'];
    $y = $_GET['year'];
    $monthName = strtoupper(date("F", strtotime("2023-$m-01")));
    $this->SetFont('Helvetica','B',12);
    $this->cell(50,30, $this->Image('prop/mmshi.png', 20, 10, 30), 0,0,'L');
    $this->Cell(180,10,'KIDAPAWAN MEDICAL SPECIALIST CENTER, INC.',0,0,'C');
    $this->Ln();
    $this->SetFont('Helvetica','B',8);
    $this->Cell(280,5,'BRGY. SUDAPIN, KIDAPAWAN CITY',0,0,'C');
    $this->Ln();
    $this->Cell(280,5,'TEL. NO.: (064)577-4553',0,0,'C');
    $this->Ln(10);
    $this->SetFont('Helvetica','B',12);
    $this->SetTextColor(255,103,0);
    $this->Cell(280,10,'ROD SCHEDULE FOR THE MONTH OF '.$monthName.' '.$y ,0,0,'C');
    $this->Ln(20);
   
}
    // Current column and row
    var $col = 0;
    var $row = 0;

    // Set the month and year
    var $month;
    var $year;

    // Get the number of days in the selected month and year
    var $num_days;

    // Get the first day of the month as a number (0-6) where 0 is Sunday
    var $first_day;
function CalendarTable() {
        $condb = new PDO('mysql::host=localhost;dbname=kmsci','root','');
        // Prepare and execute query to fetch appointments
        $stmt = $condb->prepare("SELECT id, lastname, firstname, station_id, station_name, start_datetime FROM doclogfile_rod");
        $stmt->execute();
        $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $m = $_GET['month'];
        $y = $_GET['year'];

        // Set the month and year
        $this->month = $m;
        $this->year = $y;

        $monthName = strtoupper(date("F", strtotime("2023-$m-01")));

        
        // Get the number of days in the selected month and year
        $this->num_days = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
        
        // Get the first day of the month as a number (0-6) where 0 is Sunday
        $this->first_day = date('w', mktime(0, 0, 0, $this->month, 1, $this->year));
        
        // Set the column width and row height
        $this->SetFont('Arial', '', 12);
        $this->SetFillColor(200);
        $this->SetTextColor(0);
        $this->SetDrawColor(0);
        $this->SetLineWidth(.3);
        $this->SetTopMargin(10);
        $this->SetLeftMargin(10);
        
        // Calculate cell dimensions
        $cellWidth = 36.5;
        $cellHeight = 20;
        $cellMargin = 2;
        
        // Draw the day labels
        $dayLabels = array('SUNDAY', 'MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY');
        $this->SetFont('Arial', 'B', 10); $this->SetTextColor(0, 0, 102); $lbsWidth = 33; $lbsHeight = 10; $dLabelX = 5; $dLabelY = 45;
        $this->SetXY($dLabelX, $dLabelY); $this->Cell($lbsWidth, $lbsHeight,$monthName.' '.$y, 1, 0, 'C');
        
        // Print the day labels horizontally
        $labelsWidth = 36.5;
        $labelsHeight = 10;

        // Set the font and color for the table labels
        $this->SetFont('Arial', 'B', 10);
        $this->SetTextColor(0, 0, 102);
        // Set the positions for the labels
        $dayLabelsX = 38;
        $dayLabelsY = 45;
        // Print the day labels horizontally
        $this->SetXY($dayLabelsX, $dayLabelsY);
        foreach ($dayLabels as $dayLabel) {
            $this->Cell($labelsWidth, $labelsHeight, $dayLabel, 1, 0, 'C');
        }


        // Draw the calendar table
        $this->SetXY(38, 55);
        for ($day = 1 - $this->first_day; $day <= $this->num_days; $day++) {
            // Calculate x and y position of cell
        
            $xPos = $this->GetX();
            $yPos = $this->GetY();
        
            // Draw the cell border
            $this->Cell($cellWidth, $cellHeight, '', 1, 0, '');
        
            // Draw the day number
            if ($day > 0) {
                $stations = array(); // an array to store the appointments for each station
                foreach ($appointments as $appointment) {
                    if ($appointment['start_datetime'] == date('Y-m-d', mktime(0, 0, 0, $this->month, $day, $this->year))) {
                        $station_id = $appointment['station_id'];
                        $firstname = $appointment['firstname'];
                        $lastname = $appointment['lastname']." ".$firstname[0].".";
                        if (!isset($stations[$station_id])) {
                            $stations[$station_id] = array(); // create an array for this station if it doesn't exist
                        }
                        $stations[$station_id][] = $lastname;
                    }
                }

                $this->SetXY($xPos, $yPos);
                $this->SetFont('Arial', '', 10);
                $this->SetTextColor(0,0,102);
                $this->Cell($cellWidth, $cellMargin + 5, $day, 0, 0, 'L');

                $this->SetFont('Arial', 'B', 8);
                $this->SetTextColor(0,0,102);

                // loop through the stations in order
                foreach ($stations as $station_id => $lastnames) {
                    $names_string = implode("/ ", $lastnames); // join names with a slash
                    $this->SetXY($xPos, $yPos + $cellMargin + 4 * ($station_id - 1)); // set Y position based on station_id
                    $this->MultiCell($cellWidth, $cellMargin + 1, $names_string, 0, 'C');
                }
            
                // Move to next cell
                $this->SetXY($xPos + $cellWidth + 50, $yPos);
                if (($day + $this->first_day) % 7 == 0) {
                    $this->Ln($cellHeight);
                    $this->SetX(38);
                }
            }
    
            // Move to next cell
            $this->SetXY($xPos + $cellWidth, $yPos);
            if (($day + $this->first_day) % 7 == 0) {
                $this->Ln($cellHeight);
                $this->SetX(38);
            } 
        }

        //separate column located at first column

        // Set the column width and row height
        $this->SetFont('Arial', '', 12);
        $this->SetFillColor(200);
        $this->SetTextColor(0);
        $this->SetDrawColor(0);
        $this->SetLineWidth(.3);
        $this->SetTopMargin(10);
        $this->SetLeftMargin(10);

        // Calculate cell dimensions
        $cellWidth = 33;
        $cellHeight = 20;
        $cellMargin = 2;

        // Define the data for the tables
        //$table1Data = array('Label a', 'Label b', 'Label c', 'Label d', 'Label e');
        // Define the position of the first table
        $table1X = 5;
        $table1Y = 55;

        $stations = array("ER","NS1/OR-DR/NS4","NS2/RDU/NS3","ICU/NS5/NS6");
        $this->SetFont('Arial', 'B', 8);
        $this->SetTextColor(0, 0, 102);
        // Set the positions for the two tables
        $num_rows = ceil(($this->num_days + $this->first_day) / 7);
        // Add data to Table 1
        $this->SetXY($table1X, $table1Y);
        for($i = 0; $i < $num_rows; $i++){
            $this->MultiCell(33, 5, implode("\n", $stations), 1, 'C');
            $this->SetX(10) + $cellWidth + $cellMargin; // Move to the next column
            if ($i != $num_rows - 1) {
                $this->SetX($table1X); // Reset the X position to the start of the column
            }
        }
        $this->Ln(5);
     }
        // Page footer
    function Footer()
    {
            $this->SetFont('Arial', 'B', 10);
            $this->SetTextColor(0, 0, 102);
            $this->Cell(95,15,'Prepared by:', 0, 0,'L');
            $this->Cell(95,15,'Noted by:', 0, 0,'L');
            $this->Cell(95,15,'Approved by:',0, 0,'L');
            $this->Ln(15);
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(95,5,'Prepare User Name',0, 0,'L');
            $this->Cell(95,5,'ELVIE C. EMBALSADO, MD',0, 0,'L');
            $this->Cell(95,5,'LILY MUDANZA, MD',0, 0,'L');
            $this->Ln();
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(95,5,'N/A',0, 0,'L');
            $this->Cell(95,5,'Head ROD',0, 0,'L');
            $this->Cell(95,5,'Medical Director',0, 0,'L');
       
    }
}


$pdf = new PDF();
$pdf->AddPage('L');
$pdf->CalendarTable();
$pdf->Output();
?>