<?php
$stktsql=mysqli_query($conn,"SELECT * FROM stocktable WHERE code='$code' AND rrno='$rrno' AND dept='$stk' AND (trantype NOT LIKE 'dispensed' OR trantype NOT LIKE 'return') ORDER BY datearray");
$stktfetch=mysqli_fetch_array($stktsql);


$sdate=$stktfetch['date'];
$spo=$stktfetch['po'];
$sinvno=$stktfetch['invno'];
$ssuppliercode=$stktfetch['suppliercode'];
$ssuppliername=$stktfetch['suppliername'];
$scode=$stktfetch['code'];
$sdescription=$stktfetch['description'];
$sunitcost=$stktfetch['unitcost'];

$srecdqty=$stktfetch['recdqty'];
$sgeneric=$stktfetch['recdqty'];
$sstatquantity=$stktfetch['statquantity'];
$sexpiration=$stktfetch['expiration'];
$slotno=$stktfetch['lotno'];
$strantype=$stktfetch['trantype'];
$sterms=$stktfetch['terms'];

$sprodtype1=$stktfetch['prodtype1'];
$spaymentstatus=$stktfetch['paymentstatus'];
$sisid=$stktfetch['isid'];
$sprevqty=$stktfetch['prevqty'];
$sstockalert=$stktfetch['stockalert'];
$sduedate=$stktfetch['duedate'];

$squantity=$quanti*(-1);
$stransdate=date("M-d-Y");;
$sdatearray=date("Y-m-d");

mysqli_query($conn,"INSERT INTO `stocktable` (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`) VALUES ('$sdate', '$rrno', '$spo', '$sinvno', '$caseno', '$patientname', '$scode', '$sdescription', '$sunitcost', '$squantity', '$srecdqty', '$sgeneric', '$sstatquantity', '$sexpiration', '$slotno', 'dispensed', '$sterms', '$stransdate', '$stk', '$sprodtype1', '$spaymentstatus', '$sisid', '$ccname', '$sprevqty', '$sstockalert', '$sduedate', '$sdatearray')");
//echo "INSERT INTO `stocktable` (`date`, `rrno`, `po`, `invno`, `suppliercode`, `suppliername`, `code`, `description`, `unitcost`, `quantity`, `recdqty`, `generic`, `statquantity`, `expiration`, `lotno`, `trantype`, `terms`, `transdate`, `dept`, `prodtype1`, `paymentstatus`, `isid`, `receivinguser`, `prevqty`, `stockalert`, `duedate`, `datearray`) VALUES ('$sdate', '$rrno', '$spo', '$sinvno', '$ssuppliercode', '$ssuppliername', '$scode', '$sdescription', '$sunitcost', '$squantity', '$srecdqty', '$sgeneric', '$sstatquantity', '$sexpiration', '$slotno', 'dispensed', '$sterms', '$stransdate', '$stk', '$sprodtype1', '$spaymentstatus', '$sisid', '$ccname', '$sprevqty', '$sstockalert', '$sduedate', '$sdatearray')<br />";
?>
