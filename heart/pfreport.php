<?php
if(isset($_POST['btn_save'])) { 
$reader=$_POST['reader'];
$radtech=$_POST['radtech'];
$status=$_POST['status'];
$filmno=$_POST['filmno'];
$desc=$_POST['desc'];
$caseno=$_POST['caseno'];
$refno=$_POST['refno'];
$refphys=$_POST['refphys'];
$report=$_POST['report'];
$nursename=$_POST['user'];
$lastname=$_POST['lastname'];
$firstname=$_POST['firstname'];
$middlename=$_POST['middlename'];
$branch=$_POST['branch'];
$approvalno = "$nursename"."_$filmno";
$designation="CARDIOLOGIST";
$cardiologist=$_POST['cardiologist'];

$sql2g = "SELECT * FROM nsauthdoctors where empid='$reader' order by name";
$result2g = $conn->query($sql2g);
while($row2g = $result2g->fetch_assoc()) { 
$name=$row2g['name'];
$empid=$row2g['empid'];
}

//if($status=="PROCEED"){$status="pending";} else {$status="Testtobedone";}

$sqll = "update productout set referenceno='$reader' ,approvalno='$approvalno', terminalname='$status' where refno = '$refno'";
if ($conn->query($sqll) === TRUE) {}

$sqll = "delete from xrayevent where hmo='$refno'";
if ($conn->query($sqll) === TRUE) {}

$sqll = "insert into xrayevent (`patientidno`, `caseno`, `lastname`, `firstname`, `middlename`, `senior`, `ward`, `hmo`, `branch`, `ap`, `productsubtype`) values('$patientidno','$caseno','$lastname','$firstname','$middlename','$senior','$ward','$refno','$branch','$name','$prodsubtype')";
if ($conn->query($sqll) === TRUE) {}

$sqll = "delete from xray1 where refno='$refno' and caseno='$caseno'";
if ($conn->query($sqll) === TRUE) {}

$sqll = "delete from 2dechoresult where refno='$refno' and caseno='$caseno'";
if ($conn->query($sqll) === TRUE) {}

$sqll = "insert into 2dechoresult (`patientidno`, `caseno`, `refno`, `reader`, `partexamined`, `validate`,remarks) values ('$patientidno','$caseno','$refno','$name','$desc','$cardiologist','$technician')";
if ($conn->query($sqll) === TRUE) {}


if($status == "Testdone"){

if ($trantype == "cash") {
$status1 = "PAID";
$sql778 = "insert into productout values('$coder','$todaytimex','$caseno','$empid','$reader','$amtSum1','1','0','$amtSum1','NONE','0','0','$amtSum1','$localdate','$status1','$productcode','','$refno','READERS FEE','PROFESSIONAL FEE','','$refno','','$branch','','$todayx','')";
if ($conn->query($sql778) === TRUE) {}   
}

if ($trantype == "charge") {
$status1 = "Approved";
$sql779 = "insert into productout values('$coder','$todaytimex','$caseno','$empid','$reader','$amtSum1','1','0','$amtSum1','NONE','0','$amtSum1','0','$localdate','$status1','$productcode','','$refno','READERS FEE','PROFESSIONAL FEE','','$refno','','$branch','','$todayx','')";
if ($conn->query($sql779) === TRUE) {}  
}

$sql777 = "insert into readersfee values('$maxid','$caseno','$coder','$productcode','$reader','$empid','$todayx','$refno','$amtSum1','$opdprice','$senior','PROFESSIONAL FEE')";
if ($conn->query($sql777) === TRUE) {}
}

// ------------ Arvid 04-23-2021 8:17 pm  for checking of user who set the xray decking and radtech assigned ---------------------
$userdec = "Set By: ".$user; // examnurse column
$userrad = $radtech; // examperform column
// -------------------------------------------------------------------------------------------------------------------------------

$sqll = "insert into xray1 (`patientidno`, `caseno`, `refno`, `radiologist`, `partexamined`, `examnurse` , `examperform`) values ('$patientidno','$caseno','$refno','$name','$desc','$userdec','$userrad')";
if ($conn->query($sqll) === TRUE) {}
echo"<script>alert('Successfully Saved.. $refno-$caseno-$status'); window.location='?view=main&modulex=IPD$datax';</script>";	
}								
?>






<?php
$refno=$_GET['refno'];
$caseno=$_GET['caseno'];
?>


<?php
   $sql2 = "SELECT * FROM admission, patientprofile where admission.patientidno=patientprofile.patientidno and caseno='$caseno'";
   $result2 = $conn->query($sql2);
   $checkexist = mysqli_num_rows($result2);
   
   if($checkexist<=0){
   $sql2 = "SELECT * FROM admission, patientprofile where admission.patientidno=patientprofile.patientidno and caseno='$caseno'";
   $result2 = $conn->query($sql2);
   }
   while($row2 = $result2->fetch_assoc()) { 
   $ap=$row2['ap'];
   $patientidno=$row2['patientidno'];
   $ward=$row2['ward'];
   $senior=$row2['senior'];
   $birthdate = $row2['birthdate'];
	$lastname = $row2['lastname'];
	$firstname = $row2['firstname'];
	$middlename = $row2['middlename'];
	$senior = $row2['senior'];
	$age = $row2['age'];
	$sex = $row2['sex'];
	$namearray = "$lastname".",  "."$firstname"."  "."$middlename";
   }
   



   
$sql22 = "SELECT * from productout where refno='$refno' and caseno='$caseno'";
$result22 = $conn->query($sql22);
while($pffetch = $result22->fetch_assoc()) { 
$productdesc=$pffetch['productdesc'];
$prodsubtype=$pffetch['productsubtype'];
$approvalno=$pffetch['approvalno'];
}
list($docc, $film) = explode("_", $approvalno);


if (strpos($productdesc, 'PEDIA') !== false) {$reports = "PEDIA 2D ECHO REPORT";}
elseif(strpos($productdesc, 'ADULT') !== false) {$reports = "ADULT 2D ECHO REPORT";}
elseif(strpos($productdesc, 'STRESS') !== false) {$reports = "TREADMILL TEST RESULTS";}
elseif(strpos($productdesc, 'ECG') !== false) {$reports = "ECG TEST RESULTS";}
else {$reports = "2D ECHO REPORT";}
?>


<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?view=main">Main</a></li>
<li class="breadcrumb-item"><a href=""></a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">
<h5> Readers Fee Report <hr>

<table width="40%"><tr><td style='font-size: 12px;'>
<form action="readersfee_print.php" target="_blank">	
<br><br>
<div class='card' style='box-shadow: 0px 0px 0px 1px lightgrey;'>
<div class='card-body'>
<div class='d-flex align-items-center justify-content-between mt-5'>
<div class='lesson_name'>
<div class='project-block light-primary-bg'>
<i class='icofont-undo'></i>
</div>
<span class='small project_name fw-bold'> <?php echo $namearray."-".$approvalno ?> </span>
</div>
</div>

<table class="pbord" width="95%" align="center">
<tr>
<td style='font-size: 12px;'><font color="black"> Start Date : <br><input type="date" name="dstartx" value="<?php echo $datec ?>" class="form-control"> </font></td>
</tr>
<tr>
<td style='font-size: 12px;'><font color="black"> End Date : <br><input type="date" name="dendx" value="<?php echo $datec ?>" class="form-control"> </font></td>
</tr>
<tr>
<td style='font-size: 12px;'><font color="black">  TRANSACTION : <br> 
<select name="trans" class="form-control">
<option value="CASH">CASH</option>
<option value="HMO">HMO</option>
<option value="PHIC">PHIC</option>
</select>
</font>
</td>
</tr>
<tr>
<td style='font-size: 12px;'><font color="black">  TEST : <br> 
<select name="test" class="form-control">

<?php
   $sqltest = "SELECT productcode,productdesc FROM `productout` WHERE `productsubtype` LIKE 'HEARTSTATION' or `productsubtype` LIKE 'ECG' group by productcode ORDER BY `productdesc` ASC ";
   $resulttest = $conn->query($sqltest);
   while($rowresult = $resulttest->fetch_assoc()) { 
   $productcode=$rowresult['productcode'];
   $productdesc=$rowresult['productdesc'];


echo "
<option value='$productcode'>$productdesc</option>
";

 }
?>
<option value='All'>All</option>
</select>
</font>
</td>
</tr>
<tr>
<td style='font-size: 12px;'><font color="black">  READER : <br> 
<select name="reader" class="form-control">

<?php
   $sql22d = "select * FROM nsauthdoctors where station='HEARTREADER' or station='HEARTDOCTOR'";
   $result22d = $conn->query($sql22d);
   while($row22d = $result22d->fetch_assoc()) { 
   $name=$row22d['name'];
   $empid=$row22d['empid'];
   $vval = $empid."_".$name;


echo "
<option value='$vval'>$name</option>
";

 }
?>
</select>
</font>
</td>
</tr>
<tr>
<td style='font-size: 12px;'>
<button type="submit" class="btn btn-success btn-sm"><font size="3%"><i class="fa fa-share-square-o"> Submit</i></font></button>&nbsp;&nbsp;
<br> <br> 
</td>
</tr>
</table>

</div>
</div>
</form>

</td>
</tr>
</table>	   

</div>
</div>
</div>
</div>
</section>
</main>