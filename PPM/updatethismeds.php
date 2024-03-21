<?php
include 'prop/connect/link.php';
ini_set('display_errors','on');
$change = "";
$code = $_POST['code'];
$approff = $_POST['approff'];
$reqdept = $_POST['reqdept'];
$supplier = $_POST['supplier'];
$datefrom = $_POST['datefrom'];
$dateto = $_POST['dateto'];
$slct_type = $_POST['slct_type'];
if($slct_type == "expenes"){$change = "charge";}
if($slct_type == "charge"){$change = "EXPENSE";}

$updateQuery = $conn->query("UPDATE purchaseorder po
JOIN stocktable s ON po.reqno = s.isid AND po.code = s.code
JOIN receiving r ON r.code = s.code
SET po.approvingofficer = '$change'
WHERE s.isid <> ''
  AND po.supplier = '$supplier'
  AND po.code = '$code'
  AND po.approvingofficer = '$approff'
  AND po.reqdept = '$reqdept'
  AND po.reqdate BETWEEN '$datefrom' AND '$dateto'");

  if ($updateQuery){
    echo "success";
  }else{
    echo "failed";
  }
?>