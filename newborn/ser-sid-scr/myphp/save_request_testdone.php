<?php
include("../../meshes/alink.php");
ini_set('display_errors', 'on');
$bb_radtech = $_POST['bb_radtech'];
$bb_seriesno = $_POST['bb_seriesno'];
$bb_patientidno = $_POST['bb_patientidno'];
$bb_caseno = $_POST['bb_caseno'];
$bb_refno = $_POST['bb_refno'];
$bb_description = $_POST['bb_description'];
$bb_refphysician = $_POST['bb_refphysician'];
$bb_clinicalservices = $_POST['bb_clinicalservices'];
$fname = $_POST['fname'];
$mdname = $_POST['mdname'];
$lsname = $_POST['lsname'];
$lguser = $_POST['lguser'];
$productcode = $_POST['productcode'];
$productdesc = $_POST['productdesc'];
$trantype = $_POST['trantype'];
$bb_reader = $_POST['bb_reader'];
$senior = $_POST['senior'];
$branch = "KMSCI";
$today = date("Ymd");
$todaytime = date("his");
$coder = $todaytime . "" . $today;
$localdate = date("M-d-Y");
$todayx = date("Y-m-d");
$todaytimex = date("H:i:s");
$approvalno = "KIT-" . "$bb_seriesno";
$approvalno2 = $lguser."-" . "$bb_seriesno";
$transaction = $bb_caseno." ".$fname." ".$mdname.". ".$lsname." (".$productdesc.") set as Testdone by ".$lguser;
$patient_name = $lsname.", ".$fname." ".$mdname;

// for stocktable query 
$queryStock = $pdo->query("SELECT rrno, `code`, `description`, `unitcost`, SUM(quantity) AS ttl_qty FROM stocktable WHERE `description` LIKE '%EXPANDED NEWBORN%' AND `dept` ='NEW BORN SCREENING' GROUP BY rrno HAVING ttl_qty != 0 ORDER BY datearray DESC");
$foundItems = false;
while ($rFth = $queryStock->fetch(PDO::FETCH_ASSOC)) {
    $stck_rrno = $rFth['rrno'];
    $stck_code = $rFth['code'];
    $stck_desc = $rFth['description'];
    $stck_cost = $rFth['unitcost'];
    $ttl_qty = $rFth['ttl_qty'];

    if ($ttl_qty > 0) { 
        $foundItems = true;
    }
}

if (empty($bb_reader)) {
    $readersId = "";
    $readersName = "";
} else {
    $queryReaderName = $pdo->query("SELECT `name`, `empid` FROM `nsauthdoctors` WHERE `station`= 'NEWBORNDOCTORS' AND `empid` = '$bb_reader'");
    $rdfth = $queryReaderName->fetch(PDO::FETCH_ASSOC);
    $readersId = $bb_reader;
    $readersName = $rdfth['name'];
}
$executeUpdateProd = false;
$executeUpdateProd2 = false;

// auto dispensing
if ($productdesc != 'AUDIOMETRY' && $productdesc != 'NEWBORN HEARING TEST' && !$foundItems) {
    echo "noitem";
}elseif($productdesc == 'NEWBORN HEARING TEST'){
    $queryUpdateProd2 = $pdo->prepare("UPDATE productout SET referenceno=?, approvalno=?, terminalname='Testdone' WHERE refno=? AND caseno=?");
    $executeUpdateProd2 = $queryUpdateProd2->execute([$readersId, $approvalno2, $bb_refno, $bb_caseno]);
}else{
    $queryUpdateProd = $pdo->prepare("UPDATE productout SET referenceno=?, approvalno=?, terminalname='Testdone' WHERE refno=? AND caseno=?");
    $executeUpdateProd = $queryUpdateProd->execute([$readersId, $approvalno, $bb_refno, $bb_caseno]);
}

$readersExecuteStatus = false;
$ExecuteStatus = false;

if ($productdesc == 'AUDIOMETRY') {
    $querySelectProdMasList = $pdo->prepare("SELECT * FROM productsmasterlist WHERE code=?");
    $querySelectProdMasList->execute([$productcode]);
    $rpml = $querySelectProdMasList->fetch(PDO::FETCH_ASSOC);
    $opdprice = $rpml['opd'];
    if ($senior == "y" or $senior == "Y") {
        $opdprice1 = $opdprice * 0.20;
        $opdprice = $opdprice - $opdprice1;
    } else {
        $opdprice1 = 0;
        $opdprice = $opdprice - $opdprice1;
    }
    $amtSum1 = $opdprice * 0.25;
  
    if ($trantype == "cash") {
        $status1 = "PAID";
        $executeInsertProdCash = $pdo->query("INSERT INTO `productout`(`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`, `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`, `referenceno`, `administration`,`shift`, `location`, `senior`, `datearray`) 
        VALUES ('$coder','$todaytimex','$bb_caseno','$readersId','$readersName','$amtSum1','1','0','$amtSum1','NONE','0','0','$amtSum1','$localdate','$status1','$productcode','','$bb_refno','READERS FEE','PROFESSIONAL FEE','','$bb_refno','','$branch','','','$todayx')");
        if (!$executeInsertProdCash) {
            echo "Error in executeInsertProdCash: ";
            print_r($pdo->errorInfo());
        }else{
            $ExecuteStatus = true;
        }
    }

    if ($trantype == "charge") {
        $status1 = "Approved";
        $executeInsertProdCharge = $pdo->query("INSERT INTO `productout`(`refno`, `invno`, `caseno`, `productcode`, `productdesc`, `sellingprice`, `quantity`, `adjustment`, `gross`, `trantype`, `phic`, `hmo`, `excess`, `date`, `status`, `terminalname`, `loginuser`, `batchno`, `producttype`, `productsubtype`, `approvalno`, `referenceno`, `administration`,`shift`, `location`, `senior`, `datearray`) 
        VALUES ('$coder','$todaytimex','$bb_caseno','$readersId','$readersName','$amtSum1','1','0','$amtSum1','NONE','0','$amtSum1','0','$localdate','$status1','$productcode','','$bb_refno','READERS FEE','PROFESSIONAL FEE','','$bb_refno','','$branch','','','$todayx')");
        if (!$executeInsertProdCharge) {
            echo "Error in executeInsertProdCharge: ";
            print_r($pdo->errorInfo());
        }else{
            $ExecuteStatus = true;
        }
    }

    $executeInsertReadersfee = $pdo->query("INSERT INTO `readersfee`(`caseno`, `refno`, `productcode`, `doctor`, `doctorsid`, `date`, `refno1`, `amount`, `gross`, `producttype`, `productsubtype`) 
    VALUES ('$bb_caseno','$coder','$productcode','$readersName','$readersId','$todayx','$bb_refno','$amtSum1','$opdprice','$senior','PROFESSIONAL FEE')");
    if (!$executeInsertReadersfee) {
        echo "Error in executeInsertReadersfee: ";
        print_r($pdo->errorInfo());
    }else{
        $readersExecuteStatus = true;
    }  
}

if ($productdesc == 'AUDIOMETRY'  && $executeUpdateProd && $ExecuteStatus && $readersExecuteStatus) {
    $pdo->query("INSERT INTO userlogs (`transaction`,`loginuser`,`datearray`,`timearray`) VALUES ('$transaction','$lguser','$todayx','$todaytimex')");
    echo "success: audiometry";
} elseif ($executeUpdateProd) {
    $queryStock = $pdo->query("INSERT INTO `stocktable` (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`, `timearray`) 
    VALUES ('$localdate','$stck_rrno','','','$bb_caseno','$patient_name','$stck_code','$stck_desc','$stck_cost','-1','0','','1','0000-00-00','','dispensed','NONE','$localdate','NEW BORN SCREENING','0','NONE','','$lguser','','u','$todaytimex','$todayx','$todaytimex')");
    $pdo->query("INSERT INTO userlogs (`transaction`,`loginuser`,`datearray`,`timearray`) VALUES ('$transaction','$lguser','$todayx','$todaytimex')");
    echo "success: screening";
}elseif($executeUpdateProd2){
    $pdo->query("INSERT INTO userlogs (`transaction`,`loginuser`,`datearray`,`timearray`) VALUES ('$transaction','$lguser','$todayx','$todaytimex')");
    echo "success: hearing";
} else {
    echo "failed";
}
?>