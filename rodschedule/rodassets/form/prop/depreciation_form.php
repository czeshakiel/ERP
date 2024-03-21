<?php
require('../fpdf.php');
$con = new PDO('mysql::host=http://192.168.8.101:100;dbname=kmsci','root','b0ykup4l');
$id=$_GET['id'];
$account=$_GET['account'];
$date_end=date('Y-m-d',strtotime($_GET['date']));

//echo $account."---->".$date_end;
  class PDF extends FPDF

{
// Page header
function Header()
{
    // Logo
    $this->Image('mmshi.png',20,10,22);
    // Arial bold 15
    $this->SetFont('Helvetica','B',12);
    // Title
    $this->Cell(0,10,'KIDAPAWAN MEDICAL SPECIALIST CENTER, INC.',0,0,'C');
    // Line break
    $this->Ln();
    $this->SetFont('Helvetica','',9);
    $this->Cell(0,0,'Brgy. Sudapin, Kidapawan City',0,0,'C');
    $this->Ln(5);
    $this->SetFont('Helvetica','',9);
    $this->Cell(0,0,'Tel. No.: (064)278-4553/288-1762',0,0,'C');
    $this->Ln(10);

}
function Thead($con)
{
    $account=$_GET['account'];
    $date_end=date('Y-m-d',strtotime($_GET['date']));
    $this->SetFont('Helvetica','B',12);
    $this->Cell(0,0,'EQUIPMENT ASSIGNMENT FORM',0,0,'C');$this->Ln(5);
    $this->Cell(0,0,'ASSET DEPRECIATION REPORT',0,0,'C');$this->Ln(2);
    $this->SetFont('Helvetica','B',9);
    $this->Cell(100,4,'Period Ending:',0,0,'R');
    $this->Cell(90,4,$account,0,0,'L');$this->Ln();
    $this->Cell(97,4,'Account Code:',0,0,'R');
    $this->Cell(95,4,$date_end,0,0,'L');$this->Ln(10);
    $this->SetFont('Helvetica','B',9);
    $this->Cell(190,1,'',1,0,'L',true);$this->Ln();
    $this->SetFillColor(976,245,458);
}
function Tbody($con)
{
    $this->SetFont('Helvetica','B',8);
    $this->Cell(25,5,'Asset ID',1,0,'C');
    $this->Cell(44,5,'Description',1,0,'C');
    $this->Cell(15,5,'In Service',1,0,'C');
    $this->Cell(10,5,'Life',1,0,'C');
    $this->Cell(21,5,'Cost',1,0,'C');
    $this->Cell(21,5,'Period Depre',1,0,'C');
    $this->Cell(21,5,'YTD Depr',1,0,'C');
    $this->Cell(22,5,'Accum. Depr',1,0,'C');
    $this->Cell(11,5,'Status',1,0,'C');$this->Ln();
    //
    $account=$_GET['account'];
    $date_end=date('Y-m-d',strtotime($_GET['date']));
    $count = 1;
    $total_cost=0;
    $total_monthly_depr=0;
    $total_year_depr=0;
    $total_accum_depr=0;
    $total_disposed=0;
    $sqli=$con->query("SELECT * FROM asset WHERE accountcode='$account' and datepurchased < '$date_end' ORDER BY code ASC");
    while ($rowdep=$sqli->fetch(PDO::FETCH_OBJ))
    {
      $code=$rowdep->code;
      $description=$rowdep->description;
      $amount=$rowdep->amount;
      $salvage=$rowdep->picid;
      $span=$rowdep->depreciation;
      $cost=$rowdep->amount;
      $status=$rowdep->statasset;
      $date_ac=date('Y-m-d',strtotime($rowdep->datepurchased));
      $datedisposed=date('Y-m-d',strtotime($rowdep->datedisposed));
      $asset_life_by_month= $span * 12;

      $asset_period_depr = $cost / $asset_life_by_month;

                $year_ac = date('Y', strtotime($date_ac));
                $month_ac = date('m', strtotime($date_ac));
                $day_ac = date('d', strtotime($date_ac));

            if($status == "Good Condition")
            {
               $year_end = date('Y', strtotime($date_end));
               $month_end = date('m', strtotime($date_end));
               $day_end = date('d', strtotime($date_end));
            }
            else
            {
              $year_end = date('Y', strtotime($datedisposed));
               $month_end = date('m', strtotime($datedisposed));
               $day_end = date('d', strtotime($datedisposed));

            }



                       $year_diff= $year_end - $year_ac;




                       $month_diff= $month_end - $month_ac;

               if($day_end > $day_ac)
               {
                $day_diff= $day_end - $day_ac;
               }
               else
              {
                $day_diff= (30 - $day_ac) + $day_end;
              }


                       $total_asset_age_month= ($year_diff * 12) + $month_diff;




              $moths_accum_depr = $month_diff * $asset_period_depr;


              if($day_diff > 0 )
              {
                  $days_accum_depr = $asset_period_depr;
              }
              else
              {
                  $days_accum_depr = 0;
              }




              if($total_asset_age_month >= 12)
              {
                $ytd_depr = $amount / $span;

              }
              else
              {

                  $ytd_depr = ($total_asset_age_month * $asset_period_depr) + $days_accum_depr;

              }


              $years_accum_depr = $year_diff * $ytd_depr;

              if($total_asset_age_month < $asset_life_by_month)
              {
                  if($total_asset_age_month >= 12)
                  {
                      $accum_depr = $years_accum_depr + $moths_accum_depr + $days_accum_depr;
                  }
                  else
                  {
                      $accum_depr = ($total_asset_age_month * $asset_period_depr) + $days_accum_depr;
                  }

              }

              else
                {

                 $accum_depr = $asset_life_by_month * $asset_period_depr ;

                }

      $this->SetFont('Helvetica','',8);
      $this->Cell(25,5,$code,1,0,'L');
      $this->SetFont('Helvetica','',8);
      $this->Cell(44,5,$description,1,0,'L');
      $this->Cell(15,5,date('m/d/y',strtotime($date_ac)),1,0,'C');
      $this->Cell(10,5,$span,1,0,'C');
      $cst=number_format($rowdep->amount,2); $total_cost = $total_cost + $row->amount;
      $this->Cell(21,5,$cst,1,0,'R');
      if($total_asset_age_month < $asset_life_by_month)
        {
                   $perdep=number_format($asset_period_depr,2);

                      $total_monthly_depr = $total_monthly_depr + $asset_period_depr;
        }
      else
      {
        $perdep = "0.00";
      }
      $this->Cell(21,5,$perdep,1,0,'R');
      if($total_asset_age_month < $asset_life_by_month)
        {

        $ytd= number_format($ytd_depr,2);

      $total_year_depr = $total_year_depr + $ytd_depr;
      }
      else
      {
        $ytd = "0.00";
      }
      $this->Cell(21,5,$ytd,1,0,'R');

      $accumdep = number_format($accum_depr,2) ;
      $total_accum_depr = $total_accum_depr + $accum_depr;

      $this->Cell(22,5,$accumdep,1,0,'R');
      if($total_asset_age_month > $asset_life_by_month )
        {
        $statdep = "F";
       }
       else if ($status == "Disposed")
       {
         $total_disposed = $amount - $accum_depr;
         $statdep = "D";
       }
      $this->Cell(11,5,$statdep,1,0,'C');$this->Ln();
    $count++;
  }
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-120);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->SetTitle('ASSET DEPRECIATION');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Thead($con);
$pdf->Tbody($con);
$pdf->SetFont('Arial','',12);
$pdf->Output();
//
?>
