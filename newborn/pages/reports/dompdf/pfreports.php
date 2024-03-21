<?php
$version = explode(".", phpversion());
ini_set('display_errors', 'off');
session_start();
if ($version[0] == "5") {
    // 5.4 and above   
    require_once '../dompdf/dompdf0.8.3/autoload.inc.php';
} else {
    // 7.1 and above    
    require_once '../dompdf/dompdf7.1/autoload.inc.php';
}

include '../dompdf/alink.php';
$lguser = $_SESSION['username'];
$dept = $_SESSION['dept'];
$dateFrom = $_GET['dateFrom'];
$dateTo = $_GET['dateTo'];
$pf = $_GET['pf'];

$queryFthPf = $pdo->query("SELECT * FROM `nsauthdoctors` WHERE `empid` = '$pf' AND `station`='NEWBORNDOCTORS' ORDER BY `name`");
$fthpf = $queryFthPf->fetch(PDO::FETCH_ASSOC);
$pf_name = $fthpf['name'];

$sqlqry = $pdo->query("SELECT * FROM nsauth WHERE `station`='$dept' AND `name`= '$lguser'");
$fth = $sqlqry->fetch(PDO::FETCH_ASSOC);
$brch = $fth['Branch']; $nqry = $pdo->query("SELECT * FROM mainandbranches WHERE `branch_acroname`='$brch'");
$fthis = $nqry->fetch(PDO::FETCH_ASSOC);
$brchname = $fthis['branch_fname'];
$brchadd = $fthis['branch_address'];
$telno = $fthis['tel_no'];
$zcode = $fthis['zip_code'];

if($brch == "KMSCI"){$logo = "kmsci.png";}
if($brch == "AMSHI"){$logo = "antipas.png";}
if($brch == "MMSHI"){$logo = "mmshi.png";}
if($brch == "MMHI"){$logo = "mmhi.png";}
if($brch == "CMSHI"){$logo = "cmshi.png";}

$dompdf = new Dompdf\Dompdf();
    $html = "<!DOCTYPE html>
    <html>
        <head>
            <title>Readers Fee Report</title>
            <style>
                .kmscilogo{width: 80px; position: absolute;}
                .arlfont16bold{font-family: 'Times New Roman', Times, serif; font-weight:bold; font-size:16px; text-align:center;none;}
                .arlfont16{font-family: 'Times New Roman', Times, serif; font-size:16px; text-align:center;}
                .arlfont14{font-family: 'Times New Roman', Times, serif; font-size:14px; text-align:center;}
                .arlfont14bold{font-family: 'Courier New', Courier, monospace; font-size:14px; text-align:center; font-weight:bold;}
                .tableheader .arlfont12{font-family: 'Times New Roman', Times, serif;font-size: 12px;text-align: center;}
                .divider{border: 0.5px solid #000000;}
                .arlfont14, .arlfont16, .arlfont16bold {
                    word-wrap: break-word;
                }
            </style>
        </head>
        <body>
            <img src='".$logo."' alt='logo' class='kmscilogo'>            
                <table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                        <td>
                            <table width='100%' border='0' cellpadding='0' cellspacing='0'>
                                <tr>
                                    <td class='arlfont16bold'><b>$brchname</b></td>
                                </tr>
                                <tr>
                                    <td class='arlfont16'>$brchadd</td>
                                </tr>
                                <tr>
                                    <td class='arlfont16bold' style='height:30px; vertical-align:bottom'>PF READERS FEE REPORT</td>
                                </tr>
                                <tr>
                                    <td class='arlfont14'>$dateFrom to $dateTo</td>
                                </tr>
                                <tr>
                                    <td class='arlfont16bold' style='height:30px;'>$pf_name</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class='divider'></td>
                    </tr>
                    <tr>
                        <td style='padding-top: 10px; min-height: 200px;'>
                            <table width='100%' border='0' cellpadding='0' cellspacing='0'>
                                <thead>
                                    <tr>
                                        <td class='arlfont14' style='text-align:center; widtd:5%'> No. </td>
                                        <td class='arlfont14' style='text-align:center; widtd:20%'> PATIENT'S NAME </td>
                                        <td class='arlfont14' style='text-align:center; widtd:10%'> SEN</td>
                                        <td class='arlfont14' style='text-align:center; widtd:10%'> CASH </td>
                                        <td class='arlfont14' style='text-align:center; widtd:10%'> DATE </td>
                                        <td class='arlfont14' style='text-align:center; widtd:10%'> TEST </td>
                                        <td class='arlfont14' style='text-align:center; widtd:20%'> ACCTTITLE </td>
                                        <td class='arlfont14' style='text-align:center; widtd:10%'> GROSS </td>
                                        <td class='arlfont14' style='text-align:center; widtd:10%'> SHARE </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class='arlfont14' style='text-align:center; border-bottom:1px solid #000; height:20px; width:5%'></td>
                                        <td class='arlfont14' style='text-align:center; border-bottom:1px solid #000; height:20px; width:20%'></td>
                                        <td class='arlfont14' style='text-align:center; border-bottom:1px solid #000; height:20px; width:5%'></td>
                                        <td class='arlfont14' style='text-align:center; border-bottom:1px solid #000; height:20px; width:10%'></td>
                                        <td class='arlfont14' style='text-align:center; border-bottom:1px solid #000; height:20px; width:10%'></td>
                                        <td class='arlfont14' style='text-align:center; border-bottom:1px solid #000; height:20px; width:10%'></td>
                                        <td class='arlfont14' style='text-align:center; border-bottom:1px solid #000; height:20px; width:20%'></td>
                                        <td class='arlfont14bold' style='text-align:center; border-bottom:1px solid #000; height:20px; width:10%'></td>
                                        <td class='arlfont14bold' style='text-align:center; border-bottom:1px solid #000; height:20px; width:10%'></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan='2' class='arlfont14' style='text-align:left; height:20px; width:5%'> TOTAL: </td>
                                        <td class='arlfont14' style='text-align:center; height:20px;'></td>
                                        <td class='arlfont14' style='text-align:center; height:20px;'></td>
                                        <td class='arlfont14' style='text-align:center; height:20px;'></td>
                                        <td class='arlfont14' style='text-align:center; height:20px;'></td>
                                        <td class='arlfont14' style='text-align:center; height:20px;'></td>
                                        <td class='arlfont14bold' style='text-align:center; height:20px;'>900932</td>
                                        <td class='arlfont14bold' style='text-align:center; height:20px;'>900932</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style='padding-top:10px'></td>
                    </tr>
                    <tr>
                        <td class='divider'></td>
                    </tr>
                    <tr>
                        <td>
                            <table width='100%' border='0' cellpadding='0' cellspacing='0'>
                                <tr>
                                    <td style='border-bottom:none; width:2%; '></td>
                                    <td style='border:none'> PREPARED BY:</td>
                                    <td style='border-bottom:none; width:2%; '></td>
                                    <td style='border:none'> CHECKED BY:</td>
                                    <td style='border-bottom:none; width:2%; '></td>
                                    <td style='border:none'> NOTED BY:</td>
                                    <td style='border-bottom:none; width:2%; '></td>
                                </tr>
                                <tr>
                                    <td style='border-bottom:none; width:2%; padding-top:50px;'></td>
                                    <td style='border-bottom:1px solid #000000; text-align:center; padding-top:50px;'><span></span></td>
                                    <td style='border-bottom:none; width:2%; padding-top:50px;'></td>
                                    <td style='border-bottom:1px solid #000000; text-align:center; padding-top:50px;'><span></span></td>
                                    <td style='border-bottom:none; width:2%; padding-top:50px;'></td>
                                    <td style='border-bottom:1px solid #000000; text-align:center; padding-top:50px;'><span></span></td>
                                    <td style='border-bottom:none; width:2%; padding-top:50px;'></td>
                                </tr>
                                <tr>
                                    <td style='border-bottom:none; width:2%; '></td>
                                    <td style='border:none; text-align:center'> RADIOLOGY HEAD</td>
                                    <td style='border-bottom:none; width:2%; '></td>
                                    <td style='border:none; text-align:center'> ACCOUNTING IN-CHARGE</td>
                                    <td style='border-bottom:none; width:2%; '></td>
                                    <td style='border:none; text-align:center'> ADMINISTRATOR</td>
                                    <td style='border-bottom:none; width:2%; '></td>
                                </tr>
                            </table>
                        </td>
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
?>