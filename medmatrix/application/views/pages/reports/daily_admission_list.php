<div>
	<table width="100%" border="1" cellspacing="0" cellpadding="1" style="border-collapse:collapse; font-size:12px;font-family:Arial;">
		<tr>
			<td align="center" width="3%">No.</td>
			<td align="center" width="25%">Patient Name</td>
			<td align="center" width="5%">Age</td>
			<td align="center" width="10%">Discharged</td>
			<td align="center" width="2%"></td>
			<td align="center" width="10%">Department</td>
			<td align="center" width="10%">HRN</td>
			<td align="center" width="10%">Case No</td>
			<td align="center" width="15%">Admission Date</td>
			<td align="center" width="10%">Hospital No.</td>
		</tr>
		<?php
		$x=1;
		foreach($body as $item){
			$timeadmit=date('h:i A',strtotime($item['timeadmitted']));
			$street=$item['street'].", ";
			$barangay=$item['barangay'].", ";
			$city=$item['municipality'].", ";
			$province=$item['province'];
			$zipcode=$item['zipcode'];
			$ad=$this->General_model->fetch_single_doctor_by_code($item['ad']);
			$ap=$this->General_model->fetch_single_doctor_by_code($item['ap']);
			$caserates=$this->General_model->finalcaserate($item['caseno']);
			$finaldx="";
			if(sizeof($caserates)>0){
				foreach($caserates as $caserate){
					$finaldx .=$caserate['icdcode']." ".$caserate['description']."<br>";
				}
			}else{
				$finaldx=$item['finaldiagnosis'];
			}
			$discharged=$this->Admission_model->discharged($item['caseno']);
			if($discharged['datedischarged']==""){
				$datedischarged="";
				$timedischarged="";
			}else{
				$datedischarged=$discharged['datedischarged'];
				$timedischarged=date('h:i A',strtotime($discharged['timedischarged']));
			}
			$mem=explode('-',$item['membership']);
			if($mem[0]=='phic'){
				$member="P";
			}else{
				$member="NP";
			}
			$caseno=str_replace('I-','',$item['caseno']);
			$hrn=$this->General_model->getHRN($item['patientidno']);
			echo "<tr>";
			echo "<td>$x.</td>";
			echo "<td>$item[lastname], $item[firstname]</td>";
			echo "<td align='center'>$item[age]</td>";
			echo "<td align='center'>$item[status]</td>";
			echo "<td align='center'>$member</td>";
			echo "<td>$ap[specialization]</td>";
			echo "<td align='center'>$item[patientidno]</td>";
			echo "<td align='center'>$caseno</td>";
			echo "<td align='center'>$item[dateadmitted] $timeadmit</td>";
			echo "<td align='center'>$hrn[hrn]</td>";
			echo "</tr>";
			$x++;
		}
		?>
	</table>
</div>
