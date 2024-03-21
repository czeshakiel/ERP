<div>
	<table width="100%" border="1" cellspacing="0" cellpadding="1" style="border-collapse:collapse; font-size:12px;font-family:Arial;">
		<tr>
			<td align="center">No.</td>
			<td align="center">HRN</td>
			<td align="center">Case No</td>
			<td align="center">MR Locator</td>
			<td align="center">Patient Name</td>
			<td align="center">Sex</td>
			<td align="center">Birthdate & Time</td>
			<td align="center">Mother's Name</td>
			<td align="center">Address</td>
			<td align="center">Discharged Date</td>
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
			$caseno=str_replace('I-','',$item['caseno']);
			echo "<tr>";
			echo "<td>$x.</td>";
			echo "<td align='center'>$item[patientidno]</td>";
			echo "<td align='center'>$caseno</td>";
			echo "<td align='center'>$item[employerno]</td>";
			echo "<td>$item[lastname], $item[firstname]</td>";
			echo "<td align='center'>$item[sex]</td>";
			echo "<td>".date('M-d-Y',strtotime($item['dateadmit']))." ".date('h:i A',strtotime($item['timeadmitted']))."</td>";
			echo "<td>$item[firstnamed]</td>";
			echo "<td>$street, $barangay, $city, $province $zipcode</td>";
			echo "<td align='center'>$datedischarged</td>";
			echo "</tr>";
			$x++;
		}
		?>
	</table>
</div>
