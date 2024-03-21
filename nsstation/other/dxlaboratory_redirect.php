<?php
include "../../main/class.php";
$caseno=$_GET['caseno'];
$refno = $_GET['refno'];

$zzsql=mysqli_query($conn,"SELECT * FROM `labresults` WHERE `refno`='$refno' LIMIT 0,1");
$zzcount=mysqli_num_rows($zzsql);
if($zzcount==0){

  $sql = $conn->query("SELECT * FROM productout where caseno= '$caseno' and refno='$refno'");
  while($row = $sql->fetch_assoc()) {$productcode=$row['productcode'];}

  $resultq1 = $conn->query("SELECT * FROM receiving WHERE code='$productcode'");
  while($rowq1 = $resultq1->fetch_assoc()) {$lotno=$rowq1['lotno'];}

  $resultq2 = $conn->query("SELECT * FROM hematology WHERE caseno='$caseno' and lab29='$refno'");
  while($rowq2 = $resultq2->fetch_assoc()) {$testno=$rowq2['testno'];}

  if($lotno=="hematology"){$linked="http://$ip/labprint/hemabody.php?caseno=$caseno&lab29=$refno&from=$dept";}
  elseif(($lotno=="chemistry")||($lotno=="serology")){$linked="http://$ip/labprint/bloodchem.php?caseno=$caseno&lab29=$refno&testno=$testno&from=$dept";}
  elseif($lotno=="serology"){$linked="http://$ip/labprint/bloodchem.php?caseno=$caseno&lab29=$refno&testno=$testno&from=$dept";}
  elseif($lotno=="parasitology"){$linked="http://$ip/cgi-bin/fecalysis200.cgi?patient=$patient[patientname]_$caseno&refno=$refno&from=$dept";}
  elseif($lotno=="covid"){$linked="http://$ip/labprint/AntigenTest.php?caseno=$caseno&lab29=$refno&from=$dept";}
  elseif($lotno=="clinical microscopy"){$linked="http://$ip/labprint/Urinalysis-body.php?caseno=$caseno&refno=$refno&from=$dept";}
  elseif($lotno=="LABORATORY"){$linked="http://$ip/labprint/xxx.php?caseno=$caseno&refno=$refno&from=$dept";}
  else{$linked="http://$ip/labprint/ABG-body.php?caseno=$caseno&lab29=$refno&testno=$testno&from=$dept";}

  
}
else{
  $zzfetch=mysqli_fetch_array($zzsql);
  $zzlogs=trim($zzfetch['logs']);
  $zzpbn=$zzfetch['printbatchno'];
  
  if($zzlogs!=""){$elogs=1;}
  
  $linked="../../extra/LabExpress/PrintResult/?caseno=$caseno&patid=$patientidno&printbatchno=$zzpbn&stype=$lotno&asd=$userunique&noh";
}

echo"<script>window.location='$linked';</script>";
?>
