<?php
include '../../meshes/alink.php';
ini_set("display_errors", "on");

$startDate = new DateTime(date("Y-m-d", strtotime("first day of January this year")));
$endDate = new DateTime(date("Y-m-d", strtotime("last day of December this year")));
$datefrom = $startDate->format("Y-m-d");
$dateto = $endDate->format("Y-m-d");

$queryNewbornScreening = $pdo->prepare("SELECT COUNT(po.productdesc) AS newborn_screening_count
    FROM admission a 
    JOIN productout po ON a.caseno = po.caseno 
    WHERE po.productdesc = 'NEWBORN SCREENING' 
    AND quantity != '0'  
    AND a.status != 'CANCELLED' 
    AND po.terminalname != 'CANCELLED' 
    AND po.terminalname = 'Testdone' 
    AND po.status != 'CANCELLED' 
    AND po.datearray BETWEEN :datefrom AND :dateto");
$queryNewbornScreening->bindParam(':datefrom', $datefrom, PDO::PARAM_STR);
$queryNewbornScreening->bindParam(':dateto', $dateto, PDO::PARAM_STR);
$queryNewbornScreening->execute();
$newbornScreeningCount = $queryNewbornScreening->fetch(PDO::FETCH_ASSOC)['newborn_screening_count'];

// Query for 'NEWBORN HEARING TEST'
$queryNewbornHearing = $pdo->prepare("SELECT COUNT(po.productdesc) AS newborn_hearing_count
    FROM admission a 
    JOIN productout po ON a.caseno = po.caseno 
    WHERE po.productdesc = 'NEWBORN HEARING TEST' 
    AND a.status != 'CANCELLED' 
    AND quantity != '0' 
    AND po.terminalname != 'CANCELLED' 
    AND po.terminalname = 'Testdone' 
    AND po.status != 'CANCELLED' 
    AND po.datearray BETWEEN :datefrom AND :dateto");
$queryNewbornHearing->bindParam(':datefrom', $datefrom, PDO::PARAM_STR);
$queryNewbornHearing->bindParam(':dateto', $dateto, PDO::PARAM_STR);
$queryNewbornHearing->execute();
$newbornHearingCount = $queryNewbornHearing->fetch(PDO::FETCH_ASSOC)['newborn_hearing_count'];

// Query for 'AUDIOMETRY'
$queryAudiometry = $pdo->prepare("SELECT COUNT(po.productdesc) AS newborn_audiometry_count
    FROM admission a 
    JOIN productout po ON a.caseno = po.caseno 
    WHERE po.productdesc = 'AUDIOMETRY' 
    AND a.status != 'CANCELLED' 
    AND po.terminalname != 'CANCELLED' 
    AND po.terminalname = 'Testdone' 
    AND po.status != 'CANCELLED' 
    AND po.datearray BETWEEN :datefrom AND :dateto");
$queryAudiometry->bindParam(':datefrom', $datefrom, PDO::PARAM_STR);
$queryAudiometry->bindParam(':dateto', $dateto, PDO::PARAM_STR);
$queryAudiometry->execute();
$newbornAudiometryCount = $queryAudiometry->fetch(PDO::FETCH_ASSOC)['newborn_audiometry_count'];

// Query for 'REPEAT NBS'
$queryRepeat = $pdo->prepare("SELECT COUNT(caseno) AS newborn_repeat_count 
    FROM `productout` 
    WHERE (productdesc LIKE '%newborn hearing%' OR productdesc LIKE '%newborn screening%') 
    AND trantype = 'repeat' 
    AND datearray BETWEEN :datefrom AND :dateto");
$queryRepeat->bindParam(':datefrom', $datefrom, PDO::PARAM_STR);
$queryRepeat->bindParam(':dateto', $dateto, PDO::PARAM_STR);
$queryRepeat->execute();
$newbornRepeatCount = $queryRepeat->fetch(PDO::FETCH_ASSOC)['newborn_repeat_count'];

if($queryNewbornScreening && $queryNewbornHearing && $queryAudiometry && $queryRepeat) {
    echo json_encode([
            'newborn_screening_count' => $newbornScreeningCount,
            'newborn_hearing_count' => $newbornHearingCount,
            'newborn_audiometry_count' => $newbornAudiometryCount,
            'newborn_repeat_count' => $newbornRepeatCount
        ]);
} else {
    echo json_encode(['error' => 'Query execution failed']);
}
?>