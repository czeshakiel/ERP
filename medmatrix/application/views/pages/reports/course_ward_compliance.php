<div>
	<table width="100%" border="1" cellspacing="0" cellpadding="1" style="border-collapse:collapse; font-size:12px;font-family:Arial;">
		<tr>
			<td colspan="2" align="center" width="15%">DISCHARGED</td>
			<td rowspan="2" align="center">CASE NO</td>
			<td rowspan="2" align="center" width="20%">NAME OF PATIENT</td>
			<td rowspan="2" align="center" width="20%">ATTENDING DOCTOR</td>
			<td rowspan="2" align="center">FINAL DIAGNOSIS</td>
			<td rowspan="2" align="center">With C.I.W.</td>
			<td rowspan="2" align="center" width="15%">Done by</td>
			<td rowspan="2" align="center" width="10%">Remarks</td>
		</tr>
		<tr>
			<td align="center" width="8%">DATE</td>
			<td align="center" width="7%">TIME</td>
		</tr>
		<?php
		$x=0;
		$yes=0;
		$no=0;
		$fd_yes=0;
		$fd_no=0;
		foreach($body as $item){
			$timeadmit=date('h:i A',strtotime($item['timeadmitted']));
			$street=$item['street'].", ";
			$barangay=$item['barangay'].", ";
			$city=$item['municipality'].", ";
			$province=$item['province'];
			$zipcode=$item['zipcode'];
			$finaldx = $item['finaldiagnosis'];
			$ap=$this->General_model->fetch_single_doctor_by_code($item['ap']);
			$caserates=$this->General_model->finalcaserate($item['caseno']);
			if(sizeof($caserates)>0){
				$rate="Yes";
				$color_rate='';
				$fd_yes++;
			}else{
				$rate="No";
				$color_rate='#F57462';
				$fd_no++;
			}
			if($finaldx != ""){
				$rate="Yes";
				$color_rate='';
				$fd_yes++;
			}else{
				$rate="No";
				$color_rate='#F57462';
				$fd_no++;
			}
			$discharged=$this->Admission_model->discharged($item['caseno']);
			if($discharged['datedischarged']==""){
				$datedischarged="";
				$timedischarged="";
			}else{
				$datedischarged=$discharged['datedischarged'];
				$timedischarged=date('h:i A',strtotime($discharged['timedischarged']));
			}
			$caseno=$item['caseno'];
			$courseward=$this->Records_model->getCF4CourseWard($caseno);
			$ciwuser="";
			$ciwcount=0;
			$ciwstatus="";
			foreach($courseward as $course){
				if($course['status'] == 'No'){
					$color='#F57462';
					$no++;
				} else {
					$color='';
					$yes++;
				}
				$ciwuser=$course['user'];
				$ciwcount +=$course['ciwcount'];
				$ciwstatus = $course['status'];
			}
			echo "<tr>";
			echo "<td align='center'>$datedischarged</td>";
			echo "<td align='center'>$timedischarged</td>";
			echo "<td align='center'>$caseno</td>";
			echo "<td>$item[lastname], $item[firstname]</td>";
			echo "<td>DR. $ap[name]</td>";
			echo "<td align='center'>$rate</td>";
			echo "<td align='center'>$ciwstatus</td>";
			echo "<td>$ciwuser</td>";
			echo "<td align='center'>$ciwcount entry/s</td>";
			echo "</tr>";
			$x++;
		}
		?>
	</table>
	<table>
		<tr>
			<td>
				Total Discharged Patients: <b> <?php echo $x; ?> </b>
			</td>
		</tr>

		<tr>
			<td>
				Total CIW Yes: <?php echo "<b>".$yes." (". number_format(($yes/$x) * 100,2) . "%) </b>"; ?>
			</td>
		</tr>
		<tr>
			<td>
				Total CIW No: <b> <?php echo $no." (". number_format(($no/$x) * 100,2) . "%)"; ?> </b>
			</td>
		</tr>
		<tr>
			<td>
				&nbsp;
			</td>
		</tr>
		<tr>
			<td>
				Total No Final Caserate: <b> <?php echo $fd_no; ?> </b>
			</td>
		</tr>

	</table>
</div>
