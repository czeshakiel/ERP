<?php
include '../main/class.php';
ini_set("display_errors", "off");
$version = explode(".", phpversion());

if($version[0]=="5"){require_once '../resultform/dompdf5.4/autoload.inc.php'; } //5.4 and above  
else{ require_once '../resultform/dompdf7.1/autoload.inc.php'; } //7.1 and above

$dompdf = new Dompdf\Dompdf();
$datef = $_POST['datef'];
$datet = $_POST['datet'];
$datef2 = date("F d, Y", strtotime($datef));
$datet2 = date("F d, Y", strtotime($datet));
$readerid = $_POST['reader'];
if($readerid == "All"){
$pfName = "";
}else{
$queryPfDtls = $conn->query("SELECT * FROM nsauthdoctors WHERE empid = '$readerid'");
$row = $queryPfDtls->fetch_assoc();
$pfName = $row['name'];
}
// Define the HTML content
$html = '
<style>
.data-table{width:100%; cellpadding:0; cellspacing:0; border:1; margin-top:20px}
.footer { position: fixed; left: 0; bottom: 25%; width: 100%; }
</style>

<table width="100%"><tr>
<td width="10%"><img src="../resultform/kmsci.png" width="70" height="70"></td>
<td>
<table align="center"><tr>
<td style="text-align: center;"><b>'.$heading.'</b></td>
</tr><tr>
<td style="font-size: 13px; text-align: center;">'.$address.'</td>
</tr><tr>
<td style="font-size: 13px; text-align: center;">Tel. No.: '.$telno.'</td>
</tr></table>
</td>
<td width="10%">&nbsp;</td>
</tr></table>
<p align="right" style="font-size: 13px;">Date: <b>'.$datef2.' - '.$datet2.'</b></p>
<table align="center"><tr>
<td style="font-size: 15px; text-align: center;"><b>'.$pfName.'<b></td>
</tr></table>

';
if($readerid == "All"){
$html .= '
<table align="center" width="100%" border="1" style="border-collapse: collapse;">
<tr>
<td style="text-align: center; font-size: 11px; width: 30%;"><b> Reader</b></td>
<td style="text-align: center; font-size: 11px; width: 30%;"><b> Charge to</b></td>
<td style="text-align: center; font-size: 11px; width: 10%;"><b> Date</b></td>
<td style="text-align: center; font-size: 11px; width: 10%;"><b> Product Description</b></td>
<td style="text-align: center; font-size: 11px; width: 10%;"><b> Amount</b></td>
</tr>
';
$query = $conn->query("SELECT * FROM productout 
                          WHERE productdesc = 'AUDIOMETRY' 
                          AND terminalname = 'Testdone' 
                          AND (caseno NOT LIKE '%cancelled%' OR trantype NOT LIKE '%cancelled%') 
                          AND datearray BETWEEN '$datef' AND '$datet' 
                          ORDER BY datearray");

while ($fthis = $query->fetch_assoc()) {
    $refno = $fthis['refno'];
    $caseno = $fthis['caseno'];
    $desc = $fthis['productdesc'];
    $referenceno = $fthis['referenceno'];
    $datearray = $fthis['datearray'];
    $queryReader = $conn->query("SELECT * FROM nsauthdoctors WHERE empid = '$referenceno'");
    $rws = $queryReader->fetch_assoc();
    $readername = $rws['name'];
    $queryPt = $conn->query("SELECT p.lastname, p.firstname, p.middlename FROM patientprofile p 
                        JOIN admission a ON a.patientidno = p.patientidno 
                        WHERE a.caseno = '$caseno'");
        $rwsi = $queryPt->fetch_assoc();
        if ($rwsi) {
          $patientname = $rwsi['firstname'] . " ";
          if (!empty($rwsi['middlename'])) {
              $patientname .= substr($rwsi['middlename'], 0, 1) . ". ";
          }
          $patientname .= $rwsi['lastname'];
      } else {
      }

    //   $queryAmount = $conn->query("SELECT * FROM readersfee WHERE caseno = '$caseno'");
    //   if($queryAmount -> num_rows > 0){
    //     $fchamt = $queryAmount->fetch_assoc();
    //     $amnt = $fchamt['amount'];
    //   }else{
        $amnt = 0;
    //   }
      $ttlamnt += $amnt;
     

$html .= '
<tr>
<td style="text-align: center; font-size: 11px;">'.$readername.'</td>
<td style="text-align: center; font-size: 11px;">'.$patientname.'</td>
<td style="text-align: center; font-size: 11px;">'.$datearray.'</td>
<td style="font-size: 11px; text-align:center">'.$desc.'</td>
<td style="text-align: center; font-size: 11px;">'.$amnt.'</td>
</tr>
';
}

$html .= '</table><br>';
$ovrttl = number_format($ttlamnt, 2);
$html .=  '
<table width="40%" align="right">
<tr>
<td style="font-size: 13px;">Total</td>
<td style="font-size: 13px; border-bottom: 1px solid black;">'.$ovrttl.'</td>
</tr>
</table>';
}else{
  $html .= '
<table align="center" width="100%" border="1" style="border-collapse: collapse;">
<tr>
<td style="text-align: center; font-size: 11px; width: 40%;"><b> Charge to</b></td>
<td style="text-align: center; font-size: 11px; width: 10%;"><b> Date</b></td>
<td style="text-align: center; font-size: 11px; width: 30%;"><b> Product Description</b></td>
<td style="text-align: center; font-size: 11px; width: 10%;"><b> Amount</b></td>
</tr>
';
$queryi = $conn->query("SELECT * FROM productout 
                          WHERE productdesc = 'AUDIOMETRY' 
                          AND terminalname = 'Testdone'
                          AND referenceno = '$readerid'
                          AND (caseno NOT LIKE '%cancelled%' OR trantype NOT LIKE '%cancelled%') 
                          AND datearray BETWEEN '$datef' AND '$datet' 
                          ORDER BY datearray");
while ($fthi = $queryi->fetch_assoc()) {
  $icaseno = $fthi['caseno'];
  $idesc = $fthi['productdesc'];
  $idatearray = $fthi['datearray'];
  $iqueryReader = $conn->query("SELECT * FROM nsauthdoctors WHERE empid = '$readerid'");
  $irws = $iqueryReader->fetch_assoc();
  $ireadername = $irws['name'];
  $iqueryPt = $conn->query("SELECT pt.lastname, pt.firstname, pt.middlename FROM patientprofile pt
                      JOIN admission ad ON ad.patientidno = pt.patientidno 
                      WHERE ad.caseno = '$icaseno'");
      $irws = $iqueryPt->fetch_assoc();
      if ($irws) {
        $ipatientname = $irws['firstname'] . " ";
        if (!empty($irws['middlename'])) {
            $ipatientname .= substr($irws['middlename'], 0, 1) . ". ";
        }
        $ipatientname .= $irws['lastname'];
    } else {
        $ipatientname = "";
    }

    // $iqueryAmount = $pdo->query("SELECT * FROM readersfee WHERE caseno = '$icaseno'");
    // if($iqueryAmount -> num_rows() > 0){
    //   $ifchamt = $iqueryAmount->fetch_assoc();
    //   $iamnt = $ifchamt['amount'];
    // }else{
      $iamnt = 0;
    // }
    $ittlamnt += $iamnt;
$html .= '
<tr>
<td style="text-align: center; font-size: 11px;">'.$ipatientname.'</td>
<td style="text-align: center; font-size: 11px;">'.$idatearray.'</td>
<td style="font-size: 11px; text-align:center"> '.$idesc.'</td>
<td style="text-align: center; font-size: 11px;">'.$iamnt.'</td>
</tr>';
}

$html .= '</table><br>';
$ittlamnt = number_format($ittlamnt, 2);
$html .=  '
<table width="40%" align="right">
<tr>
<td style="font-size: 13px;">Total</td>
<td style="font-size: 13px; border-bottom: 1px solid black;">'.$ittlamnt.'</td>
</tr>
</table>';
}

$html .= '

<br><br>

</table>
<table class="data-table">
<tr>
    <td style="font-size: 11px"><b>Prepared by: </b></td>
    <td style="font-size: 11px"><b></b></td>
    <td style="font-size: 11px"><b>Checked by: </b></td>
    <td style="font-size: 11px"><b></b></td>
    <td style="font-size: 11px"><b>Approved by: </b></td>
</tr>
<tr>
    <td style="padding-top:30px; width:30%"></td>
    <td style="padding-top:30px; width:5%"></td>
    <td style="padding-top:30px; width:30%"></td>
    <td style="padding-top:30px; width:5%"></td>
    <td style="padding-top:30px; width:30%"></td>
</tr>
<tr>
    <td style="font-size: 12px; text-align:center"><b>'.$user.'</b></td>
    <td></td>
    <td style="font-size: 12px; text-align:center"></td>
    <td></td>
    <td style="font-size: 12px; text-align:center"></td>
</tr>
<tr>
    <td style="border-bottom:1px solid #000000"></td>
    <td></td>
    <td style="border-bottom:1px solid #000000"></td>
    <td></td>
    <td style="border-bottom:1px solid #000000"></td>
</tr>
<tr>
    <td style="font-size: 11px; text-align:center"><span>Audiometrecian</span></td>
    <td></td>
    <td style="font-size: 11px; text-align:center"><span>Accounting In-charge</span></td>
    <td></td>
    <td style="font-size: 11px; text-align:center"><span>Administrator</span></td>
</tr>
</table>';
// Load the HTML into the renderer
$dompdf->loadHtml($html);

// Set the paper size and orientation
$dompdf->setPaper('Letter', 'portrait');
//$dompdf->setPaper([0,0,612,1008], 'portrait');

// Render the PDF
$dompdf->render();

// Output the generated PDF to the browser
$dompdf->stream('Newborn PF.pdf', array('Attachment' => false));
?>