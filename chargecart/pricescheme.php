<?php
//include "../chargecart/pricingscheme_vat.php";
// ------ Start Receiving ------
$sql = "SELECT * from receiving where code = '$code'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
$code=$row['code'];
$unitcost=$row['unitprice'];
$lotno=$row['lotno'];
$testcode = $row['testcode'];
$unit = $row['unit'];
}

// --------- if Mark-up price -------
$sqlmm = "SELECT * from stocktable where code='$code' and (trantype= 'charge' or trantype= 'cash') order by datearray";
$resultmm = $conn->query($sqlmm);
while($rowmm = $resultmm->fetch_assoc()){ 
$unitp=$rowmm['unitcost'];
}

// -------- if Special price ---
$sql22223 = "SELECT * from productsmasterlist where code='$code'";
$result22223 = $conn->query($sql22223);
while($row22223 = $result22223->fetch_assoc()){ 
$fixprice=$row22223['opd'];
$fixprice2=$row22223['philhealth'];
}

// -------- if cash/charge transaction ----------
if($btn=="cash"){$phic = $fixprice;}else{$phic = $fixprice2;}

$datalist = $unit."||".$lotno."||".$unitp."||".$phic."||".$testcode."||".$qty1."||".$code;

if($btn=="cash"){

if($senior=="N" or $senior=="n"){list($sp, $newgross, $newadj, $newnet, $lessvat, $less) = cashPOS($datalist);}
else{list($sp, $newgross, $newadj, $newnet, $lessvat, $less) = seniorPOS($datalist);}
$appr= "requested"; 

}
else{list($sp, $newgross, $newadj, $newnet) = chargehomemeds($datalist); $appr= "Approved";}

$ind_sp = $newgross / $qty1;
$ind_ad = $newadj / $qty1;
$ind_net = $newnet / $qty1;
$ind_vat = $lessvat / $qty1;
$ind_less = $less / $qty1;
$dt = date("Y-m-d H:i:s");

if($lessvat>0){$wvat="Y";}else{$wvat="N";}
if($senior=="N" or $senior=="n"){$scpwd = "N";}else{$scpwd="Y";}

// ------- insert productout (exclude AUTOGEN) ------
$pos = strpos($code, "AUTOGEN");
if($pos === false) {include "../chargecart/scm_fifo.php";}

?>
