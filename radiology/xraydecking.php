<?php
include "../main/class.php";
include "../main/header.php";

$refno=$_GET['refno'];
$caseno=$_GET['caseno'];

if(isset($_POST['btn_save'])){ 
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
$prodsubtype=$_POST['prodsubtype'];
$namearray = $lastname.", ".$firstname." ".$middlename;
$branch=$_POST['branch'];
$approvalno = "$nursename"."_$filmno";
$status2 = "Testtobedone";


$result2g = $conn->query("SELECT * FROM nsauthdoctors where empid='$reader' order by name");
while($row2g = $result2g->fetch_assoc()) { 
$name=$row2g['name'];
$empid=$row2g['empid'];
$readersinfo = $empid."_".$name;
}

// if($status=="PROCEED"){$status="pending";} else {$status="Testtobedone";}

$sqll = $conn->query("update productout set referenceno='$reader',approvalno='$approvalno',terminalname='$status2', administration='$readersinfo' where refno = '$refno'");
$sqll = $conn->query("delete from xrayevent where hmo='$refno'");
$sqll = $conn->query("insert into xrayevent (`patientidno`, `caseno`, `lastname`, `firstname`, `middlename`, `senior`, `ward`, `hmo`, `branch`, `ap`, `productsubtype`) values 
('$patientidno','$caseno','$lastname','$firstname','$middlename','$senior','$ward','$refno','$branch','$name','$prodsubtype')");


// ------------ Arvid 04-23-2021 8:17 pm  for checking of user who set the xray decking and radtech assigned ---------------------
$userdec = "Set By: ".$user; // examnurse column
$userrad = $radtech; // examperform column
// -------------------------------------------------------------------------------------------------------------------------------
$sqll = $conn->query("delete from xray1 where refno='$refno' and caseno='$caseno'");
$sqll = $conn->query("insert into xray1 (`patientidno`, `caseno`, `refno`, `radiologist`, `partexamined`, `examnurse` , `examperform`) values ('$patientidno','$caseno','$refno','$name','$desc','$userdec','$userrad')");



// //SERIALIZED JSON
// class ArrayValue implements JsonSerializable {
// public function __construct(array $array) {$this->array = $array;}
// public function jsonSerialize() {return $this->array;}
// }
// //END SERIALIZED JSON

// $name=$_FILES['file']['name'];
// $size=$_FILES['file']['size'];
// $type=$_FILES['file']['type'];
// $temp=$_FILES['file']['tmp_name'];
// $filetype=$_POST['filetype'];
// list($file2, $type2) = explode(".", $name);
// $name2 = $refno.".".$type2;
// $file_name = $_FILES['file']['name'];
// $asd=move_uploaded_file($temp, "temp/".$name2);

// $from = $_SERVER['DOCUMENT_ROOT']."/ERP/radiology/temp/$name2";
// $to = "http://38.17.52.121/imaging/files.php";


// $post_request = array(
// "sender" => "KMSCI",
// "patientidno" => "$patientidno",
// "caseno" => "$caseno",
// "refno" => "$refno",
// "name" => "$namearray",
// "gender" => "$gender",
// "age" => "$age",
// "code" => "$code",
// "desc" => "$desc",
// "datereq" => "$datereq",
// "reader" => "$reader",
// "file" => curl_file_create($from) // for php 5.5+
// );

// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, $to);
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $post_request);
// $result = curl_exec($ch);
// curl_close($ch);

// $file_path = 'temp/'.$name2;
// if (file_exists($file_path)){if(unlink($file_path)){}}

if($status=="Testtobedone"){echo"<script>alert('saved..'); window.location='';</script>";}
else{echo"<script>window.open('../radiology/?editresult&caseno=$caseno&refno=$refno&productsubtype=$prodsubtype', '_blank'); window.close();</script>";}	
}								




$sql2 = "SELECT * FROM admission, patientprofile where admission.patientidno=patientprofile.patientidno and caseno='$caseno'";
$result2 = $conn->query($sql2);
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
$administration=$pffetch['administration'];
}

list($userx, $film) = explode("_", $approvalno);
list($docid, $docname) = explode("_", $administration);

if($prodsubtype == "XRAY") {$reports = "RADIOGRAPHY RESULT";}
if($prodsubtype == "CT SCAN") {$reports = "COMPUTED TOMOGRAPHY RESULT";}
if($prodsubtype == "ULTRASOUND") {$reports = "ULTRASOUND RESULT";}
if($prodsubtype == "RADIOLOGY") {$reports = "RADIOGRAPHY RESULT";}
if($prodsubtype == "CARDIAC") {$reports = "CARDIAC RESULT";}
?>


<table width="100%"><tr><td>
<form enctype="multipart/form-data" action="" name="form" method="post">
<br><br>
<div class='card' style='box-shadow: 0px 0px 0px 1px lightgrey;'>
<div class='card-body'>
<div class='d-flex align-items-center justify-content-between mt-5'>
<div class='lesson_name'>
<div class='project-block light-primary-bg'>
<i class='icofont-hotel-boy'></i>
</div>
<span class='small project_name fw-bold'> <?php echo $namearray ?> </span>
</div>
</div>
<hr>

<table width="100%">
<tr>
<td width="20%" style="font-size: 11px;">Patient ID:</td>
<td width="30%" style="font-size: 11px;"><u><?php echo $patientidno ?></td>
<td width="20%" style="font-size: 11px;">Caseno:</td>
<td width="30%" style="font-size: 11px;"><u><?php echo $caseno ?></td>
</tr>
<tr>
<td style="font-size: 11px;">Refno</td>
<td style="font-size: 11px;"><u><?php echo $refno ?></td>
<td style="font-size: 11px;">Test:</td>
<td style="font-size: 11px;"><u><?php echo $productdesc ?></td>
</tr>
</table>
<hr>

<table width="95%" align="center">
<tr>
<td style="font-size: 11px;">Upload Image:
<input type="file" name="file" id="file" class="form-control" multiple="">
</td>
</tr>
<tr>
<td style="font-size: 11px;">READER:
<select class="select2-single form-control" style="width:100%;" name="reader">
<option></option>
<?php
$sql2g = "SELECT * FROM nsauthdoctors where station='RADIOLOGYDOCTORS' order by name";
$result2g = $conn->query($sql2g);
while($row2g = $result2g->fetch_assoc()) { 
$name=$row2g['name'];
$empid=$row2g['empid'];
if($docid==$empid){$sel="selected";}else{$sel="";}
echo "<option value='$empid' $sel>$name</option> ";
}
?>
</select><br>
</td>
</tr>
<tr>
<td style="font-size: 11px;">RAD TECH:

<select class="select2-single form-control" style="width:100%;" name="radtech">
<?php
$sql2gg = "SELECT * FROM nsauth where station='XRAY' and access='1' order by name";
$result2gg = $conn->query($sql2gg);
while($row2gg = $result2gg->fetch_assoc()) { 
$name=$row2gg['name'];
$empid=$row2gg['empid'];
echo "<option value='$name'>$name</option> ";
}
?>
</select><br>
</td>
</tr>

<tr>
<td style="font-size: 11px;">STATUS OF TEST:
<select class="select2-single form-control" style="width:100%;" name="status">
<option value="Testtobedone">TEST TO BE DONE</option>
<option value="makeresult">MAKE RESULT</option>
</select><br>
</td>
</tr>
<tr>
<td style="font-size: 11px;">FILM NO.:</font><input type="text" name="filmno" value="<?php echo $film ?>" class="form-control" required><p></td>
</tr>
<tr>
<td>
<input type="hidden" name="patientidno" value="<?php echo $patientidno ?>">
<input type="hidden" name="caseno" value="<?php echo $caseno ?>">
<input type="hidden" name="refno" value="<?php echo $refno ?>">
<input type="hidden" name="desc" value="<?php echo $productdesc ?>">
<input type="hidden" name="refphys" value="<?php echo $ap ?>">
<input type="hidden" name="report" value="<?php echo $reports ?>">
<input type="hidden" name="prodsubtype" value="<?php echo $prodsubtype ?>">
<input type="hidden" name="user" value="<?php echo $user ?>">
<input type="hidden" name="lastname" value="<?php echo $lastname ?>">
<input type="hidden" name="firstname" value="<?php echo $firstname ?>">
<input type="hidden" name="middlename" value="<?php echo $middlename ?>">
<input type="hidden" name="branch" value="<?php echo $branch ?>">
<p align="right"><button type="submit" name="btn_save" class="btn btn-outline-danger btn-sm"><i class="icofont-check-circled"></i> Submit Request</button> </td>
</tr>
</table>
</div>
</div>
</form>

</td>
</tr>
</table>	

<?php include "../main/footer.php"; ?>