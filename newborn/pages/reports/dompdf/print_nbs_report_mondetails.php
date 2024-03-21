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
if($brch == "KMSCI"){$logo = "kmsci.png";}
if($brch == "AMSHI"){$logo = "antipas.png";}
if($brch == "MMSHI"){$logo = "mmshi.png";}
if($brch == "MMHI"){$logo = "mmhi.png";}
if($brch == "CMSHI"){$logo = "cmshi.png";}

$queryFstQuarts = $pdo->query("SELECT *FROM nbs_report_details WHERE CASE WHEN `month` = 'January' THEN 1 WHEN `month` = 'February' THEN 2 WHEN `month` = 'March' THEN 3 ELSE 0 END BETWEEN 1 AND 3 AND `year` = '$yr_slct'");
$querySndQuarts = $pdo->query("SELECT *FROM nbs_report_details WHERE CASE WHEN `month` = 'april' THEN 4 WHEN `month` = 'may' THEN 5 WHEN `month` = 'june' THEN 6 ELSE 0 END BETWEEN 4 AND 6 AND `year` = '$yr_slct'");
$queryThrdQuarts = $pdo->query("SELECT *FROM nbs_report_details WHERE CASE WHEN `month` = 'july' THEN 7 WHEN `month` = 'august' THEN 8 WHEN `month` = 'september' THEN 9 ELSE 0 END BETWEEN 7 AND 9 AND `year` = '$yr_slct'");
$queryFrthQuarts = $pdo->query("SELECT *FROM nbs_report_details WHERE CASE WHEN `month` = 'october' THEN 10 WHEN `month` = 'november' THEN 11 WHEN `month` = 'december' THEN 12 ELSE 0 END BETWEEN 10 AND 12 AND `year` = '$yr_slct'");
$dompdf = new Dompdf\Dompdf();
$html = "<!DOCTYPE html>
    <html>
        <head>
            <title>NBS REPORT $yr_slct</title>
            <style>
                .main-heading{ font-family: 'Times New Roman', Times, serif; font-size:16px; text-align:center; }
                .page { page-break-before: always; margin: 20px; } .kmscilogo{ width: 80px; position: absolute; } 
                .timesRom16boldHdrCntr{ font-family: 'Times New Roman', Times, serif; font-weight:bold; font-size:16px; text-align:center; padding-top: 20px;}
                .timesRom16HdrCntr{ font-family: 'Times New Roman', Times, serif; font-size:16px; text-align:center;}
                .timesRom16HdrLftPadt20{ font-family: 'Times New Roman', Times, serif; font-size:16px; text-align:left; padding-top: 20px}
                .timesRom16C{ font-family: 'Times New Roman', Times, serif; font-size:16px; text-align:center;}
                .timesRom16{ font-family: 'Times New Roman', Times, serif; font-size:16px;}
                .paddT20{ padding-top: 20px} .marL40{ margin-left:40px;}
                .signature img{ width:100px; height:40px; padding:0; border:none;}
            </style>
        </head>
        <body>
            <div class='first-page'>
                <img src='logo/".$logo."' alt='logo' class='kmscilogo'>            
                <table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                        <td>
                            <table width='100%' border='0' cellpadding='0' cellspacing='0'>
                                <tr>
                                    <td class='timesRom16boldHdrCntr'><b> $brchname</b></td>
                                </tr>
                                <tr>
                                    <td class='timesRom16HdrCntr'> $brchadd</td>
                                </tr>
                                <tr>
                                    <td class='timesRom16boldHdrCntr'> 1ND QUARTER CENSUS FOR $yr_slct</td>
                                </tr>
                                <tr>
                                    <td class='timesRom16boldHdrCntr'> Newborn Screening Center – Mindanao</td>
                                </tr>
                                <tr>
                                    <td class='timesRom16HdrLftPadt20'> ARE YOU BIRTHING FACILITY? &nbsp;<u>YES</u></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <table width='100%' border='1' cellpadding='0' cellspacing='0' class='paddT20'>
                            <thead>
                                <tr>
                                    <th class='timesRom16C' style='width:20%'> Month</th>
                                    <th class='timesRom16C' style='width:12%'> Total No. of <br> Deliveries</th>
                                    <th class='timesRom16C' style='width:12%'> Total No. of <br> Neonatal Deaths</th>
                                    <th class='timesRom16C' style='width:12%'> Total No. of <br> Live Births</th>
                                    <th class='timesRom16C' style='width:12%'> Total No. of <br> Inborn Screened</th>
                                    <th class='timesRom16C' style='width:12%'> Total No. of <br> Outborn Screened</th>
                                    <th class='timesRom16C' style='width:12%'> Total No. of <br> Refused Parents</th>
                                    <th class='timesRom16C' style='width:12%'> Total No. of <br> NBS</th>
                                </tr>
                            </thead>
                            <tbody>
                            ";
                            while ($quar1 = $queryFstQuarts->fetch(PDO::FETCH_ASSOC)){
                                $totalSum1 = $quar1['ttl_of_inbornscn'] + $quar1['ttl_of_outbornscn'];
                            $html.="
                                <tr>
                                    <td class='timesRom16C'>".strtoupper($quar1['month'])." ".$quar1['year']."</td>
                                    <td class='timesRom16C'>".$quar1['ttl_of_deliveries']."</td>
                                    <td class='timesRom16C'>".$quar1['ttl_of_neodths']."</td>
                                    <td class='timesRom16C'>".$quar1['ttl_of_livebirths']."</td>
                                    <td class='timesRom16C'>".$quar1['ttl_of_inbornscn']."</td>
                                    <td class='timesRom16C'>".$quar1['ttl_of_outbornscn']."</td>
                                    <td class='timesRom16C'>".$quar1['ttl_of_refusal']."</td>
                                    <td class='timesRom16C'>".$totalSum1."</td>
                                </tr>
                            ";
                            }
                            $html.="
                            </tbody>
                        </table>
                    </tr>
                </table>
                <table width='100%' border='0' cellpadding='0' cellspacing='0' class='paddT20'>
                    <tr>
                        <td class='timesRom16'>
                            <p>LEGEND: <br>
                                <span style='margin-left:60px;'>Birthing Facility - a health facility that is capable of newborn delivery. </span><br>
                                <span style='margin-left:60px;'>Live Births - total recorded number of live newborns born (at least 24 hours) in your hospital.</span><br>
                                <span style='margin-left:60px;'>Neonatal Deaths - total recorded number of expired newborns. </span><br>
                                <span style='margin-left:60px;'>Outborn NBS patient - total recorded number of babies screened but born outside of your hospital.</span><br>
                                <span style='margin-left:60px;'>Dissent - total recorded of babies not screened due to refusal of parents.</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class='timesRom16'>
                            <span>Hospital Code: <u>&nbsp;&nbsp; 464 &nbsp;&nbsp;</u></span>
                        </td>
                    </tr>
                    <tr>
                        <td class='timesRom16'>
                            <span>Hospital Name: (do not abbreviate) <u>Kidapawan Medical Specialist Center, Inc.</u></span>
                        </td>
                    </tr>
                </table>
                <table width='70%' border='0' cellpadding='0' cellspacing='0' class='paddT20 marL40'>
                    <tr>
                        <td class='signature'><img src='logo/signatureERR.png' alt='signature' style='margin-left:120px;'></td>
                    </tr>
                    <tr>
                        <td class='prepbyName'>Prepared by: <b><u>Eunice R. Rigonan, RN, MN<b>&nbsp;&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;&nbsp;Person in charge</u></td>
                    </tr>
                    <tr>
                        <td class='timesRom16C'>
                            <span>(Signature over printed name and designation/date)</span>
                        </td>
                    </tr>
                    <tr>
                        <td class='signature'><img src='logo/signatureMLi.png' alt='signature' style='margin-left:100px;'></td>
                    </tr>
                    <tr>
                        <td class='prepbyName'>Noted: <u><span style='margin-left:39px;'>Lily Y. Mudanza MD</span></u></td>
                    </tr>
                    <tr>
                        <td class='timesRom16'>
                            <span style='margin-left:85px;'>Newborn Screening Coordinator</span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class='page'>
                <img src='logo/$logo' alt='logo' class='kmscilogo'>            
                <table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                        <td>
                            <table width='100%' border='0' cellpadding='0' cellspacing='0'>
                                <tr>
                                    <td class='timesRom16boldHdrCntr'><b> $brchname</b></td>
                                </tr>
                                <tr>
                                    <td class='timesRom16HdrCntr'> $brchadd</td>
                                </tr>
                                <tr>
                                    <td class='timesRom16boldHdrCntr'> 2ND QUARTER CENSUS FOR $yr_slct</td>
                                </tr>
                                <tr>
                                    <td class='timesRom16boldHdrCntr'> Newborn Screening Center – Mindanao</td>
                                </tr>
                                <tr>
                                    <td class='timesRom16HdrLftPadt20'> ARE YOU BIRTHING FACILITY? &nbsp;<u>YES</u></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <table width='100%' border='1' cellpadding='0' cellspacing='0' class='paddT20'>
                            <thead>
                                <tr>
                                    <th class='timesRom16C' style='width:20%'> Month</th>
                                    <th class='timesRom16C' style='width:12%'> Total No. of <br> Deliveries</th>
                                    <th class='timesRom16C' style='width:12%'> Total No. of <br> Neonatal Deaths</th>
                                    <th class='timesRom16C' style='width:12%'> Total No. of <br> Live Births</th>
                                    <th class='timesRom16C' style='width:12%'> Total No. of <br> Inborn Screened</th>
                                    <th class='timesRom16C' style='width:12%'> Total No. of <br> Outborn Screened</th>
                                    <th class='timesRom16C' style='width:12%'> Total No. of <br> Refused Parents</th>
                                    <th class='timesRom16C' style='width:12%'> Total No. of <br> NBS</th>
                                </tr>
                            </thead>
                            <tbody>
                            ";
                            while ($quar2 = $querySndQuarts->fetch(PDO::FETCH_ASSOC)){
                                $totalSum2 = $quar2['ttl_of_inbornscn'] + $quar2['ttl_of_outbornscn'];
                            $html.="
                                <tr>
                                    <td class='timesRom16C'>".strtoupper($quar2['month'])." ".$quar2['year']."</td>
                                    <td class='timesRom16C'>".$quar2['ttl_of_deliveries']."</td>
                                    <td class='timesRom16C'>".$quar2['ttl_of_neodths']."</td>
                                    <td class='timesRom16C'>".$quar2['ttl_of_livebirths']."</td>
                                    <td class='timesRom16C'>".$quar2['ttl_of_inbornscn']."</td>
                                    <td class='timesRom16C'>".$quar2['ttl_of_outbornscn']."</td>
                                    <td class='timesRom16C'>".$quar2['ttl_of_refusal']."</td>
                                    <td class='timesRom16C'>".$totalSum2."</td>
                                </tr>
                            ";
                            }
                            $html.="
                            </tbody>
                        </table>
                    </tr>
                </table>
            <table width='100%' border='0' cellpadding='0' cellspacing='0' class='paddT20'>
                <tr>
                    <td class='timesRom16'>
                        <p>LEGEND: <br>
                            <span style='margin-left:60px;'>Birthing Facility - a health facility that is capable of newborn delivery. </span><br>
                            <span style='margin-left:60px;'>Live Births - total recorded number of live newborns born (at least 24 hours) in your hospital.</span><br>
                            <span style='margin-left:60px;'>Neonatal Deaths - total recorded number of expired newborns. </span><br>
                            <span style='margin-left:60px;'>Outborn NBS patient - total recorded number of babies screened but born outside of your hospital.</span><br>
                            <span style='margin-left:60px;'>Dissent - total recorded of babies not screened due to refusal of parents.</span>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class='timesRom16'>
                        <span>Hospital Code: <u>&nbsp;&nbsp; 464 &nbsp;&nbsp;</u></span>
                    </td>
                </tr>
                <tr>
                    <td class='timesRom16'>
                        <span>Hospital Name: (do not abbreviate) <u>Kidapawan Medical Specialist Center, Inc.</u></span>
                    </td>
                </tr>
            </table>
            <table width='70%' border='0' cellpadding='0' cellspacing='0' class='paddT20 marL40'>
                <tr>
                    <td class='signature'><img src='logo/signatureERR.png' alt='signature' style='margin-left:120px;'></td>
                </tr>
                <tr>
                    <td class='prepbyName'>Prepared by: <b><u>Eunice R. Rigonan, RN, MN<b>&nbsp;&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;&nbsp;Person in charge</u></td>
                </tr>
                <tr>
                    <td class='timesRom16C'>
                        <span>(Signature over printed name and designation/date)</span>
                    </td>
                </tr>
                <tr>
                    <td class='signature'><img src='logo/signatureMLi.png' alt='signature' style='margin-left:100px;'></td>
                </tr>
                <tr>
                    <td class='prepbyName'>Noted: <u><span style='margin-left:39px;'>Lily Y. Mudanza MD</span></u></td>
                </tr>
                <tr>
                    <td class='timesRom16'>
                        <span style='margin-left:85px;'>Newborn Screening Coordinator</span>
                    </td>
                </tr>
            </table>
            </div>
            <div class='page'>
                <img src='logo/$logo' alt='logo' class='kmscilogo'>            
                <table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                        <td>
                            <table width='100%' border='0' cellpadding='0' cellspacing='0'>
                                <tr>
                                    <td class='timesRom16boldHdrCntr'><b> $brchname</b></td>
                                </tr>
                                <tr>
                                    <td class='timesRom16HdrCntr'> $brchadd</td>
                                </tr>
                                <tr>
                                    <td class='timesRom16boldHdrCntr'> 3RD QUARTER CENSUS FOR $yr_slct</td>
                                </tr>
                                <tr>
                                    <td class='timesRom16boldHdrCntr'> Newborn Screening Center – Mindanao</td>
                                </tr>
                                <tr>
                                    <td class='timesRom16HdrLftPadt20'> ARE YOU BIRTHING FACILITY? &nbsp;<u>YES</u></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <table width='100%' border='1' cellpadding='0' cellspacing='0' class='paddT20'>
                            <thead>
                                <tr>
                                    <th class='timesRom16C' style='width:20%'> Month</th>
                                    <th class='timesRom16C' style='width:12%'> Total No. of <br> Deliveries</th>
                                    <th class='timesRom16C' style='width:12%'> Total No. of <br> Neonatal Deaths</th>
                                    <th class='timesRom16C' style='width:12%'> Total No. of <br> Live Births</th>
                                    <th class='timesRom16C' style='width:12%'> Total No. of <br> Inborn Screened</th>
                                    <th class='timesRom16C' style='width:12%'> Total No. of <br> Outborn Screened</th>
                                    <th class='timesRom16C' style='width:12%'> Total No. of <br> Refused Parents</th>
                                    <th class='timesRom16C' style='width:12%'> Total No. of <br> NBS</th>
                                </tr>
                            </thead>
                            <tbody>
                            ";
                            while ($quar3 = $queryThrdQuarts->fetch(PDO::FETCH_ASSOC)){
                                $totalSum3 = $quar3['ttl_of_inbornscn'] + $quar3['ttl_of_outbornscn'];
                            $html.="
                                <tr>
                                    <td class='timesRom16C'>".strtoupper($quar3['month'])." ".$quar3['year']."</td>
                                    <td class='timesRom16C'>".$quar3['ttl_of_deliveries']."</td>
                                    <td class='timesRom16C'>".$quar3['ttl_of_neodths']."</td>
                                    <td class='timesRom16C'>".$quar3['ttl_of_livebirths']."</td>
                                    <td class='timesRom16C'>".$quar3['ttl_of_inbornscn']."</td>
                                    <td class='timesRom16C'>".$quar3['ttl_of_outbornscn']."</td>
                                    <td class='timesRom16C'>".$quar3['ttl_of_refusal']."</td>
                                    <td class='timesRom16C'>".$totalSum3."</td>
                                </tr>
                            ";
                            }
                            $html.="
                            </tbody>
                        </table>
                    </tr>
                </table>
                <table width='100%' border='0' cellpadding='0' cellspacing='0' class='paddT20'>
                    <tr>
                        <td class='timesRom16'>
                            <p>LEGEND: <br>
                                <span style='margin-left:60px;'>Birthing Facility - a health facility that is capable of newborn delivery. </span><br>
                                <span style='margin-left:60px;'>Live Births - total recorded number of live newborns born (at least 24 hours) in your hospital.</span><br>
                                <span style='margin-left:60px;'>Neonatal Deaths - total recorded number of expired newborns. </span><br>
                                <span style='margin-left:60px;'>Outborn NBS patient - total recorded number of babies screened but born outside of your hospital.</span><br>
                                <span style='margin-left:60px;'>Dissent - total recorded of babies not screened due to refusal of parents.</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class='timesRom16'>
                            <span>Hospital Code: <u>&nbsp;&nbsp; 464 &nbsp;&nbsp;</u></span>
                        </td>
                    </tr>
                    <tr>
                        <td class='timesRom16'>
                            <span>Hospital Name: (do not abbreviate) <u>Kidapawan Medical Specialist Center, Inc.</u></span>
                        </td>
                    </tr>
                </table>
                <table width='70%' border='0' cellpadding='0' cellspacing='0' class='paddT20 marL40'>
                    <tr>
                        <td class='signature'><img src='logo/signatureERR.png' alt='signature' style='margin-left:120px;'></td>
                    </tr>
                    <tr>
                        <td class='prepbyName'>Prepared by: <b><u>Eunice R. Rigonan, RN, MN<b>&nbsp;&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;&nbsp;Person in charge</u></td>
                    </tr>
                    <tr>
                        <td class='timesRom16C'>
                            <span>(Signature over printed name and designation/date)</span>
                        </td>
                    </tr>
                    <tr>
                        <td class='signature'><img src='logo/signatureMLi.png' alt='signature' style='margin-left:100px;'></td>
                    </tr>
                    <tr>
                        <td class='prepbyName'>Noted: <u><span style='margin-left:39px;'>Lily Y. Mudanza MD</span></u></td>
                    </tr>
                    <tr>
                        <td class='timesRom16'>
                            <span style='margin-left:85px;'>Newborn Screening Coordinator</span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class='page'>
                <img src='logo/$logo' alt='logo' class='kmscilogo'>            
                <table width='100%' border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                        <td>
                            <table width='100%' border='0' cellpadding='0' cellspacing='0'>
                                <tr>
                                    <td class='timesRom16boldHdrCntr'><b> $brchname</b></td>
                                </tr>
                                <tr>
                                    <td class='timesRom16HdrCntr'> $brchadd</td>
                                </tr>
                                <tr>
                                    <td class='timesRom16boldHdrCntr'> 4TH QUARTER CENSUS FOR $yr_slct</td>
                                </tr>
                                <tr>
                                    <td class='timesRom16boldHdrCntr'> Newborn Screening Center – Mindanao</td>
                                </tr>
                                <tr>
                                    <td class='timesRom16HdrLftPadt20'> ARE YOU BIRTHING FACILITY? &nbsp;<u>YES</u></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <table width='100%' border='1' cellpadding='0' cellspacing='0' class='paddT20'>
                            <thead>
                                <tr>
                                    <th class='timesRom16C' style='width:20%'> Month</th>
                                    <th class='timesRom16C' style='width:12%'> Total No. of <br> Deliveries</th>
                                    <th class='timesRom16C' style='width:12%'> Total No. of <br> Neonatal Deaths</th>
                                    <th class='timesRom16C' style='width:12%'> Total No. of <br> Live Births</th>
                                    <th class='timesRom16C' style='width:12%'> Total No. of <br> Inborn Screened</th>
                                    <th class='timesRom16C' style='width:12%'> Total No. of <br> Outborn Screened</th>
                                    <th class='timesRom16C' style='width:12%'> Total No. of <br> Refused Parents</th>
                                    <th class='timesRom16C' style='width:12%'> Total No. of <br> NBS</th>
                                </tr>
                            </thead>
                            <tbody>
                            ";
                            while ($quar4 = $queryFrthQuarts->fetch(PDO::FETCH_ASSOC)){
                                $totalSum4 = $quar4['ttl_of_inbornscn'] + $quar4['ttl_of_outbornscn'];
                            $html.="
                                <tr>
                                    <td class='timesRom16C'>".strtoupper($quar4['month'])." ".$quar4['year']."</td>
                                    <td class='timesRom16C'>".$quar4['ttl_of_deliveries']."</td>
                                    <td class='timesRom16C'>".$quar4['ttl_of_neodths']."</td>
                                    <td class='timesRom16C'>".$quar4['ttl_of_livebirths']."</td>
                                    <td class='timesRom16C'>".$quar4['ttl_of_inbornscn']."</td>
                                    <td class='timesRom16C'>".$quar4['ttl_of_outbornscn']."</td>
                                    <td class='timesRom16C'>".$quar4['ttl_of_refusal']."</td>
                                    <td class='timesRom16C'>".$totalSum4."</td>
                                </tr>
                            ";
                            }
                            $html.="
                            </tbody>
                        </table>
                    </tr>
                </table>
                <table width='100%' border='0' cellpadding='0' cellspacing='0' class='paddT20'>
                    <tr>
                        <td class='timesRom16'>
                            <p>LEGEND: <br>
                                <span style='margin-left:60px;'>Birthing Facility - a health facility that is capable of newborn delivery. </span><br>
                                <span style='margin-left:60px;'>Live Births - total recorded number of live newborns born (at least 24 hours) in your hospital.</span><br>
                                <span style='margin-left:60px;'>Neonatal Deaths - total recorded number of expired newborns. </span><br>
                                <span style='margin-left:60px;'>Outborn NBS patient - total recorded number of babies screened but born outside of your hospital.</span><br>
                                <span style='margin-left:60px;'>Dissent - total recorded of babies not screened due to refusal of parents.</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class='timesRom16'>
                            <span>Hospital Code: <u>&nbsp;&nbsp; 464 &nbsp;&nbsp;</u></span>
                        </td>
                    </tr>
                    <tr>
                        <td class='timesRom16'>
                            <span>Hospital Name: (do not abbreviate) <u>Kidapawan Medical Specialist Center, Inc.</u></span>
                        </td>
                    </tr>
                </table>
                <table width='70%' border='0' cellpadding='0' cellspacing='0' class='paddT20 marL40'>
                    <tr>
                        <td class='signature'><img src='logo/signatureERR.png' alt='signature' style='margin-left:120px;'></td>
                    </tr>
                    <tr>
                        <td class='prepbyName'>Prepared by: <b><u>Eunice R. Rigonan, RN, MN<b>&nbsp;&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;&nbsp;Person in charge</u></td>
                    </tr>
                    <tr>
                        <td class='timesRom16C'>
                            <span>(Signature over printed name and designation/date)</span>
                        </td>
                    </tr>
                    <tr>
                        <td class='signature'><img src='logo/signatureMLi.png' alt='signature' style='margin-left:100px;'></td>
                    </tr>
                    <tr>
                        <td class='prepbyName'>Noted: <u><span style='margin-left:39px;'>Lily Y. Mudanza MD</span></u></td>
                    </tr>
                    <tr>
                        <td class='timesRom16'>
                            <span style='margin-left:85px;'>Newborn Screening Coordinator</span>
                        </td>
                    </tr>
                </table>
            </div>
        </body>
    </html>";

// Load the HTML content into Dompdf
$dompdf->loadHtml($html);
// Set the paper size and orientation
$dompdf->setPaper('letter', 'portrait');
// Render the PDF
$dompdf->render();
// Output the PDF to the browser
$dompdf->stream('example.pdf', ['Attachment' => false]);