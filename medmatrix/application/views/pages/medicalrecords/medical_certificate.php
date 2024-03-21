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
			<td colspan="3"><font style="font-size: 14px;font-family: Times New Roman; text-decoration:underline;font-weight:bold">MEDICAL CERTIFICATE</font></td>
			<td align="center"><font style="font-size: 14px;font-family: Times New Roman; text-decoration:underline;"><?=date('m/d/Y');?></font><br>Date</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px; margin-top: 10px;">
		<tr>
			<td colspan="6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<font style="font-family: Times New Roman;font-weight:bold">TO WHOM IT MAY CONCERN:</font>
			</td>
		</tr>
		<tr>
			<td colspan="6">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This is to certify that the person named hereunder has the records of confinement/consultation and treatment in this hospital:</td>
		</tr>
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
			<td width="8%"><b>STATUS:</b></td>
			<td align="center" style="border-bottom: 1px solid black;" width="15%"><?=$patient['stat1'];?></td>
			<td width="10%"><b>ADDRESS:</b></td>
			<td align="center" colspan="3" style="border-bottom: 1px solid black;"><?=$patient['street'];?>, <?=$patient['barangay'];?>, <?=$patient['municipality'];?>, <?=$patient['province'];?> <?=$patient['zipcode'];?></td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px; margin-top: 10px;">
		<tr>
			<td colspan="2">
				<font style="font-family: Times New Roman;font-weight:bold">RECORDS OF CONFINEMENT/CONSULTATION:</font>
			</td>
		</tr>
		<tr>
			<td width="20%">In-Patient Record No.:</td>
			<td align="center" style="border-bottom: 1px solid black;"><?=$patient['patientidno'];?></td>
		</tr>
		<?php
		if($discharged['datedischarged']==""){
			$ddate="Present";
			$dtime="";
		}else{
			$ddate=$discharged['datedischarged'];
			$dtime=$discharged['timedischarged'];
		}
		?>
		<tr>
			<td width="20%">Period of Confinement:</td>
			<td align="center" style="border-bottom: 1px solid black;"><?=$patient['dateadmitted'];?> <?=date("H:i A",strtotime($patient['timeadmitted']));?> to <?=$ddate;?> <?=date("H:i A",strtotime($dtime));?></td>
		</tr>
		<tr>
			<td width="20%">Date of Consultation:</td>
			<td align="center" style="border-bottom: 1px solid black;"><?=$patient['dateadmitted'];?></td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px; margin-top: 10px;">
		<tr>
			<td>
				<font style="font-family: Times New Roman;font-weight:bold">DIAGNOSIS / FINDINGS:</font>
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
			<td width="10%">
				<font style="font-family: Times New Roman;font-weight:bold">PURPOSE:</font>
			</td>
			<td style="border-bottom: 1px solid black">
				<?=$document['purpose'];?>
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
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px; margin-top: 10px;">
		<tr>
			<td width="10%">
				<font style="font-family: Times New Roman;font-weight:bold">REMARKS:</font>
			</td>
			<td style="border-bottom: 1px solid black">
				<?=$document['recommendation'];?>
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px; margin-top: 30px;">
		<tr>
			<td width="10%" style="vertical-align: top;">
				<font style="font-family: Times New Roman;font-weight:bold">NOTE:</font>
			</td>
			<td>
				<b>NOT VALID FOR MEDICO-LEGAL CASES<br>
					A MARK, ERASURES, OR ALTERATION OF ANY ENTRY INVALIDATES THIS CERTIFICATION.</b>
			</td>
		</tr>
	</table>
</div>
