<?php
$subjective=$this->Records_model->getChiefComplaint($caseno);
$vital=$this->Records_model->getvitalSigns($caseno);
$bp=$vital['pSystolic']."/".$vital['pDiastolic'];
$hr=$vital['pHr'];
$rr=$vital['pRr'];
$temp=$vital['pTemp'];
$ap = $this->Admission_model->fetch_single_admission($caseno);
$doctor = $this->General_model->fetch_single_doctor_by_code($ap['ap']);
?>
<div style="text-align:center;font-family:Arial;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size: 12px;">
		<tr>
			<td width="20">&nbsp;</td>
			<td width="80"><img src="<?=base_url();?>design/images/kmsci.png" width="80"></td>
			<td align="center" style="font-family:Arial;"><b style="font-size:16px;"><?=$header['heading'];?></b><br>
				<font style="font-size:13px;"><?=$header['address'];?></font><br>
				<font style="font-size:13px;">Tel No.: <?=$header['telno'];?></font></td>
			<td width="30">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="4">&nbsp;</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size: 12px;">
		<tr>
			<td colspan="2" align="right"><font style="font-size: 14px;font-family: Times New Roman; font-weight:bold">MEDICAL ABSTRACT</font></td>
			<td align="right" colspan="2">Date: <font style="font-size: 14px;font-family: Times New Roman; text-decoration:underline;"><?=date('m/d/Y');?></font></td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px; margin-top: 10px;">
		<tr>
			<td colspan="6">&nbsp;</td>
		</tr>
		<tr>
			<td width="7%"><b>NAME:</b></td>
			<td align="center" style="border-bottom: 1px solid black;" width="40%"><?=$patient['lastname'];?>, <?=$patient['firstname'];?> <?=$patient['middlename'];?> <?=$patient['suffix'];?></td>
			<td width="5%"><b>AGE:</b></td>
			<td align="center" style="border-bottom: 1px solid black;"><?=$patient['age'];?></td>
			<td width="5%"><b>SEX:</b></td>
			<?php
			if($patient['sex']=="M"){
				$sex="Male";
			}else{
				$sex="Female";
			}
			?>
			<td align="center" style="border-bottom: 1px solid black;"><?=$sex;?></td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px;">
		<tr>
			<td width="10%"><b>ADDRESS:</b></td>
			<td align="center" colspan="3" style="border-bottom: 1px solid black;"><?=$patient['street'];?>, <?=$patient['barangay'];?>, <?=$patient['municipality'];?>, <?=$patient['province'];?> <?=$patient['zipcode'];?></td>
			<td width="16%"><b>DATE OF BIRTH:</b></td>
			<td align="center" style="border-bottom: 1px solid black;" width="15%"><?=$patient['birthdate'];?></td>
		</tr>
	</table>
	<?php
	if($discharged['datedischarged']==""){
		$ddate="Present";
	}else{
		$ddate=$discharged['datedischarged'];
	}
	?>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px;">
		<tr>
			<td width="21%"><b>Period of Confinement:</b></td>
			<td style="border-bottom: 1px solid black;"><?=$patient['dateadmitted'];?> to <?=$ddate;?></td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px; margin-top: 10px;">
		<tr>
			<td>
				<font style="font-family: Times New Roman;font-weight:bold">BRIEF HISTORY OF ILLNESS:</font>
			</td>
		</tr>
		<tr>
			<td style="padding-left: 30px;">
				<?=$subjective['pIllnessHistory'];?>
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px; margin-top: 10px;">
		<tr>
			<td>
				<font style="font-family: Times New Roman;font-weight:bold">PERTINENT PHYSICAL FINDINGS:</font>
			</td>
		</tr>
		<tr>
			<td style="padding-left: 30px;">
				BP: <?=$bp;?> mmHg &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				CR: <?=$hr;?> /min &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				RR: <?=$rr;?> /min &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Temp: <?=$temp;?> &#176;C
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px; margin-top: 10px;">
		<tr>
			<td>
				<font style="font-family: Times New Roman;font-weight:bold">DIAGNOSIS / FINDINGS:</font>
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top;">
				<?php
				// if(count($caserates)>0){
				// 	foreach($caserates as $case){
				// 		echo $case['icdcode']." - ".$case['description']."<br>";
				// 	}
				// }else{
					if($patient['finaldiagnosis']==""){
						echo $patient['initialdiagnosis'];
					}else{
						echo $patient['finaldiagnosis'];
					}
				//}
				?>
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px; margin-top: 10px;">
		<tr>
			<td>
				<font style="font-family: Times New Roman;font-weight:bold">MEDICATION:</font>
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top;height: 50px;">
				<?php
				$results = $this->Records_model->getAllChargesMeds($caseno,'MEDICINE');
				foreach($results as $res){
					echo $res['productdesc'].", ";
				}
				?>
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px; margin-top: 10px;">
		<tr>
			<td>
				<font style="font-family: Times New Roman;font-weight:bold">LABORATORIES AND IMAGING PROCEDURES DONE:</font>
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top; height: 50px;">
				<?php
				$results = $this->Records_model->getLabResult($caseno,'LABORATORY');
				foreach($results as $res){
					echo $res['productdesc'].", ";
				}
				$results = $this->Records_model->getLabResult($caseno,'XRAY');
				foreach($results as $res){
					echo $res['productdesc'].", ";
				}
				$results = $this->Records_model->getLabResult($caseno,'ULTRASOUND');
				foreach($results as $res){
					echo $res['productdesc'].", ";
				}
				$results = $this->Records_model->getLabResult($caseno,'CT SCAN');
				foreach($results as $res){
					echo $res['productdesc'].", ";
				}
				$results = $this->Records_model->getLabResult($caseno,'EEG');
				foreach($results as $res){
					echo $res['productdesc'].", ";
				}
				?>
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px; margin-top: 20px;">
		<tr>
			<td>
				<font style="font-family: Times New Roman;font-weight:bold">OPERATION PERFORMED:</font>
			</td>
		</tr>
		<tr>
			<td style="height: 30px; vertical-align: top;">
				<?php
				if(count($surgical)>0){
					foreach($surgical as $case){
						echo $case['icdcode']." - ".$case['description']."<br>";
					}
				}else{
					echo "NONE";
				}
				?>
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px; margin-top: 30px;">
		<tr>
			<td width="10%" style="vertical-align: top;">
				<font style="font-family: Times New Roman;font-weight:bold">NOTE:</font>
			</td>
			<td style="height:50px;">
				<b>NOT VALID FOR MEDICO-LEGAL CASES<br>
					A MARK, ERASURES, OR ALTERATION OF ANY ENTRY INVALIDATES THIS CERTIFICATION.</b>
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px; margin-top: 10px;">
		<tr>
			<td width="10%">
				<font style="font-family: Times New Roman;font-weight:bold">PURPOSE:</font>
			</td>
			<td>
				<u><?=$document['purpose'];?></u>
			</td>
		</tr>
	</table>
</div>
<br><br>
<div>
        <table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size:12px;font-weight:bold;">
            <tr>
            	<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3" style="height: 20px;"><b>VERIFIED BY:</b></td>
			</tr>
			<tr>
				<td></td>
				<td width="20%">&nbsp;</td>
				<td align="right" ><u><?=$doctor['name'];?>,M.D.</u></td>
			</tr>
			<tr>
				<td><b><u>JESSA LOU P. GOMEZ</u></b></td>
				<td width="20%">&nbsp;</td>
				<td align="right">Attending Physician</td>
			</tr>
			<tr>
				<td>Medical Records Officer</td>
				<td width="20%">&nbsp;</td>
				<td align="right">License No.: <u><?=$doctor['licenseno'];?></u></td>
			</tr>
			<tr>
				<td><b>CERTIFIED CORRECT PER RECORD</b></td>
				<td width="20%">&nbsp;</td>
				<td align="right">PTR No.: <u><?=$doctor['ptrno'];?></u></td>
			</tr>
            </table>
        </div>