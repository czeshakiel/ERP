<?php
$subjective=$this->Records_model->getChiefComplaint($caseno);
$vital=$this->Records_model->getvitalSigns($caseno);
$bp=$vital['pSystolic']."/".$vital['pDiastolic'];
$hr=$vital['pHr'];
$rr=$vital['pRr'];
$temp=$vital['pTemp'];
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
		<tr>
			<td colspan="3"><font style="font-size: 12px;font-family: Times New Roman;">PCGH - ML Case Control No.________________</font></td>
			<td align="center"><font style="font-size: 12px;font-family: Times New Roman; text-decoration:underline;"><?=date('m/d/Y');?></font><br>Date</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px; margin-top: 10px;">
		<tr>
			<td align="center">FINAL MEDICO - LEGAL CERTIFICATE</td>
		</tr>
	</table>
	<?php
	if($patient['sex']=="M"){
		$sex="Male";
	}else{
		$sex="Female";
	}
	if($discharged['datedischarged']==""){
		$ddate="Present";
	}else{
		$ddate=$discharged['datedischarged'];
	}
	?>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px; margin-top: 10px;">
		<tr>
			<td colspan="6">
				<font style="font-family: Times New Roman;font-weight:bold">TO WHOM IT MAY CONCERN:</font>
			</td>
		</tr>
		<tr>
			<td colspan="6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This is to certify that <b><?=$patient['lastname'];?></b>, <b><?=$patient['firstname'];?> <?=$patient['suffix'];?> <?=$patient['middlename'];?></b> , <b><?=$patient['age'];?></b> years old, <b><?=$sex;?></b>, <b><?=$patient['stat1'];?></b> and a resident of
				<b><?=$patient['street'];?></b>, <b><?=$patient['barangay'];?></b>, <b><?=$patient['municipality'];?></b>, <b><?=$patient['province'];?></b> was examined, treated in this hospital with the following findings during the time of examination on<b><?=date('F d, Y',strtotime($patient['dateadmitted']));?></b>.</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px; margin-top: 10px;">
		<tr>
			<td>
				<font style="font-family: Times New Roman;font-weight:bold">ADMITTING NOTES/EMERGENCY CONSULTATION NOTES:</font>
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
				<font style="font-family: Times New Roman;font-weight:bold">AMBULATORY / BEDRIDDEN / WHEEL CHAIRED:</font>
			</td>
		</tr>
		<tr>
			<td style="padding-left: 30px;height: 20px;">
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px; margin-top: 10px;">
		<tr>
			<td>
				<font style="font-family: Times New Roman;font-weight:bold">PERTINENT FINDINGS DURING PHYSICAL EXAMINATIONS:</font>
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
				<font style="font-family: Times New Roman;font-weight:bold">MEDICOLEGAL CASES</font>
			</td>
		</tr>
		<tr>
			<td style="padding-left: 30px;"><ul><li><?=$document['medcase'];?></li></ul></td>
		</tr>
	</table><br>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px; margin-top: 10px;">
		<tr>
			<td width="5%">
				<font style="font-family: Times New Roman;font-weight:bold;">NOI:</font>
			</td>
			<td>
				<?=$document['medcase'];?>
			</td>
		</tr>
		<tr>
			<td width="5%">
				<font style="font-family: Times New Roman;font-weight:bold;">POI:</font>
			</td>
			<td>
				<?=$document['medplace'];?>
			</td>
		</tr>
		<tr>
			<td width="5%">
				<font style="font-family: Times New Roman;font-weight:bold;">TOI:</font>
			</td>
			<td>
				<!-- <?=date('H:i:s',strtotime($document['medtime']));?> -->
				<?=date('h:i A',strtotime($document['medtime']));?>
			</td>
		</tr>
		<tr>
			<td width="5%">
				<font style="font-family: Times New Roman;font-weight:bold;">DOI:</font>
			</td>
			<td>
				<?=date('M-d-Y',strtotime($document['meddate']));?>
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px; margin-top: 10px;">
		<tr>
			<td>
				<font style="font-family: Times New Roman;font-weight:bold">FINDINGS:</font>
			</td>
		</tr>
		<tr>
			<td style="height: 100px; vertical-align: top;">
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
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px; margin-top: 10px;">
		<tr>
			<td width="25%">
				<font style="font-family: Times New Roman;font-weight:bold">Advise to rest for:</font>
			</td>
			<td>
				<?=$document['medadvised'];?>
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px; margin-top: 10px;">
		<tr>
			<td width="25%">
				<font style="font-family: Times New Roman;font-weight:bold">May go back to work:</font>
			</td>
			<td>
				<?=$document['medrecommend'];?>
			</td>
		</tr>
	</table>
</div>
