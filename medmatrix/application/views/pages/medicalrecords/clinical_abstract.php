<?php
$subjective=$this->Records_model->getChiefComplaint($caseno);
$survey=$this->Records_model->getGenSurvey($caseno);
if($survey['pGenSurveyId']=="1"){
	$surveyRem="Awake and Alert";
}else{
	$surveyRem="Altered Sensorium";
}
$vital=$this->Records_model->getvitalSigns($caseno);
$bp=$vital['pSystolic']."/".$vital['pDiastolic'];
$hr=$vital['pHr'];
$rr=$vital['pRr'];
$temp=$vital['pTemp'];
$abdomen=$this->Records_model->getAbdomen($caseno);
$heent=$this->Records_model->getHeent($caseno);
$guie=$this->Records_model->getGUIE($caseno);
$chest=$this->Records_model->getChest($caseno);
$skin=$this->Records_model->getSkin($caseno);
$heart=$this->Records_model->getHeart($caseno);
$neuro=$this->Records_model->getNeuro($caseno);
$courseward=$this->Records_model->getCourseWard($caseno);
$preg=$this->Records_model->getPregHistory($caseno);
?>
<center style="text-align:center;font-family:Arial;">
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
			<td colspan="2" align="right"><font style="font-size: 14px;font-family: Times New Roman; font-weight:bold">CLINICAL ABSTRACT</font></td>
			<td align="right" colspan="2">Date: <font style="font-size: 14px;font-family: Times New Roman; text-decoration:underline;"><?=date('m/d/Y');?></font></td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px; margin-top: 10px;">
		<tr>
			<td colspan="6">&nbsp;</td>
		</tr>
		<tr>
			<td width="7%"><b>NAME:</b></td>
			<td align="center" style="border-bottom: 1px solid black;" width="40%"><?=$patient['lastname'];?>, <?=$patient['firstname'];?> <?=$patient['middlename'];?></td>
			<td width="5%"><b>AGE:</b></td>
			<td align="center" style="border-bottom: 1px solid black;" width="5%"><?=$patient['age'];?></td>
			<td width="15%"><b>DATE OF ADMISSION:</b></td>
			<td align="center" style="border-bottom: 1px solid black; width: 10%"><?=$patient['dateadmitted'];?></td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px;">
		<tr>
			<td width="10%"><b>ADDRESS:</b></td>
			<td align="center" colspan="3" style="border-bottom: 1px solid black;" ><?=$patient['street'];?>, <?=$patient['barangay'];?>, <?=$patient['municipality'];?>, <?=$patient['province'];?> <?=$patient['zipcode'];?></td>
			<td width="20%" align="right"><b>TIME OF ADMISSION:</b></td>
			<td align="center" style="border-bottom: 1px solid black;" width="13.5%"><?=date('h:i A',strtotime($patient['timeadmitted']));?></td>
		</tr>
		<tr>
			<td width="10%">&nbsp;</td>
			<td align="center" colspan="3" >&nbsp;</td>
			<td width="20%"><b>&nbsp;DATE OF BIRTH:</b></td>
			<td align="center" style="border-bottom: 1px solid black;" width="13.5%"><?=$patient['birthdate'];?></td>
		</tr>
		<tr>
			<td width="10%">&nbsp;</td>
			<td align="center" colspan="3" >&nbsp;</td>
			<td width="20%"><b>&nbsp;CASE #:</b></td>
			<td align="center" style="border-bottom: 1px solid black;" width="13.5%"><?=$patient['employerno'];?></td>
		</tr>
	</table>
	<br>
	<table width="100%" border="0" cellpadding="1" style="font-size: 12px;" cellspacing="0">
		<tr>
			<td rowspan="2" style="border: 1px solid black; width: 40%; vertical-align: middle;" align="center">
				<u><?=$patient['admittingclerk'];?></u><br>Printed Name/Signature of Admitting Officer
			</td>
			<td style=" width: 20%; height: 50px;"></td>
			<td rowspan="2"  style="border: 1px solid black; width: 40%; vertical-align: top;">
				<b>Chief Complaint/ Reason for Admission:</b><br><br>
				&nbsp;&nbsp;<?=$subjective['pChiefComplaint'];?>
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top; border-top: 1px solid black; border-bottom: 1px solid black; height: 60px;"><b>Allergies:</b></td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px; margin-top: 10px; border: 1px solid black;">
		<tr>
			<td>
				<font style="font-family: Times New Roman;font-weight:bold; text-transform: capitalize;">BRIEF HISTORY OF ILLNESS:</font>
			</td>
		</tr>
		<tr>
			<td style="padding-left: 30px; height: 120px;">
				<?=$subjective['pIllnessHistory'];?>
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px; margin-top: 10px; border: 1px solid black;">
		<tr>
			<td>
				<font style="font-family: Times New Roman;font-weight:bold; text-transform: capitalize;">Physical Examination (PERTINENT FINDINGS per system):</font>
			</td>
		</tr>
		<tr>
			<td style="height: 120px;">
				<table width="100%" border="0" style="font-size: 10px;">
					<tr>
						<td width="14%">General Survey: </td>
						<td colspan="4"><b><?=$surveyRem;?></b></td>
					</tr>
					<tr>
						<td>Vital Signs</td>
						<td width="2%">:</td>
						<td width="50%">BP: <b><?=$bp;?> mmHg</b> &nbsp;&nbsp;&nbsp;&nbsp;HR: <b><?=$hr;?> /min </b>&nbsp;&nbsp;&nbsp;&nbsp;RR: <b><?=$rr;?> /min</b>&nbsp;&nbsp;&nbsp;&nbsp;Temp: <b><?=$temp;?> &#176;C</b></td>
						<td width="12%">Abdomen</td>
						<td width="2%">:</td>
						<td><b><?=$abdomen;?></b></td>
					</tr>
					<tr>
						<td>HEENT</td>
						<td width="2%">:</td>
						<td width="50%"><b><?=$heent;?></b></td>
						<td width="12%">GU (IE)</td>
						<td width="2%">:</td>
						<td><b><?=$guie;?></b></td>
					</tr>
					<tr>
						<td>Chest/Lung</td>
						<td width="2%">:</td>
						<td width="50%"><b><?=$chest;?></b></td>
						<td width="12%">Skin/Extrimities</td>
						<td width="2%">:</td>
						<td><b><?=$skin;?></b></td>
					</tr>
					<tr>
						<td>CVS</td>
						<td width="2%">:</td>
						<td width="50%"><b><?=$heart;?></b></td>
						<td width="13%">Neuro Examination</td>
						<td width="2%">:</td>
						<td><b><?=$neuro;?></b></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px; margin-top: 10px; border-bottom: 1px solid black;">
		<tr>
			<td>
				<font style="font-family: Times New Roman;font-weight:bold">Admitting Diagnosis:</font>
			</td>
		</tr>
		<tr>
			<td style="padding-left: 30px; height: 70px;">
				<?=$patient['initialdiagnosis'];?>
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px; margin-top: 10px; border-bottom: 1px solid black;">
		<tr>
			<td>
				<font style="font-family: Times New Roman;font-weight:bold">Final Diagnosis:</font>
			</td>
		</tr>
		<tr>
			<td style="padding-left: 30px; height: 70px;">
				<?php
				if(count($caserates)>0){
					foreach($caserates as $case){
						echo $case['icdcode']." - ".$case['description']."<br>";
					}
				}else{
					if($patient['finaldiagnosis']==""){
						echo $patient['initialdiagnosis'];
					}else{
						echo $patient['finaldiagnosis'];
					}
				}
				?>
			</td>
		</tr>
	</table>
</div>
