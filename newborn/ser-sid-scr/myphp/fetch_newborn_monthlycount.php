<?php
include '../../meshes/alink.php';
ini_set("display_errors", "on");

$ynow = date("Y");
$jan = "01"; $forJan = $ynow . "-" . $jan;
$feb = "02"; $forFeb = $ynow . "-" . $feb;
$mar = "03"; $forMar = $ynow . "-" . $mar;
$apr = "04"; $forApr = $ynow . "-" . $apr;
$may = "05"; $forMay = $ynow . "-" . $may;
$jun = "06"; $forJun = $ynow . "-" . $jun;
$jul = "07"; $forJul = $ynow . "-" . $jul;
$aug = "08"; $forAug = $ynow . "-" . $aug;
$sep = "09"; $forSep = $ynow . "-" . $sep;
$oct = "10"; $forOct = $ynow . "-" . $oct;
$nov = "11"; $forNov = $ynow . "-" . $nov;
$dec = "12"; $forDec = $ynow . "-" . $dec;

$queryJanIpd = $pdo->query("SELECT COUNT(caseno) AS janCount_Ipd FROM admission WHERE `status` != 'CANCELLED' AND `stat1` = 'New Born' AND dateadmit LIKE '%$forJan%' AND caseno LIKE '%I-%'");
$queryJanOpd = $pdo->query("SELECT COUNT(caseno) AS janCount_Opd FROM admission WHERE `status` != 'CANCELLED' AND `stat1` = 'New Born' AND dateadmit LIKE '%$forJan%' AND caseno LIKE '%O-%'");
$rJanIpd = $queryJanIpd->fetch(PDO::FETCH_ASSOC); $janIpdTotalCount = $rJanIpd['janCount_Ipd']; 
$rJanOpd = $queryJanOpd->fetch(PDO::FETCH_ASSOC); $janOpdTotalCount = $rJanOpd['janCount_Opd'];

$queryFebIpd = $pdo->query("SELECT COUNT(caseno) AS febCount_Ipd FROM admission WHERE `status` != 'CANCELLED' AND `stat1` = 'New Born' AND dateadmit LIKE '%$forFeb%' AND caseno LIKE '%I-%'");
$queryFebOpd = $pdo->query("SELECT COUNT(caseno) AS febCount_Opd FROM admission WHERE `status` != 'CANCELLED' AND `stat1` = 'New Born' AND dateadmit LIKE '%$forFeb%' AND caseno LIKE '%O-%'");
$rFebIpd = $queryFebIpd->fetch(PDO::FETCH_ASSOC); $febIpdTotalCount = $rFebIpd['febCount_Ipd']; 
$rFebOpd = $queryFebOpd->fetch(PDO::FETCH_ASSOC); $febOpdTotalCount = $rFebOpd['febCount_Opd'];

$queryMarIpd = $pdo->query("SELECT COUNT(caseno) AS marCount_Ipd FROM admission WHERE `status` != 'CANCELLED' AND `stat1` = 'New Born' AND dateadmit LIKE '%$forMar%' AND caseno LIKE '%I-%'");
$queryMarOpd = $pdo->query("SELECT COUNT(caseno) AS marCount_Opd FROM admission WHERE `status` != 'CANCELLED' AND `stat1` = 'New Born' AND dateadmit LIKE '%$forMar%' AND caseno LIKE '%O-%'");
$rMarIpd = $queryMarIpd->fetch(PDO::FETCH_ASSOC); $marIpdTotalCount = $rMarIpd['marCount_Ipd']; 
$rMarOpd = $queryMarOpd->fetch(PDO::FETCH_ASSOC); $marOpdTotalCount = $rMarOpd['marCount_Opd'];

$queryAprIpd = $pdo->query("SELECT COUNT(caseno) AS aprCount_Ipd FROM admission WHERE `status` != 'CANCELLED' AND `stat1` = 'New Born' AND dateadmit LIKE '%$forApr%' AND caseno LIKE '%I-%'");
$queryAprOpd = $pdo->query("SELECT COUNT(caseno) AS aprCount_Opd FROM admission WHERE `status` != 'CANCELLED' AND `stat1` = 'New Born' AND dateadmit LIKE '%$forApr%' AND caseno LIKE '%O-%'");
$rAprIpd = $queryAprIpd->fetch(PDO::FETCH_ASSOC); $aprIpdTotalCount = $rAprIpd['aprCount_Ipd']; 
$rAprOpd = $queryAprOpd->fetch(PDO::FETCH_ASSOC); $aprOpdTotalCount = $rAprOpd['aprCount_Opd'];

$queryMayIpd = $pdo->query("SELECT COUNT(caseno) AS mayCount_Ipd FROM admission WHERE `status` != 'CANCELLED' AND `stat1` = 'New Born' AND dateadmit LIKE '%$forMay%' AND caseno LIKE '%I-%'");
$queryMayOpd = $pdo->query("SELECT COUNT(caseno) AS mayCount_Opd FROM admission WHERE `status` != 'CANCELLED' AND `stat1` = 'New Born' AND dateadmit LIKE '%$forMay%' AND caseno LIKE '%O-%'");
$rMayIpd = $queryMayIpd->fetch(PDO::FETCH_ASSOC); $mayIpdTotalCount = $rMayIpd['mayCount_Ipd']; 
$rMayOpd = $queryMayOpd->fetch(PDO::FETCH_ASSOC); $mayOpdTotalCount = $rMayOpd['mayCount_Opd'];

$queryJunIpd = $pdo->query("SELECT COUNT(caseno) AS junCount_Ipd FROM admission WHERE `status` != 'CANCELLED' AND `stat1` = 'New Born' AND dateadmit LIKE '%$forJun%' AND caseno LIKE '%I-%'");
$queryJunOpd = $pdo->query("SELECT COUNT(caseno) AS junCount_Opd FROM admission WHERE `status` != 'CANCELLED' AND `stat1` = 'New Born' AND dateadmit LIKE '%$forJun%' AND caseno LIKE '%O-%'");
$rJunIpd = $queryJunIpd->fetch(PDO::FETCH_ASSOC); $junIpdTotalCount = $rJunIpd['junCount_Ipd']; 
$rJunOpd = $queryJunOpd->fetch(PDO::FETCH_ASSOC); $junOpdTotalCount = $rJunOpd['junCount_Opd'];

$queryJulIpd = $pdo->query("SELECT COUNT(caseno) AS julCount_Ipd FROM admission WHERE `status` != 'CANCELLED' AND `stat1` = 'New Born' AND dateadmit LIKE '%$forJul%' AND caseno LIKE '%I-%'");
$queryJulOpd = $pdo->query("SELECT COUNT(caseno) AS julCount_Opd FROM admission WHERE `status` != 'CANCELLED' AND `stat1` = 'New Born' AND dateadmit LIKE '%$forJul%' AND caseno LIKE '%O-%'");
$rJulIpd = $queryJulIpd->fetch(PDO::FETCH_ASSOC); $julIpdTotalCount = $rjulIpd['julCount_Ipd']; 
$rJulOpd = $queryJulOpd->fetch(PDO::FETCH_ASSOC); $julOpdTotalCount = $rjulOpd['julCount_Opd'];

$queryAugIpd = $pdo->query("SELECT COUNT(caseno) AS auhCount_Ipd FROM admission WHERE `status` != 'CANCELLED' AND `stat1` = 'New Born' AND dateadmit LIKE '%$forAug%' AND caseno LIKE '%I-%'");
$queryAugOpd = $pdo->query("SELECT COUNT(caseno) AS auhCount_Opd FROM admission WHERE `status` != 'CANCELLED' AND `stat1` = 'New Born' AND dateadmit LIKE '%$forAug%' AND caseno LIKE '%O-%'");
$rAugIpd = $queryAugIpd->fetch(PDO::FETCH_ASSOC); $augIpdTotalCount = $rAugIpd['augCount_Ipd']; 
$rAugOpd = $queryAugOpd->fetch(PDO::FETCH_ASSOC); $augOpdTotalCount = $rAugOpd['augCount_Opd'];

$querySepIpd = $pdo->query("SELECT COUNT(caseno) AS sepCount_Ipd FROM admission WHERE `status` != 'CANCELLED' AND `stat1` = 'New Born' AND dateadmit LIKE '%$forSep%' AND caseno LIKE '%I-%'");
$querySepOpd = $pdo->query("SELECT COUNT(caseno) AS sepCount_Opd FROM admission WHERE `status` != 'CANCELLED' AND `stat1` = 'New Born' AND dateadmit LIKE '%$forSep%' AND caseno LIKE '%O-%'");
$rSepIpd = $querySepIpd->fetch(PDO::FETCH_ASSOC); $sepIpdTotalCount = $rSepIpd['sepCount_Ipd']; 
$rSepOpd = $querySepOpd->fetch(PDO::FETCH_ASSOC); $sepOpdTotalCount = $rSepOpd['sepCount_Opd'];

$queryOctIpd = $pdo->query("SELECT COUNT(caseno) AS octCount_Ipd FROM admission WHERE `status` != 'CANCELLED' AND `stat1` = 'New Born' AND dateadmit LIKE '%$forOct%' AND caseno LIKE '%I-%'");
$queryOctOpd = $pdo->query("SELECT COUNT(caseno) AS octCount_Opd FROM admission WHERE `status` != 'CANCELLED' AND `stat1` = 'New Born' AND dateadmit LIKE '%$forOct%' AND caseno LIKE '%O-%'");
$rOctIpd = $queryOctIpd->fetch(PDO::FETCH_ASSOC); $octIpdTotalCount = $rOctIpd['octCount_Ipd']; 
$rOctOpd = $queryOctOpd->fetch(PDO::FETCH_ASSOC); $octOpdTotalCount = $rOctOpd['octCount_Opd'];

$queryNovIpd = $pdo->query("SELECT COUNT(caseno) AS novCount_Ipd FROM admission WHERE `status` != 'CANCELLED' AND `stat1` = 'New Born' AND dateadmit LIKE '%$forNov%' AND caseno LIKE '%I-%'");
$queryNovOpd = $pdo->query("SELECT COUNT(caseno) AS novCount_Opd FROM admission WHERE `status` != 'CANCELLED' AND `stat1` = 'New Born' AND dateadmit LIKE '%$forNov%' AND caseno LIKE '%O-%'");
$rNovIpd = $queryNovIpd->fetch(PDO::FETCH_ASSOC); $novIpdTotalCount = $rNovIpd['novCount_Ipd']; 
$rNovOpd = $queryNovOpd->fetch(PDO::FETCH_ASSOC); $novOpdTotalCount = $rNovOpd['novCount_Opd'];

$queryDecIpd = $pdo->query("SELECT COUNT(caseno) AS decCount_Ipd FROM admission WHERE `status` != 'CANCELLED' AND `stat1` = 'New Born' AND dateadmit LIKE '%$forDec%' AND caseno LIKE '%I-%'");
$queryDecOpd = $pdo->query("SELECT COUNT(caseno) AS decCount_Opd FROM admission WHERE `status` != 'CANCELLED' AND `stat1` = 'New Born' AND dateadmit LIKE '%$forDec%' AND caseno LIKE '%O-%'");
$rDecIpd = $queryDecIpd->fetch(PDO::FETCH_ASSOC); $decIpdTotalCount = $rDecIpd['decCount_Ipd']; 
$rDecOpd = $queryDecOpd->fetch(PDO::FETCH_ASSOC); $decOpdTotalCount = $rDecOpd['decCount_Opd'];

if ($queryJanIpd && $queryJanOpd) {
    echo json_encode([
        'janCountIpd' => $janIpdTotalCount, 'janCountOpd' => $janOpdTotalCount,
        'febCountIpd' => $febIpdTotalCount, 'febCountOpd' => $febOpdTotalCount,
        'marCountIpd' => $marIpdTotalCount, 'marCountOpd' => $marOpdTotalCount,
        'aprCountIpd' => $aprIpdTotalCount, 'aprCountOpd' => $aprOpdTotalCount,
        'mayCountIpd' => $mayIpdTotalCount, 'mayCountOpd' => $mayOpdTotalCount,
        'junCountIpd' => $junIpdTotalCount, 'junCountOpd' => $junOpdTotalCount,
        'julCountIpd' => $julIpdTotalCount, 'julCountOpd' => $julOpdTotalCount,
        'augCountIpd' => $augIpdTotalCount, 'augCountOpd' => $augOpdTotalCount,
        'sepCountIpd' => $sepIpdTotalCount, 'sepCountOpd' => $sepOpdTotalCount,
        'octCountIpd' => $octIpdTotalCount, 'octCountOpd' => $octOpdTotalCount,
        'novCountIpd' => $novIpdTotalCount, 'novCountOpd' => $novOpdTotalCount,
        'decCountIpd' => $decIpdTotalCount, 'decCountOpd' => $decOpdTotalCount
    ]);
} else {
    echo json_encode(['error' => 'Query execution failed']);
}

// $ynow = "2023";

// $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
// $counts = [];

// foreach ($months as $month) {
//     $monthNum = date('m', strtotime($month));
//     $forMonth = $ynow . "-" . str_pad($monthNum, 2, '0', STR_PAD_LEFT);

//     foreach (['Ipd', 'Opd'] as $type) {
//         $prefix = $type === 'Ipd' ? 'I-' : 'O-';
//         $query = $pdo->query("SELECT COUNT(caseno) AS {$month}Count_{$type} FROM admission WHERE `status` != 'CANCELLED' AND `stat1` = 'New Born' AND dateadmit LIKE '{$forMonth}%' AND caseno LIKE '%{$prefix}%'");
//         $result = $query->fetch(PDO::FETCH_ASSOC);
//         $counts["{$month}Count{$type}"] = $result["{$month}Count_{$type}"];
//     }
// }

// if (!empty($counts)) {
//     echo json_encode($counts);
// } else {
//     echo json_encode(['error' => 'Query execution failed']);
// }
?>
