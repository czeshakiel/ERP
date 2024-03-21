<table border="1" cellspacing="0" cellpadding="1" width="100%" style="font-size: 9px; margin-top: 5px; border-collapse: collapse;">
	<tr>
		<td width="12%" align="center"><b># of Adm.</b></td>
		<td align="center" width="29%" colspan="2"><b>Date/Time Admit</b></td>
		<td align="center" width="29%" colspan="2"><b>Date/Time Disc</b></td>
		<td align="center" width="33%"><b>Doctor</b></td>
	</tr>
	<?php
	$x=1;
	foreach($body as$item){
		$discharged=$this->Admission_model->discharged($item['caseno']);
		if($discharged['datedischarged']==""){
			$ddate="";
			$dtime="";
		}else{
			$ddate=$discharged['datedischarged'];
			$dtime=date('h`:i A',strtotime($discharged['timedischarged']));
		}
		$ap=$this->General_model->fetch_single_doctor_by_code($item['ap']);
		echo "<tr>";
			echo "<td align='center'>$x</td>";
			echo "<td width='15%' align='center'>$item[dateadmitted]</td>";
			echo "<td width='14%' align='center'>".date('h:i A',strtotime($item['timeadmitted']))."</td>";
			echo "<td width='15%' align='center'>$ddate</td>";
			echo "<td width='14%' align='center'>$dtime</td>";
		echo "<td >DR. $ap[name]</td>";
		echo "</tr>";
		$x++;
	}
	?>
</table>
