<?php
$version = explode(".", phpversion());
ini_set('display_errors', 'off');
if ($version[0] == "5") { require_once '../dompdf/dompdf0.8.3/autoload.inc.php';} // 5.4 and above
else { require_once '../dompdf/dompdf7.1/autoload.inc.php'; } // 7.1 and above
include '../dompdf/alink.php';
$code = $_POST['repCode'];
$queryItemDesc = $pdo->query("SELECT `description` FROM receiving WHERE `code` = '$code'"); $fdesc = $queryItemDesc->fetch(PDO::FETCH_ASSOC);
$itemdesc = $fdesc['description'];
$datef = $_POST['repDateFrom'];
$datet = $_POST['repDateTo'];
$dateFrom = date('F d, Y', strtotime($datef));
$dateTo = date('F d, Y', strtotime($datet));
$dept = $_SESSION['dept'];
$lguser = $_SESSION['username'];
$sqlqry = $pdo->query("SELECT * FROM nsauth WHERE `station`='$dept' AND `name`= '$lguser'");
$fth = $sqlqry->fetch(PDO::FETCH_ASSOC);
$brch = $fth['Branch']; $nqry = $pdo->query("SELECT * FROM mainandbranches WHERE `branch_acroname`='$brch'");
$fthis = $nqry->fetch(PDO::FETCH_ASSOC);
$brchname = $fthis['branch_fname'];
$brchadd = $fthis['branch_address'];
$telno = $fthis['tel_no'];
$zcode = $fthis['zip_code'];
$queryHeading = $pdo->query("SELECT * FROM heading");
$res = $queryHeading->fetch(PDO::FETCH_ASSOC);
$heading = $res['heading'];
$address = $res['address'];
$queryRepeat = $pdo->query("SELECT * FROM `productout` WHERE productcode = '$code' AND terminalname='Testdone' AND trantype='repeat' AND datearray BETWEEN '$datef' AND '$datet' ORDER BY datearray ASC");
$dompdf = new Dompdf\Dompdf();
$html = "<!DOCTYPE html>
    <html>
        <head>
            <title>AUDIOMETRY REPORT $code</title>
            <style>
                .kmscilogo{ width: 60px; position:absolute;}
                .main-heading{ font-family: 'Times New Roman', Times, serif; font-size:16px; text-align:center;}
                .header-logos { text-align: center; padding: 5px}
                .arial14C{ font-family: 'Times New Roman', Times, serif; font-size:14px; text-align:center;}
                .arial12{ font-family: 'Times New Roman', Times, serif; font-size:12px;}
                .arial12C{ font-family: 'Times New Roman', Times, serif; font-size:12px; text-align:center;}
                .arial12pt{ font-family: 'Times New Roman', Times, serif; font-size:12px; padding-top:5px;}
                .divider{border-bottom:2px solid #000000; padding-top: 20px;}
                .pddtp20{padding-top:20px;}
                .data-table{width:100%; cellpadding:0; cellspacing:0; border:1; margin-top:20px}
            </style>
        </head>
        <body>
            <img src='logo/kmsci.png' alt='logo' class='kmscilogo'> 
            <table width='100%' border='0' cellpadding='0' cellspacing='0'>
                <tr>
                    <td class='main-heading'>
                        <span><b>$heading</b></span><br>
                        <span>$address</span>
                    </td>
                </tr>
                <tr><td style='padding-top:30px;'></td></tr>
                <tr>
                    <td class='arial14C'><b>NBS REPEAT REPORT</b></td>
                </tr>
                <tr>
                    <td class='arial12C'>$dateFrom to $dateTo</td>
                </tr>
            </table>
            <table width='100%' border='0' cellpadding='0' cellspacing='0'>
                <tr>
                    <td class='divider'></td>
                </tr>
                <tr>
                    <td class='arial12pt'>Code: <b>$code</b></td>
                </tr>
                <tr>
                    <td class='arial12'>Description: <b>$itemdesc</b></td>
                </tr>
            </table>
            <table width='100%' border='1' cellpadding='0' cellspacing='0' class='pddtp20'>
                <thead>
                    <tr>
                        <th class='arial12C' style='width: 5%'>#</th>
                        <th class='arial12C' style='width: 20%'>Caseno</th>
                        <th class='arial12C' style='width: 35%'>Patient Name</th>
                        <th class='arial12C' style='width: 20%'>Kit No</th>
                        <th class='arial12C' style='width: 15%'>Date</th>
                    </tr>
                </thead>
                <tbody>";
                $cnt = 0;
                if($queryRepeat->rowCount() > 0 ){
                    while($row = $queryRepeat->fetch(PDO::FETCH_ASSOC)){
                        $cnt++;
                        $caseno = $row['caseno'];
                        $kitno = $row['approvalno'];
                        $dtrray = $row['datearray'];
                        $queryadm = $pdo->query("SELECT p.firstname, p.lastname, p.middlename FROM patientprofile p INNER JOIN admission a ON a.patientidno = p.patientidno WHERE a.caseno = '$caseno'");
                        $fadm = $queryadm->fetch(PDO::FETCH_ASSOC);
                        $mname = substr($fadm['middlename'], 0, 1);
                        $patientname = $fadm['firstname']." ".$mname.". ".$fadm['lastname'];
                $html .="
                    <tr>
                        <td class='arial12C'>$cnt.</td>
                        <td class='arial12C'>$caseno</td>
                        <td class='arial12C'>$patientname</td>
                        <td class='arial12C'>$kitno</td>
                        <td class='arial12C'>$dtrray</td>
                    </tr>";
                    }
                }else{
                $html .="<tr><td colspan='5' class='arial12C'>No data available.</td></tr>";
                }
                $html.="
                </tbody>
            </table>
            <table class='data-table'>
            <tr>
                <td class='arial12'><b>Prepared by: </b></td>
                <td class='arial12'><b></b></td>
                <td class='arial12'><b>Checked by: </b></td>
                <td class='arial12'><b></b></td>
                <td class='arial12'><b>Approved by: </b></td>
            </tr>
            <tr>
                <td style='padding-top:30px; width:30%'></td>
                <td style='padding-top:30px; width:5%'></td>
                <td style='padding-top:30px; width:30%'></td>
                <td style='padding-top:30px; width:5%'></td>
                <td style='padding-top:30px; width:30%'></td>
            </tr>
            <tr>
                <td class='arial12C'><b>$lguser</b></td>
                <td></td>
                <td class='arial12'></td>
                <td></td>
                <td class='arial12'></td>
            </tr>
            <tr>
                <td style='border-bottom:1px solid #000000'></td>
                <td></td>
                <td style='border-bottom:1px solid #000000'></td>
                <td></td>
                <td style='border-bottom:1px solid #000000'></td>
            </tr>
            <tr>
                <td class='arial12C'><span>Nurse/Audiologist</span></td>
                <td></td>
                <td class='arial12C'><span>Accounting In-charge</span></td>
                <td></td>
                <td class='arial12C'><span>Administrator</span></td>
            </tr>
        </body>
    </html>";

// Load the HTML content into Dompdf
$dompdf->loadHtml($html);
// Set the paper size and orientation
$dompdf->setPaper('folio', 'portrait');
// Render the PDF
$dompdf->render();
// Output the PDF to the browser
$dompdf->stream('example.pdf', ['Attachment' => false]);