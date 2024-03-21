<table width="100%" border="1" style="border-collapse: collapse; font-size: 10px;" cellspacing="0" cellpadding="1">
	<tr>
		<td width="3%" align="center"><b>No.</b></td>
		<td align="center"><b>Patient Name</b></td>
		<td align="center"><b>Date</b></td>
		<td align="center"><b>Age</b></td>
		<td align="center"><b>Doctor</b></td>
		<td align="center"><b>Diagnosis</b></td>
	</tr>
	<?php
	$x=1;
	foreach($body as $item){		
		echo "<tr>";
			echo "<td>$x.</td>";
			echo "<td>$item[lastname], $item[firstname] $item[middlename]</td>";
			echo "<td>".date('M-d-Y',strtotime($item['dateadmit']))."</td>";
			echo "<td align='center'>$item[age]</td>";
			echo "<td>DR. $item[name]</td>";
			echo "<td>$item[initialdiagnosis]</td>";
		echo "</tr>";
		$x++;
	}
	?>
</table>
