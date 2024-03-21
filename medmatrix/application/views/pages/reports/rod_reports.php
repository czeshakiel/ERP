<?php
$doctor=$this->General_model->fetch_single_doctor_by_code($rod);
$rodname=$doctor['name'];
?>
<table width="100%" border="1" style="border-collapse: collapse; font-size: 12px;" cellpadding="1" cellspacing="0">
	<tr>
		<td width="18%">Residen on Duty</td>
		<td><?=$rodname;?></td>
	</tr>
</table>
<br>
<table width="100%" border="1" style="border-collapse: collapse; font-size: 12px;" cellspacing="0" cellpadding="1">
	<tr>
		<td width="3%">No.</td>
		<td>Case Number</td>
		<td>Date Admitted</td>
		<td>Patient Name</td>
		<td>Department</td>
	</tr>
	<?php
	$x=1;
	foreach($body as $item){
		$ap=$this->General_model->fetch_single_doctor_by_code($item['ap']);
		$specialization=$ap['specialization'];
		echo "<tr>";
			echo "<td>$x.</td>";
			echo "<td>$item[caseno]</td>";
			echo "<td>".date('M-d-Y',strtotime($item['dateadmit']))."</td>";
			echo "<td>$item[lastname], $item[firstname] $item[middlename] $item[suffix]</td>";
			echo "<td>$specialization</td>";
		echo "</tr>";
		$x++;
	}
	?>
</table>
