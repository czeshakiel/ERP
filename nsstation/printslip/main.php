<?php
$caseno = $_GET['caseno'];
if(strpos($caseno, 'R')===false){$submitx="hidden";}else{$submitx="";}

if(isset($_POST['btnsave'])){
$refno = $_POST['refno'];
$remarks = $_POST['remarks'];
$test = $_POST['test'];

$sql22x = "select * from labtest  where caseno='$caseno' and refno='$refno'";
$result22x = $conn->query($sql22x);
$countx = mysqli_num_rows($result22x);

if($countx>0){
$sql778 = "update labtest set remarks = '$remarks' where caseno='$caseno' and refno='$refno'";
if ($conn->query($sql778) === TRUE) {}
}else{
$sql778 = "insert into labtest (remarks, caseno, refno, test) values ('$remarks', '$caseno', '$refno', '$test')";
if ($conn->query($sql778) === TRUE) {}
}

mysqli_query($conn,"UPDATE `productout` SET `remarks`='$remarks' WHERE `refno`='$refno'");

echo"<script>alert('Successfully Update!'); window.location = '?printslip&caseno=$caseno$datax';</script>";
}
?>
<body onload="changebgmain();">
<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?detail&caseno=<?php echo $caseno ?>">Patient Information</a></li>
<li class="breadcrumb-item"><a href="?printslip&caseno=<?php echo $caseno ?>">Print Charge Slip</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">

<font color='black'><?php echo $caseno." - ".$ptname ?></font><hr>


<ul class="nav nav-tabs px-3 border-bottom-0" role="tablist">
<li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav-p1" role="tab" id="pp1" onclick="changebg(this.id)"><i class='icofont-flask'></i> Test Procedure</a></li>
<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-p2" role="tab" id="pp2" onclick="changebg(this.id)"><i class='icofont-pills'></i> Medicine/s</a></li>
<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-p3" role="tab" id="pp3" onclick="changebg(this.id)"><i class='icofont-injection-syringe'></i> Supplies</a></li>
<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-p4" role="tab" id="pp4" onclick="changebg(this.id)"><i class='icofont-nurse-alt'></i> Other Services</a></li>
<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav-p5" role="tab" id="pp5" onclick="changebg(this.id)"><i class='icofont-icu'></i> RDU</a></li>
</ul>

<div class="card mb-3">
<div class="card-body">
<div class="tab-content">
<div class="tab-pane fade show active" id="nav-p1" role="tabpanel">


<?php
$array = array("LABORATORY", "XRAY", "ULTRASOUND", "MAMMO", "CT SCAN", "EEG", "ECG", "HEARTSTATION", "PHYSICAL THERAPY", "RESPIRATORY", "PACKAGE");
$arcount = count($array);

for($ix=0; $ix<$arcount; $ix++){
$ck = $conn->query("select * from productout where caseno='$caseno' and productsubtype = '$array[$ix]' and terminalname!='Testdone'");
$ck2 = $conn->query("select * from productout where caseno='$caseno' and location like '%$array[$ix]%' and terminalname!='Testdone'");
if(mysqli_num_rows($ck)>0 or mysqli_num_rows($ck2)>0){

$lg='xray'; $lc='warning';
if($array[$ix]=="LABORATORY"){$lg='flask'; $lc='primary';}
if($array[$ix]=="HEARTSTATION"){$lg='pulse'; $lc='danger';}
if($array[$ix]=="PHYSICAL THERAPY"){$lg='aim'; $lc='primary';}
if($array[$ix]=="RESPIRATORY"){$lg='lungs'; $lc='warning';}

if($ix==0){$show="show"; $collapse="collapsedive";}else{$show=""; $collapse="collapsed";}
//$collapse="collapsed";
echo"
<form method='POST' name='arvz$ix' action='../nsstation/printslip/ticket_select.php?caseno=$caseno&user=$user' target='_blank'>
<div class='accordion accordion-flush' id='accordionFlushExample'>
<div class='accordion-item'>
<h2 class='accordion-header' id='flush-heading$ix'>
<button class='accordion-button $collapse' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapse$ix' aria-expanded='false' aria-controls='flush-collapse$ix'>
<b><i class='icofont-$lg'></i> &nbsp; $array[$ix]</b> &nbsp;<b id='medcount'></b></button></h2>
<div id='flush-collapse$ix' class='accordion-collapse collapse $show' aria-labelledby='flush-heading$ix' data-bs-parent='#accordionFlushExample'>

<table width='98%' class='table'>
<tr>
<td width='5%' bgcolor='$primarycolor' class='text-center'></td>
<td align='center' bgcolor='$primarycolor' class='text-center'><b>Description</td>
<td align='center' bgcolor='$primarycolor' class='text-center'><b>Date/Time</td>
<td align='center' bgcolor='$primarycolor' class='text-center'><b>Status</td>
<td width='10%' bgcolor='$primarycolor' class='text-center'></td>
</tr>
";

if($array[$ix]!="PACKAGE"){$que ="and productsubtype like '%$array[$ix]%' and location not like '%PACKAGE%'";}
else{$que ="and location like '%PACKAGE%'";}

$i = 0;
$sql22 = "SELECT * from productout where caseno='$caseno' $que and status!='CANCELLED' and terminalname!='Testdone' order by producttype, productsubtype, terminalname, productdesc";
$result22 = $conn->query($sql22);
$count = mysqli_num_rows($result22);
while($row22 = $result22->fetch_assoc()) {
$desc=$row22['productdesc'];
$refno=$row22['refno'];
$trantype=$row22['trantype'];
$status=$row22['status'];
$status2=$row22['terminalname'];
$referenceno=$row22['referenceno'];
$approvalno=$row22['approvalno'];
$datereq=date("F d, Y", strtotime($row22['datearray']));
$invno=date("h:i:s a", strtotime($row22['invno']));
$desc2 = $desc;
$i++;


$packagename="";
$pckge = $conn->query("select * from packagelist where pckgno='$referenceno'");
while($pcg = $pckge->fetch_assoc()){$packagename = $pcg['packagename'];}

$remarks="";
$sql222 = $conn->query("SELECT * from labtest where caseno='$caseno' and refno='$refno'");
while($row222 = $sql222->fetch_assoc()) {$remarks=$row222['remarks'];}

//if($remarks != ""){$desc = $desc." - <font size='1' color='blue'> (".$remarks.")</font>";}
//if($packagename!= ""){$desc = $desc." - <font size='1' color='red'><i> (".$packagename.")</i></font>";}
if($packagename!=""){$packagename="<br><font color='#9BA3E7'>Package Name:</font> $packagename";}

echo"
<tr>
<td align='center'><input type='checkbox' style='transform : scale(1.5);' name='ck[]' id='ck' value='$refno'></td>
<td style='font-size:12px;'><font color='#9BA3E7'>Description:</font> <b>$desc</b><br><font color='#9BA3E7'>Remark:</font> <font color='red'>$remarks</font>$packagename</td>
<td style='font-size:12px;'><font color='#9BA3E7'>Date:</font> $datereq<br><font color='#9BA3E7'>Time:</font> $invno</td>
<td style='font-size:12px;'><font color='#9BA3E7'>Trantype:</font> $trantype<br><font color='#9BA3E7'>Status:</font> $status - $status2</td>
<td class='text-center'>
<div class='dropdown'>
<button class='btn btn-primary btn-sm dropdown-toggle' type='button' id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false'>
<i class='icofont-ui-settings'></i>
</button>
<ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>
<li><a class='dropdown-item' href='../resultform/ticket_batch.php?caseno=$caseno&refno=$refno&user=$user&approvalno=$approvalno' target='_blank'><i class='fa fa-print'></i> Print</a>
";
?>
<li><a class='dropdown-item' data-toggle="modal" data-target="#exampleModalScrollable" id="#modalScroll" onclick="rem('<?php echo $remarks ?>', '<?php echo $refno ?>', '<?php echo $desc2 ?>'); document.getElementById('iddecking').click();"><i class='fa fa-edit'></i> Edit Remarks</a>
<button type='button' id='iddecking' data-bs-toggle='modal' data-bs-target='#decking' hidden>My Button</button>
<?php
echo"
</ul>
</div>
</td>
</tr>
";
}

if($count>1){
echo "
<tr><td colspan='6' style='text-align: center;'>
<button type='button' class='btn btn-info' onclick='check($ix)' style='padding: 0px 10px;'><i class='icofont-checked'></i> Check ALL</button>
<button type='button' class='btn btn-primary' onclick='uncheck($ix)' style='padding: 0px 10px;'><i class='icofont-close-squared-alt'></i> Uncheck ALL</button>
<button class='btn btn-danger' style='padding: 0px 10px;'><i class='icofont-printer'></i> Print Selected Item(s)</button>
</td></tr>
";
}
echo"
</table>

</div>
</div>
</div>
</form>
";
}
}
?>


</div>
<div class="tab-pane fade" id="nav-p2" role="tabpanel">

<?php
echo"
<table width='50%'><tr><td><form method='POST' action='../nsstation/printslip/ticket_select.php?caseno=$caseno&user=$user' target='_blank'>
";

$i = 0;
$sql2 = "SELECT * from productout where caseno='$caseno' AND productsubtype like '%MEDICINE%' AND administration='pending' and status!='PAID' and quantity>0 group by batchno order by batchno desc, datearray desc";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()){
$batchno=$row2['batchno'];
$trantype = $row2['trantype'];
$datereq = date("F d, Y", strtotime($row2['datearray']));

$lg='surgeon'; $lc='warning';
if(strpos($batchno, 'PHARMACY')!==false){$lg="pills"; $lc='primary';}
if(strpos($batchno, 'CSR')!==false){$lg="injection-syringe"; $lc='danger';}

$btncash = "<a href='../nsstation/printslip/ticket_cash.php?caseno=$caseno&batchno=$batchno&user=$user' target='_blank'><button type='button' class='btn btn-primary btn-sm' style='padding: 0px 10px;'><i class='icofont-print'></i> Print Cash</button></a>";
$btncharge = "<a href='../nsstation/printslip/ticket_charge.php?caseno=$caseno&batchno=$batchno&user=$user' target='_blank'><button type='button' class='btn btn-warning btn-sm' style='padding: 0px 10px;'><i class='icofont-print'></i> Print Change</button></a>";


echo"<br><br>
<div class='card' style='box-shadow: 0px 0px 0px 1px lightgrey;'>
<div class='card-body'>
<div class='d-flex align-items-center justify-content-between mt-5'>
<div class='lesson_name'>
<div class='project-block light-$lc-bg'>
<i class='icofont-$lg'></i>
</div>
<span class='small project_name fw-bold'> $batchno<br><font size='1px'>Date Requested: $datereq</font> </span>
</div>
</div>
<table width='100%' align='center' class='table'>
";
$sql22 = "SELECT * from productout where batchno = '$batchno' and caseno='$caseno' AND status!='CANCELLED' and status!='REFUNDED' AND (productsubtype like '%SUPPLIES%' or productsubtype like '%MEDICINE%') group by productcode order by productdesc";
$result22 = $conn->query($sql22);
$count = mysqli_num_rows($result22);
while($row22 = $result22->fetch_assoc()) {
$desc=$row22['productdesc'];
$refno=$row22['refno'];
$trantype=$row22['trantype'];
$status=$row22['status'];
$status2=$row22['terminalname'];
$referenceno=$row22['referenceno'];
$quantity=$row22['quantity'];
$desc2=$desc;
$remarks="";
$sql222 = $conn->query("SELECT * from labtest where caseno='$caseno' and refno='$refno'");
while($row222 = $sql222->fetch_assoc()) {$remarks=$row222['remarks'];}
if($remarks!=""){$desc2 = "$desc <font color='blue' size='2px'>($remarks)</font>";}

if($trantype == "cash") {$btn = "http://$ip/2021codes/ChargeCart/ccpharmacyprintticketRX.php?ticketno=$batchno&caseno=$caseno";}
else{$btn = "../nsstation/printslip/ticket_batch.php?caseno=$caseno&refno=$refno&user=$user";}

echo"
<tr>
<td style='font-size:11px;'>$desc2
"; ?>
<a data-toggle="modal" data-target="#exampleModalScrollable" id="#modalScroll" onclick="rem('<?php echo $remarks ?>', '<?php echo $refno ?>', '<?php echo $desc ?>'); document.getElementById('iddecking2').click();"><font color='red'><i class='icofont-edit'></i></font></a>
<button type='button' id='iddecking2' data-bs-toggle='modal' data-bs-target='#decking' hidden>My Button</button>
<?php  echo"
</td>
<td class='text-center' style='font-size:11px;'>$trantype</td>
<td class='text-center'><a href='$btn' target='_blank'><button type='button' class='btn btn-primary' style='padding: 0px 10px;' $submitx><i class='icofont-print'></i></button></a></td>
</tr>
";

}
echo"</table><hr>
$btncash $btncharge
</div></div></form>";
}
echo"</td></tr></table>";
?>

</div>

<div class="tab-pane fade" id="nav-p3" role="tabpanel">

<?php
echo"
<table width='50%'><tr><td><form method='POST' action='../nsstation/printslip/ticket_select.php?caseno=$caseno&user=$user' target='_blank'>
";

$i = 0;
$sql2 = "SELECT * from productout where caseno='$caseno' AND productsubtype like '%SUPPLIES%' AND administration='pending' and status!='PAID' and quantity>0 group by batchno order by batchno desc, datearray desc";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()){
$batchno=$row2['batchno'];
$trantype = $row2['trantype'];
$datereq = date("F d, Y", strtotime($row2['datearray']));

$lg='surgeon'; $lc='warning';
if(strpos($batchno, 'PHARMACY')!==false){$lg="pills"; $lc='primary';}
if(strpos($batchno, 'CSR')!==false){$lg="injection-syringe"; $lc='danger';}

$btncash = "<a href='../nsstation/printslip/ticket_cash.php?caseno=$caseno&batchno=$batchno&user=$user' target='_blank'><button type='button' class='btn btn-primary btn-sm' style='padding: 0px 10px;'><i class='icofont-print'></i> Print Cash</button></a>";
$btncharge = "<a href='../nsstation/printslip/ticket_charge.php?caseno=$caseno&batchno=$batchno&user=$user' target='_blank'><button type='button' class='btn btn-warning btn-sm' style='padding: 0px 10px;'><i class='icofont-print'></i> Print Change</button></a>";


echo"<br><br>
<div class='card' style='box-shadow: 0px 0px 0px 1px lightgrey;'>
<div class='card-body'>
<div class='d-flex align-items-center justify-content-between mt-5'>
<div class='lesson_name'>
<div class='project-block light-$lc-bg'>
<i class='icofont-$lg'></i>
</div>
<span class='small project_name fw-bold'> $batchno<br><font size='1px'>Date Requested: $datereq</font> </span>
</div>
</div>
<table width='100%' align='center' class='table'>
";
$sql22 = "SELECT * from productout where batchno = '$batchno' and caseno='$caseno' AND status!='CANCELLED' and status!='REFUNDED' AND (productsubtype like '%SUPPLIES%' or productsubtype like '%MEDICINE%') group by productcode order by productdesc";
$result22 = $conn->query($sql22);
$count = mysqli_num_rows($result22);
while($row22 = $result22->fetch_assoc()) {
$desc=$row22['productdesc'];
$refno=$row22['refno'];
$trantype=$row22['trantype'];
$status=$row22['status'];
$status2=$row22['terminalname'];
$referenceno=$row22['referenceno'];
$quantity=$row22['quantity'];

if($trantype == "cash") {$btn = "http://$ip/2021codes/ChargeCart/ccpharmacyprintticketRX.php?ticketno=$batchno&caseno=$caseno";}
else{$btn = "../nsstation/printslip/ticket_batch.php?caseno=$caseno&refno=$refno&user=$user";}

echo"
<tr>
<td style='font-size:11px;'>$desc</td>
<td class='text-center' style='font-size:11px;'>$trantype</td>
<td class='text-center'><a href='$btn' target='_blank'><button type='button' class='btn btn-primary' style='padding: 0px 10px;'><i class='icofont-print'></i></button></a></td>
</tr>
";

}
echo"</table><hr>
$btncash $btncharge
</div></div></form>";
}
echo"</td></tr></table>";
?>

</div>



<div class="tab-pane fade" id="nav-p4" role="tabpanel">
<?php
echo"<table width='50%'><tr><td><form method='POST' action='../nsstation/printslip/ticket_select.php?caseno=$caseno&user=$user' target='_blank'>";
// ---------------------------------------->>>>>>>>>>>>>>>>>.... OTHER SERVICES
$i = 0;
$sql2 = "SELECT * from productout where caseno='$caseno' AND (productsubtype like '%MISCELLANEOUS%' or productsubtype like '%AMBULANCE%' or productsubtype like '%OXYGEN%') and status!='PAID' and quantity>0 group by batchno order by batchno desc, datearray desc";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()){
$batchno=$row2['batchno'];
$trantype = $row2['trantype'];

$btncash = "<a href='../nsstation/printslip/ticket_cash.php?caseno=$caseno&batchno=$batchno&user=$user&other' target='_blank'><button class='btn btn-primary btn-sm' style='padding: 0px 10px;'><i class='icofont-print'></i> Print Cash</button></a>";
$btncharge = "<a href='../nsstation/printslip/ticket_charge.php?caseno=$caseno&batchno=$batchno&user=$user&other' target='_blank'><button class='btn btn-warning btn-sm' style='padding: 0px 10px;'><i class='icofont-print'></i> Print Change</button></a>";

$lg='surgeon'; $lc='warning';
echo"
<br><br>
<div class='card' style='box-shadow: 0px 0px 0px 1px lightgrey;'>
<div class='card-body'>
<div class='d-flex align-items-center justify-content-between mt-5'>
<div class='lesson_name'>
<div class='project-block light-$lc-bg'>
<i class='icofont-$lg'></i>
</div>
<span class='small project_name fw-bold'> $batchno </span>
</div>
</div>

<table width='100%' border='1' align='center' class='table'>
";


$sql22 = "SELECT * from productout where batchno = '$batchno' and caseno='$caseno' AND status!='CANCELLED' and status!='REFUNDED' group by productcode order by productdesc";
$result22 = $conn->query($sql22);
$count = mysqli_num_rows($result22);
while($row22 = $result22->fetch_assoc()) {
$desc=$row22['productdesc'];
$refno=$row22['refno'];
$trantype=$row22['trantype'];
$status=$row22['status'];
$status2=$row22['terminalname'];
$referenceno=$row22['referenceno'];
$quantity=$row22['quantity'];
$productsubtype=$row22['productsubtype'];

if(strpos($productsubtype, "MEDICINE")===false or strpos($productsubtype, "SUPPLIES")===false){
  $btn = "../nsstation/printslip/ticket_batch.php?caseno=$caseno&refno=$refno&user=$user";
}else{

if($trantype == "cash") {$btn = "http://$ip/2021codes/ChargeCart/ccpharmacyprintticketRX.php?ticketno=$batchno&caseno=$caseno";}
else{$btn = "../nsstation/printslip/ticket_batch.php?caseno=$caseno&refno=$refno&user=$user";}

}
echo"
<tr>
<td style='font-size:11px;'>$desc</td>
<td class='text-center' style='font-size:11px;'>$trantype</td>
<td class='text-center'><a href='$btn' target='_blank'><button type='button' class='btn btn-primary' style='padding: 0px 10px;'><i class='icofont-print'></i></button></a></td>
</tr>
";


}
echo"</table><hr>
$btncash $btncharge</div></div>";
}
echo"</form></td></tr></table>";
// ---------------------------------------->>>>>>>>>>>>>>>>>. END OTHER SERVICES
?>
</div>



<div class="tab-pane fade" id="nav-p5" role="tabpanel">
<?php
// ------------------------------------->>>>>>>>>>>> RDU MED/SUP
echo"<table width='50%'><tr><td><form method='POST' action='../nsstation/printslip/ticket_select.php?caseno=$caseno&user=$user' target='_blank'>";
$ii = 0;
$sql2 = "SELECT * from productout where caseno='$caseno' AND (caseno like 'R-%' or caseno like 'WD-%') and status!='PAID' and quantity>0 group by batchno order by batchno desc, datearray desc";
$result2 = $conn->query($sql2);
while($row2 = $result2->fetch_assoc()){
$batchno=$row2['batchno'];
$trantype = $row2['trantype'];

$btncash = "<a href='../nsstation/printslip/ticket_cash.php?caseno=$caseno&batchno=$batchno&user=$user&rdu' target='_blank'><button class='btn btn-primary btn-sm' style='padding: 0px 10px;'><i class='icofont-print'></i> Print Cash</button></a>";
$btncharge = "<a href='../nsstation/printslip/ticket_charge.php?caseno=$caseno&batchno=$batchno&user=$user&rdu' target='_blank'><button class='btn btn-warning btn-sm' style='padding: 0px 10px;'><i class='icofont-print'></i> Print Change</button></a>";

$lg='surgeon'; $lc='warning';

echo"
<br><br>
<div class='card' style='box-shadow: 0px 0px 0px 1px lightgrey;'>
<div class='card-body'>
<div class='d-flex align-items-center justify-content-between mt-5'>
<div class='lesson_name'>
<div class='project-block light-$lc-bg'>
<i class='icofont-$lg'></i>
</div>
<span class='small project_name fw-bold'> $batchno </span>
</div>
</div>

<table width='100%' border='1' align='center' class='table'>
";

$sql22 = "SELECT * from productout where batchno = '$batchno' and caseno='$caseno' AND (status!='CANCELLED' and status!='REFUNDED') group by productcode order by productdesc";
$result22 = $conn->query($sql22);
$count = mysqli_num_rows($result22);
while($row22 = $result22->fetch_assoc()) {
$desc=$row22['productdesc'];
$refno=$row22['refno'];
$trantype=$row22['trantype'];
$status=$row22['status'];
$status2=$row22['terminalname'];
$referenceno=$row22['referenceno'];
$quantity=$row22['quantity'];

if($trantype == "cash") {$btn = "http://$ip/2021codes/ChargeCart/ccpharmacyprintticketRX.php?ticketno=$batchno&caseno=$caseno";}
else{$btn = "../nsstation/printslip/ticket_batch.php?caseno=$caseno&refno=$refno&user=$user";}

echo"
<tr>
<td class='text-center' style='font-size:11px;'>$desc</td>
<td class='text-center' style='font-size:11px;'>$trantype</td>
<td class='text-center'><a href='$btn' target='_blank'><button type='button' class='btn btn-primary' style='padding: 0px 10px;'><i class='fa fa-print'></i></button></a></td>
</tr>
";
}
echo"</table><hr>
$btncash $btncharge</div></div>";
}
echo"</form></td></tr></table>";
// ------------------------------------->>>>>>>> END RDU MED/SUP
?>
</div>


</div>
</div>
</div>


</div>
</div>
</div>
</div>
</section>
</main>

<script>
function rem(val, val2, val3){
document.getElementById("myTextarea").value = val;
document.getElementById("refno").value = val2;
document.getElementById("test").value = val3;
document.getElementById('lab').innerHTML = val3;
}


function check(val){
var myval = "arvz" + val;
if(!document.forms[myval])
return;
var objCheckBoxes = document.forms[myval].elements['ck[]'];
if(!objCheckBoxes)
return;
var countCheckBoxes = objCheckBoxes.length;
if(!countCheckBoxes)
objCheckBoxes.checked = true;
else
for(var i = 0; i < countCheckBoxes; i++)
objCheckBoxes[i].checked = true;
}

function uncheck(val){
var myval = "arvz" + val;
if(!document.forms[myval])
return;
var objCheckBoxes = document.forms[myval].elements['ck[]'];
if(!objCheckBoxes)
return;
var countCheckBoxes = objCheckBoxes.length;
if(!countCheckBoxes)
objCheckBoxes.checked = false;
else
for(var i = 0; i < countCheckBoxes; i++)
objCheckBoxes[i].checked = false;
}


function changebg(val){
for (let i = 1; i <= 5; i++) {
var text="";
text += "pp" + i;
document.getElementById(text).style="width: 170px; border-color: #e9e9ee;";
}
document.getElementById(val).style="background: #5a6495; color: white; border-color: #f44336; width: 170px;";
}

function changebgmain(){

for (let i = 1; i <= 5; i++) {
var text="";
text += "pp" + i;
document.getElementById(text).style="width: 170px; border-color: #e9e9ee;";
}
document.getElementById('pp1').style="background: #5a6495; color: white; border-color: #f44336; width: 170px;";
}
</script>

  <!-- Modal Scrollable -->
<form method="POST">


<div class="modal fade" id="decking" tabindex="-1" data-bs-backdrop="static">
<div class="modal-dialog glowing-circle2">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title"><i class="bi bi-arrow-up-left-circle"></i> EDIT REMARKS</h5>
<button type="button" class="btn-close" onclick="location.reload();" aria-label="Close"></button>
</div>
<div class="modal-body">

<h5 class="font-weight-bold">Remarks</h5>
<p id="lab"></p>
<textarea name="remarks" id = "myTextarea" class="form-control"></textarea>
<input type="hidden" name="refno" id = "refno">
<input type="hidden" name="test" id = "test">
<div class="modal-footer">
<button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
<button type="submit" name="btnsave" class="btn btn-primary">Save changes</button>
</div>
</div>
</div>
</div>
</form>
<!-- Modal Center -->
