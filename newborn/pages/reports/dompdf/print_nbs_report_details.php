<?php
session_start();
$version = explode(".", phpversion());
ini_set('display_errors', 'off');
if ($version[0] == "5") { require_once '../dompdf/dompdf0.8.3/autoload.inc.php';} // 5.4 and above
else { require_once '../dompdf/dompdf7.1/autoload.inc.php'; } // 7.1 and above
include '../dompdf/alink.php';
$yr_slct = $_GET['yr'];
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
$queryRDetails = $pdo->query("SELECT * FROM nbs_report_details WHERE `year` = '$yr_slct'");
$dompdf = new Dompdf\Dompdf();
$html = "<!DOCTYPE html>
    <html>
        <head>
            <title>NBS REPORT $yr_slct</title>
            <style>
                .kmscilogo{ width: 90px; height:auto; border:none; }
                .spmclogo{ width: 80px; height:auto; border:none; }
                .main-heading{ font-family: 'Times New Roman', Times, serif; font-size:16px; text-align:center; width:60%; }
                .tmsNewRom12C{ font-family: 'Times New Roman', Times, serif; font-size:14px; text-align:center; }
                .header-logos { text-align:center; padding:5px; width:20%;}
                .arialbold18{ font-family: Arial, Helvetica, sans-serif; font-size:18px; text-align:center; font-weight: bold; }
                .arialbold14{ font-family: Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;}
                .arialbold16{ font-family: Arial, Helvetica, sans-serif; font-size:16px; font-weight: bold; padding:5px;}
                .arialbold14C{ font-family: Arial, Helvetica, sans-serif; font-size:14px; text-align:center; font-weight:bold;}
                .arialbold14DC{ font-family: Arial, Helvetica, sans-serif; font-size:14px; text-align:center; font-weight:bold; width:14%; padding-top:10px;}
                .arialbold12R{ font-family: Arial, Helvetica, sans-serif; font-size:16px; text-align:right; font-weight:bold; }
                .arialbold12{ font-family: Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold;}
                .pddtp20{ padding-top: 20px; } .undrlne{ border-bottom: 1px solid #000000; padding-top: 30px}
                .rmrks{font-family: Arial, Helvetica, sans-serif; font-size:14px; font-weight: bold; padding:5px; width:50px;}
                .tblecenter{ margin: 0 auto; padding-top:20px;}
                .signature img{ width: 100px; height: 50px; border: none; position: absolute; left:295px; top: -29px; }
                .w-300{ width: 300px; padding: 0;}
                .w-200{ width: 100px; padding: 0;}
            </style>
        </head>
        <body>           
            <table width='100%' border='0' cellpadding='0' cellspacing='0'>
                <tr>
                    <td class='header-logos'>
                        <img src='logo/SPMC.png' alt='logo' class='spmclogo'> 
                    </td>
                    <td class='main-heading'>
                        <span><b> NEWBORN SCREENING CENTER - MINDANAO</b></span><br>
                        <span>SOUTHERN PHILIPPINES MEDICAL CENTER</span><br>
                        <span class='tmsNewRom12C'>J.P Laurel Avenue, Davao City, 8000 Philippines</span><br>
                        <span class='tmsNewRom12C'>Telephone: (082) 2264595/ (082) 2240337/ (082) 3053897</span><br>
                        <span class='tmsNewRom12C'>Telefax: (082) 227-4152</span><br>
                        <a href='' class='tmsNewRom12C'>nbsprogram@nscmindanao.ph</a>
                    </td>
                    <td class='header-logos'>
                        <img src='logo/kmsci.png' alt='logo' class='kmscilogo'>
                    </td>
                </tr>
                <tr><td colspan='3' style='padding-top:20px;'></td></tr>
                <tr>
                    <td colspan='3' class='arialbold18'>NBS CENSUS REPORT</td>
                </tr>
            </table>
            <table width='100%' border='0' cellpadding='0' cellspacing='0' class='pddtp20'>
                <tr class='arialbold14'>
                    <td><b>NAME OF FACILITY: <u>KIDAPAWAN MEDICAL SPECIALISTS CENTER, INC.</u></b></td>
                    <td><b>FACILITY CODE: <u>464</u></b></td>
                </tr>
            </table>
            <table width='100%' border='1' cellpadding='0' cellspacing='0' class='pddtp20'>
                <thead>
                    <tr>
                        <th class='arialbold14C' style='width:11%' >CALENDAR<br> YEAR: <br> $yr_slct</th>
                        <th class='arialbold14C' style='width:11%' >Total Count of Deliveries</th>
                        <th class='arialbold14C' style='width:11%' >Total Count of Livebirths</th>
                        <th class='arialbold14C' style='width:11%' >Total Count of Stillbirths</th>
                        <th class='arialbold14C' style='width:11%' >Total Count of Inborn Screened</th>
                        <th class='arialbold14C' style='width:11%' >Total Count of Outborn Screened</th>
                        <th class='arialbold14C' style='width:11%' >Total Count of Total Count of Babies Not Screened (Transferred to other Facility or Early Neonatal Death)</th>
                        <th class='arialbold14C' style='width:11%' >Total Count of Total Count of Babies Not Screened due to Refusal by Parents/ Gurdian</th>
                        <th class='arialbold14C' style='width:11%' >Reason for Refusals <small>(Please attach photocopy of refusal forms)</small></th>
                    </tr>
                </thead>
                <tbody>";
                    while($fth = $queryRDetails->fetch(PDO::FETCH_ASSOC)){
                        $delsum += $fth['ttl_of_deliveries'];
                        $livsum += $fth['ttl_of_livebirths'];
                        $inbsum += $fth['ttl_of_inbornscn'];
                        $onbsum += $fth['ttl_of_outbornscn'];
                        $refsum += $fth['ttl_of_refusal'];
                        $neosum += $fth['ttl_of_neodths'];
                        $stbsum += $fth['ttl_of_stillbirths'];
                        $trnsum += $fth['ttl_of_transferred'];
                $html .= "
                    <tr>
                        <td class='arialbold14DC'>".strtoupper($fth['month'])."</td>
                        <td class='arialbold14DC'>".$fth['ttl_of_deliveries']."</td>
                        <td class='arialbold14DC'>".$fth['ttl_of_livebirths']."</td>
                        <td class='arialbold14DC'>".$fth['ttl_of_stillbirths']."</td>
                        <td class='arialbold14DC'>".$fth['ttl_of_inbornscn']."</td>
                        <td class='arialbold14DC'>".$fth['ttl_of_outbornscn']."</td>
                        <td class='arialbold14DC'>".$fth['ttl_of_neodths']."</td>
                        <td class='arialbold14DC'>".$fth['ttl_of_refusal']."</td>
                        <td class='arialbold14DC'>".$fth['reason_for_refu']."</td>
                    </tr>";
                    }
                $html .= "
                    <tr>
                        <td class='arialbold14DC'>TOTAL</td>
                        <td class='arialbold14DC'>$delsum</td>
                        <td class='arialbold14DC'>$livsum</td>
                        <td class='arialbold14DC'>$stbsum</td>
                        <td class='arialbold14DC'>$inbsum</td>
                        <td class='arialbold14DC'>$onbsum</td>
                        <td class='arialbold14DC'>$neosum</td>
                        <td class='arialbold14DC'>$refsum</td>
                        <td class='arialbold14DC'></td>
                    </tr>
                </tbody>
            </table>
            <table width='98%' border='0' cellpadding='0' cellspacing='0' class='tblecenter'>
                <tr>
                    <td colspan='2' class='arialbold14'>*Inborn refers to the newborns delivered in the facility.</td>
                </tr>
                <tr>
                    <td colspan='2' class='arialbold14'>*Outborn refers to the newborns delivered at HOME or referred from other facility.</td>
                </tr>
                <tr>
                    <td class='rmrks'>REMARKS:</td>
                    <td class='undrlne'></td>
                </tr>
                <tr>
                    <td colspan='2' class='undrlne'> </td>
                </tr>
                <tr>
                    <td colspan='2' class='undrlne'> </td>
                </tr>
            </table>
            <table width='98%' border='0' cellpadding='0' cellspacing='0' class='tblecenter'>
                <tr><td style='padding-top:20px'></td></tr>
                <tr>
                    <td class='arialbold14' style='width:230px; position:relative; font-weight:bold'>
                        <div class='signature'><img src='logo/signatureERR.png' alt='signature'></div>
                        Prepared by: (Name and Signature): <u>EUNICE R. RIGONAN RN, MN</u>
                    </td>
                </tr>
                <tr>
                    <td class='arialbold14'> Contanct Number: <u> 09123819130</u></td>
                </tr>
                <tr>
                    <td style='padding-top:40px'></td>
                </tr>
                <tr>
                    <td class='arialbold14' style='text-align:justify;'><b>Please submit your report via email <a href=''>nbsdohro12@gmail.com</a> and <a href=''>nbsprogram@nscmindanao.php</a></b></td>
                </tr>
            </table>
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