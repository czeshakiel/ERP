<div>
	<table width="100%" border="1" cellpadding="1" cellspacing="0" style="border-collapse: collapse;font-size: 11px;">
		<tr>
			<td align="center">Room</td>
			<td align="center">Name of Patient</td>
			<td align="center">Age</td>
			<td align="center">Religion</td>
			<td align="center">Admitting Diagnosis</td>
			<td align="center">Diet</td>
		</tr>
		<?php
		foreach($body AS $item){
			$diet=$this->Dietary_model->getSingleDiet($item['caseno']);
			if($diet['description']==""){
				$description=$item['diet'];
			}else{
				$description=$diet['description'];
			}
			echo "<tr>";
			echo "<td>$item[room]</td>";
			echo "<td>$item[patientname]</td>";
			echo "<td>$item[age]</td>";
			echo "<td>$item[religion]</td>";
			echo "<td>$item[initialdiagnosis]</td>";
			echo "<td>$description</td>";
			echo "</tr>";
		}
		?>
	</table>
</div>
