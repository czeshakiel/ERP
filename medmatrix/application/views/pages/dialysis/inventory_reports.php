<table width="100%" border="1" style="font-size:10px; border-collapse: collapse;">
	<tr>
		<td align='center'>CODE</td>
		<td align='center'>DESCRIPTION</td>
		<td align='center'>PATIENT NAME</td>
		<td align='center'>QUANTITY</td>
		<td align='center'>UNIT COST</td>
		<td align='center'>TOTAL</td>
		<td align='center'>TRANTYPE</td>
		<td align='center'>STATUS</td>
	</tr>
	<?php
		foreach($items as $item){
			$name=$this->Dialysis_model->getSinglePatient($item['caseno']);
			$srp=$item['quantity']*$item['sellingprice'];
			echo "<tr>
                     <td>$item[productcode]</td>
                     <td>$item[productdesc]</td>
                     <td>$name[patientname]</td>
                     <td align='center'>$item[quantity]</td>
                     <td align='right'>".number_format($item['sellingprice'],2,".",",")."</td>
                     <td align='right'>".number_format($srp,2,".",",")."</td>
                     <td align='center'>$item[trantype]</td>
                     <td align='center'>$item[status]</td>
                  </tr>
                 ";
		}
	?>
</table>
