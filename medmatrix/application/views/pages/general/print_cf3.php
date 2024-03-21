<?php
$admit=$this->Admission_model->fetch_single_admission($caseno);
$discharged=$this->Admission_model->discharged($caseno);
if($discharged['datearray']==""){
	$ddate="|    | - |    | - |      |";
	$tdate="|     |  ";
}else{
	$ddate=date('| m | - | d | - | Y |',strtotime($discharged['datearray']));
	$tdate=date('|h:i|A',strtotime($discharged['timedischarged']));
}
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
<div style="text-align: right; font-size: 12px; font-family: 'Arial Black'; border-bottom: 1px solid black;">
	This form may be reproduced and NOT FOR SALE
</div>
<div style="width: 100%">
	<table width="100%" border="0" cellpadding="1" cellspacing="0">
		<tr>
			<td width="50" style="vertical-align: middle;">
				<img src="<?=base_url();?>design/images/phic.png" width="50">
			</td>
			<td>
				<b style="font-size:18;">PhilHealth</b><br><b style="font-weight:normal; font-size:8px;">Your Partner in Health</b>
			</td>
			<td width="20%" align="center" style="font-family: 'Arial Black'; font-weight: bold;">
				<h1 style="font-size: 16px;">CF3</h1>
				<p style="font-size: 9px;"><br/>(Claim Form 3)<br/>Revised November 2013</p>
			</td>
		</tr>
	</table>
</div>
<div style="border-top: 2px solid black; border-bottom: 2px solid black; margin-top: 10px;text-align: center;">
	<font style="font-weight: bold;background-color: #FFFFFF; font-size:10px;">PART I - PATIENT`S CLINICAL RECORD </font>
</div>
<div>
	<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size:11px; font-family: Arial;">
		<tr>
			<td>
				<table width="100%" border="0" cellspacing="0" cellpadding="1" style="font-size:11px; font-family: Arial;">
					<tr>
						<td colspan="6" style="vertical-align: top;">
							1. Philhealth Accreditation No. (PAN) - Institutional Health Care Provider:
						</td>
					</tr>
					<tr>
						<td colspan="6">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="6" style="vertical-align: top;">
							2. Name of Patient
						</td>
					</tr>
					<tr>
						<td colspan="4" style="border-bottom: 1px solid black; font-weight: bold;" width="40%">
							<?=$admit['lastname'];?>, <?=$admit['firstname'];?> <?=$admit['suffix'];?> <?=$admit['middlename'];?>
						</td>
						<td width="5%">&nbsp;</td>
						<td style="border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;" width="40%">3. Chief Complaint/ Reason for Admission:</td>
					</tr>
					<tr>
						<td colspan="5" style="vertical-align: top; font-size:8px;">Last Name | First Name | Middle Name (example: Dela Cruz, Juan Jr. Sipag)</td>
						<td style="border-left:1px solid black;border-right:1px solid black; vertical-align: top;" width="40%" rowspan="6"><br>&nbsp;&nbsp;&nbsp;&nbsp;<?=$subjective['pChiefComplaint'];?></td>
					</tr>
					<tr>
						<td colspan="6">&nbsp;</td>
					</tr>
					<tr>
						<td width="17%">4. Date Admitted:</td>
						<td width="20%"><?=date('| m | - | d | - | Y |',strtotime($admit['dateadmit']));?></td>
						<td width="15%">Time Admitted:</td>
						<td width="20%"><?=date('|h:i|A',strtotime($admit['timeadmitted']));?></td>
					</tr>
					<tr>
						<td></td>
						<td style="font-size: 8px;">Month&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Day&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Year</td>
						<td></td>
						<td style="font-size: 8px;">&nbsp;hh:mm</td>
					</tr>
					<tr>
						<td colspan="6">&nbsp;</td>
					</tr>
					<tr>
						<td width="18%">5. Date Discharged:</td>
						<td width="22%"><?=$ddate;?></td>
						<td width="16%">Time Discharged:</td>
						<td width="20%"><?=$tdate;?></td>
					</tr>
					<tr>
						<td></td>
						<td style="font-size: 8px;">Month&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Day&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Year</td>
						<td></td>
						<td style="font-size: 8px;">&nbsp;hh:mm</td>
						<td></td>
						<td style="border-bottom: 1px solid black; border-right: 1px solid black; border-left:1px solid black;">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="6" style="border-bottom: 1px solid black;">&nbsp;</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top; border-bottom: 1px solid black;height: 130px;">
				6. Brief History of Present Illness/OB History:<br><br>
				<table width="100%" border="0">
					<tr>
						<td>
							<?=$subjective['pIllnessHistory'];?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top; border-bottom: 1px solid black; height: 140px;">
				7. Physical Examination (Pertinent Findings per System):<br><br>
				<table width="100%" border="0">
					<tr>
						<td width="12%">General Survey: </td>
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
						<td width="14%">Neuro Examination</td>
						<td width="2%">:</td>
						<td><b><?=$neuro;?></b></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top; border-bottom: 1px solid black; height: 280px;">
				8. Course in the Wards (Attach additional sheet if necessary):<br><br>
				<table width="100%" border="0" style="font-size: 9px;">
					<tr>
						<td align="center" width="10%">DATE</td>
						<td align="center">DOCTOR'S ORDER/ACTION</td>
					</tr>
					<?php
					foreach($courseward as $course){
						echo "<tr>";
							echo "<td align='center' style='vertical-align: top;'>".date('m/d/Y',strtotime($course['pDateAction']))."</td>";
							echo "<td>$course[pDoctorsAction]</td>";
						echo "</tr>";
					}
					?>
				</table>
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top; border-bottom: 1px solid black; height: 180px;">
				9. Pertinent Laboratory and Diagnostic Findings: (CBC, Urinalysis, Fecalysis, X-Ray, Biopsy, etc.)<br><br>
				<?php
				$labfindings=$this->Records_model->getLabFindings($caseno);
				foreach($labfindings as $findings){
					echo $findings['labfindings']."<br><br>";
				}
				?>
			</td>
		</tr>
		<?php
		$improved="";
		$transferred="";
		$hama="";
		$absconded="";
		$expired="";

		if($admit['disposition']=="IMPROVED"){
			$improved="checked='true'";
		}
		if($admit['disposition']=="TRANSFERRED"){
			$transferred="checked='true'";
		}
		if($admit['disposition']=="HAMA"){
			$hama="checked='true'";
		}
		if($admit['disposition']=="ABSCONDED"){
			$absconded="checked='true'";
		}
		if($admit['disposition']=="DIED"){
			$expired="checked='true'";
		}
		?>
		<tr>
			<td style="vertical-align: top; border-bottom: 1px solid black;">
				10. Disposition on Discharged &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" <?=$improved;?>> IMPROVED &nbsp;&nbsp;&nbsp;<input type="checkbox" <?=$transferred;?>> TRANSFERRED &nbsp;&nbsp;&nbsp;<input type="checkbox" <?=$hama;?>> HAMA &nbsp;&nbsp;&nbsp;<input type="checkbox" <?=$absconded;?>> ABSCONDED &nbsp;&nbsp;&nbsp;<input type="checkbox" <?=$expired;?>> EXPIRED
				<br>
			</td>
		</tr>
	</table>
</div>
<div style="text-align: right; font-size: 12px; font-family: 'Arial Black'; border-bottom: 1px solid black;margin-top: 10px;">
	This form may be reproduced and NOT FOR SALE
</div>
<div style="border-top: 2px solid black; border-bottom: 2px solid black; margin-top: 10px;text-align: center;">
	<font style="font-weight: bold;background-color: #FFFFFF; font-size:10px;">PART II - MATERNITY CARE PACKAGE</font>
</div>
<table width="100%" border="0" style="font-size: 10px;">
	<tr>
		<td colspan="4" style="font-size:2px;"></td>
	</tr>
	<tr>
		<td colspan="4" style="text-align: center;font-weight: bold;background-color: #FFFFFF; font-size:10px; border-top:1px solid black;border-bottom:1px solid black;">PRENATAL CONSULTATION</td>
	</tr>
	<tr>
		<td colspan="4"></td>
	</tr>
	<tr>
		<td colspan="4"><img src="<?=base_url();?>design/images/IPC.png" width="300" height="30" /></td>
	</tr>
	<tr>
		<td colspan="4">2. Clinical History and Physical Examination</td>
	</tr>
	<tr>
		<td colspan="2">a. Vital Signs are normal&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="chkbx[]" value="1" style="font-size:15px;"></td>
		<td colspan="2">c. Menstrual History&emsp;&emsp;LMP: <u><?=$preg["pLastMensPeriod"];?></u>&emsp;&emsp;Age of Menarche ________</td>
	</tr>
	<tr>
		<td colspan="2">b. Ascertain the present Pregnancy is low-Risk&emsp;&emsp;&emsp;<input type="checkbox" name="chkbx[]" value="1" style="font-size:15px;"></td>
		<td colspan="2">d. Obstetric History&emsp;&emsp;G: &emsp;<u><?=$preg["pPregCnt"];?></u>&emsp;P: &emsp;<u><?=$preg["pDeliveryCnt"];?></u>&emsp; (&emsp;<u><?=$preg["pFullTermCnt"];?></u>&emsp;,&emsp;<u><?=$preg["pPrematureCnt"];?></u>&emsp;,&emsp;<u><?=$preg["pAbortionCnt"];?></u>&emsp;,&emsp;<u><?=$preg["pLivChildrenCnt"];?></u>&emsp;)</td>
	</tr>
	<tr>
		<td colspan="3"></td>
		<td  align="left"> &emsp;T&emsp;&emsp;P&emsp;&emsp;A&emsp;&emsp;L</td>
	</tr>
	<tr>
		<td colspan="4">3. Obstetric Risk Factors</td>
	</tr>
	<tr>
		<td>
			a. Multiple Pregnancy &emsp;<input type="checkbox" name="chkbx[]" value="1" style="font-size:15px;" readonly="readonly"><br>
			b. Ovarian cyst &emsp;&emsp;&emsp;&emsp; <input type="checkbox" name="chkbx[]" value="1" style="font-size:15px;" readonly="readonly"><br>
			c. Myoma uteri &emsp;&emsp;&emsp;&emsp; <input type="checkbox" name="chkbx[]" value="1" style="font-size:15px;" readonly="readonly"><br>
		</td>
		<td>
			d. Placenta Previa&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="chkbx[]" value="1" style="font-size:15px;" readonly="readonly"><br>
			e. History of 3 miscarriage &emsp; <input type="checkbox" name="chkbx[]" value="1" style="font-size:15px;" readonly="readonly"><br>
			f. History of stillbirth&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="chkbx[]" value="1" style="font-size:15px;" readonly="readonly"><br>
		</td>
		<td colspan="2">
			g. History of pre-eclampsia &emsp;<input type="checkbox" name="chkbx[]" value="1" style="font-size:15px;" readonly="readonly"><br>
			h. History of eclampsia &emsp;&emsp;&emsp;<input type="checkbox" name="chkbx[]" value="1" style="font-size:15px;" readonly="readonly"><br>
			i. Premature contraction &emsp;&emsp; <input type="checkbox" name="chkbx[]" value="1" style="font-size:15px;" readonly="readonly"><br>
		</td>
	</tr>

	<tr>
		<td colspan="4">4. Medical/Surgical Risk Factors</td>
	</tr>
	<tr>
		<td width="20%">
			a. Hypertension&emsp;&emsp;<input type="checkbox" name="chkbx[]" value="1" style="font-size:15px;" readonly="readonly"><br>
			b. Heart Disease &emsp; <input type="checkbox" name="chkbx[]" value="1" style="font-size:15px;" readonly="readonly"><br>
			c. Diabetes &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="chkbx[]" value="1" style="font-size:15px;" readonly="readonly"><br>
		</td>
		<td>
			d. Thyroid Disorder &emsp;&emsp;&emsp;&emsp;&emsp; <input type="checkbox" name="chkbx[]" value="1" style="font-size:15px;" readonly="readonly"><br>
			e. Obesity&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="chkbx[]" value="1" style="font-size:15px;" readonly="readonly"><br>
			f. Moderate to severe asthma <input type="checkbox" name="chkbx[]" value="1" style="font-size:15px;" readonly="readonly"><br>
		</td>
		<td>
			g. Epilepsy&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="chkbx[]" value="1" style="font-size:15px;" readonly="readonly"><br>
			h. Renal disease &emsp;&emsp;&emsp;<input type="checkbox" name="chkbx[]" value="1" style="font-size:15px;" readonly="readonly"><br>
			i. Bleeding disorders &emsp;<input type="checkbox" name="chkbx[]" value="1" style="font-size:15px;" disabled="disabled"><br>
		</td>
		<td width="30%">
			j. History of previous cesarian section &emsp;<input type="checkbox" name="chkbx[]" value="1" style="font-size:15px;" readonly="readonly"><br>
			k. History of uterine myomectomy&emsp;&emsp;&emsp;<input type="checkbox" name="chkbx[]" value="1" style="font-size:15px;" readonly="readonly"><br>
		</td>
	</tr>
	<tr>
		<td colspan="4">5. Admitting Diagosis: ________________________________________________________________________________________________________________________________________________</td>
	</tr>
	<tr>
		<td colspan="4">6. Delivery Plan</td>
	</tr>
	<tr>
		<td colspan="2"> a. Orientatin to MCPA/Availment of Benefits&emsp;&emsp;&emsp;<input type="checkbox" name="chkbx[]" value="1" style="font-size:15px;" readonly="readonly">&emsp;&emsp;<input type="checkbox" name="chkbx[]" value="1" style="font-size:15px;" readonly="readonly"></td>
		<td colspan="2">
			<img src="<?=base_url();?>design/images/EDE.png" width="300" height="20" />
		</td>
	</tr>
	<tr>
		<td colspan="2" align="right">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;yes&emsp;no&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; </td>
		<td colspan="2"></td>
	</tr>
	<tr>
		<td colspan="4"><img src="<?=base_url();?>design/images/FOLLOWUPD.png" width="700" height="130" /></td>
	</tr>
	<tr>
		<td colspan="4"><img src="<?=base_url();?>design/images/DOT.png" width="700" height="140" /></td>
	</tr>
	<tr>
		<td colspan="4"><img src="<?=base_url();?>design/images/PTC.png" width="700" height="140" /></td>
	</tr>
	<tr>
		<td colspan="4"><img src="<?=base_url();?>design/images/SIGNATURE.png" width="700" height="120" /></td>
	</tr>
</table>
