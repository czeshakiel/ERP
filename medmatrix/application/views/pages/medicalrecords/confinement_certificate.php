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
			<td colspan="4" align="center" style="font-size: 14px;">C O N F I N E M E N T &nbsp;&nbsp;&nbsp;C E R T I F I C A T E</td>
		</tr>
		<tr>
			<td colspan="4">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="4">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2"><font style="font-size: 14px;font-family: Times New Roman; text-decoration:underline;font-weight:bold"></font></td>
			<td align="right" colspan="2"><font style="font-size: 14px;font-family: Times New Roman;">Date: <?=date('m/d/Y');?></font></td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 13px; margin-top: 10px;">
		<tr>
			<td colspan="6">
				<font style="font-family: Times New Roman;font-weight:bold">TO WHOM IT MAY CONCERN:</font>
			</td>
		</tr>
		<tr>
			<td colspan="6">&nbsp;</td>
		</tr>
		<?php
		if($patient['sex']=="M"){
			$sex="Male";
		}else{
			$sex="Female";
		}
		if($discharged['datedischarged']==""){
			$ddate="Present";
		}else{
			$ddate=date('F d, Y',strtotime($discharged['datedischarged']));
		}
		?>
		<tr>
			<td colspan="6" style="text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This is to certify that <b><?=$patient['lastname'];?></b>, <b><?=$patient['firstname'];?> <?=$patient['suffix'];?> <?=$patient['middlename'];?></b> , <b><?=$patient['age'];?></b> years old, <b><?=$sex;?></b>, <b><?=$patient['stat1'];?></b> and a resident of
				<b><?=$patient['street'];?></b>, <b><?=$patient['barangay'];?></b>, <b><?=$patient['municipality'];?></b>, <b><?=$patient['province'];?></b> was examined, treated on <b><?=date('F d, Y',strtotime($patient['dateadmitted']));?></b> up to <b><?=$ddate;?></b>.</td>
		</tr>
		<tr>
			<td colspan="6">&nbsp;</td>
		</tr>
	</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px; margin-top: 10px;">
		<tr>
			<td>
				<font style="font-family: Times New Roman;font-weight:bold">Diagnosis:</font>
			</td>
		</tr>
		<tr>
			<td style="height: 70px; vertical-align: top;">
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
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size: 12px; margin-top: 20px;">
		<tr>
			<td>
				<font style="font-family: Times New Roman;font-weight:bold">Procedures:</font>
			</td>
		</tr>
		<tr>
			<td style="height: 70px; vertical-align: top;">
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
				<font style="font-family: Times New Roman;font-weight:bold">PURPOSE:</font>
			</td>
			<td>
				<?=$document['purpose'];?>
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
