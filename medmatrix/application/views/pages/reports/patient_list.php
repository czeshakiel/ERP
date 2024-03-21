<div>
	<table width="100%" border="1" cellspacing="0" cellpadding="1" style="border-collapse:collapse; font-size:12px;font-family:Arial;">
		<tr>
			<td align="center" width="2%"></td>
			<td align="center" width="8%">HRN</td>
			<td align="center" width="30%">PATIENT NAME</td>
			<td align="center" width="15%">ADMISSION DATE / TIME</td>
			<td align="center" width="15%">DISCHARGED DATE / TIME</td>
			<td align="center" width="15%">PROCESSED BY</td>
			<td align="center" width="15%">DATE / TIME PROCESSED</td>
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

			$discharged=$this->Admission_model->discharged($item['caseno']);
			if($discharged['datedischarged']==""){
				$datedischarged="";
				$timedischarged="";
			}else{
				$datedischarged=$discharged['datedischarged'];
				$timedischarged=date('h:i A',strtotime($discharged['timedischarged']));
			}
			$caseno=$item['caseno'];
			echo "<tr>";
			echo "<td>$x.</td>";
			echo "<td align='center'>$item[patientidno]</td>";
			echo "<td>$item[lastname], $item[firstname]</td>";
			echo "<td align='center'>".date('M-d-Y',strtotime($item['dateadmit']))." | ".date('h:i A',strtotime($item['timeadmitted']))."</td>";
			echo "<td align='center'>$datedischarged | $timedischarged</td>";
			$processby="";
			$datetimeprocess="";
			$userlogs=$this->General_model->getProcessBy($caseno);
			foreach($userlogs as $row){
				$processby=$row['loginuser'];
				$datetimeprocess=date('M-d-Y',strtotime($row['datearray']))." | ".$row['timearray'];
			}

			echo "<td>$processby</td>";
			echo "<td align='center'>$datetimeprocess</td>";
			echo "</tr>";
			$x++;
		}
		?>
	</table>
</div>
