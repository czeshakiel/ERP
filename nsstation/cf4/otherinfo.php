<style>
textarea:focus{border: solid 1px blue;}
textarea{
resize: none;
border: none;
border-radius: 10px;
outline: none;
padding: 2px;
font-size: 1em;
color: black;
transition: border 0.5s;
-webkit-transition: border 0.5s;
-moz-transition: border 0.5s;
-o-transition: border 0.5s;
border: solid 1px <?php echo $primarycolor ?>;
-webkit-box-sizing:border-box;
-moz-box-sizing:border-box;
box-sizing:border-box;
font-size: 13px;
}
</style>
<body onload="myFunction();">

<?php include "../nsstation/cf4/part1.php"; ?>

<main id="main" class="main">
<div class="pagetitle">
<h5><?php echo strtoupper($dept)." DEPARTMENT" ?></h5>
<nav>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="?main">Main</a></li>
<li class="breadcrumb-item"><a href="?detail&caseno=<?php echo $caseno ?>">Patient Information</a></li>
<li class="breadcrumb-item"><a href="?otherinfo&caseno=<?php echo $caseno ?>">CF4 Additional Information</a></li>
</ol>
</nav>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-body">
<p><b style='font-size: 11px;'><i class="bi bi-file-earmark-medical"></i> CF4 PART 1 <font size="1">[ <?php echo $caseno." - ".$namearray ?> ]</font></b></p><hr>

<form method="POST">
<table width="100%">
<tr>
<td width="60%" valign="TOP">

<div class='card teacher-card  mb-3' style="box-shadow: 0px 0px 0px 1px lightgrey;">
<div class='card-body  d-flex teacher-fulldeatil'>
<div class='profile-teacher pe-xl-4 pe-md-2 pe-sm-4 pe-0 text-center w220 mx-sm-0 mx-auto'>
<img src='../main/img/ad.png' width='70' height='70' style='border-radius: 50%; box-shadow: 0px 0px 1px 1px lightgrey;'>
<p><b style='font-size: 11px;'>Admitting Diagnosis:</b></p>
</div>
<div class='teacher-info border-start ps-xl-4 ps-md-3 ps-sm-4 ps-4 w-100'>
<textarea class="form-control" placeholder="Address" id="floatingTextarea" name="admittingdx" onkeydown="if(event.keyCode == 13){return false;}" style="height:105px; font-size:10pt; background: white; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e;"><?php echo $initialdx ?></textarea>
</div>
</div>
</div>

<div class='card teacher-card  mb-3' style="box-shadow: 0px 0px 0px 1px lightgrey;">
<div class='card-body  d-flex teacher-fulldeatil'>
<div class='profile-teacher pe-xl-4 pe-md-2 pe-sm-4 pe-0 text-center w220 mx-sm-0 mx-auto'>
<img src='../main/img/cc.jpg' width='70' height='70' style='border-radius: 50%; box-shadow: 0px 0px 1px 1px lightgrey;'>
<p><b style='font-size: 11px;'>Chief Complaint:</b></p>
</div>
<div class='teacher-info border-start ps-xl-4 ps-md-3 ps-sm-4 ps-4 w-100'>
<textarea class="form-control" placeholder="Address" id="floatingTextarea" name="chiefcomplaint" onkeydown="if(event.keyCode == 13){return false;}" style="height:105px; font-size:10pt; background: white; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e;"><?php echo $chiefcomplaint ?></textarea>
</div>
</div>
</div>

<div class='card teacher-card  mb-3' style="box-shadow: 0px 0px 0px 1px lightgrey;">
<div class='card-body  d-flex teacher-fulldeatil'>
<div class='profile-teacher pe-xl-4 pe-md-2 pe-sm-4 pe-0 text-center w220 mx-sm-0 mx-auto'>
<img src='../main/img/history.png' width='70' height='70' style='border-radius: 50%; box-shadow: 0px 0px 1px 1px lightgrey;'>
<p><b style='font-size: 11px;'>History of Present Illness:</b></p>
</div>
<div class='teacher-info border-start ps-xl-4 ps-md-3 ps-sm-4 ps-4 w-100'>
<textarea class="form-control" placeholder="Address" id="floatingTextarea" name="historyPI" onkeydown="if(event.keyCode == 13){return false;}" style="height:105px; font-size:10pt; background: white; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e;"><?php echo $historyofpresentillness ?></textarea>
</div>
</div>
</div>

<div class='card teacher-card  mb-3' style="box-shadow: 0px 0px 0px 1px lightgrey;">
<div class='card-body  d-flex teacher-fulldeatil'>
<div class='profile-teacher pe-xl-4 pe-md-2 pe-sm-4 pe-0 text-center w220 mx-sm-0 mx-auto'>
<img src='../main/img/pm.png' width='70' height='70' style='border-radius: 50%; box-shadow: 0px 0px 1px 1px lightgrey;'>
<p><b style='font-size: 11px;'>Past Medical History:</b></p>
</div>
<div class='teacher-info border-start ps-xl-4 ps-md-3 ps-sm-4 ps-4 w-100'>
<textarea class="form-control" placeholder="Address" id="floatingTextarea" name="pastMH" onkeydown="if(event.keyCode == 13){return false;}" style="height:105px; font-size:10pt; background: white; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e;"><?php echo $pastmedicalhistory ?></textarea>
</div>
</div>
</div>

<div class="card" style="box-shadow: 0px 0px 0px 1px lightgrey;">
<div class="card-body">
<table width="100%">
<tr><td colspan="2">
<div class="col-md-12">
<div class="form-floating">
<input type="text" class="form-control" id="floatingName" name="heartrate" placeholder="Aaa" style="background: white; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e;" value="<?php echo $heartrate ?>">
<label for="floatingName"><font color="red">&#128151; Heart Rate:</label>
</div>
</div>
</td></tr>

<tr><td colspan="2">
<div class="col-md-12">
<div class="form-floating">
<input type="text" class="form-control" id="floatingName" name="resprate" placeholder="Aaa" style="background: white; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e;" value="<?php echo $respiratoryrate ?>">
<label for="floatingName"><font color="red">&#129729; Respiratory Rate:</label>
</div>
</div>
</td></tr>



<tr><td colspan="2"><br><h1 style="border-bottom:1pt solid black;"></h1></td></tr>

<tr>
<td><font class='font3'>Referblue from another health care institution:</td>
<td><font color="black">

<table><tr><td>
<div class="custom-control custom-radio">
<input type="radio" id="customRadio3" name="referblue" class="custom-control-input" value="NO" onclick="myFunction()" style="height:25px; width:25px; vertical-align: middle;" <?php echo $checkno ?>>
<label class="custom-control-label" for="customRadio3">NO</label>
</div>
</td><td>&nbsp;</td><td>
<div class="custom-control custom-radio">
<input type="radio" id="customRadio4" name="referblue" class="custom-control-input" value="YES" onclick="myFunction()" style="height:25px; width:25px; vertical-align: middle;" <?php echo $checkyes ?>>
<label class="custom-control-label" for="customRadio4">YES</label>
</div>
</td></tr></table>

</td>
</tr>
<tr><td colspan="2"><h1 style="border-bottom:1pt solid black;"></h1></td></tr>

<tr><td colspan="2">
<div id="myDIV" style="display: none;">
<table width="100%">

<tr><td colspan="2">
<div class="col-md-12">
<div class="form-floating">
<input type="text" class="form-control" id="floatingName" name="reason" placeholder="Aaa" style="background: white; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e;" value="<?php echo $reason ?>">
<label for="floatingName"><font color="red">&#128129;&#127995; If yes, Specify Reason:</label>
</div>
</div>
</td></tr>

<tr><td colspan="2">
<div class="col-md-12">
<div class="form-floating">
<input type="text" class="form-control" id="floatingName" name="HCI" placeholder="Aaa" style="background: white; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e;" value="<?php echo $hci ?>">
<label for="floatingName"><font color="red">&#127970; If yes, Name of Originating HCI:</label>
</div>
</div>
</td></tr>
</table>

</div>
</td></tr>
<tr>
<td>
<input type="hidden" name="user" value="<?php echo $user ?>">
<input type="hidden" name="lastname" value="<?php echo $lastname ?>">
<input type="hidden" name="firstname" value="<?php echo $firstname ?>">
<input type="hidden" name="middlename" value="<?php echo $middlename ?>">
<input type="hidden" name="branch" value="<?php echo $branch ?>">
</td>
</tr>
</table>
</div></div>

</td><td width="2%"></td><td valign="TOP">

<br>
<div class='card' style="box-shadow: 0px 0px 0px 1px lightgrey;">
<div class='card-body'>
<div class='d-flex align-items-center justify-content-between mt-5'>
<div class='lesson_name'>
<div class='project-block light-primary-bg'>
<i class='icofont-info-circle'></i>
</div>
<span class='small project_name fw-bold'> PATIENT INFORMATION REVIEW </span>
</div>
</div>

<table width="100%" align="center">
<tr>
<td width="50%">
<font class="font8">EClaims Transmittal ID Number:
<input type="text" name='txtPerTransmittalNo' class="form-control" value="<?php echo $pHospitalTransmittalNo ?>" style='width:95%; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e; background-color: white; padding: 2px 8px;' readonly>
</td>
<td></td>
</tr>

<tr>
<td>
<font class="font8">Claim ID Number:
<input type="text" id='txtPerClaimId' name='txtPerClaimId' class="form-control" value="<?php echo $caseno ?>" style='width:95%; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e; background-color: white; padding: 2px 8px;' readonly>
</td>
<td><font class="font8">Patient PIN:
<input type="text" id='txtPerPatPIN' name='txtPerPatPIN' class="form-control" value="<?php echo $pinrel ?>" style='width:95%; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e; background-color: white; padding: 2px 8px;' readonly>
</td>
</tr>

<tr>
<td><font class="font8">Last Name:
<input type="text" id='txtPerPatLname' name='txtPerPatLname' class="form-control" value="<?php echo $lastname ?>" style='width:95%; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e; background-color: white; padding: 2px 8px;' readonly>
</td>
<td><font class="font8">First Name:
<input type="text" id='txtPerPatFname' name='txtPerPatFname' class="form-control" value="<?php echo $firstname ?>" style='width:95%; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e; background-color: white; padding: 2px 8px;' readonly>
</td>
</tr>

<tr>
<td><font class="font8">Middle Name:
<input type="text" id='txtPerPatMname' name='txtPerPatMname' class="form-control" value="<?php echo $middlename ?>" style='width:95%; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e; background-color: white; padding: 2px 8px;' readonly>
</td>
<td><font class="font8">Extension Name:
<input type="text" id='txtPerPatExtName' name='txtPerPatExtName' class="form-control" value="<?php echo $suffix ?>" style='width:95%; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e; background-color: white; padding: 2px 8px;' readonly></td>
</tr>

<tr>
<td><font class="font8">Date of Birth (mm/dd/yyyy):
<input type="text" name="transmittalidno" class="form-control" value="<?php echo $birthdate ?>" style='width:95%; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e; background-color: white; padding: 2px 8px;' readonly></td>
<td><font class="font8">Sex:
<input type="text" name='txtPerPatSex' id='txtPerPatSex' class="form-control" value="<?php echo $sex ?>" style='width:95%; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e; background-color: white; padding: 2px 8px;' readonly></td>
</tr>

<tr>
<td><font class="font8">Civil Status:
<input type="text" name='txtPerPatStatus' id='txtPerPatStatus' class="form-control" value="<?php echo $mystat ?>" style='width:95%; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e; background-color: white; padding: 2px 8px;' readonly></td>
<td><font class="font8">Patient Type:
<input type="text" name='txtPerPatType' id='txtPerPatType' class="form-control" value="<?php echo $ptype ?>" style='width:95%; box-shadow: 0 0 5px #67a6ee; border: 1px solid #16559e; background-color: white; padding: 2px 8px;' readonly></td>
</tr>

</table><br>
</div></div>

<br>

<?php if($sex=="FEMALE"){ ?>

<br>
<div class='card' style="box-shadow: 0px 0px 0px 1px lightgrey;">
<div class='card-body'>
<div class='d-flex align-items-center justify-content-between mt-5'>
<div class='lesson_name'>
<div class='project-block light-danger-bg'>
<i class='icofont-woman-in-glasses'></i>
</div>
<span class='small project_name fw-bold'> FOR FEMALE ONLY </span>
</div>
</div>

<table width="100%" align="center"><tr><td>
<font class="font8x" color="blue"><i class="bi bi-droplet"></i> MENSTRUAL HISTORY</font>
</td></tr></table>

<table width="95%" align="center">
<tr>
<td width="35%">Applicable?
<select name="mhDone" id="applicable" onchange="myFunction();" style="height:35px; font-size:11pt; width: 100%;">
<option value="<?php echo $pIsApplicable ?>" selected><?php echo $pIsApplicable2 ?></option>
<option value="<?php echo $pIsApplicable33 ?>"><?php echo $pIsApplicable3 ?></option>
</select>
</td>
<td width="3%"></td>
<td>
<div id="myDIV2" style="display: none;">
<table width="100%"><tr>
<td width="40%">Last menstrual period:
<input type="date" name='menstrualdate' id='menstrualdate' value="<?php echo $pLastMensPeriod  ?>" style="height:35px; font-size:11pt; width: 100%;">
</td>
</tr></table>
</div>
</td>
</tr>
</table><hr>


<table width="95%" align="center"><tr><td>
<font class="font8x" color="blue"><i class="bi bi-person-check"></i>  PREGNANCY HISTORY <br><small>[Please leave a zero value if not applicable]</small></font>
</td></tr></table>




<table width="95%" align="center">
<tr>
<td width="50%"><font class="font8"><font color='blue'>*</font> Gravidity (no. of pregnancy):
<input type="text" name='txtOBHistGravity' id='txtOBHistGravity' value="<?php echo $pPregCnt ?>" style="height:35px; font-size:11pt; width: 100%;" requiblue></td>
<td><font class="font8"><font color='blue'>*</font> Parity (no. of delivery):
<input type="text" name='txtOBHistParity' id='txtOBHistParity' value="<?php echo $pDeliveryCnt ?>" style="height:35px; font-size:11pt; width: 100%;" requiblue></td>
</tr>

<tr>
<td><font class="font8"><font color='blue'>*</font> No. of full term:
<input type="text" name='txtOBHistFullTerm' id='txtOBHistFullTerm' value="<?php echo $pFullTermCnt ?>" style="height:35px; font-size:11pt; width: 100%;" requiblue></td>
<td><font class="font8"><font color='blue'>*</font> No. of premature:
<input type="text" name='txtOBHistPremature' id='txtOBHistPremature' value="<?php echo $pPrematureCnt ?>" style="height:35px; font-size:11pt; width: 100%;" requiblue></td>
</tr>

<tr>
<td><font class="font8"><font color='blue'>*</font> No. of abortion:
<input type="text" name='txtOBHistAbortion' id='txtOBHistAbortion' value="<?php echo $pAbortionCnt ?>" style="height:35px; font-size:11pt; width: 100%;" requiblue></td>
<td><font class="font8"><font color='blue'>*</font> No. of living children:
<input type="text" name='txtOBHistLivingChildren' id='txtOBHistLivingChildren' value="<?php echo $pLivChildrenCnt ?>" style="height:35px; font-size:11pt; width: 100%;" requiblue></td>
</tr>
</table>

<br>
</div>
</div>

<?php } ?>

</td>
</tr>
</table>

<hr>
<p align="right"><button class="btn btn-primary btn-sm" name="btn_save"> NEXT <i class="icofont-arrow-right"></i></button></p>
</form>

</div>
</div>
</div>
</div>
</section>
</main>

<script>

function myFunction() {
if(document.getElementById("customRadio3").checked == true){
document.getElementById("myDIV").style.display = "none";
}else if(document.getElementById("customRadio4").checked == true){
document.getElementById("myDIV").style.display = "block";
}else{
document.getElementById("myDIV").style.display = "none";
}

if(document.getElementById("applicable").value == "Y"){
document.getElementById("myDIV2").style.display = "block";
document.getElementById("menstrualdate").requiblue = true;
}else{
document.getElementById("myDIV2").style.display = "none";
document.getElementById("menstrualdate").requiblue = false;
}
}
</script>


