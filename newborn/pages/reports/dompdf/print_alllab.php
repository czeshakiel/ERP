<?php
$version = explode(".", phpversion());
ini_set('display_errors', 'off');

if ($version[0] == "5") {
    // 5.4 and above   
    require_once '../dompdf/dompdf0.8.3/autoload.inc.php';
} else {
    // 7.1 and above    
    require_once '../dompdf/dompdf7.1/autoload.inc.php';
}

include '../dompdf/alink.php';
$caseno = $_GET['caseno'];
$refno = $_GET['refno'];
$dept = $_GET['dept'];
$lguser = $_GET['lginuser'];

$sqlqry = $pdo->query("SELECT * FROM nsauth WHERE `station`='$dept' AND `name`= '$lguser'");
$fth = $sqlqry->fetch(PDO::FETCH_ASSOC);
$brch = $fth['Branch']; $nqry = $pdo->query("SELECT * FROM mainandbranches WHERE `branch_acroname`='$brch'");
$fthis = $nqry->fetch(PDO::FETCH_ASSOC);
$brchname = $fthis['branch_fname'];
$brchadd = $fthis['branch_address'];
$telno = $fthis['tel_no'];
$zcode = $fthis['zip_code'];

if($brch == "KMSCI"){
    $logo = "kmsci.png";
}
if($brch == "AMSHI"){
    $logo = "antipas.jpg";
}
if($brch == "MMSHI"){
    $logo = "mmshi.jpg";
}
if($brch == "MMHI"){
    $logo = "mmhi.jpg";
}
if($brch == "CMSHI"){
    $logo = "cmshi.jpg";
}

$dompdf = new Dompdf\Dompdf();
    $html = "<!DOCTYPE html>
    <html>
        <head>
            <title>Fixed Asset Management System Depreciation</title>
            <style>
            .kmscilogo{width: 80px; position: absolute;}
            .arlfont16bold{font-family: 'Times New Roman', Times, serif; font-weight: bold;font-size: 16px; text-align: center;}
            .arlfont12{font-family: 'Times New Roman', Times, serif;font-size: 12px;text-align: center;}
            .tableheader .arlfont12{font-family: 'Times New Roman', Times, serif;font-size: 12px;text-align: center;}
            .divider{border: 1px solid #000000;}
            .tabledata{font-size:12px; text-align:center}
            .tfooter{font-family: 'Times New Roman', Times, serif;font-size:12px;text-align:center;font-wieght:bold}
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
                                    <td class='arlfont12'>$brchadd</td>
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